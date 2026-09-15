
<!doctype html>
<html lang="es">

<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- SEO: title, description, canonical, robots, Open Graph y Twitter Cards --}}
    <x-seo-meta
        :title="$__env->yieldContent('meta_title')"
        :description="$__env->yieldContent('meta_description')"
        :robots="$__env->yieldContent('meta_robots')"
    />

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('themes/webpage/images/Logo_Icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('themes/webpage/images/Logo_Icon.png') }}">

    {{-- Datos estructurados: Organización --}}
    <script type="application/ld+json">
    <?php echo json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'ERIOS CONSULTORES',
        'url' => url('/'),
        'logo' => url(asset('themes/webpage/images/Logo_Web.jpg')),
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'customer service',
            'availableLanguage' => ['es'],
        ],
    ]); ?>
    </script>

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/slick.css') }}">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/animate.css') }}">

    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/nice-select.css') }}">

    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/jquery.nice-number.min.css') }}">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/magnific-popup.css') }}">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/bootstrap.min.css') }}">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/font-awesome.min.css') }}">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/default.css') }}">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/style.css') }}">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/responsive.css') }}">    <!--====== Sky-Tabs css ======-->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/sky-tabs.css') }}">

    @yield('page_styles')
  
</head>

<body>
   
    <!--====== PRELOADER PART START ======

    <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>-->

    <!--====== PRELOADER PART START ======-->
    
    <!--====== HEADER PART START ======-->
    <x-header />
    <!--====== HEADER PART ENDS ======-->
   
    <!--====== SEARCH BOX PART START ======-->
    
    <div class="search-box">
        <div class="search-form">
            <div class="closebtn">
                <span></span>
                <span></span>
            </div>
            <form action="#">
                <input type="text" placeholder="Search by keyword">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div> <!-- search form -->
    </div>
    
    <!--====== SEARCH BOX PART ENDS ======-->
   
    @yield('content')
    
    <!--====== FOOTER PART START ======-->
    <x-footer />
    <!--====== FOOTER PART ENDS ======-->

    
    <!--Whatsapp Start-->
    <x-whatsapp /> 
    <!--Whatsapp End--
   
    <!--====== BACK TO TP PART START ======-->
    
    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
    
    <!--====== BACK TO TP PART ENDS ======-->
   
    

    <!--====== jquery js ======-->
    <script src="{{ asset('themes/webpage/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/vendor/jquery-1.12.4.min.js') }}"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{ asset('themes/webpage/js/bootstrap.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('themes/webpage/js/slick.min.js') }}"></script>

    <!--====== Magnific Popup js ======-->
    <script src="{{ asset('themes/webpage/js/jquery.magnific-popup.min.js') }}"></script>

    <!--====== Counter Up js ======-->
    <script src="{{ asset('themes/webpage/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/jquery.counterup.min.js') }}"></script>

    <!--====== Nice Select js ======-->
    <script src="{{ asset('themes/webpage/js/jquery.nice-select.min.js') }}"></script>

    <!--====== Nice Number js ======-->
    <script src="{{ asset('themes/webpage/js/jquery.nice-number.min.js') }}"></script>

    <!--====== Count Down js ======-->
    <script src="{{ asset('themes/webpage/js/jquery.countdown.min.js') }}"></script>

    <!--====== Validator js ======-->
    <script src="{{ asset('themes/webpage/js/validator.min.js') }}"></script>

    <!--====== Ajax Contact js ======-->
    <script src="{{ asset('themes/webpage/js/ajax-contact.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('themes/webpage/js/main.js') }}"></script>

    <!--====== Map js ======-->
    <script src="{{ asset('themes/webpage/js/map-script.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    

</body>

</html>
