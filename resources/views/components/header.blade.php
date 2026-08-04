<div>
    <header id="header-part">
        <div class="header-top d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="header-contact">
                            <ul>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:{{ $header[0]->content }}">{{ $header[0]->content }}</a>
                                </li>
                                <li><i class="fa fa-phone"></i><span>{{ $header[1]->content }}</span></li>
                            </ul>
                        </div> <!-- header contact -->
                    </div>
                    <div class="col-md-6">
                        <div class="header-right d-flex justify-content-end">
                            <div class="social d-flex">
                                <span class="follow-us">Siguenos en :</span>
                                <ul>
                                    <li>
                                        <a style="padding: 0px 5px;" href="{{ $header[2]->content }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                    </li>
                                    {{-- <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li> --}}
                                    <li>
                                        <a style="padding: 0px 5px;" href="{{ $header[3]->content }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fab fa-instagram" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a style="padding: 0px 5px;" href="{{ $header[4]->content }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fab fa-linkedin" aria-hidden="true"></i></a>
                                    </li>
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
                                <img style="width: 180px;" src="{{ asset('storage/' . $header[5]->content) }}"
                                    alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="{{ request()->routeIs('index_main') ? 'active' : '' }}"
                                            href="{{ route('index_main') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ request()->routeIs('web_about') ? 'active' : '' }}"
                                            href="{{ route('web_about') }}">Nosotros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ request()->routeIs('web_services') ? 'active' : '' }}"
                                            href="{{ route('web_services') }}">Servicios</a>
                                    </li>
                                    {{-- <li class="nav-item">
            <a class="{{ request()->routeIs('web_courses') ? 'active' : '' }}" href="{{ route('web_courses') }}">Cursos</a>
        </li> --}}
                                    <li class="nav-item">
                                        <a class="{{ request()->routeIs('web_contact_us') ? 'active' : '' }}"
                                            href="{{ route('web_contact_us') }}">Contactanos</a>
                                    </li>
                                    <li class="nav-item">
                                        <!-- Nota: Esta ruta apunta a 'web_about', si tienes una ruta específica para el campus, cámbiala aquí también -->
                                        <a class="{{ request()->routeIs('web_about') ? 'active' : '' }}"
                                            href="{{ route('web_about') }}">Campus Virtual</a>
                                    </li>
                                </ul>
                            </div>
                            {{-- <div class="right-icon text-right">
                                <ul>
                                    <li><a href="#"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>
                                </ul>
                            </div> --}}
                        </nav> <!-- nav -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>
    </header>
</div>
