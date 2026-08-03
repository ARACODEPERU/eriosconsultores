<div>
    <footer id="footer-part">
        <div class="footer-top pt-40 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer-link mt-40">
                            <div class="footer-title pb-25">
                                <h6>Navegar</h6>
                            </div>
                            <ul>
                                <li><a href="{{ route('index_main') }}"><i class="fa fa-angle-right"></i>Home</a></li>
                                <li><a href="{{ route('web_about') }}"><i class="fa fa-angle-right"></i>Nosotros</a></li>
                                <li><a href="{{ route('web_services') }}"><i class="fa fa-angle-right"></i>Servicios</a></li> 
                                {{-- <li><a href="{{ route('web_courses') }}"><i class="fa fa-angle-right"></i>Cursos</a></li> --}}
                                <li><a href="{{ route('web_contact_us') }}"><i class="fa fa-angle-right"></i>Contactanos</a></li>
                            </ul>
                        </div> <!-- footer link -->
                    </div>
                    <div class="col-md-4">
                        <div class="footer-link support mt-40">
                            <div class="footer-title pb-25">
                                <h6>Políticas</h6>
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-right"></i>Politicas de Privacidad</a></li>
                            </ul>
                        </div> <!-- support -->
                    </div>
                    <div class="col-md-4">
                        <div class="footer-address mt-40">
                            <div class="footer-title pb-25">
                                <h6>Contactanos</h6>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>{{ $footer[0]->content }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>{{ $footer[1]->content }}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p><a href="mailto:{{ $footer[2]->content }}">{{ $footer[2]->content }}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-about mt-40">
                            <ul class="mt-20">
                                <li>
                                    <a style="padding: 0px 5px;" href="{{ $footer[3]->content }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    </a>
                                </li>
                                {{-- <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li> --}}
                                <li>
                                    <a style="padding: 0px 5px;" href="{{ $footer[4]->content }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fab fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a style="padding: 0px 5px;" href="{{ $footer[5]->content }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <i class="fab fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-copyright pt-10 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright text-md-left text-center pt-15">
                            <p>&copy; Copyrights 2026 | ERIOS CONSULTORES Todos los derechos reservados. </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="copyright text-md-right text-center pt-15">
                            <p>Desarrollado por <span><a href="https://aracodeperu.com/">ARACODE SMART
                                        SOLUTIONS</a></span> </p>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer copyright -->
    </footer>
</div>
