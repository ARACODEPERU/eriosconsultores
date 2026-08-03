<div>
    <section id="about-page" class="pt-70 pb-110">
        <div class="container">
            @foreach ($services as $service)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section-title mt-50">
                            <h2>{{ $service->item->items[1]->content }}</h2>
                        </div> 
                        <div class="about-cont">
                            <p>
                                {{ $service->item->items[2]->content }}
                            </p>
                            <p>
                                {{ $service->item->items[3]->content }}
                            </p>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="about-image mt-50">
                            <img src="{{ asset('storage/' . $service->item->items[0]->content) }}" alt="Services">
                        </div>  <!-- about image -->
                    </div> 
                </div>
                <br/>
            @endforeach
        </div> 
    </section>
</div>