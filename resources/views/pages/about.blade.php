@extends('layouts.webpage')

@section('meta_title', 'Nosotros')
@section('meta_description', 'Conoce a ERIOS CONSULTORES: quiénes somos, nuestra misión, visión y valores. Más de una década formando profesionales y acompañando a empresas.')

@section('page_styles')
<style>
    /* ============ ERIOS · Nosotros ============ */
    .erc-about {
        display: grid;
        grid-template-columns: minmax(0, 5fr) minmax(0, 6fr);
        gap: 50px;
        align-items: center;
    }
    @media (max-width: 991px) {
        .erc-about { grid-template-columns: 1fr; gap: 40px; }
    }

    /* ---- Columna visual ---- */
    .erc-about__media {
        position: relative;
        padding: 0 26px 26px 0;
    }
    .erc-about__media-main {
        border-radius: 16px;
        overflow: hidden;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        box-shadow: 0 14px 40px rgba(0, 74, 173, 0.18);
    }
    .erc-about__img {
        width: 100%;
        height: 360px;
        object-fit: cover;
        display: block;
    }
    .erc-about__img--fallback {
        width: auto;
        max-width: 60%;
        margin: 0 auto;
        height: 360px;
        object-fit: contain;
        filter: brightness(0) invert(1);
        opacity: .92;
    }
    .erc-about__media-accent {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 55%;
        height: 55%;
        border: 3px solid #ffc600;
        border-radius: 16px;
        z-index: -1;
    }
    .erc-about__badge {
        position: absolute;
        right: -6px;
        bottom: 44px;
        background: #ffc600;
        border-radius: 14px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 10px 26px rgba(255, 198, 0, 0.35);
    }
    .erc-about__badge-num {
        font-family: 'Montserrat', sans-serif;
        font-size: 34px;
        font-weight: 700;
        color: #07294d;
        line-height: 1;
    }
    .erc-about__badge-label {
        font-size: 13px;
        line-height: 17px;
        font-weight: 600;
        color: #07294d;
    }

    /* ---- Columna de contenido ---- */
    .erc-about__eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #004aad;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 14px;
    }
    .erc-about__eyebrow::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-about__title {
        font-size: 36px;
        font-weight: 700;
        color: #1d2025;
        line-height: 1.25;
        margin: 0 0 16px;
    }
    .erc-about__text {
        font-size: 15.5px;
        line-height: 27px;
        color: #505050;
        margin: 0 0 12px;
    }

    .erc-about__feats {
        list-style: none;
        margin: 18px 0 0;
        padding: 18px 0 0;
        border-top: 1px solid #eceff5;
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }
    .erc-about__feats li {
        display: flex;
        align-items: center;
        gap: 14px;
        font-size: 15px;
        color: #1d2025;
        font-weight: 500;
    }
    .erc-about__feat-icon {
        flex: none;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #eaf1ff;
        color: #004aad;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all .3s ease;
    }
    .erc-about__feats li:hover .erc-about__feat-icon {
        background: #004aad;
        color: #ffc600;
    }

    .erc-about__actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        margin-top: 26px;
    }
    .erc-btn-main {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffc600;
        color: #07294d;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        padding: 13px 28px;
        border-radius: 5px;
        text-decoration: none;
        transition: all .35s ease;
    }
    .erc-btn-main:hover {
        background: #004aad;
        color: #ffc600;
        text-decoration: none;
    }
    .erc-btn-ghost {
        display: inline-flex;
        align-items: center;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        padding: 12px 28px;
        border-radius: 5px;
        border: 2px solid #004aad;
        color: #004aad;
        text-decoration: none;
        transition: all .35s ease;
    }
    .erc-btn-ghost:hover {
        background: #004aad;
        color: #fff;
        text-decoration: none;
    }

    /* ---- Tarjetas Misión/Visión/Valores ---- */
    .erc-mvv-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 30px;
    }
    @media (max-width: 991px) {
        .erc-mvv-grid { grid-template-columns: 1fr; }
    }

    .erc-mvv-card {
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 16px;
        padding: 30px 28px;
        box-shadow: 0 6px 24px rgba(14, 23, 38, 0.06);
        transition: transform .35s ease, box-shadow .35s ease;
        position: relative;
        overflow: hidden;
    }
    .erc-mvv-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #004aad, #ffc600);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .4s ease;
    }
    .erc-mvv-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0, 74, 173, 0.14);
    }
    .erc-mvv-card:hover::before {
        transform: scaleX(1);
    }
    .erc-mvv-card__top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .erc-mvv-card__icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #eaf1ff;
        color: #004aad;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: all .35s ease;
    }
    .erc-mvv-card:hover .erc-mvv-card__icon {
        background: #004aad;
        color: #ffc600;
        transform: rotate(-6deg);
    }
    .erc-mvv-card__num {
        font-family: 'Montserrat', sans-serif;
        font-size: 44px;
        font-weight: 700;
        color: #eef2f9;
        line-height: 1;
        user-select: none;
    }
    .erc-mvv-card__title {
        font-size: 20px;
        font-weight: 700;
        color: #1d2025;
        margin: 0 0 10px;
    }
    .erc-mvv-card__text {
        font-size: 15px;
        line-height: 26px;
        color: #505050;
        margin: 0;
    }
