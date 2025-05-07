@extends('layouts.webpage')

@section('content')

    <!-- Start main-content -->
    <section class="page-title" style="background-image: url({{ asset('themes/webpage/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">Courses</h1>
                <ul class="page-breadcrumb">
                    <li><a href="{{ asset('index_main') }}">Home</a></li>
                    <li>Courses</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->

    <!-- Courses Section -->
    <section class="">
        <div class="container pb-100">
            <div class="row">
                @foreach ( $courses as $course)
                    <div class="course-block-two col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <a href="{{ route('web_course_description', $course->id) }}">
                                        <img src="{{ asset('storage/'.$course->course->image) }}" alt="">
                                    </a>
                                </figure>
                                <span class="price">S/ {{ $course->price }}</span>
                                <div class="value">{{ $course->category_description }}</div>
                            </div>
                            <div class="content-box">
                                {{-- <ul class="course-info">
                                    <li><i class="fa fa-book"></i> 8 Lessons</li>
                                    <li><i class="fa fa-users"></i> 16 Students</li>
                                    <li><i class="fa fa-clock"></i> 3 Weeks</li>
                                </ul> --}}
                                <h5 class="title">
                                    <a href="{{ route('web_course_description', $course->id) }}">
                                        {{ $course->name }}
                                    </a>
                                </h5>
                                <a href="{{route('web_course_description', ['id' => $course->id])}}" class="theme-btn btn-style-one small" style="margin-bottom: 10px; width: 100%;">
                                    Más Información
                                </a>
                                <a class="theme-btn btn-style-cart small"
                                            onclick="agregarAlCarrito({ id: {{ $course->id }}, nombre: '{{ $course->name }}', precio: {{ $course->price }} })"
                                            style="width: 100%;">
                                    <i class="lnr-icon-shopping-cart" style="font-size: 18px;"></i>
                                    &nbsp;Agregar al carrito
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Courses Section-->


@stop
