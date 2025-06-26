<x-guestlayout.layout>

    <!-- Inspiro Slider -->
    <div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-height-xs="360" data-autoplay="2600"
        data-animate-in="fadeIn" data-animate-out="fadeOut" data-items="1" data-loop="true" data-autoplay="true">
        <!-- Slide 1 -->
        @foreach ($bannerLatest as $banners)
            <div class="slide" data-bg-image="{{ asset('storage/' . $banners->banner_picture) }}">
                <div class="container">
                    <div class="slide-captions text-left">

                    </div>
                </div>
            </div>
            <!-- end: Slide 1 -->
        @endforeach
    </div>
    <!--end: Inspiro Slider -->

    <section>
        <div class="container">
            <h4 class="mb-4 text-primary">CAVD ON THE MOVE</h4>
            <div class="carousel" data-items="3">
                <!-- Post item-->
                <div class="post-item border">
                    <div class="post-item-wrap">
                        <div class="post-image">
                            <a href="#"> <img alt=""
                                    src="{{ url('frontend/guestlayout/images/1.jpg') }}" /></a>
                            <span class="post-meta-category"><a href="">Lifestyle</a></span>
                        </div>
                        <div class="post-item-description">
                            <span class="post-meta-date"><i class="fa fa-calendar-o"></i>Jan 21, 2017</span>
                            <span class="post-meta-comments"><a href=""><i class="fa fa-comments-o"></i>33
                                    Comments</a></span>
                            <h2>
                                <a href="#">Lighthouse, standard post with a single image</a>
                            </h2>
                            <p>
                                Curabitur pulvinar euismod ante, ac sagittis ante
                                posuere ac. Vivamus luctus commodo dolor porta feugiat.
                                Fusce at velit id ligula pharetra laoreet.
                            </p>
                            <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- end: Post item-->
            </div>
            <!--end: Post Carousel -->
        </div>
    </section>
    <style>
        .background-section {
            position: relative;
            background-image: url('{{ url('frontend/guestlayout/images/1.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 80vh;
            /* or whatever height you need */
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* full screen height */
            padding: 40px 0;
        }

        .background-section::before {
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

        .background-section>* {
            position: relative;
            z-index: 3;
        }
    </style>
    <section class="background-section">
        <div class="container">
            <div class="heading-text heading-section text-center m-b-40">
                <h2 class="text-primary">ABOUT US</h2>
            </div>
            <div class="row m-t-60 mb-5">
                <div class="col-lg-6 text-right">
                    <h2 class="text-primary">OUR MISSION</h2>
                    <span class="lead" style="color:black">Enabling Farmers to adopt sustainable smart agriculture,
                        boost productivity,
                        protect the environment, and enhance livelihoods through innovative technologies.
                    </span>
                </div>

                <div class="col-lg-6 text-left">
                    <h2 class="text-primary">OUR VISION</h2>
                    <span class="lead" style="color:black">By 2034, CAVD is a global leader in sustainable smart
                        agriculture,
                        empowering
                        farmers with innovative technology and real-time support, advancing a tech-savvy and
                        eco-conscious workforce.
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="qms-tab" data-toggle="tab" href="#qms"
                                    role="tab" aria-controls="qms" aria-selected="false">Quality Management
                                    System</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="core-tab" data-toggle="tab" href="#core" role="tab"
                                    aria-controls="core" aria-selected="false">Core Values</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                    aria-controls="contact" aria-selected="true">Startegy Map</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="qms" role="tabpanel"
                                aria-labelledby="qms-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                        <div class="col-lg-12">
                                            <div class="grid-item">
                                                <div class="grid-item-wrap">
                                                    <div class="grid-image">
                                                        <img alt="Image Lightbox"
                                                            src="{{ url('frontend/guestlayout/images/2.jpg') }}" />
                                                    </div>
                                                    <div class="grid-description">
                                                        <a title="QMS Team!" data-lightbox="image"
                                                            href="{{ url('frontend/guestlayout/images/2.jpg') }}"
                                                            class="btn btn-light btn-rounded">Zoom</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p>
                                            <span style="color:black;">
                                                "We commit ourselves to provide the people of Butuan with inclusive
                                                social
                                                services, sustainable environmental services, innovative economic
                                                services,
                                                transparent governance, and quality infrastructure projects projects
                                                carried
                                                out by public servants who are qualified, competent, and are committed
                                                to
                                                uphold the values of honesty, integrity, professionalism, and excellence
                                                thus making Butuan a VIBRANT, COMPETITIVE, LIVABLE, and SUSTAINABLE ECO
                                                CITY"
                                            </span>
                                            <br>
                                            <br>
                                            <span class="mb-3" style="color:black;">
                                                To achieve all these, we commit to:
                                            </span>

                                        <ul class="text-extra-dark-gray">
                                            <li style="list-style-type: none;"><i
                                                    class="fas fa-check icon-small text-success"></i>
                                                <span style="color: black">
                                                    Consistently adhere to policies, rules and
                                                    regulations
                                                </span>
                                            </li>
                                            <li style="list-style-type: none;"><i
                                                    class="fas fa-check icon-small text-success"></i>
                                                <span style="color: black">
                                                    Maintain
                                                    the values of good governance
                                                </span>
                                            </li>
                                            <li style="list-style-type: none;"><i
                                                    class="fas fa-check icon-small text-success"></i>
                                                <span style="color: black">
                                                    Continuously
                                                    improve effectiveness and
                                                    efficiency in our systems
                                                    and procedures according to internation standards
                                                </span>
                                            </li>
                                            <li style="list-style-type: none;"><i
                                                    class="fas fa-check icon-small text-success"></i>
                                                <span style="color: black">
                                                    Continuously
                                                    manage and develop our human
                                                    resources for quality service delivery
                                                </span>
                                            </li>
                                        </ul>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="core" role="tabpanel" aria-labelledby="core-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p>
                                        <div class="col-lg-12">
                                            <div class="grid-item">
                                                <div class="grid-item-wrap">
                                                    <div class="grid-image">
                                                        <img alt="Image Lightbox"
                                                            src="{{ url('frontend/guestlayout/images/3.jpg') }}" />
                                                    </div>
                                                    <div class="grid-description">
                                                        <a title="Core Values!" data-lightbox="image"
                                                            href="{{ url('frontend/guestlayout/images/3.jpg') }}"
                                                            class="btn btn-light btn-rounded">Zoom</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                    <style>
                                        .custom-grid {
                                            display: grid;
                                            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                                            gap: 20px;
                                            /* You can adjust this */
                                        }

                                        .custom-box {
                                            background-color: white;
                                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                                            border-radius: 12px;
                                            padding: 20px;
                                            text-align: center;
                                            display: flex;
                                            flex-direction: column;
                                            align-items: center;
                                            justify-content: center;
                                        }
                                    </style>

                                    <div class="col-lg-6">
                                        <div class="custom-grid">
                                            <div class="custom-box">
                                                <i class="fas fa-trophy text-primary" style="font-size:30px;"></i>
                                                <span
                                                    class="alt-font font-weight-500 mt-3 d-block text-extra-dark-gray">Excellence</span>
                                            </div>
                                            <div class="custom-box">
                                                <i class="fas fa-handshake text-primary" style="font-size:30px;"></i>
                                                <span
                                                    class="alt-font font-weight-500 mt-3 d-block text-extra-dark-gray">Honesty</span>
                                            </div>
                                            <div class="custom-box">
                                                <i class="fas fa-shield-alt text-primary" style="font-size:30px;"></i>
                                                <span
                                                    class="alt-font font-weight-500 mt-3 d-block text-extra-dark-gray">Integrity</span>
                                            </div>
                                            <div class="custom-box">
                                                <i class="fas fa-briefcase text-primary" style="font-size:30px;"></i>
                                                <span
                                                    class="alt-font font-weight-500 mt-3 d-block text-extra-dark-gray">Professionalism</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="col-lg-12">
                                    <div class="grid-item">
                                        <div class="grid-item-wrap">
                                            <div class="grid-image">
                                                <img alt="Image Lightbox"
                                                    src="{{ url('frontend/guestlayout/images/strategy.png') }}" />
                                            </div>
                                            <div class="grid-description">
                                                <a title="Strategy Map" data-lightbox="image"
                                                    href="{{ url('frontend/guestlayout/images/strategy.png') }}"
                                                    class="btn btn-light btn-rounded">Zoom</a>
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

    <section class="background-grey">
        <div class="container">
            <div class="heading-text heading-section text-center">
                <h2 class="text-primary">Services</h2>
                {{-- <p>
                    Lorem ipsum dolor sit amet, consecte adipiscing elit. Suspendisse
                    condimentum porttitor cursumus.
                </p> --}}
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div
                        class="icon-box effect medium border center d-flex flex-column align-items-center justify-content-center text-center h-100 p-4">
                        <div class="icon border-primary mb-3">
                            <a href="{{ route('farmmechanization.create') }}">
                                <i class="fa fa-cogs text-primary"></i></a>
                        </div>
                        <h3 class="text-primary">Farm Mechanization</h3>
                        {{-- <p>
                            Lorem ipsum dolor sit amet, consecte adipiscing elit.
                            Suspendisse condimentum porttitor cursumus.
                        </p> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div
                        class="icon-box effect medium border center d-flex flex-column align-items-center justify-content-center text-center h-100 p-4">
                        <div class="icon border-primary mb-3">
                            <a href="{{ route('castrationandspay.create') }}"><i class="fa fa-paw text-primary"
                                    style="font-size: 30px;"></i></a>
                        </div>
                        <h3 class="text-primary">Dog/Cat Castration and Spay</h3>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="fullscreen" data-bg-parallax="{{ url('frontend/guestlayout/images/5.jpg') }}">
        <div class="bg-overlay"></div>
        <div class="container-wide">
            <div class="container-fullscreen">
                <div class="text-middle">
                    <div class="row justify-content-between">
                        <div class="col-md-5">
                            <div class="heading-text  text-light">
                                <h5 class="text-uppercase">Social Media
                                </h5>
                                <h2><span>City Agriculture and Veterinary Department</span></h2>
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v21.0">
                                </script>
                                <div class="fb-page" data-href="https://www.facebook.com/bxuagriculturist"
                                    data-tabs="timeline" data-width="1000" data-height="" data-small-header="false"
                                    data-adapt-container-width="true" data-hide-cover="false"
                                    data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/bxuagriculturist"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/bxuagriculturist">Butuan City Agriculture
                                            and
                                            Veterinary
                                            Department</a></blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="shadow ml-5">
                                <video playsinline="" autoplay controls loop="true" muted="true"
                                    poster="{{ url('frontend/guestlayout/images/5.jpg') }}" preload="auto">
                                    <source src="{{ url('frontend/guestlayout/videos/vid.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <!-- <div class="position-relative mt-5 mb-5" data-bg-video="video/pexels-workout.mp4" style="height:340px;"></div> -->
                            <!--   <div data-bg-video="video/pexels-man-walking" data-controls="true"></div> -->
                        </div>
                    </div>
                </div>
                <!-- <div class="text-middle">
                        <div class="heading-text text-light col-lg-6">
                            <h2 class="font-weight-800"><span>Create beautiful websites with ease</span></h2>
                            <p>Polo is jam packed with tons of features that will give you the power to create the web
                                as you always wanted.</p>
                            <a href="#" class="btn btn-light btn-rounded">Read More</a>
                        </div>
                    </div> -->
            </div>
        </div>
    </section>

    <!-- WHY CHOOSE US -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="heading-text heading-section m-b-60">
                        <h4 class="text-primary">CLIMATE INFORMATION (PAGASA DOST PAGE)</h4>
                    </div>
                    <div class="mb-3">
                        <iframe src="https://bagong.pagasa.dost.gov.ph/agri-weather" width="100%" height="500px"
                            style="border:none;"></iframe>
                    </div>
                    <div class="mt-auto mx-auto mx-lg-0">
                        <a href="https://bagong.pagasa.dost.gov.ph/agri-weather" target="_blank"
                            class="btn btn-fancy btn-small btn-primary bg-primary">Go to page <i
                                class="fas fa-arrow-right text-white" style="font-size: 10px;"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="heading-text heading-section">
                        <h4 class="text-primary">LA NINA UPDATE</h4>
                    </div>
                    <div>
                        <iframe src="{{ url('frontend/guestlayout/files/lanina2024.pdf') }}" width="100%"
                            height="600px" style="border:none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-guestlayout.layout>
