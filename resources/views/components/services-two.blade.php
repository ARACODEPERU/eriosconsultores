<div>
    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            @foreach ($services as $service)
                <div class="row align-items-center mb-4">
                    <!-- Columna de Texto -->
                    <div class="col-lg-6 {{ $loop->iteration % 2 == 0 ? 'order-lg-2' : 'order-lg-1' }}">
                        <div class="section-title mt-50">
                            <h3>{{ $service->item->items[1]->content }}</h3>
                        </div>
                        <div class="about-cont">
                            <p>{{ $service->item->items[2]->content }}</p>
                            <p>{{ $service->item->items[3]->content }}</p>
                        </div>
                    </div>

                    <!-- Columna de Imagen -->
                    <div class="col-lg-6 {{ $loop->iteration % 2 == 0 ? 'order-lg-1' : 'order-lg-2' }}">
                        <div class="about-image mt-50">
                            <img src="{{ asset('storage/' . $service->item->items[0]->content) }}" alt="Services"
                                class="img-fluid">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
