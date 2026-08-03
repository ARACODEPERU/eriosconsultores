<div>
    <section id="testimonial" class="bg_cover pt-115 pb-120" data-overlay="8" style="background-image: url({{ asset('themes/webpage/images/bg-2.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-40">
                        <h5>{{ $testimonial_presentation[0]->content }}</h5>
                        <h2>{{ $testimonial_presentation[1]->content }}</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row testimonial-slide mt-40">
                @foreach ($testimonial_information as $k => $testimonial)
                <div class="col-lg-6">
                    <div class="single-testimonial">
                        <div class="testimonial-thum">
                            <img src="{{ asset('storage/' . $testimonial->item->items[0]->content) }}" alt="Testimonial">
                            <div class="quote">
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="testimonial-cont">
                            <p>{{ $testimonial->item->items[1]->content }}</p>
                            <h6>{{ $testimonial->item->items[2]->content }}</h6>
                            <span>{{ $testimonial->item->items[3]->content }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-lg-6">
                    <div class="single-testimonial">
                        <div class="testimonial-thum">
                            <img src="{{ asset('themes/webpage/images/testimonial/t-1.jpg') }}" alt="Testimonial">
                            <div class="quote">
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="testimonial-cont">
                            <p>Aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet sem nibh id elit sollicitudirem </p>
                            <h6>Rubina Helen</h6>
                            <span>Bsc, Engineering</span>
                        </div>
                    </div> <!-- single testimonial -->
                <div class="col-lg-6">
                    <div class="single-testimonial">
                        <div class="testimonial-thum">
                            <img src="{{ asset('themes/webpage/images/testimonial/t-2.jpg') }}" alt="Testimonial">
                            <div class="quote">
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="testimonial-cont">
                            <p>Aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet sem nibh id elit sollicitudirem </p>
                            <h6>Rubina Helen</h6>
                            <span>Bsc, Engineering</span>
                        </div>
                    </div> <!-- single testimonial -->
                </div>
                <div class="col-lg-6">
                    <div class="single-testimonial">
                        <div class="testimonial-thum">
                            <img src="{{ asset('themes/webpage/images/testimonial/t-3.jpg') }}" alt="Testimonial">
                            <div class="quote">
                                <i class="fa fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="testimonial-cont">
                            <p>Aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet sem nibh id elit sollicitudirem </p>
                            <h6>Rubina Helen</h6>
                            <span>Bsc, Engineering</span>
                        </div>
                    </div> <!-- single testimonial -->
                </div> --}}
            </div> <!-- testimonial slide -->
        </div> <!-- container -->
    </section>
</div>