@extends('layouts.webpage')

@section('meta_title', 'Contáctanos')
@section('meta_description', 'Escríbenos y resolvemos tus dudas sobre cursos, diplomados y servicios de ERIOS CONSULTORES. Atención personalizada por teléfono, WhatsApp y correo.')

@section('content')


    <!--====== PAGE BANNER PART START ======-->

    <x-hero-contact />

    <!--====== PAGE BANNER PART ENDS ======-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--====== CONTACT PART START ======-->

    <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-from mt-30">
                        <div class="section-title">
                            <h5>Contactanos</h5>
                            <h2>Mantenerse en contacto</h2>
                        </div> <!-- section title -->
                        <div class="main-form pt-45">
                            <form id="pageContactForm" name="contact_form" action="{{ route('apisubscriber') }}" method="post" data-toggle="validator">
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
                                            <button id="submitPageContactButton" type="submit" class="main-btn">Enviar</button>
                                        </div> <!-- single form -->
                                    </div>
                                </div> <!-- row -->
                            </form>
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
                <div class="col-lg-5">
                    <x-contact-data />
                    <div class="map mt-30">
                        <div id="contact-map"></div>
                    </div> 
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
