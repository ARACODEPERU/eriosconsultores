<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\CMS\Entities\CmsSection;
use Modules\Onlineshop\Entities\OnliItem;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaCourseLanding;
use Modules\Academic\Entities\AcaCategoryCourse;
use Modules\Onlineshop\Entities\OnliSale;
use Modules\Onlineshop\Entities\OnliSaleDetail;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Mail\StudentRegistrationMailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmPurchaseMail;
use Carbon\Carbon;
use Modules\Academic\Entities\AcaStudent;
use Modules\Academic\Entities\AcaCapRegistration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class WebPageController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function courses()
    {
        $courses = OnliItem::with('course.category', 'course.modality')
            ->where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        $categories = $courses
            ->map(function ($c) {
                return $c->category_description ?: optional(optional($c->course)->category)->description;
            })
            ->filter()
            ->unique()
            ->values();

        return view('pages.courses', [
            'courses'    => $courses,
            'categories' => $categories,
        ]);
    }

    /**
     * Ficha pública de un curso: /curso/{slug}.
     *
     * El slug canónico lo decide AcaCourse::publicSlug() (slug de la landing
     * publicada o, si no hay landing, el del nombre del curso). Para no romper
     * enlaces ya publicados se aceptan además el id numérico del curso y el id o
     * el nombre-convertido-a-slug del artículo de tienda; este último es el mismo
     * patrón que usa globalcpa, donde /curso/{id} resuelve por url_slug.
     */
    public function coursedescription(string $slug)
    {
        $course = $this->findPublicCourse($slug);

        abort_unless($course, 404);

        $canonical = $course->publicSlug();

        if ($canonical && $canonical !== $slug) {
            $query = request()->getQueryString();

            return redirect()->to(
                route('web_course_description', ['slug' => $canonical]) . ($query ? '?' . $query : ''),
                301
            );
        }

        $item = $this->shopItemFor($course);

        return view('pages.curso-descripcion', [
            'course'  => $course,
            'item'    => $item,
            'slug'    => $canonical ?: $slug,
            'public'  => $this->publicCourseData($course, $item),
            'related' => $this->relatedPublicCourses($course),
        ]);
    }

    /** Detalle por id de artículo (ruta antigua): resuelve con el mismo buscador. */
    public function cursodescripcion($id)
    {
        return $this->coursedescription((string) $id);
    }

    /**
     * Curso público que corresponde a un slug, solo entre cursos activos:
     * landing -> id del curso -> nombre del curso -> artículo de tienda.
     */
    private function findPublicCourse(string $slug): ?AcaCourse
    {
        $slug = trim($slug);

        if ($slug === '') {
            return null;
        }

        $courseQuery = fn () => AcaCourse::query()
            ->where('status', true)
            ->with(['landing', 'category', 'modality', 'modules.themes', 'teachers.teacher.person.resumes', 'brochure']);

        // 1. Slug de la landing del curso (los enlaces de campaña ya publicados).
        if ($courseId = AcaCourseLanding::query()->where('url_slug', $slug)->value('course_id')) {
            if ($course = $courseQuery()->whereKey($courseId)->first()) {
                return $course;
            }
        }

        // 2. Id numérico del curso.
        if (ctype_digit($slug) && ($course = $courseQuery()->whereKey((int) $slug)->first())) {
            return $course;
        }

        // 3. Slug del nombre del curso. La comparación va en PHP porque Str::slug
        //    translitera los acentos y un REPLACE() en SQL no.
        if ($course = $courseQuery()->get()->first(fn (AcaCourse $c) => $c->publicSlug() === $slug)) {
            return $course;
        }

        // 4. Enlaces de la tienda: id o nombre del artículo convertido a slug.
        $item = ctype_digit($slug)
            ? OnliItem::query()->where('status', true)->whereKey((int) $slug)->first()
            : OnliItem::query()->where('status', true)->get()
                ->first(fn (OnliItem $i) => Str::slug((string) $i->name) === $slug);

        if ($item && $item->item_id && ($course = $courseQuery()->whereKey($item->item_id)->first())) {
            return $course;
        }

        return null;
    }

    /** Artículo de tienda publicado del curso (precio de venta, portada y carrito). */
    private function shopItemFor(AcaCourse $course): ?OnliItem
    {
        return OnliItem::query()
            ->where('status', true)
            ->where('item_id', $course->getKey())
            ->first();
    }

    /**
     * Datos de presentación de la ficha, ya resueltos para la vista: el curso
     * manda y el artículo de tienda enriquece (nombre comercial, portada y precio
     * de venta) cuando existe, así que un curso sin artículo también se publica.
     *
     * @return array<string, mixed>
     */
    private function publicCourseData(AcaCourse $course, ?OnliItem $item): array
    {
        $title = $item->name ?? null;
        $title = filled($title) ? $title : ($course->certificate_title ?: $course->description);

        $image = $item && filled($item->getRawOriginal('image'))
            ? $item->image
            : (filled($course->image) ? asset('storage/' . $course->image) : null);

        $pricing = $this->effectivePrice(
            $item->price ?? $course->price,
            $item->discount ?? $course->discount
        );

        $description = $this->publicDescription($course, $item);

        return [
            'title'            => $title,
            'category'         => $course->category?->description ?: ($item->category_description ?? null) ?: 'General',
            'image'            => $image,
            'price'            => $pricing['value'] > 0 ? 'S/ ' . number_format($pricing['value'], 2) : 'Consultar',
            'price_old'        => $pricing['old'] ? 'S/ ' . number_format($pricing['old'], 2) : null,
            'price_value'      => $pricing['value'],
            'has_price'        => $pricing['value'] > 0,
            'description'      => $description['text'],
            'description_html' => $description['html'],
            'whatsapp'         => $course->landing?->whatsapp_link ?: 'https://wa.link/9q9g9v',
            'meta_title'       => $title . ' — Curso',
            'meta_description' => Str::limit(
                $description['text'] ?: ('Curso de ' . $title . ' de ERIOS CONSULTORES: temario, docentes, modalidad e inversión.'),
                155
            ),
        ];
    }

    /**
     * Texto público de la ficha: descripción de la tienda (HTML ya curado) ->
     * secciones de la landing -> descripción del certificado del curso.
     *
     * @return array{text: string, html: ?string}
     */
    private function publicDescription(AcaCourse $course, ?OnliItem $item): array
    {
        if ($item && filled(strip_tags((string) $item->description))) {
            return ['text' => trim(strip_tags((string) $item->description)), 'html' => (string) $item->description];
        }

        foreach (['professional_section', 'problem_section', 'study_plan_section', 'results_section'] as $section) {
            $text = trim(strip_tags((string) data_get($course->landing?->{$section}, 'description')));

            if ($text !== '') {
                return ['text' => $text, 'html' => null];
            }
        }

        return ['text' => trim((string) $course->certificate_description), 'html' => null];
    }

    /**
     * Cursos relacionados de la ficha, ya resueltos a datos de tarjeta para que
     * la vista no tenga que conocer los modelos ni la dualidad curso/artículo.
     *
     * @return Collection<int, array<string, mixed>>
     */
    private function relatedPublicCourses(AcaCourse $course, int $take = 3): Collection
    {
        return AcaCourse::query()
            ->where('status', true)
            ->whereKeyNot($course->getKey())
            ->with(['landing', 'category'])
            ->latest('id')
            ->take($take)
            ->get()
            ->map(function (AcaCourse $related) {
                $pricing = $this->effectivePrice($related->price, $related->discount);

                return [
                    'title' => $related->certificate_title ?: $related->description,
                    'slug'  => $related->publicSlug(),
                    'image' => filled($related->image) ? asset('storage/' . $related->image) : null,
                    'meta'  => ($related->category?->description ?: 'Curso') . ' · '
                        . ($pricing['value'] > 0 ? 'S/ ' . number_format($pricing['value'], 0) : 'Consultar'),
                ];
            })
            ->filter(fn (array $card) => filled($card['slug']) && filled($card['title']))
            ->values();
    }

    /**
     * Precio de venta y precio tachado: aplica el descuento solo si es menor que
     * el precio, igual que hacía la ficha antes de este cambio.
     *
     * @return array{value: float, old: ?float}
     */
    private function effectivePrice($price, $discount): array
    {
        $price = (float) $price;
        $discount = (float) $discount;

        if ($discount > 0 && $discount < $price) {
            return ['value' => $discount, 'old' => $price];
        }

        return ['value' => $price, 'old' => null];
    }

    public function servicios()
    {

        $banner = CmsSection::where('component_id', 'cursos_banner_area_14')  //siempre cambiar el id del componente
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->first();

        $title = CmsSection::where('component_id', 'cursos_titulo_area_15')  //siempre cambiar el id del componente
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();

        return view('pages.servicios', [
            'banner' => $banner,
            'title' => $title
        ]);
    }


    public function teachers()
    {
        return view('pages.teachers');
    }

    public function contact()
    {
        // $banner = CmsSection::where('component_id', 'nosotros_banner_area_11')  //siempre cambiar el id del componente
        //     ->join('cms_section_items', 'section_id', 'cms_sections.id')
        //     ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
        //     ->select(
        //         'cms_items.content',
        //         'cms_section_items.position'
        //     )
        //     ->orderBy('cms_section_items.position')
        //     ->first();

        // $title = CmsSection::where('component_id', 'header_area_1')  //siempre cambiar el id del componente
        //     ->join('cms_section_items', 'section_id', 'cms_sections.id')
        //     ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
        //     ->select(
        //         'cms_items.content',
        //         'cms_section_items.position'
        //     )
        //     ->orderBy('cms_section_items.position')
        //     ->get();


        // return view('pages.contacto', [
        //     'banner' => $banner,
        //     'title' => $title
        // ]);

        return view('pages.contact');
    }

    public function privacypolicies()
    {
        return view('pages/privacy-policies');
    }

    public function returnpolicies()
    {
        return view('pages/return-policy');
    }


    public function carrito()
    {
        return view('pages.shop-cart');
    }

    public function pagar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'names' => 'required|string|max:255',
            'app' => 'required|string|max:255',
            'apm' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'dni' => 'required|numeric|unique:people,number',
            'phone' => 'required|string|max:255',
            'email' => 'required|unique:people,email',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $productids = $request->get('item_id');

        $comprador_nombre = $request->get('names');
        $comprador_telefono = $request->get('phone');
        $comprador_email = $request->get('email');

        $preference_id = null;
        try {
            DB::beginTransaction();
            MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));
            $client = new PreferenceClient();
            $items = [];
            $products = [];
            $total = 0;

            $person = Person::create([
                'document_type_id' => $request->get('type'),
                'short_name' => $comprador_nombre,
                'full_name' => $comprador_nombre . ' ' . $request->get('app') . ' ' . $request->get('apm'),
                'number' => $request->get('dni'),
                'telephone' => $comprador_telefono,
                'email' => $comprador_email,
                'is_provider' => false,
                'is_client' => true,
                'names' => $comprador_nombre,
                'father_lastname' => $request->get('app'),
                'mother_lastname' => $request->get('apm'),
                'gender' => 'M',
                'status' => true
            ]);

            $user = User::firstOrNew(['email' => $person->email]);

            if ($user->exists) {
                // El usuario ya existe, redirige al usuario a iniciar sesión
                if (Auth::check()) {
                } else {
                    return redirect()->route('login')->with('message', 'Este correo electrónico ya está registrado. Por favor, inicia sesión.');
                }
            } else {
                $user = User::create([
                    'name' => $person->names,
                    'email' => $person->email,
                    'password' => Hash::make($person->number),
                    'person_id' => $person->id
                ]);
                Auth::login($user);
                //asignar el rol de estudiante....
                if (!$user->hasRole('Alumno')) {
                    $role = Role::where('name', 'Alumno')->first();
                    $user->assignRole($role);
                }
            }

            $sale = OnliSale::create([
                'module_name'                   => 'Onlineshop',
                'person_id'                     => $person->id,
                'clie_full_name'                => $comprador_nombre,
                'phone'                         => $comprador_telefono,
                'email'                         => $comprador_email,
                'response_status'               => 'pendiente',
            ]);

            $productquantity = 1;

            $student = AcaStudent::firstOrCreate(
                ['person_id' => $person->id],
                ['student_code' => $person->number, 'status' => true]
            );

            foreach ($productids as $key => $id) {

                $product = OnliItem::find($id);

                $this->matricular_curso($product, $student);

                array_push($items, [
                    'id' => $id,
                    'title' => $product->name,
                    'quantity'      => floatval($productquantity),
                    'currency_id'   => 'PEN',
                    'unit_price'    => floatval($product->price)
                ]);

                array_push($products, [
                    'image' => $product->image,
                    'name' => $product->name,
                    'price' => floatval($product->price),
                    'quantity'      => floatval($productquantity),
                    'total' => (floatval($productquantity) * floatval($product->price))
                ]);

                $total = $total + (floatval($productquantity) * floatval($product->price));

                OnliSaleDetail::create([
                    'sale_id'       => $sale->id,
                    'item_id'       => $product->item_id,
                    'entitie'       => $product->entitie,
                    'price'         => $product->price,
                    'quantity'      => floatval($productquantity),
                    'onli_item_id'  => $id
                ]);
            }

            $preference = $client->create([
                "items" => $items,
            ]);

            // $preference->back_urls = array(
            //     "success" => route('web_gracias_por_comprar_tu_entrada', $sale->id),
            //     // "failure" => "http://www.tu-sitio/failure",
            //     // "pending" => "http://www.tu-sitio/pending"
            // );

            $preference_id =  $preference->id;
            DB::commit();
        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            // Manejar la excepción
            DB::rollback();
            $response = $e->getApiResponse();
            //dd($response); // Mostrar la respuesta para obtener más detalles
        }
        //route('web_gracias_por_comprar_tu_entrada', $sale->id);

    }

    public function gracias()
    {
        return view('pages.gracias');
    }


    public function privacidad()
    {

        $banner = CmsSection::where('component_id', 'nosotros_banner_area_11')  //siempre cambiar el id del componente
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->first();

        return view('pages.politicas-de-privacidad', [
            'banner' => $banner
        ]);
    }

    public function processPayment(Request $request, $id)
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_TOKEN'));

        $client = new PaymentClient();
        $sale = OnliSale::find($id);

        if ($sale->response_status == 'approved') {
            return response()->json(['error' => 'el pedido ya fue procesado, ya no puede volver a pagar'], 412);
        } else {
            try {

                $payment = $client->create([
                    "token" => $request->get('token'),
                    "issuer_id" => $request->get('issuer_id'),
                    "payment_method_id" => $request->get('payment_method_id'),
                    "transaction_amount" => (float) $request->get('transaction_amount'),
                    "installments" => $request->get('installments'),
                    "payer" => $request->get('payer')
                ]);

                if ($payment->status == 'approved') {

                    $sale->email = $request->get('payer')['email'];
                    $sale->total = $request->get('transaction_amount');
                    $sale->identification_type = $request->get('payer')['identification']['type'];
                    $sale->identification_number = $request->get('payer')['identification']['number'];
                    $sale->response_status = $payment->status;
                    $sale->response_id = $request->get('collection_id');
                    $sale->response_date_approved = Carbon::now()->format('Y-m-d');
                    $sale->response_payer = json_encode($request->all());
                    $sale->response_payment_method_id = $request->get('payment_type');
                    $sale->mercado_payment_id = $payment->id;
                    $sale->mercado_payment = json_encode($payment);

                    ///enviar correo
                    Mail::to($sale->email)
                        ->send(new ConfirmPurchaseMail(OnliSale::with('details.item')->where('id', $id)->first()));

                    $sale->save();
                    $this->enviar_correo_con_cursos($id);

                    return response()->json([
                        'status' => $payment->status,
                        'message' => $payment->status_detail,
                        'url' => route('web_gracias_por_cursos', $sale->id) // AQUI solo la ruta q muestre datos de la compra
                    ]);
                } else {

                    return response()->json([
                        'status' => $payment->status,
                        'message' => $payment->status_detail,
                        'url' => route('web_pagar')
                    ]);

                    $sale->delete();
                }
            } catch (\MercadoPago\Exceptions\MPApiException $e) {
                // Manejar la excepción
                $response = $e->getApiResponse();
                $content  = $response->getContent();

                $message = $content['message'];
                return response()->json(['error' => 'Error al procesar el pago: ' . $message], 412);
            }
        }
    }

    public function graciasCompra($id)
    {
        $sale = OnliSale::where('id', $id)->with('details.item')->first();
        $person = Person::where('id', $sale->person_id)->first();
        $details = $sale->details;
        $itemIds = $details->pluck('item_id')->toArray();
        $products = OnliItem::whereIn('item_id', $itemIds)->get();
        //$student = AcaStudent::where('person_id', $person->id)->first();

        $courses = [];
        foreach ($details as $k => $detail) {
            $item = OnliItem::find($detail->onli_item_id);
            $courses[$k] = [
                'image'       => $item->image,
                'name'        => $item->name,
                'description' => $item->description,
                'type'        => $item->additional,
                'modality'    => $item->additional1,
                'price'      => $item->price
            ];
        }

        return view('pages.gracias', [
            'products' => $products,
            'sale' => $sale,
            'person' => $person,
        ]);
    }

    private function enviar_correo_con_cursos($sale_id)
    {
        $sale = OnliSale::where('id', $sale_id)->with('details.item')->first();
        $person = Person::where('id', $sale->person_id)->first();
        $details = $sale->details;
        //$itemIds = $details->pluck('item_id')->toArray();
        //        $products = OnliItem::whereIn('item_id', $itemIds)->get();
        // $student = AcaStudent::where('person_id', $person->id)->first();

        $courses = [];
        foreach ($details as $k => $detail) {
            $item = OnliItem::find($detail->onli_item_id);
            $courses[$k] = [
                'image'       => $item->image,
                'name'        => $item->name,
                'description' => $item->description,
                'type'        => $item->additional,
                'modality'    => $item->additional1,
                'price'      => $item->price
            ];
        }

        //////////codigo enviar correo /////
        Mail::to($person->email)
            ->send(new StudentRegistrationMailable([
                'courses'   => $courses,
                'names'     => $person->names,
                'email'      => $person->email,
                'password'  => $person->number
            ]));
    }

    private function matricular_curso($producto, $student)
    {

        $course_id = $producto->item_id;

        $registration = AcaCapRegistration::create([
            'student_id' => $student->id,
            'course_id' => $course_id,
            'status' => true,
            'modality_id' => 3,
            'unlimited' => true
        ]);
    }
}
