@extends('layouts.webpage')

@section('content')

    <!--====== SLIDER PART START ======-->
    <x-slider />
    <!--====== SLIDER PART ENDS ======-->
   
    <!--====== CATEGORY PART START ======-->
    <x-category-courses-slider />
    <!--====== CATEGORY PART ENDS ======-->
   
    <!--====== ABOUT PART START ======-->
    <x-about-one />
    <!--====== ABOUT PART ENDS ======-->
   
    <!--====== APPLY PART START ======-->
    <x-services-one />
    <!--====== APPLY PART ENDS ======-->
   
    <!--====== COURSE PART START ======-->
    <x-list-courses-carousel />
    <!--====== COURSE PART ENDS ======-->
   
    <!--====== VIDEO BENEFITS PART START ======-->
    <x-benefits-video />
    <!--====== VIDEO BENEFITS PART ENDS ======-->
   
    <!--====== TEACHERS PART START ======-->
    <x-teachers />
    <!--====== TEACHERS PART ENDS ======-->
   
    <!--====== PUBLICATION PART START ======-->
    
    {{-- <section id="publication-part" class="pt-115 pb-120 gray-bg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-6 col-md-8 col-sm-7">
                    <div class="section-title pb-60">
                        <h5>Publications</h5>
                        <h2>From Store </h2>
                    </div> <!-- section title -->
                </div>
                <div class="col-lg-6 col-md-4 col-sm-5">
                    <div class="products-btn text-right pb-60">
                        <a href="#" class="main-btn">All Products</a>
                    </div> <!-- products btn -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="single-publication mt-30 text-center">
                        <div class="image">
                            <img src="images/publication/p-1.jpg" alt="Publication">
                            <div class="add-cart">
                                <ul>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content pt-10">
                            <h5 class="book-title"><a href="#">Stones The Road </a></h5>
                            <p class="writer-name"><span>By</span> Scott Trench</p>
                            <div class="price-btn d-flex align-items-center justify-content-between">
                                <div class="price pt-20">
                                    <span class="discount-price">$250</span>
                                    <span class="normal-price">$200</span>
                                </div>
                                <div class="button pt-10">
                                    <a href="#" class="main-btn"><i class="fa fa-cart-plus"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- single publication -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="single-publication mt-30 text-center">
                        <div class="image">
                            <img src="images/publication/p-2.jpg" alt="Publication">
                            <div class="add-cart">
                                <ul>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content pt-10">
                            <h5 class="book-title"><a href="#">The Stranded </a></h5>
                            <p class="writer-name"><span>By</span> Scott Trench</p>
                            <div class="price-btn d-flex align-items-center justify-content-between">
                                <div class="price pt-20">
                                    <span class="discount-price">$250</span>
                                    <span class="normal-price">$200</span>
                                </div>
                                <div class="button pt-10">
                                    <a href="#" class="main-btn"><i class="fa fa-cart-plus"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- single publication -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="single-publication mt-30 text-center">
                        <div class="image">
                            <img src="images/publication/p-3.jpg" alt="Publication">
                            <div class="add-cart">
                                <ul>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content pt-10">
                            <h5 class="book-title"><a href="#">The Sicario </a></h5>
                            <p class="writer-name"><span>By</span> Scott Trench</p>
                            <div class="price-btn d-flex align-items-center justify-content-between">
                                <div class="price pt-20">
                                    <span class="discount-price">$250</span>
                                    <span class="normal-price">$200</span>
                                </div>
                                <div class="button pt-10">
                                    <a href="#" class="main-btn"><i class="fa fa-cart-plus"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- single publication -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-8">
                    <div class="single-publication mt-30 text-center">
                        <div class="image">
                            <img src="images/publication/p-4.jpg" alt="Publication">
                            <div class="add-cart">
                                <ul>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart-o"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content pt-10">
                            <h5 class="book-title"><a href="#">There Were None </a></h5>
                            <p class="writer-name"><span>By</span> Scott Trench</p>
                            <div class="price-btn d-flex align-items-center justify-content-between">
                                <div class="price pt-20">
                                    <span class="discount-price">$250</span>
                                    <span class="normal-price">$200</span>
                                </div>
                                <div class="button pt-10">
                                    <a href="#" class="main-btn"><i class="fa fa-cart-plus"></i> Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- single publication -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section> --}}
    
    <!--====== PUBLICATION PART ENDS ======-->
   
    <!--====== TEASTIMONIAL PART START ======-->
    <x-testimonial />
    <!--====== TEASTIMONIAL PART ENDS ======-->
   
    <!--====== NEWS PART START ======-->
    
    {{-- <section id="news-part" class="pt-115 pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-50">
                        <h5>Latest News</h5>
                        <h2>From the news</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="single-news mt-30">
                        <div class="news-thum pb-25">
                            <img src="{{ asset('themes/webpage/images/news/n-1.jpg') }}" alt="News">
                        </div>
                        <div class="news-cont">
                            <ul>
                                <li><a href="#"><i class="fa fa-calendar"></i>2 December 2018 </a></li>
                                <li><a href="#"> <span>By</span> Adam linn</a></li>
                            </ul>
                            <a href="blog-single.html"><h3>Tips to grade high cgpa in university life</h3></a>
                            <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt .</p>
                        </div>
                    </div> <!-- single news -->
                </div>
                <div class="col-lg-6">
                    <div class="single-news news-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="news-thum mt-30">
                                    <img src="{{ asset('themes/webpage/images/news/n-1.jpg') }}" alt="News">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="news-cont mt-30">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-calendar"></i>2 December 2018 </a></li>
                                        <li><a href="#"> <span>By</span> Adam linn</a></li>
                                    </ul>
                                    <a href="blog-single.html"><h3>Intellectual communication</h3></a>
                                    <p>Gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons  vel.</p>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- single news -->
                    <div class="single-news news-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="news-thum mt-30">
                                    <img src="{{ asset('themes/webpage/images/news/n-1.jpg') }}" alt="News">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="news-cont mt-30">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-calendar"></i>2 December 2018 </a></li>
                                        <li><a href="#"> <span>By</span> Adam linn</a></li>
                                    </ul>
                                    <a href="blog-single.html"><h3>Study makes you perfect</h3></a>
                                    <p>Gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons  vel.</p>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- single news -->
                    <div class="single-news news-list">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="news-thum mt-30">
                                    <img src="{{ asset('themes/webpage/images/news/n-1.jpg') }}" alt="News">
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="news-cont mt-30">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-calendar"></i>2 December 2018 </a></li>
                                        <li><a href="#"> <span>By</span> Adam Linn</a></li>
                                    </ul>
                                    <a href="blog-single.html"><h3>Technology eduction is now....</h3></a>
                                    <p>Gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons  vel.</p>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- single news -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section> --}}
    
    <!--====== NEWS PART ENDS ======-->
   
    <!--====== PATNAR LOGO PART START ======-->
    <x-patnar-logo />
    <!--====== PATNAR LOGO PART ENDS ======-->

@stop