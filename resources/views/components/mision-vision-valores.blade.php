<div>
    <section id="mvv-page" class="pb-110">
        <div class="container">

            {{-- ======== Encabezado de sección ======== --}}
            <div class="erc-services-head">
                <span class="erc-eyebrow">Identidad corporativa</span>
                <h2>Misión, visión y valores</h2>
                <p>Los principios que guían cada servicio que damos a nuestros clientes.</p>
            </div>

            {{-- ======== Grid de tarjetas ======== --}}
            <div class="erc-mvv-grid">
                @php
                    $mvvCards = [
                        ['icon' => 'fa-bullseye', 'num' => $mvv[0]->content, 'title' => $mvv[1]->content, 'text' => $mvv[2]->content],
                        ['icon' => 'fa-eye', 'num' => $mvv[3]->content, 'title' => $mvv[4]->content, 'text' => $mvv[5]->content],
                        ['icon' => 'fa-handshake', 'num' => $mvv[6]->content, 'title' => $mvv[7]->content, 'text' => $mvv[8]->content],
                    ];
                @endphp
                @foreach ($mvvCards as $card)
                    <article class="erc-mvv-card">
                        <div class="erc-mvv-card__top">
                            <span class="erc-mvv-card__icon"><i class="fa {{ $card['icon'] }}" aria-hidden="true"></i></span>
                            <span class="erc-mvv-card__num">{{ $card['num'] }}</span>
                        </div>
                        <h4 class="erc-mvv-card__title">{{ $card['title'] }}</h4>
                        <p class="erc-mvv-card__text">{{ $card['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</div>
