@extends('layouts.webpage')

@section('content')


    <!--====== PAGE BANNER PART START ======-->
    
    <section id="page-banner" class="pt-80 pb-80 bg_cover" data-overlay="8" style="background-image: url({{ asset('themes/webpage/images/page-banner-1.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Título del curso</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index_main') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('web_courses') }}">Cursos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Título del curso</li>
                            </ol>
                        </nav>
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
    
    <!--====== COURSES SINGEl PART START ======-->
    
    <section id="courses-single" class="pt-40 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="courses-single-left mt-30">
                        <div class="course-terms">
                            <ul>
                                <li>
                                    <div class="teacher-name">
                                        <div class="thum">
                                            <img src="{{ asset('themes/webpage/images/course/teacher/t-1.jpg') }}" alt="Teacher">
                                        </div>
                                        <div class="name">
                                            <span>Docente</span>
                                            <h6>Mark anthem</h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course-category">
                                        <span>Categoria</span>
                                        <h6>Tributario </h6>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="courses-single-image pt-10">
                            <img src="{{  asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Courses">
                        </div>
                        <div class="courses-tab mt-30">
                            <ul class="nav nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="active" id="presentation-tab" data-toggle="tab" href="#presentation" role="tab" aria-controls="presentation" aria-selected="true">Presentación</a>
                                </li>
                                <li class="nav-item">
                                    <a id="curriculum-tab" data-toggle="tab" href="#curriculum" role="tab" aria-controls="curriculum" aria-selected="false">Plan Curricular</a>
                                </li>
                                <li class="nav-item">
                                    <a id="instructor-tab" data-toggle="tab" href="#instructor" role="tab" aria-controls="instructor" aria-selected="false">Docentes</a>
                                </li>
                                <li class="nav-item">
                                    <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Preguntas Frecuentes</a>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="presentation" role="tabpanel" aria-labelledby="presentation-tab">
                                    
                                        <div style="padding: 0 15px;">
                                            <div class="single-description pt-40">
                                                <h6>Course Summery</h6>
                                                <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                            </div>
                                            <div class="single-description pt-40">
                                                <h6>Requrements</h6>
                                                <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                        <div style="padding: 0 15px;">
                                            <div class="single-description pt-40">
                                                <h6>Course Summery</h6>
                                                <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                    <div class="instructor-cont">
                                        <div class="instructor-author">
                                            <div class="author-thum">
                                                <img width="120px;" src="{{ asset('themes/webpage/images/instructor/i-1.jpg') }}" alt="Instructor">
                                            </div>
                                            <div class="author-name">
                                                <br><br>
                                                <a href="#">
                                                    <h4>John Doe</h4>
                                                </a>
                                                <span>Tributarista en AGP</span>
                                                {{-- <ul class="social">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                        <div class="instructor-description pt-25">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus fuga ratione molestiae unde provident quibusdam sunt, doloremque. Error omnis mollitia, ex dolor sequi. Et, quibusdam excepturi. Animi assumenda, consequuntur dolorum odio sit inventore aliquid, optio fugiat alias. Veritatis minima, dicta quam repudiandae repellat non sit, distinctio, impedit, expedita tempora numquam?</p>
                                        </div>
                                    </div>
                                    <div class="instructor-cont">
                                        <div class="instructor-author">
                                            <div class="author-thum">
                                                <img width="120px;" src="{{ asset('themes/webpage/images/instructor/i-1.jpg') }}" alt="Instructor">
                                            </div>
                                            <div class="author-name">
                                                <br><br>
                                                <a href="#">
                                                    <h4>John Doe</h4>
                                                </a>
                                                <span>Tributarista en AGP</span>
                                                {{-- <ul class="social">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                        <div class="instructor-description pt-25">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus fuga ratione molestiae unde provident quibusdam sunt, doloremque. Error omnis mollitia, ex dolor sequi. Et, quibusdam excepturi. Animi assumenda, consequuntur dolorum odio sit inventore aliquid, optio fugiat alias. Veritatis minima, dicta quam repudiandae repellat non sit, distinctio, impedit, expedita tempora numquam?</p>
                                        </div>
                                    </div>
                                    <div class="instructor-cont">
                                        <div class="instructor-author">
                                            <div class="author-thum">
                                                <img width="120px;" src="{{ asset('themes/webpage/images/instructor/i-1.jpg') }}" alt="Instructor">
                                            </div>
                                            <div class="author-name">
                                                <br><br>
                                                <a href="#">
                                                    <h4>John Doe</h4>
                                                </a>
                                                <span>Tributarista en AGP</span>
                                                {{-- <ul class="social">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                        <div class="instructor-description pt-25">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus fuga ratione molestiae unde provident quibusdam sunt, doloremque. Error omnis mollitia, ex dolor sequi. Et, quibusdam excepturi. Animi assumenda, consequuntur dolorum odio sit inventore aliquid, optio fugiat alias. Veritatis minima, dicta quam repudiandae repellat non sit, distinctio, impedit, expedita tempora numquam?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="reviews-cont">
                                        <div class="title">
                                            <h6>Student Reviews</h6>
                                        </div>
                                        <ul>
                                           <li>
                                               <div class="single-reviews">
                                                    <div class="reviews-author">
                                                        <div class="author-thum">
                                                            <img src="images/review/r-1.jpg" alt="Reviews">
                                                        </div>
                                                        <div class="author-name">
                                                            <h6>Bobby Aktar</h6>
                                                            <span>April 03, 2019</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviews-description pt-20">
                                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                        <div class="rating">
                                                            <ul>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            <span>/ 5 Star</span>
                                                        </div>
                                                    </div>
                                                </div> <!-- single reviews -->
                                           </li>
                                           <li>
                                               <div class="single-reviews">
                                                    <div class="reviews-author">
                                                        <div class="author-thum">
                                                            <img src="images/review/r-2.jpg" alt="Reviews">
                                                        </div>
                                                        <div class="author-name">
                                                            <h6>Humayun Ahmed</h6>
                                                            <span>April 13, 2019</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviews-description pt-20">
                                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                        <div class="rating">
                                                            <ul>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            <span>/ 5 Star</span>
                                                        </div>
                                                    </div>
                                                </div> <!-- single reviews -->
                                           </li>
                                           <li>
                                               <div class="single-reviews">
                                                    <div class="reviews-author">
                                                        <div class="author-thum">
                                                            <img src="images/review/r-3.jpg" alt="Reviews">
                                                        </div>
                                                        <div class="author-name">
                                                            <h6>Tania Aktar</h6>
                                                            <span>April 20, 2019</span>
                                                        </div>
                                                    </div>
                                                    <div class="reviews-description pt-20">
                                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                                        <div class="rating">
                                                            <ul>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                            <span>/ 5 Star</span>
                                                        </div>
                                                    </div>
                                                </div> <!-- single reviews -->
                                           </li>
                                        </ul>
                                        <div class="title pt-15">
                                            <h6>Leave A Comment</h6>
                                        </div>
                                        <div class="reviews-form">
                                            <form action="#">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-single">
                                                            <input type="text" placeholder="Fast name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-single">
                                                            <input type="text" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-single">
                                                            <div class="rate-wrapper">
                                                                <div class="rate-label">Your Rating:</div>
                                                                <div class="rate">
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-single">
                                                            <textarea placeholder="Comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-single">
                                                            <button type="button" class="main-btn">Post Comment</button>
                                                        </div>
                                                    </div>
                                                </div> <!-- row -->
                                            </form>
                                        </div>
                                    </div> <!-- reviews cont -->
                                </div>
                            </div> <!-- tab content -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="course-features mt-30">
                               <h4>Course Features </h4>
                                <ul>
                                    <li><i class="fa fa-clock-o"></i>Duaration : <span>10 Hours</span></li>
                                    <li><i class="fa fa-clone"></i>Leactures : <span>09</span></li>
                                    <li><i class="fa fa-beer"></i>Quizzes :  <span>05</span></li>
                                    <li><i class="fa fa-user-o"></i>Students :  <span>100</span></li>
                                </ul>
                                <div class="price-button pt-10">
                                    <span>Price : <b>$25</b></span>
                                    <a href="#" class="main-btn">Enroll Now</a>
                                </div>
                            </div> <!-- course features -->
                        </div>
                        <div class="col-lg-12 col-md-6">
                            <div class="You-makelike mt-30">
                                <h4>You make like </h4> 
                                <div class="single-makelike mt-20">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/your-make/y-1.jpg') }}" alt="Image">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h4>Introduction to machine languages</h4></a>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-user"></i>31</a></li>
                                            <li>$50</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-makelike mt-20">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/your-make/y-1.jpg') }}" alt="Image">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h4>How to build a basic game with java </h4></a>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-user"></i>31</a></li>
                                            <li>$50</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="single-makelike mt-20">
                                    <div class="image">
                                        <img src="{{ asset('themes/webpage/images/your-make/y-1.jpg') }}" alt="Image">
                                    </div>
                                    <div class="cont">
                                        <a href="#"><h4>Basic accounting from primary</h4></a>
                                        <ul>
                                            <li><a href="#"><i class="fa fa-user"></i>31</a></li>
                                            <li>$50</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="related-courses pt-95">
                        <div class="title">
                            <h3>Cursos relacionados</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-course mt-30">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>S/ 150</span>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <a href="">
                                            <h5>Título del curso</h5>
                                        </a>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('web_course_description') }}" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-course mt-30">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>S/ 150</span>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <a href="">
                                            <h5>Título del curso</h5>
                                        </a>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('web_course_description') }}" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-course mt-30">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="{{ asset('themes/webpage/images/course/cu-1.jpg') }}" alt="Course">
                                        </div>
                                        <div class="price">
                                            <span>S/ 150</span>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <a href="">
                                            <h5>Título del curso</h5>
                                        </a>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ route('web_course_description') }}" class="main-btn" style="background: #f8f8f8;">Leer Más</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="main-btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Adquirir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
        </div> 
    </section>
    
    <!--====== COURSES SINGEl PART ENDS ======-->

@stop
