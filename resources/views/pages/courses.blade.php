@extends('layouts.webpage')

@section('meta_title', 'Cursos')
@section('meta_description', 'Catálogo de cursos y diplomados de ERIOS CONSULTORES: modalidades En Vivo, Presencial y E-learning, horarios flexibles y certificación incluida. ¡Inscríbete ya!')

@section('page_styles')
<style>
    /* ============ Catálogo de cursos: pestañas + paginación ============ */
    .cursos-catalogo { padding: 24px 0 80px; }

    .cursos-catalogo__banner { width: 100%; border-radius: 14px; }

    .cursos-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        border: 0;
        margin: 26px 0 22px;
    }

    .cursos-tabs .nav-link {
        background: #fff;
        border: 1px solid #dbe4f0;
        border-radius: 999px;
        color: #004aad;
        font-size: 14px;
        font-weight: 700;
        padding: 8px 18px;
        cursor: pointer;
    }

    .cursos-tabs .nav-link.active,
    .cursos-tabs .nav-link:hover {
        background: #004aad;
        border-color: #004aad;
        color: #fff;
    }

    .cursos-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 24px;
    }

    .curso-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: #fff;
        border: 1px solid #e6ebf2;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(14, 23, 38, .05);
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .curso-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 74, 173, .14);
    }

    .curso-card__media {
        position: relative;
        display: block;
        aspect-ratio: 16 / 10;
        background: #f4f7fb;
    }

    .curso-card__media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .curso-card__off {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #e30613;
        border-radius: 999px;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        padding: 4px 10px;
    }

    .curso-card__body {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 10px;
        padding: 18px;
    }

    .curso-card__tipo {
        color: #e30613;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
    }

    .curso-card__title,
    .curso-card__title-link {
        color: #1d2025;
        font-size: 18px;
        font-weight: 700;
        line-height: 26px;
        margin: 0;
        min-height: 52px;
        text-decoration: none;
    }

    .curso-card__title-link:hover { color: #004aad; }

    .curso-card__actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: auto;
    }

    .curso-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border: 0;
        border-radius: 999px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
        padding: 9px 16px;
        text-decoration: none;
    }

    .curso-btn--info { background: #eef3fb; color: #004aad; }
    .curso-btn--info:hover { background: #004aad; color: #fff; }
    .curso-btn--primary { background: #004aad; color: #fff; }
    .curso-btn--primary:hover { background: #00397f; color: #fff; }
    .curso-btn del { font-weight: 500; opacity: .7; }

    .curso-card__subs { color: #6a4c93; font-size: 12px; }

    .cursos-empty {
        background: #fff;
        border: 1px dashed #dbe4f0;
        border-radius: 14px;
        color: #505050;
        padding: 48px 24px;
        text-align: center;
    }

    .cursos-pager {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 32px;
    }

    .cursos-pager button {
        min-width: 40px;
        height: 40px;
        background: #fff;
        border: 1px solid #dbe4f0;
        border-radius: 10px;
        color: #004aad;
        cursor: pointer;
        font-weight: 700;
        padding: 0 14px;
    }

    .cursos-pager button.active { background: #004aad; border-color: #004aad; color: #fff; }
    .cursos-pager button:disabled { cursor: default; opacity: .45; }

    @media (max-width: 991px) {
        .cursos-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 575px) {
        .cursos-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
    @php
        // Items por pagina del listado "Todos" (3 columnas x 3 filas).
        $perPage = 9;
        $total = $courses->count();
        $totalPages = max(1, (int) ceil($total / $perPage));
    @endphp

    <div class="cursos-catalogo">
        
    {{-- ======== Hero de la página ======== --}}
    <x-page-hero eyebrow="Formación ERIOS" title="Catálogo de Cursos"
        subtitle="Capacítate con especialistas en materia tributaria, contable y empresarial: modalidades En Vivo, Presencial y E-learning, con certificación incluida."
        heroComponent="hero_cursos_15" />

        <div class="container">
            
            <ul class="nav cursos-tabs" id="cursos-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="todos-tab" data-toggle="pill" href="#todos" role="tab"
                        aria-controls="todos" aria-selected="true" onclick="cursosMostrarTodos()">Todos</a>
                </li>

                @foreach ($types as $index => $type)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tipo-{{ $index }}-tab" data-toggle="pill" href="#tipo-{{ $index }}"
                            role="tab" aria-controls="tipo-{{ $index }}" aria-selected="false"
                            onclick="cursosMostrarTipo()">{{ $type }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content" id="cursos-tab-content">
                <div class="tab-pane fade show active" id="todos" role="tabpanel" aria-labelledby="todos-tab">
                    @if ($total === 0)
                        <div class="cursos-empty">Todavía no hay cursos publicados en el catálogo.</div>
                    @else
                        @for ($page = 0; $page < $totalPages; $page++)
                            <div class="cursos-grid cursos-page-group cursos-page-{{ $page + 1 }}"
                                @if ($page > 0) style="display: none;" @endif>
                                @foreach ($courses->slice($page * $perPage, $perPage) as $card)
                                    <x-course-card :card="$card" />
                                @endforeach
                            </div>
                        @endfor
                    @endif
                </div>

                @foreach ($types as $index => $type)
                    <div class="tab-pane fade" id="tipo-{{ $index }}" role="tabpanel"
                        aria-labelledby="tipo-{{ $index }}-tab">
                        <div class="cursos-grid">
                            @foreach ($courses->where('type', $type) as $card)
                                <x-course-card :card="$card" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($total > 0)
                <div class="cursos-pager" id="cursos-pager">
                    <button type="button" id="cursos-prev" disabled>Previo</button>

                    @for ($i = 1; $i <= $totalPages; $i++)
                        <button type="button" class="cursos-page-link @if ($i === 1) active @endif"
                            data-page="{{ $i }}">{{ $i }}</button>
                    @endfor

                    <button type="button" id="cursos-next" @if ($totalPages === 1) disabled @endif>Siguiente</button>
                </div>
            @endif
        </div>
    </div>

    @include('components.onli-cart-script')

    <script>
        // El paginador solo aplica al listado "Todos": al abrir una pestaña por
        // tipo se oculta para no mostrar botones de páginas que no existen.
        function cursosMostrarTodos() {
            var pager = document.getElementById('cursos-pager');
            if (pager) pager.hidden = false;
        }

        function cursosMostrarTipo() {
            var pager = document.getElementById('cursos-pager');
            if (pager) pager.hidden = true;
        }

        document.addEventListener('DOMContentLoaded', function () {
            var links = document.querySelectorAll('.cursos-page-link');
            var prev = document.getElementById('cursos-prev');
            var next = document.getElementById('cursos-next');
            var totalPages = links.length;

            if (!totalPages || !prev || !next) return;

            var currentPage = 1;

            function showPage(page) {
                if (page < 1) page = 1;
                if (page > totalPages) page = totalPages;
                currentPage = page;

                document.querySelectorAll('.cursos-page-group').forEach(function (group) {
                    group.style.display = 'none';
                });

                var selected = document.querySelector('.cursos-page-' + currentPage);
                if (selected) selected.style.display = '';

                links.forEach(function (link) {
                    link.classList.toggle('active', parseInt(link.dataset.page, 10) === currentPage);
                });

                prev.disabled = currentPage === 1;
                next.disabled = currentPage === totalPages;
            }

            links.forEach(function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    showPage(parseInt(this.dataset.page, 10));
                });
            });

            prev.addEventListener('click', function () { showPage(currentPage - 1); });
            next.addEventListener('click', function () { showPage(currentPage + 1); });

            showPage(1);
        });
    </script>
@endsection
