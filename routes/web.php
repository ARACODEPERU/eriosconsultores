<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ComplaintsBookController;
use App\Http\Controllers\CourseLandingPreviewController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LocalSaleController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\WebPageController;
use App\Mail\StudentRegistrationMailable;
use App\Models\District;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\Sales\Http\Controllers\SalesController;

// Rutas en Blade
// Route::get('/home', [WebPageController::class, 'index'])->name('index_main');

// Route::get('/', [WebPageController::class, 'construction'])->name('construction');
Route::get('/', [WebPageController::class, 'index'])->name('index_main');
Route::get('/nosotros', [WebPageController::class, 'about'])->name('web_about');
Route::get('/servicios', [WebPageController::class, 'services'])->name('web_services');
Route::get('/cursos', [WebPageController::class, 'courses'])->name('web_courses');
//Route::get('/curso-r/{slug}', [WebPageController::class, 'coursedescription'])->name('web_course_description');


//este es el original de global y base
Route::get('/curso/{id}', [WebPageController::class, 'course_url_slug'])->name('course_url_slug'); // ruta de cursos landing

// Vista aislada para revisar las secciones de landing de curso
// (resources/views/components/courselanding). Es noindex y no reemplaza a
// /curso/{slug}: existe solo para montar los componentes antes de integrarlos
// en la pagina publica.  Ej: /curso-landing-preview/mi-curso?solo=hero,faq
Route::get('/curso-landing-preview/{slug}', [CourseLandingPreviewController::class, 'show'])
    ->name('courselanding_preview');
Route::get('/carrito', [WebPageController::class, 'shopcart'])->name('web_carrito');
Route::get('/pagar', [WebPageController::class, 'pay'])->name('web_pay');
Route::get('/gracias', [WebPageController::class, 'thanks'])->name('web_thanks');
Route::get('/email', [WebPageController::class, 'email'])->name('web_email');
Route::get('/contactanos', [WebPageController::class, 'contact'])->name('web_contact_us');
Route::get('/docentes', [WebPageController::class, 'teachers'])->name('web_teachers');
Route::get('/politicas-privacidad', [WebPageController::class, 'privacypolicies'])->name('web_privacy_policies');
Route::get('/politicas-de-devoluciones', [WebPageController::class, 'returnpolicies'])->name('web_return_policies');
Route::get('/libro-de-reclamaciones', [ComplaintsBookController::class, 'createdByClient'])->name('web_complaints_book');
Route::post('/libro-de-reclamaciones', [ComplaintsBookController::class, 'storeByClient'])->name('web_complaints_book_store');
Route::get('/prices/academic', [LandingController::class, 'academicPrices'])->name('academic_prices');

// Ruta amigable por slug; si llega un id numerico antiguo redirige a su slug.
Route::get('/curso-descripcion/{slug}', [WebPageController::class, 'cursodescripcion'])->name('web_curso_descripcion');

// Landing publica por slug del curso (usada por catalogo, carrito y panel del alumno).
Route::get('/curso/{slug}', [WebPageController::class, 'course_url_slug'])->name('course_url_slug');

// Carrito de compras publico (la landing y la descripcion redirigen aqui).
Route::get('/carrito', [WebPageController::class, 'shopcart'])->name('web_carrito');

// Flujo de compra del carrito (checkout de MercadoPago).
Route::post('/carrito/preferencia', [WebPageController::class, 'cartPreference'])->name('web_cart_preference');
Route::post('/carrito/pago', [WebPageController::class, 'cartProcessPayment'])->name('web_cart_process_payment');
Route::post('/carrito/finalizar', [WebPageController::class, 'cartFinalize'])->name('web_cart_finalize');
Route::post('/carrito/abandonado', [WebPageController::class, 'cartAbandonedStore'])->name('web_cart_abandoned');

// Pagina de pago de una venta online (back_url de MercadoPago y retorno tras crear la venta).
Route::get('/pagar/{sale}', [WebPageController::class, 'pay'])->name('web_pagar');

