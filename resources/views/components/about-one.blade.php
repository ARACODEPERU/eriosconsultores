<div>
    <section id="about-part" class="pt-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>{{ $about[0]->content }}</h5>
                        <h2>{{ $about[1]->content }} </h2>
                    </div> <!-- section title -->
                    <div class="about-cont">
                        <p>
                            {{ $about[2]->content }}
                        </p>
                        <a href="{{ route('web_about') }}" class="main-btn mt-55">Leer Más</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{ asset('storage/' . $about[3]->content) }}" alt="About">
                    </div>  <!-- about image -->
                </div> 
                {{-- <div class="col-lg-6 offset-lg-1">
                    <div class="about-event mt-30">
                        <ul>
                            <li>
                                <div class="single-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2018</span>
                                    <a href="events-single.html"><h4>Campus clean workshop</h4></a>
                                    <span><i class="fa fa-map-marker"></i> Rc Auditorim</span>
                                </div>
                            </li>
                            <li>
                                <div class="single-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2018</span>
                                    <a href="events-single.html"><h4>Tech Summit</h4></a>
                                    <span><i class="fa fa-map-marker"></i> Rc Auditorim</span>
                                </div>
                            </li>
                            <li>
                                <div class="single-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2018</span>
                                    <a href="events-single.html"><h4>Environment conference</h4></a>
                                    <span><i class="fa fa-map-marker"></i> Rc Auditorim</span>
                                </div>
                            </li>
                        </ul> 
                    </div>
                </div> --}}
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="about-bg">
            <img src="{{ asset('storage/' . $about[3]->content ) }}" alt="About">
        </div>
    </section>
</div>