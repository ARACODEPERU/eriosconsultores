<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Educap | </title>

    <!-- Stylesheets -->
    <link href="{{ asset('themes/webpage/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('themes/webpage/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION SETTINGS STYLES -->
    <link href="{{ asset('themes/webpage/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION LAYERS STYLES -->
    <link href="{{ asset('themes/webpage/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css">
    <!-- REVOLUTION NAVIGATION STYLES -->

    <link href="{{ asset('themes/webpage/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/webpage/css/aracode.css') }}" rel="stylesheet">


    <link href="{{ asset('themes/webpage/css/responsive.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('themes/webpage/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('themes/webpage/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
    @yield('heades')

</head>

<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader"></div> --}}

        <!-- Main Header-->
        <x-header />
        <!--End Main Header -->

        @yield('content')


        <!-- Main Footer -->
        <x-footer />
        <!--End Main Footer -->



    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll To Top -->
    <div class="scroll-to-top scroll-to-target" data-target="html">
        <span class="fa fa-angle-up"></span>
    </div>


    <div id="whatsapp">
        <a href="" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <style type="text/css">
        #whatsapp .wtsapp {
            position: fixed;
            transform: all .5s ease;
            background-color: #25D366;
            display: block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            border-right: none;
            color: #fff;
            font-weight: 700;
            font-size: 30px;
            bottom: 80px;
            right: 20px;
            border: 0;
            z-index: 9999;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        #whatsapp .wtsapp:before {
            content: "";
            position: absolute;
            z-index: -1;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        #whatsapp .wtsapp:focus {
            border: none;
            outline: none;
        }

        @keyframes pulse-border {
            0% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }
    </style>

    @yield('javaScripts')

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('themes/webpage/js/jquery.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/popper.min.js') }}"></script>

    <!-- Carrito JS -->
    <script src="{{ asset('themes/educap/educap-carrito.js') }}"></script>

    <!--Revolution Slider-->
    <script src="{{ asset('themes/webpage/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}">
    </script>
    <script
        src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}">
    </script>
    <script src="{{ asset('themes/webpage/js/main-slider-script.js') }}"></script>
    <!--Revolution Slider-->

    <script src="{{ asset('themes/webpage/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/wow.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/bxslider.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/appear.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/mixitup.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/select2.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/swiper.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/owl.js') }}"></script>
    <script src="{{ asset('themes/webpage/js/script.js') }}"></script>
</body>

</html>
