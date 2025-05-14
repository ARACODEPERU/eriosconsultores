@extends('layouts.webpage')

@section('content')

	
    <!--====== PAGE BANNER PART START ======-->
    
    <section id="page-banner" class="pt-80 pb-80 bg_cover" data-overlay="8" style="background-image: url({{ asset('themes/webpage/images/page-banner-1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Contacto</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contacto</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
    
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
                            <form id="contact-form" action="contact.php" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="name" type="text" placeholder="Nombres Completos" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="single-form form-group">
                                            <input name="subject" type="text" placeholder="DNI" data-error="Subject is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form --> 
                                    </div>
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
                                            <textarea name="message" placeholder="Escribir Mensaje" data-error="Please,leave us a message." required="required"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="single-form">
                                            <button type="submit" class="main-btn">Enviar</button>
                                        </div> <!-- single form -->
                                    </div> 
                                </div> <!-- row -->
                            </form>
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
                <div class="col-lg-5">
                    <div class="contact-address mt-30">
                        <ul>
                            <li>
                                <div class="single-address">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>Urbanización Los Rosales de Santa Inés mz c lote 9 int. 2</p>
                                    </div>
                                </div> <!-- single address -->
                            </li>
                            <li>
                                <div class="single-address">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>990 687 621</p>
                                    </div>
                                </div> <!-- single address -->
                            </li>
                            <li>
                                <div class="single-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>eriosc0406@gmail.com</p>
                                    </div>
                                </div> <!-- single address -->
                            </li>
                        </ul>
                    </div> <!-- contact address -->
                    <div class="map mt-30">
                        <div id="contact-map"></div>
                    </div> <!-- map -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== CONTACT PART ENDS ======-->

@stop