<div>
    <section id="video-feature" class="erc-video-band">
        <div class="container">
            <div class="row align-items-center">

                {{-- ======== Video ======== --}}
                <div class="col-lg-5 order-last order-lg-first" data-reveal>
                    <div class="erc-video__playwrap">
                        <a class="erc-video__play Video-popup" href="{{ $benefits[1]->content }}" aria-label="Ver video">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                    </div>
                    <p class="erc-video__note">Conoce a ERIOS en 2 minutos</p>
                </div>

                {{-- ======== Beneficios ======== --}}
                <div class="col-lg-6 offset-lg-1 order-first order-lg-last">
                    <div class="erc-sec-head erc-sec-head--left" data-reveal>
                        <span class="erc-sec-eyebrow">¿Por qué elegirnos?</span>
                        <h2 style="color:#fff;">Beneficios que marcan la diferencia</h2>
                    </div>
                    <div class="erc-vfeat-grid">
                        @php
                            $vfeats = [
                                ['icon' => 'fa-university', 'title' => $benefits[3]->content, 'text' => $benefits[4]->content],
                                ['icon' => 'fa-cogs', 'title' => $benefits[6]->content, 'text' => $benefits[7]->content],
                                ['icon' => 'fa-check-circle', 'title' => $benefits[9]->content, 'text' => $benefits[10]->content],
                            ];
                        @endphp
                        @foreach ($vfeats as $i => $feat)
                            <div class="erc-vfeat" data-reveal data-reveal-delay="{{ $i * 120 }}">
                                <span class="erc-vfeat__icon"><i class="fa {{ $feat['icon'] }}" aria-hidden="true"></i></span>
                                <div>
                                    <h4>{{ $feat['title'] }}</h4>
                                    <p>{{ $feat['text'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
</div>
