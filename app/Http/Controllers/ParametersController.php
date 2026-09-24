<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ParametersController extends Controller
{
    public function index()
    {
        $parameters = (new Parameter())->newQuery();

        if (request()->has('search')) {
            $parameters->where('description', 'Like', '%' . request()->input('search') . '%');
        }
        $parameters = $parameters->get();

        $formatted = [];

        foreach ($parameters as $parameter) {
            $json_query_data = [];
            if ($parameter->control_type == 'sq') {
                $json_query_data = $this->getSubQuery($parameter->json_query_data);
            } else {
                $data = json_decode($parameter->json_query_data);
                // Verifica si la decodificación fue exitosa
                if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                    // El JSON es inválido
                    $json_query_data = null;
                } else {
                    $json_query_data = $parameter->json_query_data;
                }
            }

            // Verificar estado de sincronizacion para archivos (P000026, P000027)
            $sync_status = $this->getFileSyncStatus($parameter);

            array_push($formatted, [
                'id' => $parameter->id,
                'parameter_code' => $parameter->parameter_code,
                'description' => $parameter->description,
                'control_type' => $parameter->control_type,
                'json_query_data' => $json_query_data,
                'value_default' => $parameter->value_default,
                'sync_status' => $sync_status,
                'selected_values' => $this->selectedValues($parameter) ?? [],
            ]);
        }
        //dd($formatted);
        return Inertia::render('Parameters/List', [
            'parameters' => $formatted
        ]);
    }

    public function create()
    {
        return Inertia::render('Parameters/Create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'parameter_code'        => 'required|max:10',
            'parameter_code'        => 'unique:parameters,parameter_code',
            'description'           => 'required|max:255',
            'control_type'          => 'required',
            'value_default'         => 'required'
        ]);

        $valor_seguro = $request->get('value_default');

        if($request->get('control_type') == 'tx'){
            $value_default = $request->get('value_default');
            // Convertir los caracteres especiales a entidades HTML
            $valor_seguro = htmlspecialchars($value_default, ENT_QUOTES, 'UTF-8');
        }

        Parameter::create([
            'parameter_code'        => $request->get('parameter_code'),
            'description'           => $request->get('description'),
            'control_type'          => $request->get('control_type'),
            'json_query_data'       => $request->get('json_query_data'),
            'value_default'         => $valor_seguro
        ]);
    }

    public function edit($id)
    {
        $parameter = Parameter::find($id);
        return Inertia::render('Parameters/Edit', [
            'parameter' => $parameter
        ]);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'parameter_code'        => 'required|max:10',
            'parameter_code'        => 'unique:parameters,parameter_code,' . $id,
            'description'           => 'required|max:255',
            'control_type'          => 'required',
            'value_default'         => 'required'
        ]);

        $valor_seguro = $request->get('value_default');

        if($request->get('control_type') == 'tx'){
            $value_default = $request->get('value_default');
            // Convertir los caracteres especiales a entidades HTML
            $valor_seguro = htmlspecialchars($value_default, ENT_QUOTES, 'UTF-8');
        }

        $parameter = Parameter::find($id);
        $parameter->update([
            'parameter_code'        => $request->get('parameter_code'),
            'description'           => $request->get('description'),
            'control_type'          => $request->get('control_type'),
            'json_query_data'       => $request->get('json_query_data'),
            'value_default'         => $valor_seguro
        ]);

        // Invalidar caches que dependen de valores de parametros (ej: API Key de OpenAI en P000025)
        Cache::forget('academic:openai-api-key:' . $request->get('parameter_code'));
        Log::info('Parametro actualizado, cache de API key invalidada', ['parameter_code' => $request->get('parameter_code')]);

        // Sincronizar archivos (robots.txt, llms.txt)
        $this->syncFileFromParameter($parameter);
    }

    public function getSubQuery($json_query_data)
    {
        $result  = DB::select($json_query_data);

        return json_encode($result);
    }

    /**
     * Guarda el valor por defecto de un parametro desde la lista de parametros.
     *
     * El valor viaja en el cuerpo de la peticion (no en la URL) para admitir
     * textareas largos (robots.txt, llms.txt) y multiselecciones como JSON.
     *
     * Reemplaza al antiguo updateDefaultValue(), que era un GET de dos segmentos
     * ({id}/{val}) al que el axios.post() del front nunca podia apuntar: guardar
     * cualquier parametro desde la lista respondia 405.
     */
    public function updateDefaultValuePost(Request $request, $id)
    {
        $parameter = Parameter::findOrFail($id);

        $value = $request->input('value', $request->input('value_default', ''));

        // Multiseleccion (chq/chj): el front manda el arreglo de opciones marcadas.
        if (is_array($value)) {
            $value = json_encode(array_values($value));
        }

        $parameter->update([
            'value_default' => $value,
        ]);

        // Invalidar caches que dependen de valores de parametros (ej: API Key de OpenAI en P000025)
        Cache::forget('academic:openai-api-key:' . $parameter->parameter_code);

        // Sincronizar archivos (robots.txt, llms.txt)
        $this->syncFileFromParameter($parameter);

        return response()->json([
            'success' => true,
            'value_default' => $parameter->value_default,
            'selected_values' => $this->selectedValues($parameter) ?? [],
        ]);
    }

    /**
     * Opciones marcadas de los parametros de multiseleccion (chq/chj).
     * Se guardan como JSON en value_default y el front las espera decodificadas.
     */
    private function selectedValues(Parameter $parameter): ?array
    {
        if (!in_array($parameter->control_type, ['chq', 'chj'], true)) {
            return null;
        }

        $decoded = json_decode((string) $parameter->value_default, true);

        return is_array($decoded) ? array_values($decoded) : [];
    }

    /**
     * Sincroniza el contenido del parametro con su archivo correspondiente en public/.
     * Aplica solo para P000026 (robots.txt) y P000027 (llms.txt).
     */
    private function syncFileFromParameter(Parameter $parameter): void
    {
        $fileMap = [
            'P000026' => 'robots.txt',
            'P000027' => 'llms.txt',
        ];

        if (!isset($fileMap[$parameter->parameter_code])) {
            return;
        }

        $fileName = $fileMap[$parameter->parameter_code];
        $filePath = public_path($fileName);
        $content = $parameter->value_default ?? '';

        try {
            File::put($filePath, $content);
            Log::info("Archivo {$fileName} sincronizado desde parametro {$parameter->parameter_code}");
        } catch (\Exception $e) {
            Log::error("Error al sincronizar {$fileName}: " . $e->getMessage());
        }
    }

    /**
     * Verifica si el valor del parametro coincide con el contenido del archivo.
     * Retorna 'Actualizado' si coinciden, 'Pendiente' si son diferentes, o null si no aplica.
     */
    private function getFileSyncStatus(Parameter $parameter): ?string
    {
        $fileMap = [
            'P000026' => 'robots.txt',
            'P000027' => 'llms.txt',
        ];

        if (!isset($fileMap[$parameter->parameter_code])) {
            return null;
        }

        $fileName = $fileMap[$parameter->parameter_code];
        $filePath = public_path($fileName);

        if (!File::exists($filePath)) {
            return 'Pendiente';
        }

        $fileContent = File::get($filePath);
        $paramContent = $parameter->value_default ?? '';

        // Normalizar saltos de linea para comparacion
        $fileContentNormalized = str_replace("\r\n", "\n", $fileContent);
        $paramContentNormalized = str_replace("\r\n", "\n", $paramContent);

        return $fileContentNormalized === $paramContentNormalized ? 'Actualizado' : 'Pendiente';
    }
}