// Gracias por la compra de cursos (venta online).
Route::get('/gracias-cursos/{id}', [WebPageController::class, 'thanks'])->name('web_gracias_por_cursos');

// Procesamiento del pago con tarjeta (checkout de la vista pagar).
Route::put('/pagar-proceso/{sale}/{student}', [WebPageController::class, 'processPayment'])->name('web_process_payment');

// Alias para plantillas de email antiguas (evita duplicar el path /).
Route::get('/inicio', function () { return redirect()->route('index_main'); })->name('web_inicio');


//////mensajes de whatsapp///////
Route::get('/ask/product/{id}', [LandingController::class, 'redirectToWhatsApp'])->name('whatsapp_send');

/////cunsulta comprobante electronico ///////////
Route::get('/find/invoice', [SalesController::class, 'findInvoice'])->name('find_electronic_invoice');
Route::post('/find/invoice', [SalesController::class, 'clientSearchDocument'])->name('client_search_electronic_invoice');

// Route::get('/blog/home', [BlogController::class, 'index'])->name('blog_principal');
// Route::get('/article/{url}', [BlogController::class, 'article'])->name('blog_article_by_url');
// Route::get('/category/{id}', [BlogController::class, 'category'])->name('blog_category');
// Route::get('/policies', [BlogController::class, 'policies'])->name('blog_policies');
// Route::get('/contact-us', [BlogController::class, 'contactUs'])->name('blog_contact_us');

Route::get('/stories/article/{url}', [BlogController::class, 'storiesArticle'])->name('blog_stories_article_by_url');
Route::get('/stories/policies', [BlogController::class, 'storiesPolicies'])->name('blog_stories_policies');
Route::get('/stories/contact-us', [BlogController::class, 'storiesContactUs'])->name('blog_stories_contact_us');


Route::get('/mipais', function () {
    $ip = $_SERVER['REMOTE_ADDR']; // Esto contendrá la ip de la solicitud.

    // Puedes usar un método más sofisticado para recuperar el contenido de una página web con PHP usando una biblioteca o algo así
    // Vamos a recuperar los datos rápidamente con file_get_contents
    $dataArray = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

    //var_dump($dataArray);

    dd($dataArray);
});

