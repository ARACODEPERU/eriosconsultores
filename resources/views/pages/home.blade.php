@extends('layouts.webpage')

@section('meta_title', 'Inicio')
@section('meta_description', 'ERIOS CONSULTORES: instituto de capacitación profesional. Cursos, diplomados y consultoría para potenciar tu carrera e impulsar tu empresa.')

@section('page_styles')
<style>
    /* ============================================================
       ERIOS · Home moderna (tarjetas, sección headers, reveal)
       ============================================================ */
    .erc-sec-head { text-align: center; max-width: 720px; margin: 0 auto 46px; padding: 0 15px; }
    .erc-sec-head--left { text-align: left; margin-left: 0; }
    .erc-sec-eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #004aad;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
    .erc-sec-eyebrow::before { content: ''; position: absolute; bottom: 0; left: 0; width: 35px; height: 2px; background: #ffc600; }
    .erc-sec-head:not(.erc-sec-head--left) .erc-sec-eyebrow::after {
        content: ''; position: absolute; bottom: 0; left: 50%; transform: translateX(8px); width: 35px; height: 2px; background: #ffc600;
    }
    .erc-sec-head:not(.erc-sec-head--left) .erc-sec-eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
    .erc-sec-head h2 { font-size: 36px; font-weight: 700; color: #1d2025; line-height: 1.3; margin-bottom: 14px; }
    .erc-sec-head p { font-size: 16px; line-height: 28px; color: #505050; margin: 0; }

    /* ---- Botones ---- */
    .erc-btn {
        display: inline-flex; align-items: center; gap: 8px;
        font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 14.5px;
        padding: 13px 28px; border-radius: 5px; text-decoration: none; transition: all .35s ease;
    }
    .erc-btn:hover { text-decoration: none; transform: translateY(-2px); }
    .erc-btn--yellow { background: #ffc600; color: #07294d; }
    .erc-btn--yellow:hover { background: #004aad; color: #ffc600; }
    .erc-btn--ghost { border: 2px solid #fff; color: #fff; }
    .erc-btn--ghost:hover { background: #ffc600; border-color: #ffc600; color: #07294d; }
    .erc-btn--outline { border: 2px solid #004aad; color: #004aad; }
    .erc-btn--outline:hover { background: #004aad; color: #fff; }

    /* ---- Hero slider ---- */
    .erc-hero__content { position: relative; z-index: 2; padding: 76px 0 78px; }
    .erc-hero__badge {
        display: inline-flex; align-items: center; gap: 9px;
        background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        color: #fff; font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 13px;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 8px 18px; border-radius: 50px; margin-bottom: 22px;
    }
    .erc-hero__badge i { color: #ffc600; }
    .erc-hero__title {
        color: #fff; font-size: 52px; font-weight: 700; line-height: 1.15;
        margin-bottom: 18px; max-width: 640px;
        text-shadow: 0 2px 24px rgba(7, 41, 77, 0.45);
    }
    .erc-hero__text { color: rgba(255,255,255,.88); font-size: 17px; line-height: 29px; max-width: 560px; margin-bottom: 30px; }
    .erc-hero__actions { display: flex; gap: 14px; flex-wrap: wrap; }
    .erc-hero__actions .erc-btn--yellow { box-shadow: 0 10px 26px rgba(255, 198, 0, 0.35); }
    .erc-slick-dots { position: absolute; bottom: 34px; left: 0; right: 0; text-align: center; z-index: 5; }
    .erc-slick-dots button { background: rgba(255,255,255,.45) !important; border: none; border-radius: 50px; width: 26px; height: 4px; padding: 0; transition: all .3s ease; }
    .erc-slick-dots .slick-active button { background: #ffc600 !important; width: 40px; }

    .erc-hero__overlay {
        position: absolute; inset: 0;
        /* Izquierda sólida para legibilidad; derecha casi transparente para ver la imagen completa */
        background: linear-gradient(100deg, rgba(7, 41, 77, 0.93) 0%, rgba(7, 41, 77, 0.78) 34%, rgba(7, 41, 77, 0.30) 62%, rgba(7, 41, 77, 0.04) 100%);
    }
    /* Altura contenida: siempre se nota que hay más secciones debajo */
    #slider-part { height: clamp(430px, 62vh, 560px); overflow: hidden; }
    .single-slider {
        position: relative;
        padding: 0 !important; /* anula el padding-bottom:300px de la plantilla Edubin */
        height: 100% !important;
        background-position: center;
        background-size: cover;
    }
    #slider-part .slick-list, #slider-part .slick-track,
    #slider-part .slick-slide, #slider-part .slick-slide > div { height: 100%; }

    /* ---- Sobre (home) ---- */
    .erc-habout { display: grid; grid-template-columns: minmax(0,5fr) minmax(0,6fr); gap: 50px; align-items: center; }
    @media (max-width: 991px) { .erc-habout { grid-template-columns: 1fr; } }
    .erc-habout__media { position: relative; }
    .erc-habout__imgwrap {
        border-radius: 16px; overflow: hidden;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        box-shadow: 0 14px 40px rgba(0, 74, 173, 0.18);
    }
    .erc-habout__img { width: 100%; height: 400px; object-fit: cover; display: block; }
    .erc-habout__img--fallback { width: auto; max-width: 60%; margin: 0 auto; height: 400px; object-fit: contain; filter: brightness(0) invert(1); opacity: .92; }
    .erc-habout__accent { position: absolute; right: -20px; bottom: -20px; width: 55%; height: 55%; border: 3px solid #ffc600; border-radius: 16px; z-index: -1; }
    .erc-habout__title { font-size: 36px; font-weight: 700; color: #1d2025; line-height: 1.25; margin: 0 0 16px; }
    .erc-habout__text { font-size: 15.5px; line-height: 27px; color: #505050; margin: 0 0 14px; }
    .erc-habout__actions { display: flex; gap: 14px; flex-wrap: wrap; margin-top: 26px; }

    /* ---- Video/beneficios ---- */
    .erc-video-band { position: relative; background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%); padding: 90px 0; overflow: hidden; }
    .erc-video-band::before { content: ''; position: absolute; width: 320px; height: 320px; border-radius: 50%; border: 2px solid rgba(255,198,0,.12); top: -120px; right: -80px; }
    .erc-video-band::after { content: ''; position: absolute; width: 420px; height: 420px; border-radius: 50%; border: 2px solid rgba(255,198,0,.12); bottom: -180px; left: -120px; }
    .erc-video-band .container { position: relative; z-index: 1; }
    .erc-video__playwrap { display: flex; justify-content: center; align-items: center; }
    .erc-video__play {
        width: 92px; height: 92px; border-radius: 50%; background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.25); color: #ffc600; font-size: 30px;
        display: flex; align-items: center; justify-content: center; text-decoration: none;
        position: relative; transition: all .35s ease;
    }
    .erc-video__play::before { content: ''; position: absolute; inset: -14px; border-radius: 50%; border: 2px solid rgba(255,198,0,.35); animation: erc-pulse 2s ease-out infinite; }
    .erc-video__play:hover { background: #ffc600; color: #07294d; transform: scale(1.06); }
    @keyframes erc-pulse { 0% { transform: scale(.9); opacity: 1; } 100% { transform: scale(1.25); opacity: 0; } }
    .erc-video__note { color: rgba(255,255,255,.75); font-size: 13px; letter-spacing: 1px; text-transform: uppercase; font-family: 'Montserrat', sans-serif; margin-top: 20px; text-align: center; }
    .erc-vfeat-grid { display: grid; grid-template-columns: 1fr; gap: 18px; }
    .erc-vfeat {
        display: flex; gap: 16px; align-items: flex-start;
        background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px; padding: 20px 22px; transition: all .35s ease;
    }
    .erc-vfeat:hover { background: rgba(255,255,255,.09); border-color: rgba(255,198,0,.45); transform: translateX(6px); }
    .erc-vfeat__icon {
        flex: none; width: 48px; height: 48px; border-radius: 12px;
        background: rgba(255,198,0,.14); color: #ffc600;
        display: flex; align-items: center; justify-content: center; font-size: 20px; transition: all .35s ease;
    }
    .erc-vfeat:hover .erc-vfeat__icon { background: #ffc600; color: #07294d; }
    .erc-vfeat h4 { color: #fff; font-size: 17px; font-weight: 700; margin: 0 0 6px; }
    .erc-vfeat p { color: rgba(255,255,255,.72); font-size: 14px; line-height: 24px; margin: 0; }

    /* Docentes: el CSS vive dentro del componente (autocontenido) */

    /* Testimonios: el CSS vive dentro del componente (autocontenido) */

    @media (max-width: 575px) {
        .erc-hero__title { font-size: 34px; }
        .erc-sec-head h2, .erc-habout__title { font-size: 27px; }
    }
</style>
@endsection

@section('content')

    <!--====== SLIDER PART START ======-->
    <x-slider />
    <!--====== SLIDER PART ENDS ======-->
   
    <!--====== CATEGORY PART START ======-->
    {{-- <x-category-courses-slider /> --}}
    <!--====== CATEGORY PART ENDS ======-->
   
    <!--====== ABOUT PART START ======-->
    <x-about-one />
    <!--====== ABOUT PART ENDS ======-->

    <!--====== CEO FUNDADORA PART START ======-->
    <x-ceo-profile :show-link="true" />
    <!--====== CEO FUNDADORA PART ENDS ======-->
   
    <!--====== APPLY PART START ======-->
    <x-services-one />
    <!--====== APPLY PART ENDS ======-->
   
    <!--====== COURSE PART START ======-->
    {{-- <x-list-courses-carousel /> --}}
    <!--====== COURSE PART ENDS ======-->
   
    <!--====== VIDEO BENEFITS PART START ======-->
    <x-benefits-video />
    <!--====== VIDEO BENEFITS PART ENDS ======-->
   
    <!--====== TEACHERS PART START ======-->
    <x-teachers :limit="6" :show-button="true" />
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
    {{-- <x-patnar-logo /> --}}
    <!--====== PATNAR LOGO PART ENDS ======-->

@stop