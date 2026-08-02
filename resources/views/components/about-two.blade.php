<div>
    
    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>{{ $about[0]->content }}</h5>
                        <h2>{{ $about[1]->content }}</h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>
                            {{ $about[2]->content }}
                        </p>
                        <p>
                            {{ $about[3]->content }}
                        </p>
                    </div>
                </div> <!-- about cont -->
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('storage/' . $about[5]->content) }}" alt="About">
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
</div>