@extends('layouts.webpage')

@section('meta_title', 'Contáctanos')
@section('meta_description', 'Escríbenos y resolvemos tus dudas sobre cursos, diplomados y servicios de ERIOS CONSULTORES. Atención personalizada por teléfono, WhatsApp y correo.')

@section('page_styles')
<style>
    /* ============ ERIOS · Página de contacto ============ */
    .erc-contact { padding: 90px 0 110px; background: #f4f7fb; }
    .erc-contact__head { text-align: center; max-width: 680px; margin: 0 auto 52px; padding: 0 15px; }
    .erc-contact__head .erc-contact__eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #004aad;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
    .erc-contact__head .erc-contact__eyebrow::before,
    .erc-contact__head .erc-contact__eyebrow::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-contact__head .erc-contact__eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
    .erc-contact__head .erc-contact__eyebrow::after { left: 50%; transform: translateX(8px); }
    .erc-contact__head h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 36px;
        font-weight: 700;
        color: #1d2025;
        margin: 0;
    }
    .erc-contact__head p {
        font-size: 16px;
        line-height: 28px;
        color: #505050;
        margin: 14px 0 0;
    }

    /* ---- Tarjeta del formulario ---- */
    .erc-form-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 16px;
        padding: 38px 36px 42px;
        box-shadow: 0 10px 34px rgba(14, 23, 38, 0.07);
        height: 100%;
    }
    @media (max-width: 575px) { .erc-form-card { padding: 28px 22px 34px; } }
    .erc-form-card__eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #004aad;
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .erc-form-card__eyebrow::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-form-card h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #1d2025;
        line-height: 1.25;
        margin: 0 0 28px;
    }

    .erc-form .single-form { margin-top: 18px; }
    .erc-form .form-group { margin: 0; }
    .erc-form input,
    .erc-form textarea {
        width: 100%;
        height: 54px;
        padding: 0 18px;
        background: #f8fafd;
        border: 2px solid #e6ecf5;
        border-radius: 12px;
        color: #1d2025;
        font-size: 15px;
        outline: none;
        transition: all .3s ease;
    }
    .erc-form textarea { height: 140px; padding: 14px 18px; resize: vertical; }
    .erc-form input::placeholder,
    .erc-form textarea::placeholder { color: #9aa5b5; }
    .erc-form input:focus,
    .erc-form textarea:focus {
        background: #fff;
        border-color: #004aad;
        box-shadow: 0 0 0 4px rgba(0, 74, 173, 0.1);
    }
    .erc-form .help-block.with-errors { color: #e5484d; font-size: 12.5px; margin-top: 6px; }
    .erc-form .list-unstyled { margin: 0; }

    .erc-submit {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #ffc600;
        color: #07294d;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 15px;
        padding: 14px 34px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all .35s ease;
        box-shadow: 0 8px 22px rgba(255, 198, 0, 0.35);
    }
    .erc-submit:hover {
        background: #004aad;
        color: #ffc600;
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(0, 74, 173, 0.3);
    }
    .erc-submit[disabled] { opacity: .45; cursor: not-allowed; transform: none; }

    @media (max-width: 767px) {
        .erc-contact { padding: 60px 0 80px; }
        .erc-contact__head h2 { font-size: 27px; }
        .erc-form-card h2 { font-size: 26px; }
    }
</style>
@endsection

@section('content')


    <!--====== PAGE BANNER PART START ======-->

    <x-page-hero heroComponent="hero_contactanos_14"
        subtitle="Estamos listos para atenderte: escríbenos y agenda una asesoría con nuestro equipo." />

    <!--====== PAGE BANNER PART ENDS ======-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--====== CONTACT PART START ======-->

    <section id="contact-page" class="erc-contact">
        <div class="container">

            <div class="erc-contact__head" data-reveal>
                <span class="erc-contact__eyebrow">Contactanos</span>
                <h2>Mantente en contacto</h2>
                <p>Cuéntanos tu necesidad y nuestro equipo te responderá a la brevedad.</p>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="erc-form-card" data-reveal>
                        <span class="erc-form-card__eyebrow">Formulario</span>
                        <h2>Envíanos un mensaje</h2>
                            <form id="pageContactForm" name="contact_form" action="{{ route('apisubscriber') }}" method="post" data-toggle="validator" class="erc-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="single-form form-group">
                                            <input name="full_name" type="text" placeholder="Nombres Completos" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="subject" type="text" placeholder="DNI" data-error="Subject is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="email" type="email" placeholder="Correo Electrónico" data-error="Valid email is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="phone" type="text" placeholder="Teléfono" data-error="Phone is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="single-form form-group">
                                            <textarea id="messagePageContact" name="message" placeholder="Escribir Mensaje" data-error="Please,leave us a message." required="required"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button id="submitPageContactButton" type="submit" class="erc-submit">Enviar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                        </div> <!-- single form -->
                                    </div>
                                </div> <!-- row -->
                            </form>
                    </div> <!-- erc-form-card -->
                </div>
                <div class="col-lg-5">
                    <x-contact-data />
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    <script>
        let form = document.getElementById('pageContactForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formulario = document.getElementById('pageContactForm');
            var formData = new FormData(formulario);

            // Deshabilitar el botón
            var submitButton = document.getElementById('submitPageContactButton');
            submitButton.disabled = true;
            submitButton.style.opacity = 0.25;

            // Crear una nueva solicitud XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud POST al servidor
            xhr.open('POST', "{{ route('apisubscriber') }}", true);

            // Configurar la función de callback para manejar la respuesta
            xhr.onload = function() {
                // Habilitar nuevamente el botón
                submitButton.disabled = false;
                submitButton.style.opacity = 1;
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'success',
                        title: 'Enhorabuena',
                        text: response.message,
                        customClass: {
                            container: 'sweet-modal-zindex' // Clase personalizada para controlar el z-index
                        }
                    });
                    formulario.reset();
                } else if (xhr.status === 422) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    // Maneja los errores de validación aquí, por ejemplo, mostrando los mensajes de error en algún lugar de tu página.
                    var errorMessages = errorResponse.errors;
                    var errorMessageContainer = document.getElementById('messagePageContact');
                    errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                    for (var field in errorMessages) {
                        if (errorMessages.hasOwnProperty(field)) {
                            errorMessageContainer.innerHTML += field + ': ' + errorMessages[field].join(', ') +
                                '<br>';
                        }
                    }
                } else {
                    console.error('Error en la solicitud: ' + xhr.status);
                }


            };

            // Enviar la solicitud al servidor
            xhr.send(formData);
        });
    </script>
    <!--====== CONTACT PART ENDS ======-->

@stop
