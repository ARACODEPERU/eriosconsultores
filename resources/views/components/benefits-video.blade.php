<div>
    <section id="video-feature" class="bg_cover pt-60 pb-110" style="background-image: url({{ asset('storage/'.$benefits[0]->content) }})">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-last order-lg-first">
                    <div class="video text-lg-left text-center pt-50">
                        <a class="Video-popup" href="{{ $benefits[1]->content }}"><i class="fa fa-play"></i></a>
                    </div> 
                </div>
                <div class="col-lg-5 offset-lg-1 order-first order-lg-last">
                    <div class="feature pt-50">
                        <ul>
                            <li>
                                <div class="single-feature">
                                    <div class="icon">
                                        <img src="{{ asset('storage/'.$benefits[2]->content) }}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{ $benefits[3]->content }}</h4>
                                        <p>{{ $benefits[4]->content }}</p>
                                    </div>
                                </div> 
                            </li>
                            <li>
                                <div class="single-feature">
                                    <div class="icon">
                                        <img src="{{ asset('storage/'.$benefits[5]->content) }}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{ $benefits[6]->content }}</h4>
                                        <p>{{ $benefits[7]->content }}</p>
                                    </div>
                                </div> 
                            </li>
                            <li>
                                <div class="single-feature">
                                    <div class="icon">
                                        <img src="{{ asset('storage/'.$benefits[8]->content) }}" alt="icon">
                                    </div>
                                    <div class="cont">
                                        <h4>{{ $benefits[9]->content }}</h4>
                                        <p>{{ $benefits[10]->content }}</p>
                                    </div>
                                </div> 
                            </li>
                        </ul>
                    </div> <!-- feature -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
        <div class="feature-bg"></div> <!-- feature bg -->
    </section>
</div>