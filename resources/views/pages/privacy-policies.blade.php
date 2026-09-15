@extends('layouts.webpage')

@section('meta_title', 'Políticas de Privacidad')
@section('meta_description', 'Conoce cómo ERIOS CONSULTORES recopila, usa y protege tus datos personales conforme a la normativa vigente de protección de datos.')

@section('content')

    <!--====== PAGE BANNER PART START ======-->
    <x-page-hero heroComponent="hero_politicas_de_privacidad_16"
        subtitle="Conoce cómo protegemos y tratamos tus datos personales." />

    <!--====== PAGE BANNER PART ENDS ======-->

    <section id="about-page" class="pt-20 pb-110">
        <div class="container">
            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3><strong>Última actualización:</strong> {{ now()->format('d/m/Y') }}</h3>
                    </div>
                    <div class="about-cont">
                        <p>En <strong>ERIOS CONSULTORES</strong> (en adelante, "nosotros", "nuestro" o "la empresa"), valoramos tu
                            privacidad y nos comprometemos a proteger la información personal que compartes con nosotros.
                            Esta política de privacidad describe cómo recopilamos, usamos y protegemos tus datos personales
                            cuando accedes a nuestros cursos en línea a través de nuestro sitio web <a
                                href="https://www.eriosconsultores.com/" target="_blank"
                                rel="noopener">https://www.eriosconsultores.com/</a>.</p>

                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>1. Información que Recopilamos</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            1.1 Información de Registro: Cuando te registras en nuestro sitio para acceder a nuestros
                            cursos, recopilamos información básica como tu nombre, dirección de correo electrónico, número
                            de teléfono y cualquier otra información que decidas proporcionar.
                        </p>
                        <p>
                            1.3 Información de Navegación: Podemos recopilar automáticamente datos sobre tu interacción con
                            nuestro sitio, como la dirección IP, el tipo de navegador, las páginas visitadas y el tiempo
                            pasado en nuestro sitio, utilizando cookies y tecnologías similares.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>2. Uso de la Información</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            2.1 Prestación de Servicios: Utilizamos la información que nos proporcionas para administrar tu cuenta, ofrecerte acceso a nuestros cursos, procesar pagos y comunicarnos contigo sobre cualquier aspecto relacionado con nuestros servicios.
                        </p>
                        <p>
                            2.2 Mejora de los Servicios: Analizamos los datos de uso para mejorar la funcionalidad y la experiencia del usuario en nuestro sitio, así como para desarrollar nuevos productos y servicios.
                        </p>
                        <p>
                            2.3 Marketing: Con tu consentimiento, podemos utilizar tu información de contacto para enviarte boletines informativos, promociones y actualizaciones sobre nuevos cursos y servicios que ofrecemos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>3. Compartir tu Información</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            3.1 Proveedores de Servicios: Podemos compartir tu información con terceros que prestan servicios en nuestro nombre, como procesadores de pagos, plataformas de correo electrónico y proveedores de análisis de datos. Estos terceros están obligados a proteger tu información y solo la utilizan en la medida en que sea necesario para realizar sus funciones.
                        </p>
                        <p>
                            3.2 Cumplimiento Legal: Podemos divulgar tu información si es necesario para cumplir con la ley, responder a una orden judicial, o proteger los derechos, la propiedad o la seguridad de <strong>ERIOS CONSULTORES</strong>, nuestros usuarios u otros.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>4. Seguridad de la Información</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Tomamos medidas razonables para proteger tu información personal de accesos no autorizados, uso indebido, pérdida o divulgación. Sin embargo, debes saber que ningún método de transmisión por Internet o de almacenamiento electrónico es 100% seguro.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>5. Tus Derechos</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            5.1 Acceso y Rectificación: Tienes derecho a acceder a la información personal que tenemos sobre ti y a solicitar su rectificación si es incorrecta o está desactualizada.
                        </p>
                        <p>
                            5.2 Cancelación y Oposición: Puedes solicitar la eliminación de tu información personal o limitar el uso que hacemos de ella en cualquier momento. Sin embargo, esto puede afectar nuestra capacidad para proporcionarte algunos de nuestros servicios.
                        </p>
                        <p>
                            5.3 Retiro del Consentimiento: Si has dado tu consentimiento para que usemos tu información para fines de marketing, puedes retirarlo en cualquier momento utilizando el enlace de "cancelar suscripción" en nuestros correos electrónicos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>6. Cambios a Esta Política de Privacidad</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Nos reservamos el derecho de actualizar esta política de privacidad en cualquier momento. Cualquier cambio será publicado en esta página y, si los cambios son significativos, te lo notificaremos a través de un aviso en nuestro sitio web o por correo electrónico.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>7. Contacto</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Si tienes preguntas o inquietudes sobre nuestra política de privacidad o el 
                            manejo de tu información personal, puedes contactarnos a través de 
                            <a href="mailto:Info@eriosconsultores.com">Info@eriosconsultores.com</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!--====== COUNTER PART START ======-->

    {{-- <div id="counter-part" class="bg_cover pt-65 pb-110" data-overlay="8" style="background-image: url(images/bg-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">30,000</span>+</span>
                        <p>Students enrolled</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">41,000</span>+</span>
                        <p>Courses Uploaded</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">11,000</span>+</span>
                        <p>People certificate</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">39,000</span>+</span>
                        <p>Global Teachers</p>
                    </div> <!-- single counter -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> --}}

    <!--====== COUNTER PART ENDS ======-->

    <!--====== TEACHERS PART START ======-->

    {{-- <section id="teachers-part" class="pt-65 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50 pb-35">
                        <h5>Featured Teachers</h5>
                        <h2>Meet Our teachers</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-1.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-2.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-3.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-4.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-5.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-6.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-7.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-8.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section> --}}

    <!--====== TEACHERS PART ENDS ======-->


    <!--====== PATNAR LOGO PART START ======-->

    {{-- <div id="patnar-logo" class="pt-40 pb-80 gray-bg">
        <div class="container">
            <div class="row patnar-slide">
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-1.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-2.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-3.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-1.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-2.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-3.png') }}" alt="Logo">
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>  --}}

    <!--====== PATNAR LOGO PART ENDS ======-->


@stop
