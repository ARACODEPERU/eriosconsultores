@extends('layouts.webpage')

@section('content')


    <!--Main Slider-->
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container" id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    <!-- Slide 1 -->
                    <li data-index="rs-1" data-transition="zoomout">
                        <!-- MAIN IMAGE -->
                        <img src="{{ asset('themes/webpage/images/main-slider/1.jpg') }}" alt="" class="rev-slidebg">

                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme big-ipad-hidden rs-parallaxlevel-1"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-260','-100','-100','-100']"
                        data-voffset="['-270','-190','-190','-190']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-book.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme big-ipad-hidden rs-parallaxlevel-1"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="auto"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-300','-100','-100','-100']"
                        data-voffset="['280','-190','-190','-190']"
                        data-x="['right','right','right','right']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"x:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-globe.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-250','-120','-120','-120']"
                        data-voffset="['190','100','100','100']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1500,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-dots.png') }}" alt=""></figure>
                        </div>


                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-170','120','120','120']"
                        data-voffset="['220','180','180','180']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-star.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-40','120','120','120']"
                        data-voffset="['-160','100','100','100']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-arrow.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-120','-30','-30','-30']"
                        data-voffset="['-180','-180','-180','-180']"
                        data-x="['right','right','right','right']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-dots-2.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-160','-50','0','150']"
                        data-voffset="['170','120','120','120']"
                        data-x="['right','right','right','right']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-circle-1.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['30','-50','0','150']"
                        data-voffset="['300','120','120','120']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-circle-2.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme rs-parallaxlevel-1 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['250','-50','0','150']"
                        data-voffset="['-190','120','120','120']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-circle-3.png') }}" alt=""></figure>
                        </div>


                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 big-ipad-hidden"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-220','-30','-30','-30']"
                        data-voffset="['-80','-180','-180','-180']"
                        data-x="['right','right','right','right']"
                        data-y="['middle','middle','middle','middle']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure><img src="{{ asset('themes/webpage/images/main-slider/icon/icon-bulb.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption tp-resizeme"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="shape"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-hoffset="['-100','-100','-200','-320']"
                        data-voffset="['0','0','-30','-30']"
                        data-x="['right','right','right','right']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":3000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
                            <figure class="main-image"><img src="{{ asset('themes/webpage/images/main-slider/image-1.png') }}" alt=""></figure>
                        </div>

                        <div class="tp-caption"
                        data-paddingbottom="[15,15,15,15]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text" data-height="none"
                        data-width="['750','750','750','750']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-205','-190','-210','-220']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <span class="title">COMIENZA UN NUEVO VIAJE</span>
                        </div>

                        <div class="tp-caption"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text" data-height="none"
                        data-width="['750','750','750','450']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['-55','-50','-50','-90']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <h1>Lo <span class="style-font">mejor en</span> <br>cursos online</h1>
                        </div>

                        <div class="tp-caption"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text" data-height="none"
                        data-width="['750','750','750','450']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['110','90','100','65']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <div class="text">Programas de formación y desarrollo de clase mundial <br>Desarrollada por las mejores docentes</div>
                        </div>


                        <div class="tp-caption" data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[15,15,15,15]"
                        data-paddingright="[15,15,15,15]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-type="text" data-height="none"
                        data-width="['700','750','700','450']"
                        data-whitespace="normal"
                        data-hoffset="['0','0','0','0']"
                        data-voffset="['200','185','200','185']"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        data-textalign="['top','top','top','top']"
                        data-frames='[{"delay":1000,"speed":1500,"frame":"0","from":"y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"auto:auto;","ease":"Power3.easeInOut"}]'>
                            <a href="page-courses.php" class="theme-btn btn-style-one">Ver Cursos</a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </section>
    <!-- End Main Slider-->

    <!-- About Section -->
    <x-about-section />
    <!--Emd About Section -->

    <!-- Courses Section -->
    <x-courses-carousel-section />
    <!-- End Courses Section-->

    <!-- Features Section -->
    <x-features-section />
    <!-- End Features Section-->

    <!-- Categories Section -->
    <section class="categories-section-current">
        <div class="auto-container">
            <div class="anim-icons">
                <span class="icon icon-group-1 bounce-y"></span>
                <span class="icon icon-group-2 bounce-y"></span>
            </div>

            <div class="sec-title text-center">
                <span class="sub-title">Consulta nuestras categorías</span>
                <h2>
                    Principales categorías de cursos <br>
                    populares para mostrar
                </h2>
            </div>

            <div class="row justify-content-center">
                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-student-2"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Gestión <br> Empresarial
                            </a>
                        </h6>
                    </div>
                </div>

                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-stationary"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Artes y <br>Diseño
                            </a>
                        </h6>
                    </div>
                </div>

                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-online-learning"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Ciencias de <br>la Computación
                            </a>
                        </h6>
                    </div>
                </div>

                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-study"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Desarrollo <br> Personal
                            </a>
                        </h6>
                    </div>
                </div>

                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-pie-chart"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Negocios y <br> Finanzas
                            </a>
                        </h6>
                    </div>
                </div>

                <div class="category-block-current col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <div class="inner-box">
                        <div class="icon-box">
                            <i class="icon flaticon-web-2"></i>
                        </div>
                        <h6 class="title">
                            <a href="">
                                Vídeo y <br> Fotografía
                            </a>
                        </h6>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Product Categories -->

    <!-- Signup Section -->
    <section class="signup-section" id="contact">
        <div class="auto-container">
            <div class="anim-icons">
                <span class="icon icon-paper-clip bounce-x"></span>
            </div>
            <div class="outer-box" style="background-image: url({{ asset('themes/webpage/images/background/3.jpg') }})">
                <span class="float-icon icon-pencil-line wow fadeInUp"></span>
                <div class="row">
                    <!-- Title Column -->
                    <div class="title-column col-lg-6 col-md-12 col-sm-12">
                        <div class="sec-title light">
                            <h2>Ponte en contacto con nosotros</h2>
                            <div class="text">
                                Texto corto que invite a comunicarse con la institución
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="form-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <!-- Sign Form -->
                            <div class="signup-form wow fadeInLeft">
                                <!--Contact Form-->
                                <form method="post" action="get" id="contact-form">
                                    <div class="form-group">
                                        <input type="text" name="full_name" placeholder="Nombre completo" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Teléfono" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="Email" placeholder="Email address" required>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="form_message" class="form-control required" rows="9" placeholder="Mensaje"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="theme-btn btn-style-one" type="submit" name="submit-form">Enviar Mensaje</button>
                                    </div>
                                </form>
                            </div>
                            <!--End Contact Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End FAQ Section -->

    <!-- Team Section -->
    <x-team-section />
    <!-- End Team Section -->

    <!-- Call To Action Two -->
    <section class="call-to-action" style="background-image: url({{ asset('/themes/webpage/images/background/1.jpg') }}">
        <div class="anim-icons">
            <span class="icon icon-calculator zoom-one"></span>
            <span class="icon icon-pin-clip zoom-one"></span>
            <span class="icon icon-dots"></span>
        </div>

        <div class="auto-container">
            <div class="row">
                <div class="title-column col-lg-8 col-md-12">
                    <div class="inner-column">
                        <div class="sec-title light">
                            <span class="style-font">Obtenga su</span>
                            <h1>Certificado de <br>Estudio</h1>
                            <a href="" class="theme-btn btn-style-one">
                                <span class="btn-title">Ver Cusos</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="image-column col-lg-4 col-md-12">
                    <figure class="image" style="margin-top: 5px;">
                        {{-- <img src="{{ asset('themes/webpage/images/resource/cta.png') }}" alt=""> --}}
                        <img src="https://netzun.com/_nuxt/img/certificado-netzun-siu.01abb78.jpg" alt="Modelo de certificado opcional de nuestro curso">
                    </figure>
                </div>
            </div>
        </div>
    </section>
    <!--End Call To Action Two -->

    <!-- Testimonial Section Three -->
    <section class="testimonial-section">
        <div class="anim-icons">
            <span class="icon icon-dotted-map-2"></span>
        </div>
        <div class="auto-container">
            <div class="row">
                <div class="title-column col-xl-4 col-lg-5 col-md-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <span class="sub-title">Nuestros testimonios</span>
                            <h2>
                                Lo que
                                dicen <br>
                                de nuestros cursos
                            </h2>
                            <div class="text">Aqui un pequeño texto descriptivo.</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-column col-xl-8 col-lg-7 col-md-12">
                    <div class="carousel-outer">
                        <div class="testimonial-carousel owl-carousel owl-theme">
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-1.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">
                                            Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.
                                        </div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Jame sickres</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Block -->
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-2.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">
                                            Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.
                                        </div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Aleesha brown</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Block -->
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-1.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">
                                            Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.
                                        </div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Jame sickres</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Block -->
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-2.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                        <div class="text">Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.</div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Aleesha brown</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Block -->
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-1.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.</div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Jame sickres</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Testimonial Block -->
                            <div class="testimonial-block">
                                <div class="inner-box">
                                    <div class="content-box">
                                        <figure class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/testi-thumb-2.jpg') }}" alt="">
                                        </figure>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="text">
                                            Lorem ipsum is simply free text dolor sit amet, consectetur adipisicing elit, sed do incididunt ut labore et dolore magna aliqua.
                                        </div>
                                        <div class="info-box">
                                            <span class="icon-quote"></span>
                                            <h4 class="name">Aleesha brown</h4>
                                            <span class="designation">Market Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Testimonial Section Three -->

    <!-- About Section Two-->
    <section class="about-section-two">
        {{-- <div class="anim-icons">
            <span class="icon icon-e wow zoomIn"></span>
            <span class="icon icon-dots-2 bounce-x"></span>
        </div> --}}
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-6 col-md-12 order-2 wow fadeInRight" data-wow-delay="600ms">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>Formación a distancia para desarrollar tus habilidades</h2>
                            <div class="text">
                                Descripción corta de la sección
                            </div>
                        </div>

                        <div class="row">
                            <div class="about-block col-lg-6 col-md-6 col-sm-6 wow fadeInUp">
                                <div class="inner-box">
                                    <span class="info-text">Son excelentes cursos</span>
                                    <div class="info-box">
                                        <div class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/avatar-1.jpg') }}" alt="">
                                        </div>
                                        <h5 class="name">John Doe</h5>
                                        <span class="designation">Student</span>
                                    </div>
                                </div>
                            </div>

                            <div class="about-block style-two col-lg-6 col-md-6 col-sm-6 wow fadeInRight">
                                <div class="inner-box">
                                    <span class="info-text">Muy buenos docentes</span>
                                    <div class="info-box">
                                        <div class="thumb">
                                            <img src="{{ asset('themes/webpage/images/resource/avatar-2.jpg') }}" alt="">
                                        </div>
                                        <h5 class="name">Albart Brown</h5>
                                        <span class="designation">TEACHER</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12">
                    <div class="inner-column wow fadeInLeft">
                        <div class="icons-box">
                            <span class="icon icon-dotted-map"></span>
                            <span class="icon icon-dotted-line"></span>
                            <span class="icon icon-papper-plan"></span>
                        </div>
                        <figure class="image overlay-anim wow fadeInUp">
                            <img src="{{ asset('themes/webpage/images/resource/about-3.jpg') }}" alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Emd About Section Two-->

    <!-- Countdown Section -->
    {{-- <section class="countdown-section">
        <div class="bg-image zoom-two" style="background-image: url({{ asset('themes/webpage/images/background/2.jpg') }})"></div>
        <div class="auto-container">
            <div class="content-box">
                <div class="sec-title light text-center">
                    <span class="sub-title">Book your seat now</span>
                    <h2>Upcoming study trip</h2>
                </div>
                <div class="time-counter wow fadeInUp">
                    <div class="time-countdown" data-countdown="2/2/2026"></div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Deal Section -->

    <!-- News Section -->
    {{-- <section class="news-section" id="news">
        <div class="auto-container">
            <div class="sec-title text-center">
                <span class="sub-title">directly from blog</span>
                <h2>Our latest news &<br> upcoming blog posts</h2>
            </div>

            <div class="row">
                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image">
                                <a href="">
                                    <img src="{{ asset('themes/webpage/images/resource/news-1.jpg') }}" alt="">
                                </a>
                            </figure>
                            <span class="date"><b>20</b> SEP</span>
                        </div>
                        <div class="content-box">
                            <div class="content">
                                <ul class="post-info">
                                    <li><i class="fa fa-user"></i> by Admin</li>
                                    <li><i class="fa fa-comments"></i> 2 Comments</li>
                                </ul>
                                <h4 class="title"><a href="">The quality role of the elementary teacher in education</a></h4>
                                <a href="" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image">
                                <a href="">
                                    <img src="{{ asset('themes/webpage/images/resource/news-2.jpg') }}" alt="">
                                </a>
                            </figure>
                            <span class="date"><b>20</b> SEP</span>
                        </div>
                        <div class="content-box">
                            <div class="content">
                                <ul class="post-info">
                                    <li><i class="fa fa-user"></i> by Admin</li>
                                    <li><i class="fa fa-comments"></i> 2 Comments</li>
                                </ul>
                                <h4 class="title"><a href="">The quality role of the elementary teacher in education</a></h4>
                                <a href="" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="news-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="inner-box">
                        <div class="image-box">
                            <figure class="image">
                                <a href="">
                                    <img src="{{ asset('themes/webpage/images/resource/news-3.jpg') }}" alt="">
                                </a>
                            </figure>
                            <span class="date"><b>20</b> SEP</span>
                        </div>
                        <div class="content-box">
                            <div class="content">
                                <ul class="post-info">
                                    <li><i class="fa fa-user"></i> by Admin</li>
                                    <li><i class="fa fa-comments"></i> 2 Comments</li>
                                </ul>
                                <h4 class="title"><a href="">The quality role of the elementary teacher in education</a></h4>
                                <a href="" class="read-more">Read More <i class="fa fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!--End News Section -->
    
    <!-- Clients Section   -->
    {{-- <section class="clients-section">
        <div class="auto-container">
            <!-- Sponsors Outer -->
            <div class="sponsors-outer">
                <!--clients carousel-->
                <ul class="clients-carousel owl-carousel owl-theme">
                    <li class="slide-item"> <a href="#"><img src="{{ asset('themes/webpage/images/resource/client.png') }}" alt=""></a> </li>
                    <li class="slide-item"> <a href="#"><img src="{{ asset('themes/webpage/images/resource/client.png') }}" alt=""></a> </li>
                    <li class="slide-item"> <a href="#"><img src="{{ asset('themes/webpage/images/resource/client.png') }}" alt=""></a> </li>
                    <li class="slide-item"> <a href="#"><img src="{{ asset('themes/webpage/images/resource/client.png') }}" alt=""></a> </li>
                    <li class="slide-item"> <a href="#"><img src="{{ asset('themes/webpage/images/resource/client.png') }}" alt=""></a> </li>
                </ul>
            </div>
        </div>
    </section> --}}
    <!--End Clients Section -->



@stop