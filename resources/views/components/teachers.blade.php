<div>
    <section id="teachers-part" class="pt-70 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>{{ $teachers_presentation[0]->content }}</h5>
                        <h2>{{ $teachers_presentation[1]->content }}</h2>
                    </div> <!-- section title -->
                    <div class="teachers-cont">
                        <p>{{ $teachers_presentation[2]->content }}</p>
                        <a href="#" class="main-btn mt-55">Ver Todos</a>
                    </div> <!-- teachers cont -->
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="teachers mt-20">
                        <div class="row">
                            @foreach ($teachers_information as $k => $teacher)
                            <div class="col-sm-6">
                                <div class="single-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{ asset('storage/' . $teacher->item->items[0]->content) }}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="teachers-single.html"><h6>{{ $teacher->item->items[1]->content }}</h6></a>
                                        <span>{{ $teacher->item->items[2]->content }}</span>
                                    </div>
                                </div> <!-- single teachers -->
                            </div>
                            @endforeach
                            {{-- <div class="col-sm-6">
                                <div class="single-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/teachers/t-2.jpg') }}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="teachers-single.html"><h6>David card</h6></a>
                                        <span>Pro Chancellor</span>
                                    </div>
                                </div> <!-- single teachers -->
                            </div>
                            <div class="col-sm-6">
                                <div class="single-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/teachers/t-3.jpg') }}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="teachers-single.html"><h6>Rebeka Alig</h6></a>
                                        <span>Pro Chancellor</span>
                                    </div>
                                </div> <!-- single teachers -->
                            </div>
                            <div class="col-sm-6">
                                <div class="single-teachers mt-30 text-center">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/teachers/t-4.jpg') }}" alt="Teachers">
                                    </div>
                                    <div class="cont">
                                        <a href="teachers-single.html"><h6>Hanna Bein</h6></a>
                                        <span>Aerobics head</span>
                                    </div>
                                </div> <!-- single teachers -->
                            </div> --}}
                        </div> <!-- row -->
                    </div> <!-- teachers -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
</div>