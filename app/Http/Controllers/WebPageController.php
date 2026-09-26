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
use Modules\Academic\Entities\AcaCategoryCourse;
use Modules\Onlineshop\Entities\OnliSale;
use Modules\Onlineshop\Entities\OnliSaleDetail;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use Illuminate\Support\Facades\Validator;
use App\Mail\StudentRegistrationMailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmPurchaseMail;
use Carbon\Carbon;
use Modules\Academic\Entities\AcaStudent;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourseLanding;
use Modules\Academic\Entities\AcaSubscriptionType;
use Modules\Academic\Entities\AcaTeacher;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Modules\CMS\Entities\CmsTestimony;
use Illuminate\Support\Str;
use App\Support\CourseLandingPresenter;

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
        $courses = OnliItem::query()
            ->with(['course.category', 'course.modality', 'course.landing'])
            // Catalogo: solo items de tienda activos cuyo curso exista y este activo.
            ->where('status', true)
            ->whereHas('course', fn ($q) => $q->where('status', true))
            ->orderByDesc('id')
            ->get();

        // Planes de suscripcion activos: se resuelven una sola vez, no por tarjeta.
        $hasActivePlans = AcaSubscriptionType::where('status', true)->exists();

        $cards = $courses
            ->map(fn (OnliItem $item) => $this->courseCard($item, $hasActivePlans))
            ->filter()
            ->values();

        return view('pages.courses', [
            'courses'    => $cards,
            'categories' => $cards->pluck('category')->filter()->unique()->values(),
            // Pestanas del catalogo: un tab por tipo (onli_items.additional).
            'types'      => $cards->pluck('type')->filter()->unique()->values(),
        ]);
    }

    /**
     * Prepara una tarjeta del catalogo de cursos.
     *
     *  - imagen: la de la tienda (onli_items) y, si no tiene, la del curso (aca_courses).
     *  - precio: el del curso (aca_courses.price) y, si es 0, el de la tienda. Si queda
     *    en 0 se muestra "Gratis".
     *  - descuento: aca_courses.discount es un porcentaje (0-100) y el precio final es
     *    price - price*discount/100, igual que en OnliSaleController/MercadopagoController.
     *      - discount_applies = '01' -> descuento para todos: tachado + precio final.
     *      - discount_applies = '02' -> solo suscriptores, y solo si hay planes activos:
     *        por defecto se muestra el precio normal y al pasar el mouse aparece la
     *        franja "Descuento para suscriptores" con el precio con descuento.
     */
    private function courseCard(OnliItem $item, bool $hasActivePlans = false): ?array
    {
        $course = $item->course;

        if (!$course) {
            return null;
        }

        $landing = $course->landing;
        $hasLanding = $landing && $landing->is_published && filled($landing->url_slug);

        $price = (float) $course->price;
        if ($price <= 0) {
            $price = (float) $item->price;
        }

        $percent = (float) $course->discount;
        $percent = ($price > 0 && $percent > 0 && $percent < 100) ? $percent : 0;

        $isFree = $price <= 0;
        $discounted = $percent > 0 ? round($price - ($price * $percent / 100), 2) : $price;

        $forEveryone = $percent > 0 && $course->discount_applies === '01';
        $forSubscribers = $percent > 0 && $course->discount_applies === '02' && $hasActivePlans;

        $description = trim(preg_replace('/\s+/', ' ', strip_tags((string) $item->description)) ?? '');

        $title = filled($item->name) ? $item->name : ($course->description ?: 'Curso');

        return [
            // Datos que necesita el carrito publico: guarda el id del item de tienda
            // (onli_items.id) y consulta titulo/precio al servidor.
            'id'               => $item->id,
            'type'             => $item->additional,
            'slug'             => $course->slug,
            'item_price'       => (float) $item->price,

            'title'            => $title,
            'description'      => $description !== '' ? Str::limit($description, 160) : (string) $course->description,
            'image'            => filled($item->getRawOriginal('image'))
                ? $item->image
                : CourseLandingPresenter::image($course->image),
            'category'         => $item->category_description ?: ($course->category?->description ?: 'General'),
            'modality'         => $course->modality?->description,

            // Precio y descuentos
            'price_label'      => $isFree ? null : $this->money($price),
            'final_label'      => $isFree ? 'Gratis' : $this->money($forEveryone ? $discounted : $price),
            'discount_percent' => $forEveryone ? (int) round($percent) : 0,
            'subs_percent'     => $forSubscribers ? (int) round($percent) : 0,
            'subs_label'       => $forSubscribers ? $this->money($discounted) : null,

            'url'              => $hasLanding ? route('course_url_slug', $landing->url_slug) : null,
            'whatsapp'         => $landing?->whatsapp_link ?: 'https://wa.link/9q9g9v',

            // WhatsApp de compra: mensaje prellenado con la peticion del curso.
            // wa.link ignora el parametro ?text=, por eso se usa wa.me con el numero.
            // Si la landing apunta a wa.me se reutiliza ese numero; si no, el del wa.link flotante.
            'whatsapp_buy'     => 'https://wa.me/' . (preg_match('/wa\.me\/(\d+)/', (string) $landing?->whatsapp_link, $m) ? $m[1] : '51933435823')
                . '?text=' . rawurlencode('¡Hola! Deseo comprar el curso: ' . $title),
        ];
    }

    /** S/ 250 cuando el monto es exacto y S/ 112.50 cuando tiene centavos. */
    private function money(float $value): string
    {
        return 'S/ ' . number_format($value, fmod($value, 1.0) === 0.0 ? 0 : 2);
    }

    public function cursodescripcion($slug)
    {
        // Ruta amigable: /curso-descripcion/{slug}. El slug es el de aca_courses;
        // se mantiene compatibilidad: si llega un id numerico antiguo redirige 301
        // a su slug amigable para no romper enlaces ya indexados.
        if (is_numeric($slug) && (int) $slug > 0) {
            $legacyItem = OnliItem::find((int) $slug);
            $legacyCourse = $legacyItem ? AcaCourse::find($legacyItem->item_id) : null;

            if ($legacyCourse && filled($legacyCourse->slug)) {
                return redirect()->route('web_curso_descripcion', $legacyCourse->slug, 301);
            }

            abort(404);
        }

        $course = AcaCourse::with('category')
            ->with('modality')
            ->with('modules')
            ->with('teachers.teacher.person.resumes')
            ->with('brochure')
            ->with('agreements')
            ->where('slug', $slug)
            ->firstOrFail();

        $item = OnliItem::where('item_id', $course->id)
            ->where('entitie', 'Modules-Academic-Entities-AcaCourse')
            ->first();

        $latest_courses = OnliItem::with('course')
            ->orderBy('id', 'desc')
            ->where('id', '!=', $item?->id)
            ->take(10)
            ->get()
            ->shuffle()
            ->take(3);

        return view('pages.course-description', [
            'course' => $course,
            'item' => $item,
            'onli_item_id' => $item?->id,
            'latest_courses' => $latest_courses
        ]);
    }

    // public function cursodescripcion($id)
    // {
    //     $item = OnliItem::find($id);

    //     $course = AcaCourse::with('category')
    //         ->with('modality')
    //         ->with('modules')
    //         ->with('teachers.teacher.person.resumes')
    //         ->with('brochure')
    //         ->with('agreements')
    //         ->where('id', $item->item_id)
    //         ->first();

    //     $latest_courses = OnliItem::with('course')
    //         ->orderBy('id', 'desc')
    //         ->where('id', '!=', $id)
    //         ->take(10)
    //         ->get()
    //         ->shuffle()
    //         ->take(3);

    //     return view('pages.curso-descripcion', [
    //         'course' => $course,
    //         'item' => $item,
    //         'latest_courses' => $latest_courses
    //     ]);
    // }

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


    /**
     * Ruta publica /curso/{slug}: la landing se resuelve por su url_slug.
     */
    public function course_url_slug($id)
    {
        $landing = AcaCourseLanding::with(['course.category', 'course.modality', 'course.brochure'])
            ->where('url_slug', $id)
            ->first();

        return view('pages.course-landing', $this->landingViewData($landing));
    }

    /**
     * Ruta interna /landing_preview/{id}: la landing se resuelve por su id.
     */
    public function course_landing_preview($id)
    {
        $landing = AcaCourseLanding::with(['course.category', 'course.modality', 'course.brochure'])
            ->where('id', $id)
            ->first();

        return view('pages.course-landing', $this->landingViewData($landing, 'noindex, nofollow'));
    }

    /**
     * Payload unico de la vista de landing de curso.
     *
     * Las dos rutas (/curso/{slug} y /landing_preview/{id}) comparten este mismo
     * set de variables a proposito: asi la pagina publica y el preview interno
     * no pueden desincronizarse. Toda la logica de apoyo vive en
     * App\Support\CourseLandingPresenter, que tambien usa
     * CourseLandingPreviewController.
     */
    private function landingViewData(?AcaCourseLanding $landing, string $metaRobots = 'index, follow'): array
    {
        $testimonials = CourseLandingPresenter::testimonials($landing?->course);

        return [
            'landing' => $landing,
            'teachers_premium' => CourseLandingPresenter::teachersPremium($landing),
            'colors' => CourseLandingPresenter::colors(),
            'onli_item_id' => CourseLandingPresenter::onliItemId($landing),
            'course_testimonials' => $testimonials,
            'course_schema' => CourseLandingPresenter::schema($landing, $testimonials),
            'meta_robots' => $metaRobots,
        ];
    }

	    public function pay($sale = null)
    {
        // Ruta web_pagar: retorno tras crear una venta online. La vista
        // pages/pay no existe; se resuelve con el flujo actual del checkout.
        $sale = $sale ? OnliSale::find($sale) : null;

        if (! $sale) {
            return redirect()->route('web_carrito');
        }

        if ($sale->response_status === 'approved') {
            return redirect()->route('web_gracias_por_cursos', $sale->id);
        }

        // Venta pendiente: el carrito permite reintentar el pago con el
        // checkout de MercadoPago activo.
        return redirect()->route('web_carrito');
    }

    /**
     * Registra/actualiza el carrito abandonado desde el checkout publico.
     */
    public function cartAbandonedStore(Request $request)
    {
        $data = $request->only([
            'client_id', 'phone_country', 'phone', 'name', 'email',
            'cart_items', 'cart_total',
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'utm_id',
        ]);

        if (blank($data['client_id'] ?? null) || (blank($data['phone'] ?? null) && blank($data['email'] ?? null))) {
            return response()->json(['ok' => false], 422);
        }

        $cart = OnliCarritoAbandonado::updateOrCreate(
            ['client_id' => $data['client_id']],
            $data + ['paid' => false]
        );

        return response()->json(['ok' => true, 'id' => $cart->id]);
    }
}
