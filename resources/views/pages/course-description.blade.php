@extends('layouts.webpage')

@section('content')

    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('themes/webpage/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">{{$item->name}}</h1>
                <ul class="page-breadcrumb">
                    <li><a href="">{{route('index_main')}}</a></li>
                    <li>Descripción del Curso</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!--Start courses Details-->
    <section class="course-details">
        <div class="container">
            <div class="row flex-xl-row-reverse">
                <div class="col-xl-8 col-lg-8">
                    <div class="courses-details__content">
                        <img src="{{ $item->image }}" alt="" />
                        <h2 class="mt-4">Presentación del curso</h2>
                        <p>
                            {!! $course->brochure->presentation !!}
                        </p>
                        <div class=" mt-25">
                            <ul class="accordion-box wow fadeInRight">
                                <li class="accordion block active-block">
                                    <div class="acc-btn active">Malla Curricular
                                        <div class="icon fa fa-plus"></div>
                                    </div>
                                    <div class="acc-content current">
                                        <div class="content">
                                            <div class="text">
                                                {!! $course->brochure->curriculum_plan !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">Beneficios
                                        <div class="icon fa fa-plus"></div>
                                    </div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">
                                                {!! $course->brochure->resolution !!}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">Plana Docentes
                                        <div class="icon fa fa-plus"></div>
                                    </div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">
                                                @if (count($course->teachers) > 0)
                                        @foreach ($course->teachers as $teach)
                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-2">
                                                    <a href="">
                                                        <img style="width: 150px; margin-bottom: 10px; margin-left: 10px;"
                                                            src="{{ asset('storage/'. $teach->teacher->person->image) }}" alt="img">
                                                    </a>
                                                </div>
                                                <div class="col-md-10">
                                                    <h2 style="font-size: 18px;">
                                                        <b>
                                                            {{ $teach->teacher->person->names . ' ' . $teach->teacher->person->father_lastname . ' ' . $teach->teacher->person->mother_lastname }}
                                                        </b>
                                                    </h2>
                                                    @if (count($teach->teacher->person->resumes))
                                                        @foreach ($teach->teacher->person->resumes as $resume)
                                                        <div class="list-item-aracode" style="font-size: 17px;">
                                                            <span class="list-icon-aracode">•</span>
                                                            {{ $resume->description }}
                                                        </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">Preguntas Frecuentes
                                        <div class="icon fa fa-plus"></div>
                                    </div>
                                    <div class="acc-content">
                                        <div class="content">
                                            <div class="text">
                                                sdsd
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4">
                    <div class="course-sidebar">
                        {{-- <ul class="course-details-info">
                            <li class="course-details-info-link">
                                <span class="course-details-info-icon"><i class="far fa-clock"></i></span>
                                Durations: <span>10 hours</span>
                            </li>
                            <li class="course-details-info-link">
                                <span class="course-details-info-icon"><i class="far fa-folder-open"></i></span>
                                Lectures: <span>15</span>
                            </li>
                            <li class="course-details-info-link">
                                <span class="course-details-info-icon"><i class="far fa-user-circle"></i></span>
                                Students: <span>Max 50</span>
                            </li>
                            <li class="course-details-info-link">
                                <span class="course-details-info-icon"><i class="far fa-flag"></i></span>
                                Skill Level: <span>Advanced</span>
                            </li>
                            <li class="course-details-info-link">
                                <span class="course-details-info-icon"><i class="far fa-bell"></i></span>
                                Language: <span>English</span>
                            </li>
                        </ul> --}}

                        <div class="course-details-price">
                            <p class="course-details-price-text">Precio del curso</p>
                            <p class="course-details-price-amount">S/ 50.00</p>
                            <a class="theme-btn btn-style-two course-details-price-btn">
                                <i class="lnr-icon-shopping-cart" style="font-size: 20px;"></i>&nbsp; Agregar al carrito
                            </a>
                        </div>

                        <div class="latest-course mb-30">
                            <h4 class="latest-course-title mb-30">Nuevos Cursos</h4>
                            <div class="latest-course-item">
                                <div class="latest-course-img">
                                    <img src="{{ asset('themes/webpage/images/resource/course-1.jpg') }}" alt="">
                                </div>
                                <div class="latest-course-content">
                                    <h5><a href="page-course-details.php">Modern Languages</a></h5>
                                    <a class="latest-course-author" href="#">Categoria</a>
                                    {{-- <div class="latest-course-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>4.8</span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="latest-course-item">
                                <div class="latest-course-img">
                                    <img src="{{ asset('themes/webpage/images/resource/course-2.jpg') }}" alt="">
                                </div>
                                <div class="latest-course-content">
                                    <h5><a href="page-course-details.php">Modern Technologies</a></h5>
                                    <a class="latest-course-author" href="#">Categoria</a>
                                    {{-- <div class="latest-course-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>5.0</span>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="latest-course-item">
                                <div class="latest-course-img">
                                    <img src="{{ asset('themes/webpage/images/resource/course-3.jpg') }}" alt="">
                                </div>
                                <div class="latest-course-content">
                                    <h5><a href="page-course-details.php">Development Studies</a></h5>
                                    <a class="latest-course-author" href="#">Categoria</a>
                                    {{-- <div class="latest-course-stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span>4.9</span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End courses Details-->


@stop