// Route::get('/email', function () {
//     Mail::to('elrodriguez2423@gmail.com')
//         ->send(new StudentRegistrationMailable('data'));
//     return 'mensaje enviado';
// });



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('users', UserController::class);
    Route::resource('establishments', LocalSaleController::class);
    Route::resource('modulos', ModuloController::class);
    Route::get('modulos/permissions/{id}/add', [ModuloController::class, 'permissions'])->name('modulos_permissions');
    Route::post('modulos/permissions/store', [ModuloController::class, 'storePermissions'])->name('modulos_permissions_store');
    Route::delete('establishments/destroies/{id}', [LocalSaleController::class, 'destroy'])->name('establishment_destroies');
    Route::post('establishments/updated', [LocalSaleController::class, 'update'])->name('establishment_updated');

    Route::get(
        'inventory/product/establishment',
        [KardexController::class, 'index']
    )->name('kardex_index');

    Route::post(
        'inventory/product/sizes',
        [KardexController::class, 'kardexDeailsSises']
    )->name('kardex_sizes');

    Route::post(
        'search/person/number',
        [PersonController::class, 'searchByNumberType']
    )->name('search_person_number');

    Route::post(
        'search/person/apies',
        [PersonController::class, 'searchByNumberTypeApies']
    )->name('search_person_apies');


    Route::post(
        'save/person/update/create',
        [PersonController::class, 'saveUpdateOrCreate']
    )->name('save_person_update_create');

    Route::post(
        'search/person/full_name/number',
        [PersonController::class, 'searchByNameOrNumber']
    )->name('search_person_fullname_number');

    Route::get(
        'general/stock',
        [KardexController::class, 'generalStock']
    )->name('generalstock');



    Route::get(
        'company/show',
        [CompanyController::class, 'show']
    )->name('company_show');

    Route::post(
        'company/update_create',
        [CompanyController::class, 'updateCreate']
    )->name('company_update_create');

    Route::get(
        'company/getdata',
        [CompanyController::class, 'getdata']
    )->middleware(['auth', 'verified'])->name('datosempresa');

    Route::post(
        'company/convert_upload_certificate',
        [CompanyController::class, 'convertUploadCertificate']
    )->name('company_convert_upload_certificate');

    Route::post(
        'company/sunat/credentials',
        [CompanyController::class, 'saveSunatCredentials']
    )->name('company_save_sunat_credentials');

    Route::post(
        'company/social/networks',
        [CompanyController::class, 'saveSocialNetworks']
    )->name('company_save_social_networks');

    Route::post(
        'company/upload/images',
        [CompanyController::class, 'uploadImages']
    )->name('company_upload_images');

    // Los parametros del sistema cambian el comportamiento global de la app: se
    // piden los mismos permisos que ya exige la entrada del menu lateral
    // (Security/Menu.js -> permissions: 'parametros').
    Route::middleware('permission:parametros')->group(function () {
        Route::get('parameters/list', [ParametersController::class, 'index'])->name('parameters');
        Route::get('parameters/create', [ParametersController::class, 'create'])->name('parameters_create');
        Route::post('parameters/store', [ParametersController::class, 'store'])->name('parameters_store');
        Route::get('parameters/{id}/edit', [ParametersController::class, 'edit'])->name('parameters_edit');
        Route::put('parameters/update/{id}', [ParametersController::class, 'update'])->name('parameters_update');

        // Guardado rapido desde la lista (switch, select, multiseleccion, textarea).
        // Antes era un GET de dos segmentos ({id}/{val}) que no podia atender al
        // axios.post() del front: la lista siempre respondia 405 al guardar y el
        // usuario veia "No se pudo guardar el valor" sin poder tocar ningun parametro.
        Route::post('parameters/{id}/default', [ParametersController::class, 'updateDefaultValuePost'])
            ->name('parameters_update_default_value');
    });

    ////////////////actualizar informacion de personas
    Route::get('person/update_information', function () {
        $person = Person::find(Auth::user()->person_id);
        $identityDocumentTypes = DB::table('identity_document_type')->get();

        $ubigeo = District::join('provinces', 'province_id', 'provinces.id')
            ->join('departments', 'provinces.department_id', 'departments.id')
            ->select(
                'districts.id AS district_id',
                'districts.name AS district_name',
                'provinces.name AS province_name',
                'departments.name AS department_name'
            )
            ->get();

        if (Auth::user()->hasRole('Alumno')) {
            return Inertia::render('Person/UpdateInformation', [
                'person' => $person,
                'identityDocumentTypes' => $identityDocumentTypes,
                'ubigeo' => $ubigeo
            ]);
        } else {
            return back();
        }
    })->name('user-update-profile');

    Route::post(
        'person/update_information/store',
        [PersonController::class, 'updateInformationPerson']
    )->name('user-update-profile-store');

	Route::post(
        'person/birthdays',
        [PersonController::class, 'getBirthdays']
    )->name('person-birthdays');

    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar');
    ///////////////META FACEBOOK WHATSAPP/////////////////

    Route::post('meta/whatsapp/message/send', [MetaController::class, 'sendMessageWhatsapp'])->name('meta_whatsapp_message_send');
});


//CERTIFICADOS AUTOMATIZACIÓN Y PRUEBAS
Route::get('/test-image/{student_id}/{certificate_id}', [WebController::class, 'testimage'])->name('test-image');

Route::post('online/client/pay/form', [WebPageController::class, 'formMercadopagoBlade'])->name('web_client_account_store');
Route::post('online/client/pay/process', [WebPageController::class, 'processPaymentMercadopago'])->name('web_client_account_process');
Route::get('online/client/pay/{id}/congratulations', [WebPageController::class, 'graciasCompra'])->name('web_felicitaciones_compra');
require __DIR__ . '/auth.php';
require __DIR__ . '/system.php';
