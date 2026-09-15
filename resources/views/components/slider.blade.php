<div>
    <section id="slider-part" class="slider-active">

        @foreach ($sliders as $k => $slide)
        <div class="single-slider" style="background-image: url({{ asset('storage/' . $slide->item->items[0]->content) }})">
            <div class="erc-hero__overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-9">
                        <div class="erc-hero__content">
                            <span class="erc-hero__badge" data-animation="fadeInUp" data-delay="0.9s">
                                <i class="fa fa-balance-scale" aria-hidden="true"></i> ERIOS Consultores
                            </span>
                            <h1 class="erc-hero__title" data-animation="fadeInLeft" data-delay="1.1s">
                                {{ $slide->item->items[1]->content }}
                            </h1>
                            <p class="erc-hero__text" data-animation="fadeInUp" data-delay="1.3s">
                                {{ $slide->item->items[2]->content }}
                            </p>
                            <div class="erc-hero__actions">
                                <a data-animation="fadeInUp" data-delay="1.5s" class="erc-btn erc-btn--yellow"
                                    href="{{ $slide->item->items[3]->content }}"
                                    {{ str_starts_with(trim($slide->item->items[3]->content), 'http') ? 'target="_blank" rel="noopener"' : '' }}>
                                    Conocer más <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                </a>
                                <a data-animation="fadeInUp" data-delay="1.6s" class="erc-btn erc-btn--ghost"
                                    href="{{ route('web_contact_us') }}">
                                    Contáctanos
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
        @endforeach

    </section>
</div>