</style>
@endsection

@section('content')    <!--====== PAGE BANNER PART START ====== -->

    <x-page-hero heroComponent="hero_nosotros_11"
        subtitle="Más de una década acompañando a empresas y profesionales en el cumplimiento tributario." />

    <!--====== PAGE BANNER PART ENDS ====== -->

   <!--====== ABOUT PART START ======-->
    <x-about-two />
    <!--====== ABOUT PART ENDS ======-->

    <x-mision-vision-valores />

    <!--====== COUNTER PART START ======-->
    
    {{-- <div id="counter-part" class="bg_cover pt-65 pb-110" data-overlay="8" style="background-image: url(images/bg-2.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">30,000</span>+</span>
                        <p>Students enrolled</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">41,000</span>+</span>
                        <p>Courses Uploaded</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">11,000</span>+</span>
                        <p>People certificate</p>
                    </div> <!-- single counter -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-counter text-center mt-40">
                        <span><span class="counter">39,000</span>+</span>
                        <p>Global Teachers</p>
                    </div> <!-- single counter -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> --}}
    
    <!--====== COUNTER PART ENDS ======-->
   
    <!--====== TEACHERS PART START ======-->
    
    {{-- <section id="teachers-part" class="pt-65 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50 pb-35">
                        <h5>Featured Teachers</h5>
                        <h2>Meet Our teachers</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-1.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-2.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-3.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-4.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-5.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-6.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-7.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-teachers mt-30 text-center">
                        <div class="image">
                            <img src="images/teachers/t-8.jpg" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-single.html"><h6>Mark Alen</h6></a>
                            <span>Vice Chancellor</span>
                        </div>
                    </div> <!-- single teachers -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section> --}}
    
    <!--====== TEACHERS PART ENDS ======-->
   
    <!--====== TEASTIMONIAL PART START ======-->
    <x-testimonial />
    <!--====== TEASTIMONIAL PART ENDS ======-->
   
    <!--====== PATNAR LOGO PART START ======-->
    
    {{-- <div id="patnar-logo" class="pt-40 pb-80 gray-bg">
        <div class="container">
            <div class="row patnar-slide">
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-1.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-2.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-3.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-1.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-2.png') }}" alt="Logo">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-patnar text-center mt-40">
                        <img src="{{ asset('themes/webpage/images/patnar-logo/p-3.png') }}" alt="Logo">
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div>  --}}
    
    <!--====== PATNAR LOGO PART ENDS ======-->
   

@stop