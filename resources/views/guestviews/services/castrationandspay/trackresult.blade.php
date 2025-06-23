<x-guestlayout.layout>
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                    <div class="p-3">
                        <a class="btn btn-primary" href="{{ route('castrationandspay.track') }}">Back</a>
                        <button class="btn btn-primary" onclick="downloadDivAsJPG('content')">Download</button>
                        <button class="btn btn-primary" onclick="printDiv('content')">Print</button>
                    </div>
                    <script type="text/javascript">
                        function downloadDivAsJPG(divId) {
                            const divElement = document.getElementById(divId);

                            // Temporarily set the width to a fixed desktop size
                            divElement.style.width = "1024px"; // or another suitable width for desktop view
                            divElement.style.maxWidth = "none"; // ensure no max-width constraint

                            // Use html2canvas to take a screenshot of the div
                            html2canvas(divElement).then((canvas) => {
                                // Convert canvas to data URL (base64)
                                const imgData = canvas.toDataURL('image/jpeg', 1.0); // 1.0 for maximum quality

                                // Create a link element
                                const link = document.createElement('a');
                                link.href = imgData;
                                link.download = 'div-content.jpg'; // Name of the downloaded file

                                // Append to the body and trigger click
                                document.body.appendChild(link);
                                link.click();
                                // Remove the link after triggering download
                                document.body.removeChild(link);

                                // Restore the original width of the div
                                divElement.style.width = "";
                                divElement.style.maxWidth = "";
                            }).catch((error) => {
                                console.error('Error capturing div:', error);
                            });
                        }

                        function printDiv(divId) {
                            // Get the HTML of the div
                            var divContents = document.getElementById(divId).innerHTML;
                            // Create a new window for printing
                            var printWindow = window.open('', '', 'height=600,width=800');
                            // Write the content to the new window
                            printWindow.document.write('<html><head><title>Print DIV Content</title></head><body>');
                            printWindow.document.write(divContents);
                            printWindow.document.write('</body></html>');
                            printWindow.document.close(); // Close the document for writing
                            printWindow.print(); // Trigger the print dialog
                        }
                    </script>
                    {{-- <div id="content">

                    </div> --}}
                    <div class="card">
                        <div id="content">
                            <div class="card-header">
                                <span class="h4">Castration and Spay Service Request
                                    Slip</span>
                            </div>

                            <div class="card-body">
                                @if ($trackData)
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center align-middle">
                                                <div class="d-flex justify-content-center my-3">
                                                    <div class="p-2 border rounded">
                                                        <img src="{{ $qrBase64 }}" alt="QR Code"
                                                            style="max-width: 200px; height: auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="text-center align-middle">
                                                <div class="my-3">
                                                    <h4 class="text-primary" style="font-weight:bold;">BOOKED</h4>
                                                    <div style="font-weight:bold;">
                                                        Submitted on
                                                        {{ \Carbon\Carbon::parse($trackData->created_at)->setTimezone('Asia/Manila')->format('l, F j, Y g:i A') }}
                                                    </div>
                                                    <div style="font-weight:bold;">
                                                        Operation Schedule:
                                                        <span
                                                            class="text-primary">{{ \Carbon\Carbon::parse($trackData->visitation_schedule)->setTimezone('Asia/Manila')->format('l, F j, Y g:i A') }}</span>
                                                    </div>
                                                    <div style="font-weight:bold;">
                                                        Time:
                                                        <span class="text-primary">
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $trackData->time_from)->format('h:i A') }}
                                                            to
                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $trackData->time_to)->format('h:i A') }}
                                                        </span>
                                                    </div>
                                                    <div style="font-weight:bold;">Transaction No.:
                                                        <span class="text-primary">
                                                            {{ $trackData->transaction_number }}</span>
                                                    </div>
                                                    <div style="font-weight:bold;">Service Status:
                                                        <span class="text-primary">
                                                            @if ($trackData->request_status === 0)
                                                                <span class="text-warning"
                                                                    style="font-weight:bold">Scheduled
                                                                </span>
                                                            @elseif ($trackData->request_status === 1)
                                                                <span class="text-success"
                                                                    style="font-weight:bold">Served
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-3">
                                            <h4 class="text-primary">Appointment Details</h4>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">
                                                                Full Name</td>
                                                            <td class="align-middle">{{ $trackData->full_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Address
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ $trackData->specific_loc ?? 'N/A' }},
                                                                {{ $trackData->barangay }},
                                                                {{ $trackData->municipality }},
                                                                {{ $trackData->province }},
                                                                {{ $trackData->region }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Availed Service
                                                            </td>
                                                            <td class="align-middle">{{ $trackData->service_type }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Pet Type
                                                            </td>
                                                            <td class="align-middle">{{ $trackData->animal_type }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Pet Age:
                                                            </td>
                                                            <td class="align-middle">
                                                                Year: {{ $trackData->animal_age_year }}
                                                                <br>
                                                                Month: {{ $trackData->animal_age_month }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Pet Breed
                                                            </td>
                                                            <td class="align-middle">{{ $trackData->animal_specie }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Pet Sex
                                                            </td>
                                                            <td class="align-middle">{{ $trackData->animal_sex }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Appointment Date
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ \Carbon\Carbon::parse($trackData->visitation_schedule)->setTimezone('Asia/Manila')->format('l, F j, Y') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Time:
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $trackData->time_from)->format('h:i A') }}
                                                                to
                                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $trackData->time_to)->format('h:i A') }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-large pt-3" style="font-style: italic;"><span
                                                    style="font-weight: bold;">Pre-Operative Instructions
                                                    <br> <span class="text-primary">(Mga Panudlo sa Wala
                                                        pa ang Operasyon):</span> <br>
                                                    <span
                                                        style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                        Securing the booking is FREE OF CHARGE, and Castration and Spay
                                                        Service
                                                        Request
                                                        Slip in
                                                        NON-TRANSFERABLE.
                                                        <br>
                                                        <span class="text-primary fw-bold" style="font-weight:bold;">
                                                            - Libre ang pagpa-book, ug ang Castration and Spay Service
                                                            Request Slip
                                                            dili
                                                            puwede
                                                            ipasa o ipatransfer sa lain.
                                                        </span>
                                                    </span>
                                                    <br>
                                                    <span
                                                        style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                        Do not Feed your pet 12-18 hours prior to surgery, provide only
                                                        clean
                                                        drinking water.
                                                        <br>
                                                        <span class="text-primary fw-bold" style="font-weight:bold;">
                                                            - Ayaw pakaona ang imong hayop 12-18 ka oras sa wala pa ang
                                                            operasyon,
                                                            peron pwede lang paimnon og limpyo nga tubig.
                                                        </span>
                                                    </span>
                                                    <br>
                                                    <span
                                                        style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                        Ensure that your pet is secured with a leash and/or a cage
                                                        before
                                                        transporting to the surgical area/office.
                                                        <br>
                                                        <span class="text-primary fw-bold" style="font-weight:bold;">
                                                            - Siguraduhon nga ang imong hayop nakaseguro gamit ang tali
                                                            ug/o
                                                            hawla
                                                            sa wala pa ang pagdala niini sa lugar/opisina sa operasyon.
                                                        </span></span>
                                                    <br>
                                                    <span
                                                        style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                                        Bring used towels or old newspapers to be used as bedding for
                                                        the animal
                                                        after the surgery.
                                                        <br>
                                                        <span class="text-primary fw-bold" style="font-weight:bold;">
                                                            - Magdala og gigamit nga tuwalya o daan nga diyaryo nga
                                                            gamiton nga
                                                            higdaanan sa hayop human sa operasyon.
                                                        </span>
                                                    </span>
                                                    <br>
                                                    <span
                                                        style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">5.
                                                        Your pet must be vaccinated against Rabies at least 7 days prior
                                                        to surgery
                                                        (provide the vaccination card/certificate).
                                                        <br>
                                                        <span class="text-primary fw-bold" style="font-weight:bold;">
                                                            - Ang imong hayop kinahanglan nga nabakunahan batok sa
                                                            Rabies labing
                                                            menos
                                                            7 ka adlaw sa wala pa ang operasyon (ihatag ang vaccination
                                                            card/certificate).
                                                        </span>
                                                    </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-large pt-3" style="font-style: italic;"><span
                                                    style="font-weight: bold;">Needed materials per animal <span
                                                        class="text-danger" style="font-weight: normal"> (Must be
                                                        <span style="font-weight: bold">provided by the owner</span>
                                                        prior or
                                                        during the surgery) </span>
                                                    <br> <span class="text-primary">Mga kinahanglanon nga materyales
                                                        kada
                                                        hayop <span class="text-danger" style="font-weight: normal">
                                                            (Kinahanglan nga
                                                            <span style="font-weight: bold">paliton o ihatag sa
                                                                tag-iya</span>
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
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-large pt-3" style="font-style: italic;"><span
                                                    style="font-weight: bold;">Post-Operative Care
                                                    <br> <span class="text-primary">(Pag-atiman pagkahuman sa
                                                        operasyon:):</span></span> <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                    Do not feed the animal for 6 to 8 hours after the surgery. After
                                                    that,
                                                    provide soft food diet for the animal
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Ayaw pakaona ang hayop sulod sa 6 hangtod 8 ka oras pagkahuman
                                                        sa
                                                        operasyon. Human niini, hatagi og hapsay o humok nga pagkaon ang
                                                        hayop.
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
                                                        - Pugngi ang hayop pinaagi sa kulungan o pagtali gamit ang
                                                        leash.
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
                                                        - Ayaw paligoi ang hayop sulod sa 14 ka adlaw human sa
                                                        operasyon.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">6.
                                                    Cleanse the area around the wound with betadine(iodine) and clean
                                                    gauze or
                                                    cotton
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Limpyohi ang palibot sa samad gamit ang Betadine (iodine) ug
                                                        limpyo
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
                                                        - Kung ang samad padayon nga nagdugo o naguba, palihug kontaka
                                                        dayon ang
                                                        lokal nga beterinaryo.
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-large pt-3" style="font-style: italic;"><span
                                                    style="font-weight: bold;">Other Instructions
                                                    <br> <span class="text-primary">(Ubang mga
                                                        instruksyon):</span></span> <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                    For concerns and inquiries, transact with authorized CAVD personnel
                                                    only.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Alang sa mga pangutana ug kabalaka, palihug transact lamang sa
                                                        awtorisadong personnel sa CAVD.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    The CAVD strictly implements the <span class="text-primary"
                                                        style="font-weight: bold;">"NO GIFT POLICY"</span> pursuant to
                                                    Republic Act
                                                    No. 6713, Republic Act No. 3019, and CSC Resolution No. 2100020
                                                    (2021)
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Ang CAVD hugot nga nagpatuman sa <span class="text-primary"
                                                            style="font-weight: bold;">"NO GIFT POLICY"</span>
                                                        subay sa Republic Act No. 6713, Republic Act No. 3019, ug CSC
                                                        Resolution No.
                                                        2100020 (2021).
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    The CAVD supports the <span class="text-primary"
                                                        style="font-weight: bold;">"ANTI-FIXER CAMPAIGN"</span>. Report
                                                    the name of
                                                    the fixer, name and location of government office, date and type of
                                                    transaction
                                                    to any of the following contact numbers:
                                                    <br>
                                                    <span class="text-primary">
                                                        - Gisuportahan sa CAVD ang <span
                                                            style="font-weight: bold;">"ANTI-FIXER
                                                            CAMPAIGN"</span>. Ireport ang
                                                        ngalan
                                                        sa fixer, ngalan ug lokasyon sa buhatan sa gobyerno, petsa ug
                                                        klase sa
                                                        transaksiyon sa bisan asa sa mosunod nga mga numero sa kontak:
                                                    </span>
                                                    <br>
                                                    <h5 style="margin-top:10px; margin-left: 30px; font-weight: bold;">
                                                        ANTI RED TAPE AUTHORITY (ARTA)
                                                    </h5>
                                                    <ul style="margin-left: 30px;">
                                                        <li class="pl-3">Website: arta.gov.ph</li>
                                                        <li class="pl-3">Email: complaints@arta.gov.ph</li>
                                                        <li class="pl-3">Call: 1-ARTA (12782)</li>
                                                        <li class="pl-3">8246-7940</li>
                                                        <li class="pl-3">Text: 0928-6904080</li>
                                                        <li class="pl-3">0969-2577242</li>
                                                    </ul>
                                                    <h5 style="margin-left: 30px; font-weight: bold;">
                                                        CONTACT CENTER NG BAYAN (CCB)
                                                    </h5>
                                                    <ul style="margin-left: 30px;">
                                                        <li class="pl-3">Website: contactcenterngbayan.gov.ph</li>
                                                        <li class="pl-3">Email: email@contactcenterngbayan.gov.ph
                                                        </li>
                                                        <li class="pl-3">Text:0908-8816565</li>
                                                    </ul>
                                                    <h5 style="margin-left: 30px; font-weight: bold;">
                                                        OFFICE OF THE OMBUDSMAN
                                                    </h5>
                                                    <ul style="margin-left: 30px;">
                                                        <li class="pl-3">Website: ombudsman.gov.ph</li>
                                                        <li class="pl-3">Email: pab@ombudsman.gov.ph</li>
                                                        <li class="pl-3">Call: 8926-2662</li>
                                                        <li class="pl-3">5317-8300</li>
                                                        <li class="pl-3">Text: 0926-6994703</li>
                                                    </ul>
                                                    <h5 style="margin-left: 30px; font-weight: bold;">
                                                        PRESIDENTIAL ACTION CENTER (PACe)
                                                    </h5>
                                                    <ul style="margin-left: 30px;">
                                                        <li class="pl-3">Email: pace@op.gov.ph</li>
                                                    </ul>
                                                    <h5 style="margin-left: 30px; font-weight: bold;">
                                                        8888 CITIZENS' COMPLAINT CENTER
                                                    </h5>
                                                    <ul style="margin-left: 30px;">
                                                        <li class="pl-3">Call/Text: 8888</li>
                                                    </ul>
                                                    <br>
                                                </span>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="text-large" style="font-style: italic; margin-top: -40px;">
                                                <span style="font-weight: bold;">Procedure:</span> <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                    Please ensure that the Pre-Operative Instructions were executed and
                                                    all
                                                    materials required from the owner are brought before the
                                                    operation can commence.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Palihug siguroa nga ang tanang naka indikar sa Pre-Operative
                                                        Instructions
                                                        natuman
                                                        og tanang materyales nga gikinahanglan gikan sa
                                                        tag-iya nadala na sa dili pa magsugod ang operasyon.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    Proceed to the City Agriculture and Veterinary Department (CAVD) and
                                                    present the
                                                    Castration and Spay Service Request Slip with your valid ID to the
                                                    Information Desk for
                                                    validation
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Adto sa City Agriculture and Veterinary Department (CAVD) ug
                                                        ipakita ang
                                                        Castration ug Spay Service Request Slip uban sa imong valid ID
                                                        sa
                                                        Information Desk para sa beripikasyon
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    After your documents have been validated, proceed to the Plant and
                                                    Animal Health
                                                    Unit for the procedure.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Human ma-validate ang imong mga dokumento, pwede na dayun ta
                                                        mupadayon sa
                                                        Plant and Animal
                                                        Health Unit alang sa maong proseso.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    After the operation, please take note of the veterinarian's advice
                                                    and carefully
                                                    follow the post-operative instructions provided in this document.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Human sa operasyon, palihug timan-i ang tambag sa beterinaryo
                                                        ug sundon
                                                        pag-ayo ang mga giya sa post-operatibo nga nakabutang sa niini
                                                        nga
                                                        dokumento.
                                                    </span>
                                                </span>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </section>

</x-guestlayout.layout>
