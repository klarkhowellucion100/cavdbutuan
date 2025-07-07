<x-guestlayout.layout>
    <!-- Session Status -->
    <!-- Modal for Weekend Warning -->
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
                    Weekends (Saturday and Sunday) are not allowed. Please select a weekday.
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
                            <span class="h4">Farm Mechanization</span>
                        </div>
                        <!-- Modal -->

                        <div class="card-body">
                            <form method="POST" action="{{ route('farmmechanization.store') }}">
                                @csrf
                                <div class="wizard-step" id="step-1">
                                    <h4 class="text-primary" style="font-weight:bold">
                                        Welcome to the City Agriculture and Veterinary Department (CAVD) Service
                                        Appointment System for Farm Mechanization Services
                                    </h4>
                                    <h5>
                                        Below are the steps in setting a schedule for Farm Mechanization Service:
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
                                            style="font-weight: bold;">Instructions:</span> <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                            We will process
                                            your request and validate the
                                            area
                                            within 2-3
                                            working days after receiving it. Thank you for your patience.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Among iproseso
                                                ang imong request ug susihon ang lugar sulod sa 2-3 ka adlaw
                                                human
                                                kini madawat. Salamat sa imong pagpaabot
                                            </span>
                                        </span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                            The requestor will
                                            cover the fuel costs for transporting
                                            the machinery from the office to the designated area. Additionally, the
                                            requestor is
                                            responsible for providing the required 35 liters of fuel per hectare at the
                                            start of the
                                            service.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Ang naghangyo (requestor) mao ang mogasto sa gasolina alang sa pagdala
                                                sa
                                                makina gikan sa opisina paingon sa gitudlong lugar. Dugang pa, ang
                                                naghangyo
                                                (requestor) responsibilidad nga maghatag sa gikinahanglan nga 35 litro
                                                nga
                                                gasolina matag ektarya sa pagsugod sa serbisyo
                                            </span></span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                            In the event that the machinery is under repair, encounters issues, or
                                            becomes
                                            damaged,
                                            we will promptly contact you to discuss potential rescheduling of the
                                            request.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Kung ang makina nag-under repair, naay mga problema, o naguba, among
                                                dayon
                                                kang kontakon aron hisgutan ang posibleng pag-reschedule sa maong
                                                serbisyo
                                            </span></span>
                                        <br>
                                        <span
                                            style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                            If fortuitous events occur, we will promptly contact you to discuss the
                                            possibility of
                                            rescheduling the service.
                                            <br>
                                            <span class="text-primary fw-bold" style="font-weight:bold;">
                                                - Sa dihang adunay mga dili kalikayan nga panghitabo, kami dayon
                                                mopahibalo
                                                kanimo aron hisgutan ang posibilidad sa pag-re-schedule sa serbisyo.
                                            </span></span>
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
                                    <h5 class="mt-3">Step 2: Schedule</h5>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <x-input-label for="proposed_schedule" class="text-primary"
                                                :value="__('Proposed Land Preparation Schedule')" />
                                            <x-input-label for="proposed_schedule" :value="__('(Kanus-a ang plano sa pagpa-parmol)')" />
                                            <x-text-input id="proposed_schedule" class="form-control" type="text"
                                                style="background-color: white;" name="proposed_schedule"
                                                :value="old('proposed_schedule')" required autofocus autocomplete="proposed_schedule"
                                                placeholder="Enter Date" id="proposed_schedule" />
                                            <x-input-error :messages="$errors->get('proposed_schedule')" class="mt-2 text-danger" />
                                        </div>

                                        <div class="form-group col-md-6">
                                            <x-input-label for="visitation_schedule" class="text-primary"
                                                :value="__('Schedule of Visit to Office')" />
                                            <x-input-label for="visitation_schedule" :value="__('(Petsa sa pagbisita sa opisina)')" />
                                            <x-text-input class="form-control" type="text"
                                                name="visitation_schedule" :value="old('visitation_schedule')" required autofocus
                                                autocomplete="visitation_schedule" placeholder="Enter Date"
                                                style="background-color: white" id="visitation_schedule" />
                                            <x-input-error :messages="$errors->get('visitation_schedule')" class="mt-2 text-danger" />
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
                                <div class="wizard-step d-none" id="step-3">
                                    <h5>Step 3: Details of Availment</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="machinery" class="text-primary" :value="__('Type of Machinery')" />
                                            <x-input-label for="machinery" :value="__('(Klase sa makinarya)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="machinery" required>
                                                    <option value="Farmall"
                                                        {{ old('machinery') === 'Farmall' ? 'selected' : '' }}>Farmall
                                                    </option>
                                                </select>

                                            </div>
                                            <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="area_size" class="text-primary" :value="__('Area Size')" />
                                            <x-input-label for="area_size" :value="__('(Kadak-on sa luna)')" />
                                            <x-text-input id="area_size" class="form-control" type="text"
                                                name="area_size" :value="old('area_size')" required autofocus
                                                autocomplete="area_size" placeholder="Enter Area Size (Hectare)" />
                                            <x-input-error :messages="$errors->get('area_size')" class="mt-2 text-danger" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="category" class="text-primary" :value="__('Category of Requestor')" />
                                            <x-input-label for="category" :value="__('(Kategorya sa naghimo sa hangyo)')" />
                                            <div class="input-group">
                                                <select class="form-control" style="color:grey; font-size: 12px;"
                                                    name="category" required>
                                                    <option value="Individual"
                                                        {{ old('category') === 'Individual' ? 'selected' : '' }}>
                                                        Individual</option>
                                                    <option value="Group"
                                                        {{ old('category') === 'Group' ? 'selected' : '' }}>Group
                                                    </option>
                                                </select>
                                            </div>
                                            <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="details" class="text-primary" :value="__('Details of Request')" />
                                            <x-input-label for="details" :value="__('(Detalye sa hangyo)')" />
                                            <x-text-input id="details" class="form-control" type="text"
                                                name="details" :value="old('details')" autofocus autocomplete="details"
                                                placeholder="Enter Details" />
                                            <x-input-error :messages="$errors->get('details')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step d-none" id="step-4">
                                    <h5>Step 4: Personal Information</h5>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="full_name" class="text-primary" :value="__('Full Name')" />
                                            <x-input-label for="full_name" :value="__('(Tibuok ngalan)')" />
                                            <x-text-input id="full_name" class="form-control" type="text"
                                                name="full_name" :value="old('full_name')" required autofocus
                                                autocomplete="full_name" placeholder="Enter Full Name" />
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                        </div>
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
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <x-input-label for="birthdate" class="text-primary" :value="__('Birthdate')" />
                                            <x-input-label for="birthdate" :value="__('(Petsa sa pagkatawo)')" />
                                            <x-text-input id="birthdate" class="form-control" type="text"
                                                name="birthdate" :value="old('birthdate')" autofocus autocomplete="birthdate"
                                                style="background-color: white" placeholder="Enter Birthdate" />
                                            <x-input-error :messages="$errors->get('birthdate')" class="mt-2 text-danger" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <x-input-label for="contact_number" class="text-primary"
                                                :value="__('Contact Number')" />
                                            <x-input-label for="contact_number" :value="__('(Numero sa kontak)')" />
                                            <x-text-input id="contact_number" class="form-control" type="text"
                                                name="contact_number" :value="old('contact_number')" autofocus
                                                autocomplete="contact_number" placeholder="Enter Contact No." />
                                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2 text-danger" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
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

                                </div>
                                <x-input-error :messages="$errors->get('g-recaptcha-response')" class="mt-2" />

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
                                    const currentFields = steps[currentStep].querySelectorAll('input, select');
                                    let valid = true;

                                    currentFields.forEach(field => {
                                        if (field.hasAttribute('required')) {
                                            const isEmpty = (
                                                (field.type === 'checkbox' && !field.checked) ||
                                                (!field.checked && field.type !== 'checkbox' && (!field.value || field.value.trim() ===
                                                    ""))
                                            );

                                            if (isEmpty) {
                                                field.classList.add('is-invalid');
                                                valid = false;

                                                // 🔔 Check if the field is time_from or time_to and trigger timeModal
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
                                $disabledDates = json_encode($blockDates);
                            @endphp

                            @php
                                $disabledAppointmentDates = json_encode($blockAppointmentDates);
                            @endphp

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    flatpickr("#proposed_schedule", {
                                        dateFormat: "Y-m-d",
                                        minDate: "today",
                                        disable: {!! $disabledDates !!}
                                    });

                                    const disabledAppointmentDates = {!! $disabledAppointmentDates !!};
                                    const schedule = @json($groupedSchedule); // from controller grouped by day_name
                                    const bookedSlots = @json($bookedSlots);

                                    flatpickr("#visitation_schedule", {
                                        dateFormat: "Y-m-d",
                                        minDate: "today",
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

                                            // Available slots for this day name
                                            const daySchedule = schedule[dayName] || [];
                                            // Booked slots for this exact date
                                            const bookedForDate = bookedSlots[formattedDate] || [];

                                            if (daySchedule.length > 0) {
                                                daySchedule.forEach(slot => {
                                                    // Skip if slot is booked for this date
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
                                                });
                                            } else {
                                                timeContainer.innerHTML =
                                                    `<p class="text-danger">No available times for <strong>${dayName}</strong>.</p>`;
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

                                    const dateInputs = document.querySelectorAll('#proposed_schedule, #visitation_schedule');
                                    dateInputs.forEach(input => {
                                        input.addEventListener('input', function() {
                                            const selectedDate = new Date(this.value);
                                            const day = selectedDate.getUTCDay();
                                            if (day === 0 || day === 6) {
                                                this.value = '';
                                                $('#weekendModal').modal('show');
                                            }
                                        });
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
