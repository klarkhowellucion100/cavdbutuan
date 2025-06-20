<x-guestlayout.layout>
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                    <div class="p-3">
                        <a class="btn btn-primary" href="{{ route('farmmechanization.track') }}">Back</a>
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
                                <span class="h4">Farm Mechanization Service Request
                                    Slip</span>
                            </div>

                            <div class="col-md-12 mb-3">
                                @if ($trackData->uploaded_file)
                                    <span class="text-success" style="font-weight:bold">PAID</span>
                                @else
                                    <form method="POST" action="{{ route('farmmechanization.trackresultupload') }}"
                                        enctype="multipart/form-data",>
                                        @method('POST')
                                        @csrf
                                        <input type="hidden" name="farm_mechanization_id" value="{{ $trackData->id }}">
                                        <input type="hidden" name="transaction_number"
                                            value="{{ $trackData->transaction_number }}">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <x-input-label for="or_number" class="text-primary" :value="__('Or Number')" />
                                                <x-text-input id="or_number" class="form-control" type="text"
                                                    name="or_number" :value="old('or_number')" autofocus required
                                                    autocomplete="or_number" placeholder="Enter Or Number" />
                                                <x-input-error :messages="$errors->get('or_number')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <x-input-label for="or_date" class="text-primary" :value="__('OR Date')" />
                                                <x-text-input id="or_date" class="form-control" type="date"
                                                    name="or_date" :value="old('or_date')" autofocus autocomplete="or_date"
                                                    placeholder="Enter Details" required />
                                                <x-input-error :messages="$errors->get('or_date')" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="uploaded_file"
                                                        name="uploaded_file">
                                                    <label class="custom-file-label" for="uploaded_file">Choose
                                                        file</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('uploaded_file')" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Upload OR
                                        </button>
                                    </form>
                            </div>
                            @endif
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
                                                        Visitation Schedule:
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
                                                                <span class="text-danger"
                                                                    style="font-weight:bold">Pending
                                                                </span>
                                                            @elseif ($trackData->request_status === 1)
                                                                <span class="text-warning"
                                                                    style="font-weight:bold">Approved
                                                                </span>
                                                            @elseif ($trackData->request_status === 2)
                                                                <span class="text-success"
                                                                    style="font-weight:bold">Scheduled
                                                                </span>
                                                            @elseif ($trackData->request_status === 3)
                                                                <span class="text-success"
                                                                    style="font-weight:bold">Served
                                                                </span>
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div style="font-weight:bold;">Schedule of Service:
                                                        <span class="text-primary">
                                                            @if ($trackData->final_schedule)
                                                                <span class="text-success" style="font-weight:bold">
                                                                    {{ \Carbon\Carbon::parse($trackData->final_schedule)->setTimezone('Asia/Manila')->format('l, F j, Y') }}
                                                                </span>
                                                            @else
                                                                <span class="text-danger" style="font-weight:bold">Not
                                                                    yet
                                                                    scheduled</span>
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
                                                                style="font-weight:bold;">Service
                                                            </td>
                                                            <td class="align-middle">Farm Mechanization
                                                                ({{ $trackData->machinery }})
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Category
                                                            </td>
                                                            <td class="align-middle">{{ $trackData->category }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle table-active text-primary"
                                                                style="font-weight:bold;">Proposed Land Preparation
                                                                Date
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ \Carbon\Carbon::parse($trackData->proposed_schedule)->setTimezone('Asia/Manila')->format('l, F j, Y') }}
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
                                                                style="font-weight:bold;">Area Size
                                                            </td>
                                                            <td class="align-middle">
                                                                {{ number_format($trackData->area_size, 2) }} ha
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-large pt-3" style="font-style: italic;"><span
                                                    style="font-weight: bold;">Instructions:</span> <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">1.
                                                    Securing the booking is FREE OF CHARGE, and Farm Mechanization
                                                    Service
                                                    Request
                                                    Slip in
                                                    NON-TRANSFERABLE.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Libre ang pagpa-book, ug ang Farm Mechanization Service
                                                        Request
                                                        Slip dili
                                                        puwede
                                                        ipasa o ipatransfer sa lain.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    A fee will be charged for the requested service which will be issued
                                                    by
                                                    the City
                                                    Agriculture and Veterinary Department and must be paid at the City
                                                    Treasury Department.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Adunay bayad ang pag-request sa maong serbisyo nga i andam sa
                                                        City
                                                        Agriculture and Veterinary Department ug kini bayaran sa City
                                                        Treasury
                                                        Department.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    The requestor will
                                                    cover the fuel costs for transporting
                                                    the machinery from the office to the designated area. Additionally,
                                                    the
                                                    requestor is
                                                    responsible for providing the required 35 liters of fuel per hectare
                                                    at
                                                    the
                                                    start of the
                                                    service.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Ang naghangyo (requestor) mao ang mogasto sa gasolina alang sa
                                                        pagdala
                                                        sa
                                                        makina gikan sa opisina paingon sa gitudlong lugar. Dugang pa,
                                                        ang
                                                        naghangyo
                                                        (requestor) responsibilidad nga maghatag sa gikinahanglan nga 35
                                                        litro
                                                        nga
                                                        gasolina matag ektarya sa pagsugod sa serbisyo
                                                    </span></span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                                    The document owner, who is also the requestor, must present a copy
                                                    of
                                                    their
                                                    valid ID.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Ang tag-iya sa dokumento, nga mao usab ang nag-request,
                                                        kinahanglan
                                                        mopakita og kopya sa iyang valid nga ID.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">5.
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
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">6.
                                                    In the event that the machinery is under repair, encounters issues,
                                                    or
                                                    becomes
                                                    damaged,
                                                    we will promptly contact you to discuss potential rescheduling of
                                                    the
                                                    request.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Kung ang makina nag-under repair, naay mga problema, o naguba,
                                                        among
                                                        dayon
                                                        kang kontakon aron hisgutan ang posibleng pag-reschedule sa
                                                        maong
                                                        serbisyo
                                                    </span></span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">7.
                                                    If fortuitous events occur, we will promptly contact you to discuss
                                                    the
                                                    possibility of
                                                    rescheduling the service.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Sa dihang adunay mga dili kalikayan nga panghitabo, kami dayon
                                                        mopahibalo
                                                        kanimo aron hisgutan ang posibilidad sa pag-re-schedule sa
                                                        serbisyo.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">8.
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
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">9.
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
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">10.
                                                    The CAVD supports the <span class="text-primary"
                                                        style="font-weight: bold;">"ANTI-FIXER CAMPAIGN"</span>. Report
                                                    the
                                                    name of
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
                                                        klase
                                                        sa
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
                                                    Present the Farm Mechanization Service Request Slip with your valid
                                                    ID
                                                    to the
                                                    Information Desk for
                                                    validation
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Ipakita ang Farm Mechanization Service Request Slip kauban sa
                                                        imohang
                                                        valid ID sa Information Desk
                                                        aron ma-validate
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">2.
                                                    Once validated, proceed to the Administrative Support Unit to claim
                                                    the
                                                    printed
                                                    Request Form and sign it. Afterwards, secure the Cash Collection
                                                    Slip
                                                    for
                                                    payment.
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Kung ma-validate na, palihug adto sa Administrative Support
                                                        Unit
                                                        aron
                                                        kuhaon ug pirmahan ang gi-print nga Request Form. Human niini,
                                                        kuhaa
                                                        ang
                                                        Cash Collection Slip para sa bayad.
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">3.
                                                    Proceed to the City Treasury Department to settle the fees indicated
                                                    in
                                                    the Cash
                                                    Collection Slip
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Palihug adto sa City Treasury Department aron bayran ang mga
                                                        bayrunon nga
                                                        nakasulat sa Cash Collection Slip
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">4.
                                                    Check the Official Receipt (OR), and count the change, if any
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        - Susiha ang Official Receipt (OR), ug ihap ang sinsilyo kung
                                                        adunay
                                                        sukli
                                                    </span>
                                                </span>
                                                <br>
                                                <span
                                                    style="display: block; padding-left: 20px; text-indent: -20px; margin-left: 20px;">5.
                                                    Search your transaction through this link
                                                    {{ config('app.url') }}/farmmechanization/track and upload the OR
                                                    for
                                                    proof
                                                    of payment
                                                    <br>
                                                    <span class="text-primary fw-bold" style="font-weight:bold;">
                                                        I-search ang imong transaksyon pinaagi niini nga link:
                                                        {{ config('app.url') }}/farmmechanization/track
                                                        ug i-upload ang OR isip ebidensya sa bayad.
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
