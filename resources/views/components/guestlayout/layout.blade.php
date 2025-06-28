<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    {{-- <meta name="author" content="INSPIRO" />
    <meta name="description" content="Themeforest Template Polo, html template" /> --}}
    <link rel="icon" type="image/png" href="{{ url('frontend/guestlayout/images/CAVD.png') }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Document title -->
    <title>| CAVD Butuan</title>
    <!-- Stylesheets & Fonts -->
    <link href="{{ url('frontend/guestlayout/css/plugins.css') }}" rel="stylesheet" />
    <link href="{{ url('frontend/guestlayout/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

</head>

<body>
    <!-- Body Inner -->
    <div class="body-inner">

        <div id="topbar" class="topbar-fullwidth d-none d-lg-block bg-primary text-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ul class="top-menu">
                            <li class="list-inline-item me-4">
                                <a href="tel:095175226591"><i class="icon-phone"></i> 095175226591</a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="mailto:cavd@butuan.gov.ph"><i class="icon-mail"></i>
                                    cavd@butuan.gov.ph</a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="https://maps.app.goo.gl/nKuo6Cwra33MX6Y5A" target="_blank">
                                    <i class="icon-home"></i>
                                    DOP Building, Tiniwisan, Butuan City</a>
                            </li>
                            <li class="list-inline-item" style="font-size: 13px;">
                                <i class="feather icon-feather-clock icon-extra-small text-white"></i>

                                <script type="text/javascript" id="gwt-pst">
                                    (function(d, eId) {
                                        var js, gjs = d.getElementById(eId);
                                        js = d.createElement('script');
                                        js.id = 'gwt-pst-jsdk';
                                        js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?" + new Date().getTime();
                                        gjs.parentNode.insertBefore(js, gjs);
                                    }(document, 'gwt-pst'));
                                </script>

                                <span style="font-size: 13px;"><i class="far fa-clock"></i> PST:</span> <span
                                    style="font-size: 13px;" id="pst-time"></span>

                                <script type="text/javascript">
                                    (function(d, eId) {
                                        var js, gjs = d.getElementById(eId);
                                        js = d.createElement('script');
                                        js.id = 'gwt-pst-jsdk';
                                        js.src = "//gwhs.i.gov.ph/pst/gwtpst.js?" + new Date().getTime();
                                        gjs.parentNode.insertBefore(js, gjs);
                                    }(document, 'pst-container'));

                                    var gwtpstReady = function() {
                                        new gwtpstTime('pst-time');
                                    }
                                </script>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 d-none d-sm-block">
                        <div class="social-icons social-icons-colored-hover">
                            <ul>
                                <li class="social-facebook">
                                    <a href="https://www.facebook.com/bxuagriculturist" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: Topbar -->

        <!-- Header -->
        <header id="header" data-fullwidth="true">
            <div class="header-inner">
                <div class="container">
                    <!--Logo-->
                    <div id="logo">
                        <a href="/"><span class="logo-default text-primary"><img
                                    src="{{ url('frontend/guestlayout/images/CAVD2.png') }}" alt=""
                                    style="height:60px;"></span><span class="logo-dark text-primary"><img
                                    src="{{ url('frontend/guestlayout/images/CAVD2.png') }}" alt=""
                                    style="height:60px;"></span></a>
                    </div>
                    <!--End: Logo-->
                    <!-- Search -->
                    <div id="search">
                        <a id="btn-search-close" class="btn-search-close" aria-label="Close search form"><i
                                class="icon-x"></i></a>
                        {{-- <form class="search-form" action="search-results-page.html" method="get">
                            <input class="form-control" name="q" type="text" />
                            <span class="text-muted">Start typing & press "Enter" or "ESC" to close</span>
                        </form> --}}
                        <form method="GET" action="{{ route('news.guest.index') }}" class="search-form">
                            <input type="text" name="search" class="form-control" placeholder="Type & Search..."
                                value="{{ request('search') }}">
                            <span class="text-muted mb-3">Start typing & press "Enter" or "ESC" to close</span>
                            <br>
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('news.guest.index') }}" class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                    </div>
                    <!-- end: search -->
                    <!--Header Extras-->
                    <div class="header-extras">
                        <ul>
                            <li>
                                <a id="btn-search" href="#"> <i class="icon-search"></i></a>
                            </li>
                            {{-- <li>
                                <div class="p-dropdown">
                                    <a href="#"><i class="icon-globe"></i><span>EN</span></a>
                                    <ul class="p-dropdown-content">
                                        <li><a href="#">French</a></li>
                                        <li><a href="#">Spanish</a></li>
                                        <li><a href="#">English</a></li>
                                    </ul>
                                </div> --}}
                            </li>
                        </ul>
                    </div>
                    <!--end: Header Extras-->
                    <!--Navigation Resposnive Trigger-->
                    <div id="mainMenu-trigger">
                        <a class="lines-button x"><span class="lines"></span></a>
                    </div>
                    <!--end: Navigation Resposnive Trigger-->
                    <!--Navigation-->
                    <div id="mainMenu">
                        <div class="container">
                            <nav>
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li class="dropdown">
                                        <a href="#">Services</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" class="text-primary">Avail</a></li>
                                            <li><a href="{{ route('farmmechanization.create') }}">Farm Mechanization</a>
                                            </li>
                                            <li><a href="{{ route('castrationandspay.create') }}">Dog/Cat Castration
                                                    and
                                                    Spay</a></li>
                                            <li><a href="#" class="text-primary">Track</a></li>
                                            <li><a href="{{ route('farmmechanization.track') }}">Farm
                                                    Mechanization</a>
                                            </li>
                                            <li><a href="{{ route('castrationandspay.track') }}">Dog/Cat Castration
                                                    and
                                                    Spay</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">Apps</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Price Monitoring App</a></li>
                                            <li><a href="#">AH Web App</a></li>
                                            <li><a href="#">AgriBOOST Portal</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('news.guest.index') }}">News</a></li>
                                    <li class="dropdown">
                                        <a href="#">User</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                            <li><a href="{{ route('register') }}">Register</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!--END: TRC-20250709-17500622680996-00001-->
                </div>
            </div>
        </header>
        <!-- end: Header -->

        {{ $slot }}

        <!-- Footer -->
        <style>
            .background-section2 {
                position: relative;
                background-image: url('{{ url('frontend/guestlayout/images/1.jpg') }}');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center;
                /* height: 100%;
                /* or whatever height you need */
                /* z-index: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 5vh; */
                /* full screen height */
                /* padding: 40px 0;
                */
            }

            .background-section2::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.8);
                /* white with 60% opacity */
                z-index: 2;
            }

            .background-section2>* {
                position: relative;
                z-index: 3;
            }
        </style>

        <footer id="footer" class="background-section2">

            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-lg-2 col-md-4">
                            <!-- Footer widget area 1 -->
                            <div class="widget widget-contact-us"
                                style="
                                        background-image: url('images/world-map-dark.png');
                                        background-position: 50% 20px;
                                        background-repeat: no-repeat;
                                    ">
                                <h4><img style="height: 70px;"
                                        src="{{ url('frontend/guestlayout/images/CAVD.png') }}" alt=""></h4>
                                <ul class="list-icon">
                                    <li>
                                        <i class="fa fa-map-marker-alt text-primary"></i><a
                                            href="https://maps.app.goo.gl/nKuo6Cwra33MX6Y5A" target="_blank">
                                            <span style="color:black;">DOP Building, Tiniwisan, Butuan City</span></a>
                                    </li>
                                    <li><i class="fa fa-phone text-primary fw-bold"></i> <a
                                            href="tel:095175226591"><span style="color:black;">095175226591</span></a>
                                    </li>
                                    <li>
                                        <i class="far fa-envelope text-primary"></i>
                                        <a href="mailto:cavd@butuan.gov.ph">
                                            <span style="color:black;">cavd@butuan.gov.ph</span></a>
                                    </li>
                                    <li>
                                        <br />
                                        <i class="far fa-clock text-primary"></i><span style="color:black;">
                                            Monday - Friday:
                                            <strong>08:00AM - 5:00PM</strong> <br />
                                            Saturday, Sunday: <strong>Closed</strong>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <!-- end: Footer widget area 1 -->
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-8">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d246.3152234936981!2d125.5930256!3d8.9681321!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x330195b3cbc1fcd7%3A0x361aceb0ebff3ab!2sOffice%20of%20the%20City%20Agriculturist!5e0!3m2!1sen!2sph!4v1729739767608!5m2!1sen!2sph"
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-primary fw-bold">CONTACT US</h4>
                                    <form action="{{ route('contactus.store') }}" method="post">

                                        @csrf

                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary" id="basic-addon1"><i
                                                        class="fa fa-user text-white"></i></span>
                                            </div>
                                            <input type="text" aria-required="true"
                                                class="form-control required name" placeholder="Enter your Name"
                                                name="name" />
                                        </div>

                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary" id="basic-addon1"><i
                                                        class="fa fa-phone text-white"></i></span>
                                            </div>
                                            <input type="text" aria-required="true"
                                                class="form-control required name" placeholder="Enter Contact Number"
                                                name="contact_number" />
                                        </div>

                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary" id="basic-addon1"><i
                                                        class="fa fa-envelope text-white"></i></span>
                                            </div>
                                            <input type="email" aria-required="true" required
                                                class="form-control required email" placeholder="Enter your Email"
                                                name="email" />
                                        </div>

                                        <div class="form-group mb-2">
                                            <textarea type="text" name="message" rows="5" class="form-control required"
                                                placeholder="Enter your Message"></textarea>
                                        </div>

                                        <div class="flex items-center justify-end mb-2">
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('app.captcha.captcha_site_key') }}"
                                                data-callback="onCaptchaSuccess">
                                            </div>
                                        </div>

                                        <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />

                                        <div class="form-group">
                                            <button class="btn bg-primary" type="submit">
                                                <i class="fa fa-paper-plane"></i>&nbsp;Send message
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-content bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Social icons -->
                            <div class="social-icons social-icons-colored float-left">
                                <ul>
                                    <li class="social-facebook">
                                        <a href="https://www.facebook.com/bxuagriculturist" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end: Social icons -->
                        </div>

                        <div class="col-lg-6">
                            <div class="copyright-text text-right text-white">
                                2025 City Agriculture and Veterinary Department (CAVD)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end: Footer -->
    </div>

    <style>
        .custom-alert {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: block;
            animation: fadein 0.5s, fadeout 0.5s 4.5s;
            padding: 15px;
            border-radius: 4px;
            min-width: 300px;
        }

        /* Animations */
        @keyframes fadein {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeout {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }
    </style>

    @if (session('success'))
        <div class="custom-alert alert alert-success">
            <button type="button" class="close" onclick="this.parentElement.style.display='none';">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong><i class="fa fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <script>
        // Auto remove the alert after 5 seconds
        setTimeout(function() {
            const alert = document.querySelector('.custom-alert');
            if (alert) alert.remove();
        }, 5000);
    </script>

    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ url('frontend/guestlayout/js/jquery.js') }}"></script>
    <script src="{{ url('frontend/guestlayout/js/plugins.js') }}"></script>

    <!--Template functions-->
    <script src="{{ url('frontend/guestlayout/js/functions.js') }}"></script>
</body>

</html>
