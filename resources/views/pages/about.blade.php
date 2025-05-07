@extends('layouts.webpage')

@section('content')

		<!-- Start main-content -->
        <section class="page-title" style="background-image: url(images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="title-outer">
                    <h1 class="title">Sobre Nosotros</h1>
                    <ul class="page-breadcrumb">
                        <li><a href="">Home</a></li>
                        <li>Sobre Nosotros</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- end main-content -->

        <!-- About Section -->
        <x-about-section />
        <!--Emd About Section -->
    
        <!-- Courses Section -->
        <x-courses-carousel-section />
        <!-- End Courses Section-->

        <!-- Features Section -->
        <x-features-section />
        <!-- End Features Section-->

        <!-- Team Section -->
        <x-team-section />
        <!-- End Team Section -->

@stop