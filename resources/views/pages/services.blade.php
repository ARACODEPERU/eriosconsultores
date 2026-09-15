@extends('layouts.webpage')

@section('meta_title', 'Servicios')
@section('meta_description', 'Descubre los servicios de ERIOS CONSULTORES: capacitaciones a medida, asesoría empresarial y cursos de especialización con certificación oficial.')

@section('page_styles')
<style>
    /* ============ ERIOS · Servicios ============ */
    .erc-services-head {
        text-align: center;
        max-width: 720px;
        margin: 0 auto 30px;
        padding: 0 15px;
    }
    .erc-services-head .erc-eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #004aad;
        padding-bottom: 12px;
        position: relative;
        margin-bottom: 12px;
    }
    .erc-services-head .erc-eyebrow::before,
    .erc-services-head .erc-eyebrow::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-services-head .erc-eyebrow::before { left: 50%; transform: translateX(-100%); margin-right: 8px; }
    .erc-services-head .erc-eyebrow::after { left: 50%; transform: translateX(0); margin-left: 8px; }
    .erc-services-head h2 {
        font-size: 36px;
        font-weight: 700;
        color: #1d2025;
        margin-bottom: 14px;
        line-height: 1.3;
    }
    .erc-services-head p {
        font-size: 16px;
        line-height: 28px;
        color: #505050;
        margin: 0;
    }

    /* ---- Grid de tarjetas ---- */
    .erc-services-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 30px;
        max-width: 1230px;
        margin: 0 auto;
    }
    @media (max-width: 991px) {
        .erc-services-grid { grid-template-columns: 1fr; }
    }

    .erc-service-card {
        position: relative;
        background: #fff;
        border: 1px solid #eceff5;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 24px rgba(14, 23, 38, 0.06);
        transition: transform .35s ease, box-shadow .35s ease;
        display: flex;
        flex-direction: column;
    }
    .erc-service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(0, 74, 173, 0.14);
    }

    .erc-service-card__media {
        height: 190px;
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 60%, #4a86e8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .erc-service-card__img {
        width: 100%;
    height: 100%;
        object-fit: cover;
        display: block;
    }
    .erc-service-card__img--fallback {
        width: auto;
        height: 96px;
        object-fit: contain;
        filter: brightness(0) invert(1);
        opacity: .92;
        padding: 0 30px;
    }

    .erc-service-card__body {
        padding: 26px 30px 28px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .erc-service-card__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }
    .erc-service-card__icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #eaf1ff;
        color: #004aad;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: background .3s ease, color .3s ease;
    }
    .erc-service-card:hover .erc-service-card__icon {
        background: #004aad;
        color: #ffc600;
        transform: rotate(-6deg);
        transition: all .35s ease;
    }
    .erc-service-card__num {
        font-family: 'Montserrat', sans-serif;
        font-size: 44px;
        font-weight: 700;
        color: #eef2f9;
        line-height: 1;
        user-select: none;
    }
    .erc-service-card__title {
        font-size: 21px;
        font-weight: 700;
        color: #1d2025;
        line-height: 1.35;
        margin: 0 0 12px;
        min-height: 57px;
    }
    .erc-service-card__text {
        font-size: 15px;
        line-height: 26px;
        color: #505050;
        margin: 0 0 12px;
    }
    .erc-service-card__list {
        margin: 0 0 6px;
        padding: 0;
        list-style: none;
    }
    .erc-service-card__list li {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        font-size: 14.5px;
        line-height: 24px;
        color: #505050;
        margin-bottom: 9px;
    }
    .erc-service-card__list i {
        color: #00ab55;
        margin-top: 3px;
        font-size: 15px;
    }
    .erc-service-card__link {
        margin-top: auto;
        padding-top: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: .4px;
        color: #004aad;
        text-decoration: none;
    }
    .erc-service-card__link:hover {
        color: #ffc600;
        text-decoration: none;
    }
    .erc-anim-arrow {
        transition: transform .3s ease;
    }
    .erc-service-card__link:hover .erc-anim-arrow,
    .erc-cta-band__btn:hover .erc-anim-arrow {
        transform: translateX(6px);
    }

    /* ---- Banda CTA ---- */
    .erc-cta-band {
        background: linear-gradient(135deg, #004aad 0%, #2f6fd6 55%, #4a86e8 100%);
        padding: 46px 0;
    }
    .erc-cta-band__inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        flex-wrap: wrap;
    }
    .erc-cta-band__text h3 {
        color: #fff;
        font-size: 26px;
        font-weight: 700;
        margin: 0 0 6px;
    }
    .erc-cta-band__text p {
        color: rgba(255, 255, 255, .85);
        font-size: 15px;
        margin: 0;
    }
    .erc-cta-band__btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffc600;
        color: #07294d;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 15px;
        padding: 14px 30px;
        border-radius: 5px;
        white-space: nowrap;
        text-decoration: none;
        transition: all .35s ease;
    }
    .erc-cta-band__btn:hover {
        background: #07294d;
        color: #ffc600;
        text-decoration: none;
    }
    @media (max-width: 575px) {
        .erc-services-head h2 { font-size: 27px; }
        .erc-service-card__title { min-height: 0; }
        .erc-cta-band__inner { justify-content: center; text-align: center; }
    }
</style>
@endsection

@section('content')

    <!--====== PAGE BANNER PART START ======-->
    <x-page-hero heroComponent="hero_servicios_13"
        subtitle="Asesoría, fiscalización, auditoría y contencioso tributario para el crecimiento de tu empresa." />
    
    <!--====== PAGE BANNER PART ENDS ======-->

   <!--====== ABOUT PART START ======-->
    <x-services-two />
    <!--====== ABOUT PART ENDS ======-->

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