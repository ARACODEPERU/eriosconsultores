@extends('layouts.webpage')

@section('content')


    <!-- Start main-content -->
    <section class="page-title"
        style="background-image: url({{ asset('themes/webpage/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">
                    Gracias
                </h1>
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('index_main') }}">Home</a>
                    </li>
                    <li>Gracias</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <section>
        <div class="container pb-100">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <b>Estimado</b>
                        <h3>{{ $person->full_name }}</h3>
                        <p>
                            A nombre de toda la familia de <b style="font-weight: 700;">Educap</b> te damos la bienvenida a
                            nuestra plataformas de
                            estudio, al mismo tiempo te hacemos recordar que cualquier duda puedes comunicarte con nuestro
                            equipo de
                            asesores.
                        </p>
                        <p>
                            Los accesos al campus virtual han sido enviados a tu correo: <b
                                style="font-weight: 700;">{{ $person->email }}</b>
                        </p>
                        <h5>
                            <i class="fa fa-heart"></i> Gracias por tu compra
                        </h5>
                        <a href="{{ route('login') }}" class="theme-btn btn-style-one"><span class="btn-title">Campus
                                Virtual</span></a>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@stop
