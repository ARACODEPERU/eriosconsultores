@extends('layouts.webpage')

@section('content')

    <!--====== PAGE BANNER PART START ======-->
    <x-hero-return />
    <!--====== PAGE BANNER PART ENDS ======-->

    <section id="about-page" class="pt-20 pb-110">
        <div class="container">
            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3><strong>Última actualización:</strong> {{ now()->format('d/m/Y') }}</h3>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>1. Derecho de desistimiento</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            El usuario podrá ejercer su derecho de desistimiento dentro de los 7 días calendario posteriores
                            a la compra, siempre que el curso no haya iniciado.
                            En este caso, se realizará la devolución íntegra del monto pagado, utilizando el mismo medio de
                            pago empleado en la transacción.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>2. Cursos ya iniciados</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Una vez iniciado el curso o si el usuario ha accedido a los materiales digitales,
                            no procederá la devolución, salvo en casos de cancelación o reprogramación atribuibles
                            a ERIOS CONSULTORES.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>3. Cancelación o reprogramación del curso</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Si por causas de fuerza mayor o decisión institucional el curso no pudiera dictarse en la fecha
                            programada, ERIOS CONSULTORES ofrecerá al usuario:
                        </p>
                        <ul>
                            <li>La reprogramación del curso en nuevas fechas, o</li>
                            <li>La devolución del monto abonado en un plazo máximo de 15 días hábiles.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>4. Procedimiento para solicitar devoluciones</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            El usuario deberá enviar su solicitud al correo info@eriosconsultores.com, indicando sus datos
                            personales, comprobante de pago y motivo de la solicitud.
                            El área administrativa evaluará el caso y dará respuesta en un plazo máximo de 5 días hábiles.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>5. Medios de reembolso</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            El reembolso se realizará únicamente a través del mismo medio de pago utilizado en la compra (tarjeta de crédito, débito u otro medio electrónico).
                        </p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <!-- Columna de Texto -->
                <div class="col-lg-12">
                    <div class="section-title mt-30">
                        <h3>6. Contacto</h3>
                    </div>
                    <div class="about-cont">
                        <p>
                            Para consultas, reclamos o soporte, puede contactarnos a través de:
                        </p>
                        <ul>
                            <li>
                                Correo: capacitacion@globalcpaperu.com
                            </li>
                            <li>
                                Teléfono: +51 967 052 506
                            </li>
                            <li>
                                Web: https://academy.globalcpaperu.com
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


@stop
