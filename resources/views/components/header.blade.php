<div>
    <header id="header-part">
        <div class="header-top d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="header-contact">
                            <ul>
                                <li><i class="fa fa-envelope"></i><a href="#">info@yourmail.com</a></li>
                                <li><i class="fa fa-phone"></i><span>+0123-456-5678</span></li>
                            </ul>
                        </div> <!-- header contact -->
                    </div>
                    <div class="col-md-6">
                        <div class="header-right d-flex justify-content-end">
                            <div class="social d-flex">
                                <span class="follow-us">Siguenos en :</span>
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                                    {{-- <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li> --}}
                                    <li><a href="#"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div> <!-- social -->
                            {{-- <div class="login-register">
                                <ul>
                                    <li><a href="register.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                </ul>
                            </div> --}}
                        </div> <!-- header right -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header top -->
        
        <div class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="index-4.html">
                                <img style="width: 180px;" src="{{  asset('themes/webpage/images/Logo_Web.jpg') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="active" href="{{ route('index_main') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('web_about') }}">Nosotros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('web_about') }}">Servicios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('web_about') }}">Cursos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('web_about') }}">Contactanos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('web_about') }}">Campus Virtual</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right-icon text-right">
                                <ul>
                                    {{-- <li><a href="javascript:void(0)" id="search"><i class="fa fa-search"></i></a></li> --}}
                                    <li><a href="#"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>
                                </ul>
                            </div> <!-- right icon -->
                        </nav> <!-- nav -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>
    </header>
</div>