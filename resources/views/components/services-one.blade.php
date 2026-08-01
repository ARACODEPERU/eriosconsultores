<div>
    <section id="apply-aprt" class="pb-120">
        <div class="container">
            <div class="apply">
                <div class="row no-gutters">
                    @foreach ($services as $k => $service)
                        <div class="col-lg-6">
                            <div class="apply-cont apply-color-2" style="border: 0px;">
                                <h3>
                                    {{ $service->item->items[1]->content }}
                                </h3>
                                <a href="{{ $service->item->items[4]->content }}" class="main-btn">
                                   <i class="fab fa-whatsapp" style="font-size: 20px;"></i> Me interesa
                                </a>
                            </div> 
                        </div>
                    @endforeach
                    {{-- <div class="col-lg-6">
                        <div class="apply-cont apply-color-2" style="border: 0px;">
                            <h3>
                                Servicio de apoyo en Fiscalización o verificación de SUNAT
                            </h3>
                            <a href="#" class="main-btn">Aplicar Ahora</a>
                        </div> 
                    </div>  --}}
                </div>
                {{-- <div class="row no-gutters">
                    <div class="col-lg-6">
                        <div class="apply-cont apply-color-2" style="border: 0px;">
                            <h3>
                                Servicio <br> de Auditoría Tributaria Preventiva
                            </h3>
                            <a href="#" class="main-btn">Aplicar Ahora</a>
                        </div> 
                    </div> 
                    <div class="col-lg-6">
                        <div class="apply-cont apply-color-1" style="border: 0px;">
                            <h3>
                                Servicio de <br>Asesoría en Recursos contenciosos
                            </h3>
                            <a href="#" class="main-btn">Aplicar Ahora</a>
                        </div> 
                    </div>
                </div> --}}
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
</div>