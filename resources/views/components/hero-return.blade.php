<div>
    <section id="page-banner" class="pt-80 pb-80 bg_cover" data-overlay="8" style="background-image: url({{ asset('storage/' . $hero[1]->content ?? '') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>{{ $hero[0]->content ?? '' }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index_main') }}">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $hero[0]->content ?? '' }}</li>
                            </ol>
                        </nav>
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
</div>