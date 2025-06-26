<x-guestlayout.layout>
    <style>
        .service-option input[type="radio"] {
            display: none;
        }

        .service-option label {
            cursor: pointer;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 10px;
            transition: 0.3s;
        }

        .service-option input[type="radio"]:checked+label {
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px #0d6efd;
        }

        .service-option img {
            width: 50%;
            height: 50%;
            object-fit: cover;
        }
    </style>
    <!-- Session Status -->
    <!-- Modal for Weekend Warning -->
    <div class="modal fade" id="serviceModal" tabindex="-999" role="dialog" aria-labelledby="weekendModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="weekendModalLabel">Service and Animal Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Kindly select the type of animal and service you want to avail.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="weekendModal" tabindex="-999" role="dialog" aria-labelledby="weekendModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="weekendModalLabel">Invalid Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Castration and Spay Services are only available on Wednesday. Please Select a valid date.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="timeModal" tabindex="-999" role="dialog" aria-labelledby="timeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="timeModalLabel">Time Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please select a valid time slot before proceeding.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>


    <div id="agreeModal" class="modal" tabindex="-1"
        style="display:none; position: fixed; top: 0; left: 0;
    width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="weekendModalLabel">Consent</h5>
                </div>
                <div class="modal-body">
                    {{-- Please verify that you are not a robot. Once verified,  --}}
                    Read and agree to the terms above by clicking
                    "I Agree" before proceeding.
                </div>
                <div class="modal-footer">
                    <button id="closeModalBtn" class="btn btn-secondary">OK</button>
                </div>
            </div>
        </div>
    </div>
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Castration and Spay</span>
                        </div>
                        <!-- Modal -->

                        <div class="card-body">
                            <form method="POST" action="{{ route('castrationandspay.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="wizard-step" id="step-1">
                                    <h4 class="text-primary" style="font-weight:bold">
                                        Welcome to the City Agriculture and Veterinary Department (CAVD) Service
                                        Appointment System for Castration and Spay Services
                                    </h4>
                                    <h5>
                                        Below are the steps in setting a schedule for Castration and Spay Service:
                                    </h5>
                                    <div class="text-large pt-3" style="font-style: italic;"><span
                                            style="font-weight: bold;">Steps:</span> <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                    Read and understand the Steps, Privacy Notice, and Important
                                                    Reminders.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Basaha ug sabta ang mga Lakang, Pahibalo sa Pagkapribado, ug
                                                        mga
                                                        Importanteng Pahimangno.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="grid-item">
                                                        <div class="grid-item-wrap">
                                                            <div class="grid-image">
                                                                <img alt="Image Lightbox"
                                                                    src="{{ url('frontend/guestlayout/images/farmmech-step1.png') }}" />
                                                            </div>
                                                            <div class="grid-description">
                                                                <a title="Step 1" data-lightbox="image"
                                                                    href="{{ url('frontend/guestlayout/images/farmmech-step1.png') }}"
                                                                    class="btn btn-light btn-rounded">Zoom</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    Select your proposed date for Land Preparation and schedule your
                                                    Office Visit.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Pilia ang imong gisuportang petsa para sa Pag-andam sa
                                                        Yuta ug
                                                        pag-schedule sa imong Pagbisita sa Opisina.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="grid-item">
                                                        <div class="grid-item-wrap">
                                                            <div class="grid-image">
                                                                <img alt="Image Lightbox"
                                                                    src="{{ url('frontend/guestlayout/images/farmmech-step2.png') }}" />
                                                            </div>
                                                            <div class="grid-description">
                                                                <a title="Step 2" data-lightbox="image"
                                                                    href="{{ url('frontend/guestlayout/images/farmmech-step2.png') }}"
                                                                    class="btn btn-light btn-rounded">Zoom</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    Select your proposed date for Land Preparation and schedule your
                                                    Office Visit.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Pilia ang imong gisuportang petsa para sa Pag-andam sa Yuta ug
                                                        pag-schedule sa imong Pagbisita sa Opisina.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="grid-item">
                                                        <div class="grid-item-wrap">
                                                            <div class="grid-image">
                                                                <img alt="Image Lightbox"
                                                                    src="{{ url('frontend/guestlayout/images/farmmech-step2.png') }}" />
                                                            </div>
                                                            <div class="grid-description">
                                                                <a title="Step 2" data-lightbox="image"
                                                                    href="{{ url('frontend/guestlayout/images/farmmech-step2.png') }}"
                                                                    class="btn btn-light btn-rounded">Zoom</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    Provide the details of the availed service, including the
                                                    machinery
                                                    used, area size, your category as the requestor, and other
                                                    relevant
                                                    request information.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Isulod ang mga detalye sa serbisyong gi-avail, lakip ang
                                                        makinang gigamit, gidak-on sa yuta, imong kategorya isip
                                                        nangayo
                                                        sa serbisyo, ug uban pang may kalabutan nga impormasyon sa
                                                        hangyo.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="grid-item">
                                                        <div class="grid-item-wrap">
                                                            <div class="grid-image">
                                                                <img alt="Image Lightbox"
                                                                    src="{{ url('frontend/guestlayout/images/farmmech-step3.png') }}" />
                                                            </div>
                                                            <div class="grid-description">
                                                                <a title="Step 3" data-lightbox="image"
                                                                    href="{{ url('frontend/guestlayout/images/farmmech-step3.png') }}"
                                                                    class="btn btn-light btn-rounded">Zoom</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                                    Please enter your personal details accurately.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Palihug isulod ang imong personal nga impormasyon nga
                                                        husto ug tukma.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="col-lg-12">
                                                    <div class="grid-item">
                                                        <div class="grid-item-wrap">
                                                            <div class="grid-image">
                                                                <img alt="Image Lightbox"
                                                                    src="{{ url('frontend/guestlayout/images/farmmech-step4.png') }}" />
                                                            </div>
                                                            <div class="grid-description">
                                                                <a title="Step 4" data-lightbox="image"
                                                                    href="{{ url('frontend/guestlayout/images/farmmech-step4.png') }}"
                                                                    class="btn btn-light btn-rounded">Zoom</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-large pt-3" style="font-style: italic;"><span
                                            style="font-weight: bold;">Pre-Operative Instructions
                                            <br> <span class="text-primary">(Mga Panudlo sa Wala
                                                pa ang Operasyon):</span></span> <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                            Do not Feed your pet 12-18 hours prior to surgery, provide only clean
                                            drinking water.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Ayaw pakaona ang imong hayop 12-18 ka oras sa wala pa ang operasyon,
                                                peron pwede lang paimnon og limpyo nga tubig.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                            Ensure that your pet is secured with a leash and/or a cage before
                                            transporting to the surgical area/office.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Siguraduhon nga ang imong hayop nakaseguro gamit ang tali ug/o
                                                hawla
                                                sa wala pa ang pagdala niini sa lugar/opisina sa operasyon.
                                            </span></span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                            Bring used towels or old newspapers to be used as bedding for the animal
                                            after the surgery.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Magdala og gigamit nga tuwalya o daan nga diyaryo nga gamiton nga
                                                higdaanan sa hayop human sa operasyon.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                            Your pet must be vaccinated against Rabies at least 7 days prior to surgery
                                            (provide the vaccination card/certificate).
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Ang imong hayop kinahanglan nga nabakunahan batok sa Rabies labing
                                                menos
                                                7 ka adlaw sa wala pa ang operasyon (ihatag ang vaccination
                                                card/certificate).
                                            </span>
                                        </span>
                                    </div>
                                    <div class="text-large pt-3" style="font-style: italic;"><span
                                            style="font-weight: bold;">Needed materials per animal <span
                                                class="text-danger" style="font-weight: normal"> (Must be
                                                <span style="font-weight: bold">provided by the owner</span> prior or
                                                during the surgery) </span>
                                            <br> <span class="text-primary">Mga kinahanglanon nga materyales kada
                                                hayop <span class="text-danger" style="font-weight: normal">
                                                    (Kinahanglan nga
                                                    <span style="font-weight: bold">paliton o ihatag sa tag-iya</span>
                                                    sa wala pa o panahon sa operasyon) </span>:</span></span>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                            2 pcs Surgical gloves size 7.5
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                            10 pcs Sterile gauze pads (any size)
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                            3 pcs 1ml Syringes
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                            1-2 pcs polygalactin/novosyn/vicryl stutures (size 2-0 or 3-0)
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">5.
                                            1 bottle 60ml Bactidol
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">6.
                                            1 Ampule Tramadol
                                            <br>
                                        </span>
                                    </div>
                                    <div class="text-large pt-3" style="font-style: italic;"><span
                                            style="font-weight: bold;">Post-Operative Care
                                            <br> <span class="text-primary">(Pag-atiman pagkahuman sa
                                                operasyon:):</span></span> <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                            Do not feed the animal for 6 to 8 hours after the surgery. After that,
                                            provide soft food diet for the animal
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Ayaw pakaona ang hayop sulod sa 6 hangtod 8 ka oras pagkahuman sa
                                                operasyon. Human niini, hatagi og hapsay o humok nga pagkaon ang hayop.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                            Provide clean drinking water all the time
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Hatagi og limpyo nga imnunung tubig pirme
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                            Restrain the animal in a cage or with a leash
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Pugngi ang hayop pinaagi sa kulungan o pagtali gamit ang leash.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                            Avoid strenuous activity and other stressful exercises
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Likayi ang bug-at nga lihok ug ubang makastres nga ehersisyo.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">5.
                                            Do not bath the animal for 14 days following the surgery
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Ayaw paligoi ang hayop sulod sa 14 ka adlaw human sa operasyon.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">6.
                                            Cleanse the area around the wound with betadine(iodine) and clean gauze or
                                            cotton
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Limpyohi ang palibot sa samad gamit ang Betadine (iodine) ug limpyo
                                                nga gauze o cotton.
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">7.
                                            If wounds continuously bleed or mutilated, please contact the local
                                            veterinarian
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Kung ang samad padayon nga nagdugo o naguba, palihug kontaka dayon ang
                                                lokal nga beterinaryo.
                                            </span>
                                        </span>
                                        <br>
                                    </div>
                                    <div class="text-large pt-3" style="font-style: italic;"><span
                                            style="font-weight: bold;">Privacy Notice:</span> <br>
                                        <span>
                                            The City Agriculture and Veterinary Department (CAVD) is committed to
                                            protect your privacy and
                                            ensure the security of your personal information in compliance with
                                            Republic Act No. 10173, or the Data Privacy Act of 2012 of the Philippines.

                                            This Privacy Notice explains how we collect, use, disclose, and safeguard
                                            your personal information when you use our Web Appointment System.
                                        </span>
                                        <br>
                                        <span class="text-primary mt-3" style="font-weight: bold;">
                                            Ang City Agriculture and Veterinary Department (CAVD) nagkugi sa
                                            pagpanalipod sa imong pribasiya ug pagsiguro sa seguridad sa imong personal
                                            nga impormasyon subay sa Republic Act No. 10173, o ang Data Privacy Act of
                                            2012 sa Pilipinas. Kining Privacy Notice nagpasabot kung giunsa namo
                                            pagkolekta, paggamit, pagpaambit, ug pagpanalipod sa imong personal nga
                                            impormasyon samtang naggamit ka sa among Web Appointment System.
                                        </span>
                                        {{-- 1 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">1.
                                                Collection of Personal Data
                                            </span>
                                            <br>
                                            When you use our appointment system, we collect the following personal
                                            information:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Full name</li>
                                                <li class="pl-3">Contact details (e.g., phone number, email)</li>
                                                <li class="pl-3">Preferred appointment date and time</li>
                                                <li class="pl-3">Area/location (if applicable)</li>
                                                <li class="pl-3">Other information necessary for appointment
                                                    processing</li>
                                            </ul>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Pagkolekta sa Personal nga Datos
                                                </span>
                                                <br>
                                                Sa paggamit nimo sa among appointment system, among gikolekta ang
                                                mosunod nga personal nga impormasyon:
                                                <br>
                                                <ul class="pl-3">
                                                    <li class="pl-3">Tibuok nga ngalan</li>
                                                    <li class="pl-3">Detalye sa pagkontak (pananglitan, numero sa
                                                        telepono, email)</li>
                                                    <li class="pl-3">Gipili nga petsa ug oras sa appointment</li>
                                                    <li class="pl-3">Lugar/area (kung angay)</li>
                                                    <li class="pl-3">Uban pang impormasyon nga gikinahanglan para sa
                                                        pagproseso sa appointment</li>
                                                </ul>
                                            </span>
                                        </span>
                                        {{-- 2 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">2.
                                                Use of Personal Data
                                            </span>
                                            <br>
                                            Your personal data will be used solely for the following purposes:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">To process your appointment requests</li>
                                                <li class="pl-3">To contact you regarding the status of your
                                                    appointment</li>
                                                <li class="pl-3">To manage scheduling and service delivery</li>
                                                <li class="pl-3">To comply with legal and regulatory requirements
                                                </li>
                                            </ul>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Paggamit sa Personal nga Datos
                                                </span>
                                                <br>
                                                Ang imong personal nga datos gamiton lang alang sa mosunod nga mga
                                                katuyoan:
                                                <br>
                                                <ul class="pl-3">
                                                    <li class="pl-3">Aron ma-proseso ang imong mga hangyo sa
                                                        appointment</li>
                                                    <li class="pl-3">Aron makontak ka bahin sa kahimtang sa imong
                                                        appointment</li>
                                                    <li class="pl-3">Aron pagdumala sa iskedyul ug paghatag sa
                                                        serbisyo</li>
                                                    <li class="pl-3">Aron pagsunod sa mga legal ug regulasyon nga
                                                        kinahanglanon</li>
                                                </ul>
                                            </span>
                                        </span>
                                        {{-- 3 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">3.
                                                Data Sharing and Disclosure
                                            </span>
                                            <br>
                                            Your personal data will not be shared with third parties, except:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">When required by law or government authorities</li>
                                                <li class="pl-3">With service providers and partners who assist in
                                                    appointment management, under strict confidentiality agreements</li>
                                                <li class="pl-3">When you give explicit consent</li>
                                            </ul>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">Pagpaambit ug
                                                    Pagpadayag sa Datos
                                                </span>
                                                <br>
                                                Ang imong personal nga datos dili ipahimutang sa ikatulong partido,
                                                gawas lamang sa:
                                                <br>
                                                <ul class="pl-3">
                                                    <li class="pl-3">Kung gikinahanglan sa balaod o sa mga ahensya sa
                                                        gobyerno</li>
                                                    <li class="pl-3">Uban sa mga service provider ug partners nga
                                                        motabang sa pagdumala sa appointment, ubos sa istrikto nga
                                                        kasabotan sa sekreto</li>
                                                    <li class="pl-3">Kung ikaw maghatag og klarong pagtugot</li>
                                                </ul>
                                            </span>
                                        </span>
                                        {{-- 4 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">4.
                                                Data Protection Measures
                                            </span>
                                            <br>
                                            We implement technical, organizational, and physical safeguards to protect
                                            your personal data against loss, misuse, unauthorized access, disclosure, or
                                            alteration. These include:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Secure web servers with encrypted connections</li>
                                                <li class="pl-3">Access controls and authentication</li>
                                                <li class="pl-3">Regular system monitoring and updates</li>
                                            </ul>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Mga Paagi sa Pagpanalipod sa Datos
                                                </span>
                                                <br>
                                                Naga-implementar kami og teknikal, organisasyonal, ug pisikal nga mga
                                                paagi aron mapanalipdan ang imong personal nga datos batok sa pagkawala,
                                                dili angay nga paggamit, dili awtorisadong pag-access, pagpadayag, o
                                                pag-usab. Kini naglakip sa:
                                                <br>
                                                <ul class="pl-3">
                                                    <li class="pl-3">Luwas nga web server nga adunay encrypted nga
                                                        koneksyon</li>
                                                    <li class="pl-3">Kontrol sa pag-access ug pagpanghimatuud
                                                        (authentication)</li>
                                                    <li class="pl-3">Regular nga pag-monitor ug pag-update sa sistema
                                                    </li>
                                                </ul>

                                            </span>
                                        </span>

                                        {{-- 5 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">5.
                                                Retention Period
                                            </span>
                                            <br>
                                            We will retain your personal data only as long as necessary to fulfill the
                                            purposes stated above or as required by law. After which, your data will be
                                            securely deleted or anonymized.
                                            <br>
                                            <div class="mb-3"></div>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Panahon sa Pagtipig sa Datos
                                                </span>
                                                <br>
                                                Among itipig ang imong personal nga datos hangtod nga kini gikinahanglan
                                                aron matuman ang mga katuyoan nga gihisgutan sa taas o kung
                                                gikinahanglan sa balaod. Human niini, ang imong datos pagalaglagon sa
                                                luwas nga paagi o pagaanon aron dili na kini makaila (anonymized).
                                            </span>
                                        </span>

                                        {{-- 6 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">6.
                                                Your Rights as a Data Subject
                                            </span>
                                            <br>
                                            You have the following rights under the Data Privacy Act:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Right to be informed about how your data is used
                                                </li>
                                                <li class="pl-3">Right to access your personal data</li>
                                                <li class="pl-3">Right to object to data processing</li>
                                                <li class="pl-3">Right to correct inaccurate or incomplete data</li>
                                                <li class="pl-3">Right to erasure or blocking of your data</li>
                                                <li class="pl-3">Right to data portability</li>
                                            </ul>
                                            To exercise these rights, please contact our Office
                                            at:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Email: cavd@butuan.gov.ph
                                                </li>
                                                <li class="pl-3">Phone: 095175226591</li>
                                                <li class="pl-3">Address: DOP Building, Tiniwisan, Butuan City</li>
                                            </ul>
                                            <span class="text-primary" style="font-weight: bold">
                                                Imong mga Katungod isip Data Subject
                                            </span>
                                            <br>
                                            Adunay kay mosunod nga mga katungod ubos sa Data Privacy Act:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Katungod nga mahibal-an kung giunsa paggamit ang
                                                    imong datos</li>
                                                <li class="pl-3">Katungod nga ma-access ang imong personal nga datos
                                                </li>
                                                <li class="pl-3">Katungod nga mosupak sa pagproseso sa imong datos
                                                </li>
                                                <li class="pl-3">Katungod nga ma-ayo ang sayop o kulang nga datos
                                                </li>
                                                <li class="pl-3">Katungod nga mapasipala o mapugngan ang paggamit sa
                                                    imong datos</li>
                                                <li class="pl-3">Katungod sa pagbalhin sa imong datos (data
                                                    portability)</li>
                                            </ul>
                                            Aron magamit kini nga mga katungod, palihug kontaka ang among buhatan sa:
                                            <br>
                                            <ul class="pl-3">
                                                <li class="pl-3">Email: cavd@butuan.gov.ph</li>
                                                <li class="pl-3">Telepono: 095175226591</li>
                                                <li class="pl-3">Address: DOP Building, Tiniwisan, Butuan City</li>
                                            </ul>
                                        </span>
                                        {{-- 7 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">7.
                                                Consent
                                            </span>
                                            <br>
                                            By using our Web Appointment System and providing your personal data, you
                                            signify your consent to the collection, use, and processing of your personal
                                            information as outlined in this Privacy Notice.
                                            <br>
                                            <div class="mb-3"></div>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Pagtugot
                                                </span>
                                                <br>
                                                Pinaagi sa paggamit sa among Web Appointment System ug sa paghatag sa
                                                imong personal nga datos, imong gipasabot ang imong pagtugot sa
                                                pagkolekta, paggamit, ug pagproseso sa imong personal nga impormasyon
                                                sumala sa nakalatid niini nga Privacy Notice.
                                            </span>
                                        </span>
                                        {{-- 8 --}}
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;"
                                            class="mt-3">
                                            <span class="text-primary" style="font-weight: bold">8.
                                                Updates to this Notice
                                            </span>
                                            <br>
                                            This Privacy Notice may be updated from time to time. Changes will be posted
                                            on this website and will take effect immediately upon posting.
                                            <br>
                                            <div class="mb-3"></div>
                                            <span class="mt-3">
                                                <span class="text-primary" style="font-weight: bold">
                                                    Mga Pagbag-o sa Kini nga Pahibalo
                                                </span>
                                                <br>
                                                Kini nga Privacy Notice mahimong usbon gikan sa panahon ngadto sa
                                                panahon. Ang mga pagbag-o ipahibalo sa niini nga website ug epektibo
                                                dayon pagkapost niini.
                                            </span>
                                        </span>
                                    </div>

                                    <!-- Hidden until CAPTCHA success -->
                                    <div id="agree-container" class="text-center mt-4" {{-- style="display: none;" --}}>
                                        <div class="form-group col-md-6 d-flex justify-content-center align-items-center"
                                            style="margin: 0 auto;">
                                            <table class="btn btn-primary">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="agree" id="agree"
                                                                required autocomplete="agree"
                                                                style="margin-right: 8px;" />
                                                        </td>
                                                        <td>
                                                            <label for="agree" class="text-white fw-bold"
                                                                style="cursor: pointer; font-weight:bold;">
                                                                I Agree
                                                            </label>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{-- <script>
                                        function onCaptchaSuccess() {
                                            document.getElementById('agree-container').style.display = 'block';
                                        }
                                    </script> --}}
                                </div>

                                <div class="wizard-step d-none" id="step-2">
                                    <h5 class="mt-3">Step 2: Service</h5>
                                    <br>
                                    <h5 class="mt-3">Animal Type</h5>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <div class="row service-option">
                                                <div class="col-md-6 text-center">
                                                    <input type="radio" id="cat" name="animal_type" required
                                                        value="Cat">
                                                    <label for="cat">
                                                        <img src="{{ url('frontend/guestlayout/images/cat.png') }}"
                                                            alt="Cat">
                                                        <div>Cat</div>
                                                    </label>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <input type="radio" id="dog" name="animal_type" required
                                                        value="Dog">
                                                    <label for="dog">
                                                        <img src="{{ url('frontend/guestlayout/images/dog.png') }}"
                                                            alt="Dog">
                                                        <div>Dog</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mt-3">Service to Avail</h5>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <div class="row service-option">
                                                <div class="col-md-6 text-center">
                                                    <input type="radio" id="castration" name="service_type"
                                                        required value="Castration">
                                                    <label for="castration">
                                                        <img src="{{ url('frontend/guestlayout/images/castration.png') }}"
                                                            alt="Castration">
                                                        <div>Castration</div>
                                                    </label>
                                                </div>

                                                <div class="col-md-6 text-center">
                                                    <input type="radio" id="spay" name="service_type" required
                                                        value="Spay">
                                                    <label for="spay">
                                                        <img src="{{ url('frontend/guestlayout/images/spay.png') }}"
                                                            alt="Spay">
                                                        <div>Spay</div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wizard-step d-none" id="step-3">
                                    <h5 class="mt-3">Step 3: Scheduled Date and Time of Operation</h5>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="visitation_schedule" class="text-primary"
                                                :value="__('Date of Operation')" />
                                            <x-input-label for="visitation_schedule" :value="__('(Petsa sa operasyon)')" />
                                            <x-text-input class="form-control" type="text"
                                                style="background-color:white;" name="visitation_schedule"
                                                :value="old('visitation_schedule')" required autofocus autocomplete="visitation_schedule"
                                                placeholder="Enter Date" id="visitation_schedule" />
                                            <x-input-error :messages="$errors->get('visitation_schedule')" class="mt-2 text-danger" />
                                            <x-input-label for="visitation_schedule" style="font-weight:bold"
                                                :value="__('Service is only available on Wednesday')" />
                                            <x-input-label for="visitation_schedule" class="text-danger"
                                                style="font-weight:bold" :value="__('(Ang serbisyo available ra kada Miyerkules)')" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label class="text-primary" :value="__('Vacant Schedules')" />
                                            <div id="available-times" class="mt-3" style="font-weight:bold">Please
                                                select a date first to view the
                                                available time slots <span class="text-primary"
                                                    style="font-weight:bold;">(Palihug pagpili usa og petsa aron makita
                                                    ang
                                                    bakante nga mga oras.)</span></div>
                                            <input type="hidden" name="time_from" id="time_from" required autofocus>
                                            <input type="hidden" name="time_to" id="time_to" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step d-none" id="step-4">
                                    <h5>Step 4: Vaccination Status</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="vaccination_date" class="text-primary"
                                                :value="__('Date of Last Vaccination')" />
                                            <x-input-label for="vaccination_date" :value="__('(Petsa sa Katapusan nga Pagpabakuna)')" />
                                            <x-text-input id="vaccination_date" class="form-control" type="text"
                                                style="background-color:white;" name="vaccination_date"
                                                :value="old('vaccination_date')" required autofocus autocomplete="vaccination_date"
                                                placeholder="Date of Last Vaccination" />
                                            <x-input-error :messages="$errors->get('vaccination_date')" class="mt-2 text-danger" />
                                            <x-input-label for="vaccination_date" style="font-weight:bold"
                                                :value="__(
                                                    'The animal must have been vaccinated more than 7 days prior to the operation. If the vaccination is already over a year old, it is considered expired. Please ensure the animal receives a new vaccination and schedule the operation at least one week afterward. For your convenience, you may also avail of CAVD’s walk-in vaccination services',
                                                )" />
                                            <x-input-label for="vaccination_date" class="text-danger"
                                                style="font-weight:bold" :value="__(
                                                    '(Ang hayop kinahanglan nga nabakunahan sobra sa 7 ka adlaw sa wala pa ang operasyon. Kung lapas na og usa ka tuig ang bakuna, giisip kini nga expired. Palihug pa-bakunahi ug usab ug iskedyul ang operasyon usa ka semana human niini. Makapadayon sab mo sa walk-in vaccination services sa CAVD.)',
                                                )" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="vaccination_card" class="text-primary"
                                                :value="__('Upload Vaccination Card')" />
                                            <x-input-label for="vaccination_card" :value="__('(I-upload ang Kard sa Bakuna)')" />
                                            <x-text-input id="vaccination_card" class="form-control" type="file"
                                                name="vaccination_card" :value="old('vaccination_card')" required autofocus
                                                autocomplete="vaccination_card"
                                                placeholder="Upload Vaccination Card" />
                                            <x-input-error :messages="$errors->get('vaccination_card')" class="mt-2 text-danger" />

                                            <x-input-label for="vaccination_date" style="font-weight:bold"
                                                :value="__(
                                                    'Kindly upload a clear photo of the vaccination card showing the date of last vaccination. This is required for verification purposes',
                                                )" />
                                            <x-input-label for="vaccination_date" class="text-danger"
                                                style="font-weight:bold" :value="__(
                                                    '(Palihug i-upload ang klaro nga litrato sa vaccination card nga nagpakita sa petsa sa kataposang bakuna. Kini gikinahanglan alang sa among beripikasyon.)',
                                                )" />
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step d-none" id="step-5">
                                    <h5>Step 5: Personal Information</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <x-input-label for="full_name" class="text-primary" :value="__('Full Name')" />
                                            <x-input-label for="full_name" :value="__('(Tibuok ngalan)')" />
                                            <x-text-input id="full_name" class="form-control" type="text"
                                                name="full_name" :value="old('full_name')" required autofocus
                                                autocomplete="full_name" placeholder="Enter Full Name" />
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="sex" class="text-primary" :value="__('Sex')" />
                                            <x-input-label for="sex" :value="__('(Sekso)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="sex" required>
                                                    <option value="" {{ old('sex') === '' ? 'selected' : '' }}>
                                                        Select Sex</option>
                                                    <option value="Male"
                                                        {{ old('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ old('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('sex')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="birthdate" class="text-primary" :value="__('Birthdate')" />
                                            <x-input-label for="birthdate" :value="__('(Petsa sa pagkatawo)')" />
                                            <x-text-input id="birthdate" class="form-control" type="text"
                                                style="background-color: white;" name="birthdate" :value="old('birthdate')"
                                                autofocus autocomplete="birthdate" placeholder="Enter Birthdate" />
                                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="contact_number" class="text-primary"
                                                :value="__('Contact Number')" />
                                            <x-input-label for="contact_number" :value="__('(Numero sa kontak)')" />
                                            <x-text-input id="contact_number" class="form-control" type="text"
                                                name="contact_number" :value="old('contact_number')" autofocus
                                                autocomplete="contact_number" placeholder="Enter Contact No." />
                                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="email" class="text-primary" :value="__('Email')" />
                                            <x-input-label for="email" :value="__('(Adres sa email)')" />
                                            <x-text-input id="email" class="form-control" type="email"
                                                name="email" :value="old('email')" autofocus autocomplete="email"
                                                placeholder="Enter Email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="region_id" class="text-primary" :value="__('Region')" />
                                            <x-input-label for="region_id" :value="__('(Rehiyon)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="region_id" id="region_id" required>
                                                    <option value="">Select Region</option>
                                                    @foreach ($regions as $region)
                                                        <option value="{{ $region->region_id }}"
                                                            {{ old('region_id') == $region->region_id ? 'selected' : '' }}>
                                                            {{ $region->region_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('region_id')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label for="province_id" class="text-primary"
                                                :value="__('Province')" />
                                            <x-input-label for="province_id" :value="__('(Probinsya)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="province_id" id="province_id" required>
                                                    <option value="">Select Province</option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('province_id')" class="mt-2 text-danger" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="municipality_id" class="text-primary"
                                                :value="__('City/Municipality')" />
                                            <x-input-label for="municipality_id" :value="__('(Lungsod/Munisipyo)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="municipality_id" id="municipality_id" required>
                                                    <option value="">Select City/Municipality</option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('municipality_id')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label for="barangay_id" class="text-primary"
                                                :value="__('Barangay')" />
                                            <x-input-label for="barangay_id" :value="__('(Barangay)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="barangay_id" id="barangay_id" required>
                                                    <option value="">Select Barangay</option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('barangay_id')" class="mt-2 text-danger" />
                                        </div>
                                    </div>

                                    <script>
                                        function resetDropdown(elementId, defaultOptionText) {
                                            const select = document.getElementById(elementId);
                                            select.innerHTML = `<option value="">${defaultOptionText}</option>`;
                                        }

                                        function fetchDropdown(url, targetId, valueKey, textKey) {
                                            fetch(url)
                                                .then(response => response.json())
                                                .then(data => {
                                                    const select = document.getElementById(targetId);
                                                    data.forEach(item => {
                                                        const option = document.createElement('option');
                                                        option.value = item[valueKey];
                                                        option.text = item[textKey];
                                                        select.appendChild(option);
                                                    });
                                                })
                                                .catch(error => {
                                                    console.error('Dropdown fetch error:', error);
                                                });
                                        }

                                        document.getElementById('region_id').addEventListener('change', function() {
                                            const region_id = this.value;
                                            resetDropdown('province_id', 'Select Province');
                                            resetDropdown('municipality_id', 'Select City/Municipality');
                                            resetDropdown('barangay_id', 'Select Barangay');

                                            if (region_id) {
                                                fetchDropdown(`/get-provinces/${region_id}`, 'province_id', 'province_id', 'province_name');
                                            }
                                        });

                                        document.getElementById('province_id').addEventListener('change', function() {
                                            const province_id = this.value;
                                            resetDropdown('municipality_id', 'Select City/Municipality');
                                            resetDropdown('barangay_id', 'Select Barangay');

                                            if (province_id) {
                                                fetchDropdown(`/get-municipalities/${province_id}`, 'municipality_id', 'municipality_id',
                                                    'municipality_name');
                                            }
                                        });

                                        document.getElementById('municipality_id').addEventListener('change', function() {
                                            const municipality_id = this.value;
                                            resetDropdown('barangay_id', 'Select Barangay');

                                            if (municipality_id) {
                                                fetchDropdown(`/get-barangays/${municipality_id}`, 'barangay_id', 'barangay_id', 'barangay_name');
                                            }
                                        });
                                    </script>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <x-input-label for="specific_location" class="text-primary"
                                                :value="__('Specific Location (Purok/Street/Village etc.)')" />
                                            <x-input-label for="specific_location" :value="__('(Tukmang Lokasyon (Purok/Dalan/Baryo ug uban pa)')" />
                                            <x-text-input id="specific_location" class="form-control" type="text"
                                                name="specific_location" :value="old('specific_location')"
                                                autocomplete="specific_location"
                                                placeholder="Enter Purok/Street/Village etc." />
                                            <x-input-error :messages="$errors->get('specific_location')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step d-none" id="step-6">
                                    <h5>Step 6: Pet Information</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="animal_name" class="text-primary"
                                                :value="__('Pet Name')" />
                                            <x-input-label for="animal_name" :value="__('(Tibuok ngalan sa Binuhì)')" />
                                            <x-text-input id="animal_name" class="form-control" type="text"
                                                name="animal_name" :value="old('animal_name')" required autofocus
                                                autocomplete="animal_name" placeholder="Enter Full Name" />
                                            <x-input-error :messages="$errors->get('animal_name')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="animal_sex" class="text-primary" :value="__('Pet Sex')" />
                                            <x-input-label for="animal_sex" :value="__('(Sekso sa Binuhì)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="animal_sex" required>
                                                    <option value=""
                                                        {{ old('animal_sex') === '' ? 'selected' : '' }}>
                                                        Select Sex</option>
                                                    <option value="Male"
                                                        {{ old('animal_sex') === 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ old('animal_sex') === 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('animal_sex')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <x-input-label class="text-primary" :value="__('Pet Age (Year/s and Month/s)')" />
                                            <x-input-label :value="__('(Pila na ka tuig og bulan ang binuhi?)')" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label class="text-primary" :value="__('Year/s')" />
                                            <x-input-label for="animal_age_year" :value="__('(Pila na ka tuig ang binuhi?)')" />
                                            <x-text-input id="animal_age_year" class="form-control" type="number"
                                                name="animal_age_year" :value="old('animal_age_year')" autofocus
                                                autocomplete="animal_age_year"
                                                placeholder="How many years? (Pila na ka tuig)" />
                                            <x-input-error :messages="$errors->get('animal_age_year')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label class="text-primary" :value="__('Month/s')" />
                                            <x-input-label for="animal_age_month" :value="__('(Pila na ka bulan o bulan human sa tuig ang binuhi?)')" />
                                            <x-text-input id="animal_age_month" class="form-control" type="number"
                                                name="animal_age_month" :value="old('animal_age_month')" autofocus
                                                autocomplete="animal_age_month"
                                                placeholder="How many months? (Pila na ka bulan?)" />
                                            <x-input-error :messages="$errors->get('animal_age_month')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="animal_color" class="text-primary"
                                                :value="__('Pet Color')" />
                                            <x-input-label for="animal_color" :value="__('(Unsa ang kolor sa binuhi?)')" />
                                            <x-text-input id="animal_color" class="form-control" type="text"
                                                name="animal_color" :value="old('animal_color')" autofocus
                                                autocomplete="animal_color" placeholder="Enter Pet Color" />
                                            <x-input-error :messages="$errors->get('animal_color')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="animal_specie" class="text-primary"
                                                :value="__('Pet Breed')" />
                                            <x-input-label for="animal_specie" :value="__('(Unsa ang breed sa binuhi?)')" />
                                            <x-text-input id="animal_specie" class="form-control" type="text"
                                                name="animal_specie" :value="old('animal_specie')" autofocus
                                                autocomplete="animal_specie" placeholder="Enter Pet Species" />
                                            <x-input-error :messages="$errors->get('animal_specie')" class="mt-2 text-danger" />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center text-center mt-5">
                                        <div class="form-group col-md-6 d-flex flex-column justify-content-center align-items-center"
                                            style="margin: 0 auto;">
                                            <!-- Google reCAPTCHA widget -->
                                            <div class="g-recaptcha"
                                                data-sitekey="{{ config('app.captcha.captcha_site_key') }}"
                                                data-callback="onCaptchaSuccess">
                                            </div>

                                            <!-- Centered text below CAPTCHA -->
                                            <p class="mt-2 mb-0 text-center text-danger" id="paragraph_submit"
                                                style="font-weight: bold">Verify
                                                first before
                                                submitting
                                            </p>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />
                                </div>
                                <!-- Navigation Buttons -->
                                <div class="mt-4">
                                    <button type="button" class="btn btn-secondary" id="prevBtn"
                                        onclick="nextPrev(-1)">Back</button>
                                    <button type="button" class="btn btn-primary" id="nextBtn"
                                        onclick="nextPrev(1)">Next</button>
                                    <button type="submit" class="btn btn-primary d-none" id="submitBtn"
                                        disabled>Submit</button>
                                </div>
                            </form>
                            <script>
                                let currentStep = 0;
                                const steps = document.querySelectorAll('.wizard-step');

                                function showStep(step) {
                                    steps.forEach((s, index) => {
                                        s.classList.toggle('d-none', index !== step);
                                    });

                                    document.getElementById('prevBtn').style.display = step === 0 ? 'none' : 'inline-block';
                                    document.getElementById('nextBtn').classList.toggle('d-none', step === steps.length - 1);
                                    document.getElementById('submitBtn').classList.toggle('d-none', step !== steps.length - 1);
                                }

                                function nextPrev(n) {
                                    if (n === 1 && !validateStep()) return false;
                                    currentStep += n;
                                    showStep(currentStep);
                                }

                                function validateStep() {
                                    const currentFields = steps[currentStep].querySelectorAll('input, select, radio');
                                    let valid = true;

                                    currentFields.forEach(field => {
                                        if (field.hasAttribute('required')) {
                                            let isEmpty = false;

                                            if (field.type === 'checkbox') {
                                                isEmpty = !field.checked;
                                            } else if (field.type === 'radio') {
                                                // Check only the first radio in the group
                                                if (!document.querySelector(`input[name="${field.name}"]:checked`)) {
                                                    // Add 'is-invalid' to all radios in the group
                                                    document.querySelectorAll(`input[name="${field.name}"]`).forEach(radio => {
                                                        $('#serviceModal').modal('show');
                                                    });
                                                    valid = false;
                                                    return;
                                                } else {
                                                    document.querySelectorAll(`input[name="${field.name}"]`).forEach(radio => {
                                                        $('#serviceModal').modal('hide');
                                                    });
                                                    return;
                                                }
                                            } else {
                                                isEmpty = (!field.value || field.value.trim() === "");
                                            }

                                            if (isEmpty) {
                                                field.classList.add('is-invalid');
                                                valid = false;

                                                // Special case for time fields
                                                if (field.id === 'time_from' || field.id === 'time_to') {
                                                    $('#timeModal').modal('show');
                                                }
                                            } else {
                                                field.classList.remove('is-invalid');
                                            }
                                        }
                                    });

                                    // ✅ Agree checkbox validation
                                    const agreeCheckbox = document.getElementById('agree');
                                    if (agreeCheckbox && agreeCheckbox.hasAttribute('required') && !agreeCheckbox.checked) {
                                        showAgreeModal();
                                        valid = false;
                                    }

                                    // ✅ CAPTCHA on last step
                                    if (currentStep === steps.length - 1) {
                                        const captchaResponse = grecaptcha.getResponse();
                                        if (!captchaResponse) {
                                            alert("Please complete the CAPTCHA before submitting.");
                                            valid = false;
                                        }
                                    }

                                    return valid;
                                }

                                function showAgreeModal() {
                                    const modal = document.getElementById('agreeModal');
                                    modal.style.display = 'flex';

                                    const closeBtn = document.getElementById('closeModalBtn');
                                    closeBtn.onclick = () => {
                                        modal.style.display = 'none';
                                    }

                                    // Also close modal if user clicks outside modal content
                                    modal.onclick = (e) => {
                                        if (e.target === modal) {
                                            modal.style.display = 'none';
                                        }
                                    }
                                }

                                function onCaptchaSuccess() {
                                    const submitBtn = document.getElementById('submitBtn');
                                    const paragraphSubmit = document.getElementById('paragraph_submit');

                                    if (submitBtn) {
                                        submitBtn.disabled = false;
                                    }

                                    if (paragraphSubmit) {
                                        paragraphSubmit.style.display = "none";
                                    }
                                }

                                document.addEventListener('DOMContentLoaded', () => {
                                    showStep(currentStep);
                                });
                            </script>

                            @php
                                $disabledAppointmentDates = json_encode($blockAppointmentDates);
                            @endphp

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {

                                    const disabledAppointmentDates = {!! $disabledAppointmentDates !!};
                                    const schedule = @json($groupedSchedule); // from controller grouped by day_name
                                    const bookedSlots = @json($bookedSlots);

                                    flatpickr("#visitation_schedule", {
                                        dateFormat: "Y-m-d",
                                        // minDate: "today",
                                        enable: [
                                            function(date) {
                                                // Enable only Mondays (getDay() === 1)
                                                return date.getDay() === 3;
                                            }
                                        ],

                                        disable: disabledAppointmentDates,
                                        onChange: function(selectedDates, dateStr, instance) {
                                            const timeContainer = document.getElementById('available-times');
                                            timeContainer.innerHTML = '';

                                            if (selectedDates.length === 0) return;

                                            const selectedDate = selectedDates[0];
                                            const dayName = selectedDate.toLocaleDateString('en-US', {
                                                weekday: 'long'
                                            });
                                            const formattedDate = dateStr; // "YYYY-MM-DD"

                                            const daySchedule = schedule[dayName] || [];
                                            const bookedForDate = bookedSlots[formattedDate] || [];

                                            let availableCount = 0; // Track available slots added

                                            if (daySchedule.length > 0) {
                                                daySchedule.forEach(slot => {
                                                    const isBooked = bookedForDate.some(booked =>
                                                        booked.time_from === slot.time_from && booked.time_to ===
                                                        slot.time_to
                                                    );
                                                    if (isBooked) return;

                                                    const btn = document.createElement('button');
                                                    btn.type = 'button';
                                                    btn.classList.add('btn', 'btn-outline-primary', 'm-1', 'btn-sm');
                                                    btn.textContent = formatTime(slot.time_from) + ' - ' + formatTime(
                                                        slot.time_to);

                                                    btn.addEventListener('click', () => {
                                                        document.getElementById('time_from').value = slot
                                                            .time_from;
                                                        document.getElementById('time_to').value = slot.time_to;

                                                        document.querySelectorAll('#available-times button')
                                                            .forEach(b => b.classList.remove('active'));
                                                        btn.classList.add('active');
                                                    });

                                                    timeContainer.appendChild(btn);
                                                    availableCount++; // Increment if slot was added
                                                });
                                            }

                                            if (availableCount === 0) {
                                                timeContainer.innerHTML =
                                                    `<p class="text-danger">No more available timeslot for <strong>this date</strong>.</p>`;
                                            }
                                        }
                                    });

                                    function formatTime(timeStr) {
                                        const time = new Date('1970-01-01T' + timeStr);
                                        return time.toLocaleTimeString([], {
                                            hour: '2-digit',
                                            minute: '2-digit',
                                            hour12: true
                                        });
                                    }

                                    flatpickr("#birthdate", {
                                        dateFormat: "Y-m-d",
                                        maxDate: "today",
                                        disable: [
                                            function(date) {
                                                // Disable all dates before today
                                                return date > new Date().setHours(0, 0, 0, 0);
                                            }
                                        ]
                                    });

                                    const dateInputs = document.querySelectorAll('#visitation_schedule');
                                    dateInputs.forEach(input => {
                                        input.addEventListener('input', function() {
                                            const selectedDate = new Date(this.value);
                                            const day = selectedDate.getUTCDay();
                                            if (day === 0 || day === 1 || day === 2 || day === 4 || day === 5 || day ===
                                                6) {
                                                this.value = '';
                                                $('#weekendModal').modal('show');
                                            }
                                        });
                                    });

                                    flatpickr("#vaccination_date", {
                                        dateFormat: "Y-m-d",
                                        maxDate: "today",
                                        disable: [
                                            function(date) {
                                                const today = new Date();
                                                const sevenDaysAgo = new Date();
                                                sevenDaysAgo.setDate(today.getDate() - 7);

                                                const oneYearAgo = new Date();
                                                oneYearAgo.setFullYear(today.getFullYear() - 1);

                                                // Disable if date is after 7 days ago or before 1 year ago
                                                return date > sevenDaysAgo || date < oneYearAgo;
                                            }
                                        ]
                                    });

                                });
                            </script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const oldRegion = "{{ old('region_id') }}";
                                    const oldProvince = "{{ old('province_id') }}";
                                    const oldMunicipality = "{{ old('municipality_id') }}";
                                    const oldBarangay = "{{ old('barangay_id') }}";

                                    if (oldRegion) {
                                        fetchDropdown(`/get-provinces/${oldRegion}`, 'province_id', 'province_id', 'province_name');
                                        setTimeout(() => {
                                            document.getElementById('region_id').value = oldRegion;
                                        }, 200); // optional

                                        if (oldProvince) {
                                            setTimeout(() => {
                                                fetchDropdown(`/get-municipalities/${oldProvince}`, 'municipality_id',
                                                    'municipality_id', 'municipality_name');
                                                document.getElementById('province_id').value = oldProvince;
                                            }, 300);
                                        }

                                        if (oldMunicipality) {
                                            setTimeout(() => {
                                                fetchDropdown(`/get-barangays/${oldMunicipality}`, 'barangay_id', 'barangay_id',
                                                    'barangay_name');
                                                document.getElementById('municipality_id').value = oldMunicipality;
                                            }, 400);
                                        }

                                        if (oldBarangay) {
                                            setTimeout(() => {
                                                document.getElementById('barangay_id').value = oldBarangay;
                                            }, 500);
                                        }
                                    }
                                });
                            </script>

                        </div>
                    </div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </section>
</x-guestlayout.layout>
