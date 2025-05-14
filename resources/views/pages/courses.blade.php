@extends('layouts.webpage')

@section('content')


    <!--====== PAGE BANNER PART START ======-->
    
    <section id="page-banner" class="pt-80 pb-80 bg_cover" data-overlay="8" style="background-image: url({{ asset('themes/webpage/images/page-banner-1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Cursos</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cursos</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== COURSES PART START ======-->
    
    <section id="courses-part" class="pt-40 pb-80 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <ul class="nav float-left" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="all-tab" data-toggle="tab" href="#all"
                                     role="tab" aria-controls="all" aria-selected="true">
                                     <i class="fa fa-th-large"></i> Todos
                                </a>&nbsp;&nbsp;
                            </li>
                            <li class="nav-item">
                                <a id="tributario-tab" data-toggle="tab" href="#tributario" 
                                    role="tab" aria-controls="tributario" aria-selected="false">
                                    <i class="fa fa-th-list"></i> Tributario
                                </a>&nbsp;&nbsp;
                            </li>
                            <li class="nav-item">
                                <a id="niif-tab" data-toggle="tab" href="#niif" 
                                    role="tab" aria-controls="niif" aria-selected="false">
                                    <i class="fa fa-th-list"></i> Niif
                                </a>&nbsp;&nbsp;
                            </li>
                            <li class="nav-item">
                                <a id="auditoria-tab" data-toggle="tab" href="#auditoria" 
                                    role="tab" aria-controls="auditoria" aria-selected="false">
                                    <i class="fa fa-th-list"></i> Auditoria
                                </a>&nbsp;&nbsp;
                            </li>
                        </ul> <!-- nav -->
                        
                        <div class="float-right">
                            <li class="nav-item"> 4 0f 24 Results</li>
                        </div> <!-- niif search -->
                    </div> <!-- niif top search -->
                </div>
            </div> <!-- row -->
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tributario" role="tabpanel" aria-labelledby="tributario-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="niif" role="tabpanel" aria-labelledby="niif-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="auditoria" role="tabpanel" aria-labelledby="auditoria-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-course mt-30">
                                <div class="thum">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                    </div>
                                    <div class="price">
                                        <span>S/ 150</span>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="">
                                        <h5>Título del curso</h5>
                                    </a>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- tab content -->
            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="active" href="#">1</a></li>
                            <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li>
                            <li class="page-item">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>  <!-- courses pagination -->
                </div>
            </div>  <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== COURSES PART ENDS ======-->

@stop
