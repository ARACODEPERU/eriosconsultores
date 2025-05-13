@extends('layouts.webpage')

@section('content')

    <!--====== PAGE BANNER PART START ======-->
    
    <section id="page-banner" class="pt-80 pb-80 bg_cover" data-overlay="8" style="background-image: url({{ asset('themes/webpage/images/page-banner-1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>About Us</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== ABOUT PART START ======-->
    
    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>About us</h5>
                        <h2>Bienvanidos a ERIOS </h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>
                            Somos una Compañía peruana que brinda servicios especializados en materia tributaria a las empresas peruanas, 
                            que les permita cumplir con sus obligaciones tributarias formales y sustanciales y de esta manera evitar el 
                            riesgo de tener observaciones en una fiscalización de SUNAT y también que les permita optimizar su carga 
                            fiscal.
                        </p>
                        <p>
                            Bridamos una atención personalizada a cada cliente, según la realidad de su negocio y considerando los riesgos 
                            tributarios aplicables al sector. Asimismo, brindamos recomendaciones de control interno tributario que permitan 
                            generar los medios probatorios durante todo el proceso operativo, los cuales permitirán levantar las 
                            observaciones e n una fiscalización.
                        </p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('themes/webpage/images/about/about-2.jpg') }}" alt="About">
                    </div>  <!-- about image -->
                </div> 
            </div> <!-- row -->
            <div class="about-items pt-60">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-single-items mt-30">
                            <span>01</span>
                            <h4>Misión</h4>
                            <p>
                                ERIOS Tax & Compliance es una empresa de Consultoría Tributaria altamente especializada que brinda servicio 
                                de alta calidad, con un equipo con amplia experiencia en el campo tributario que permite a sus clientes 
                                gestionar el riesgo tributario y crecer sostenidamente.
                            </p>
                        </div> <!-- about single -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-single-items mt-30">
                            <span>02</span>
                            <h4>Visión</h4>
                            <p>
                                Ser la Compañía peruana que lidera el mercado en Servicios de Consultoría Tributaria altamente especializada tanto a nivel nacional y también internacional.
                            </p>
                        </div> <!-- about single -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="about-single-items mt-30">
                            <span>03</span>
                            <h4>Valores</h4>
                            <p>
                                Compromiso, responsabilidad, integridad , proactividad y eficiencia.
                            </p>
                        </div> <!-- about single -->
                    </div>
                </div> <!-- row -->
            </div> <!-- about items -->
        </div> <!-- container -->
    </section>
    
    <!--====== ABOUT PART ENDS ======-->

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
   
    <!--====== TEASTIMONIAL PART START ======-->
    <x-testimonial />
    <!--====== TEASTIMONIAL PART ENDS ======-->
   
    <!--====== PATNAR LOGO PART START ======-->
    
    <div id="patnar-logo" class="pt-40 pb-80 gray-bg">
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
    </div> 
    
    <!--====== PATNAR LOGO PART ENDS ======-->
   

@stop