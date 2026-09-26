{{--
    Tarjeta del catalogo de cursos.

    Consume el arreglo que arma WebPageController::courseCard(): titulo, imagen ya
    resuelta (storage/landing), tipo (onli_items.additional), categoria, precio con
    descuento (price_label / final_label) y el descuento para suscriptores
    (subs_percent / subs_label).

    El boton del carrito guarda solo el id del item de tienda (onli_items.id), que es
    lo que espera el endpoint del carrito (onlineshop_get_item_carrito); por eso se
    reutiliza el mismo contrato de data-* de la landing del curso.
--}}
@props(['card'])

@php
    // URL publica: landing publicada si existe; si no, la descripcion del curso por slug.
    $url = $card['url'] ?: (filled($card['slug'] ?? null) ? route('web_curso_descripcion', $card['slug']) : null);

    $tipo = $card['type'] ?: $card['category'];
    $hasDiscount = ($card['discount_percent'] ?? 0) > 0;
    $hasSubs = ($card['subs_percent'] ?? 0) > 0;
@endphp

<article class="curso-card">
    <div class="curso-card__media">
        @if ($url)<a href="{{ $url }}" aria-label="Ver {{ $card['title'] }}">@endif
        <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" loading="lazy">
        @if ($url)</a>@endif

        @if ($hasDiscount)
            <span class="curso-card__off">-{{ $card['discount_percent'] }}%</span>
        @endif
    </div>

    <div class="curso-card__body">
        @if ($tipo)
            <span class="curso-card__tipo">{{ $tipo }}</span>
        @endif

        @if ($url)
            <a href="{{ $url }}" class="curso-card__title-link">
                <h3 class="curso-card__title">{{ $card['title'] }}</h3>
            </a>
        @else
            <h3 class="curso-card__title">{{ $card['title'] }}</h3>
        @endif

        <div class="curso-card__actions">
            @if ($url)
                <a href="{{ $url }}" class="curso-btn curso-btn--info">Leer Más</a>
            @endif

            {{-- Botón del carrito desactivado por ahora — reactivar cuando se use el flujo de compra (agrega al carrito y lleva a /carrito) --}}
            {{--
            <button type="button" class="curso-btn curso-btn--primary"
                data-erc-cl-inscribe
                data-cart-id="{{ $card['id'] }}"
                data-course-name="{{ $card['title'] }}"
                data-price="{{ $card['item_price'] }}"
                data-cart-url="{{ route('web_carrito') }}">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                @if ($hasDiscount && filled($card['price_label']))
                    <del>{{ $card['price_label'] }}</del> {{ $card['final_label'] }}
                @else
                    {{ $card['final_label'] }}
                @endif
            </button>
            --}}

            {{-- CTA de compra: WhatsApp con mensaje prellenado de compra del curso --}}
            <a href="{{ $card['whatsapp_buy'] }}" target="_blank" rel="noopener" class="curso-btn curso-btn--primary" aria-label="Inscribirse por WhatsApp en {{ $card['title'] }}">
                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                @if ($hasDiscount && filled($card['price_label']))
                    <del>{{ $card['price_label'] }}</del> {{ $card['final_label'] }} — ¡Inscríbete!
                @else
                    {{ $card['final_label'] }} — ¡Inscríbete!
                @endif
            </a>
        </div>

        @if ($hasSubs && filled($card['subs_label']))
            <small class="curso-card__subs">
                Suscriptores:
                @if (filled($card['price_label']))
                    <del>{{ $card['price_label'] }}</del>
                @endif
                <b>{{ $card['subs_label'] }}</b>
            </small>
        @endif
    </div>
</article>
