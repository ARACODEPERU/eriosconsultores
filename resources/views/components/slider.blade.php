<div>
    <section id="slider-part" class="slider-active ">
        
        @foreach ($sliders as $k => $slide)
        <div class="single-slider bg_cover pt-150" style="background-image: url({{ asset('storage/' . $slide->item->items[0]->content) }})" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="fadeInLeft" data-delay="1s">{{ $slide->item->items[1]->content }}</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s">
                                {{ $slide->item->items[2]->content }}
                            </p>
                            <ul>
                                <li>
                                    <a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="{{ $slide->item->items[3]->content }}">Leer Más</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
        @endforeach
           
    </section>
</div>