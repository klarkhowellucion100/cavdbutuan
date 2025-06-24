<x-userlayout.layout>

    @if ($formData)
        <script type="text/javascript">
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
        {{--
    Save this file for other usage. printing and downloading
    <script type="text/javascript">
        function downloadDivContent(divId) {
            // Get the content of the div
            var content = document.getElementById(divId).innerHTML;
            // Create a Blob from the content
            var blob = new Blob([content], {
                type: 'text/html'
            });
            // Create a link element
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = 'div-content.html'; // Name of the downloaded file
            // Append to the body and trigger click
            document.body.appendChild(link);
            link.click();
            // Remove the link after triggering download
            document.body.removeChild(link);
        }
    </script>

    <div id="printableArea" style="border: 1px solid black; padding: 10px;">
        <h1>This is the content to print</h1>
        <p>Only this content will be printed when you click the button.</p>
    </div>

    <button onclick="printDiv('printableArea')">Print This Div</button>

    <button onclick="downloadDivContent('printableArea')">Download Div Content</button> --}}
        <div style="text-align:left">
            <a href="{{ route('castrationandspay.user.served.index') }}"
                class="btn btn-primary waves-effect waves-light w-md">Back</a>
        </div>
        <div class="row">
            <div class="col-xl-12 col-sm-6 mt-3">
                <div class="card">
                    <div class="card-body">


                        <section class="big-section">
                            <div class="container">
                                <div class="row justify-content-center">

                                </div>
                                <div class="row justify-content-center">
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
                                    </script>
                                    <div class="p-3">
                                        <button class="btn btn-primary"
                                            onclick="downloadDivAsJPG('content')">Download</button>
                                        <button class="btn btn-primary" onclick="printDiv('content')">Print</button>
                                    </div>
                                    <div id="content" style="border: 1px solid #357ae8; padding: 10px; width: 100%;">
                                        @if ($formData)
                                            <div>
                                                <img src="{{ url('frontend/guestlayout/images/letterhead.png') }}"
                                                    style="width: 100%;" alt="">
                                            </div>
                                            <div class="pt-5">
                                                <table
                                                    style="width:100%; black; border-collapse: collapse; color:black;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align:center;" colspan="10">
                                                                <p
                                                                    style="font-size: 30px; font-weight:bold; color: black">
                                                                    CASTRATION AND
                                                                    SPAY <br>
                                                                    PRE AND POST OPERATIVE INSTRUCTIONS
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td style="width:10%"></td>
                                                            <td style="text-align: left; font-weight:bold;">
                                                                Scheduled Date
                                                                and Time of
                                                                Operation:</td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                {{ date('d M Y', strtotime($formData->visitation_schedule)) ?? 'N/A' }};
                                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $formData->time_from)->format('h:i A') }}
                                                                to
                                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $formData->time_to)->format('h:i A') }}
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td style="width:10%"></td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td></td>
                                                            <td style="text-align: left; font-weight:bold;">Name of
                                                                Owner:
                                                            </td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                {{ $formData->full_name ?? 'N/A' }}</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td></td>
                                                            <td style="text-align: left; font-weight:bold;">Species:
                                                            </td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                {{ $formData->animal_specie ?? 'N/A' }}</td>
                                                            <td style="text-align: left; font-weight:bold;">No. of Pets:
                                                            </td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                1</td>

                                                            <td style="text-align: left; font-weight:bold;">Sex:
                                                            </td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                {{ $formData->animal_sex ?? 'N/A' }}</td>
                                                            <td style="text-align: left; font-weight:bold;">Age:
                                                            </td>
                                                            <td
                                                                style="text-align: left; border-bottom: solid 1px black;">
                                                                Y:{{ $formData->animal_age_year ?? '0' }}; M:
                                                                {{ $formData->animal_age_month ?? '0' }}</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td colspan="10"
                                                                style="text-align: left; text-decoration: underline; font-weight:bold; padding-top: 10px;">
                                                                <em style="margin-left:40px;">Pre-Operative
                                                                    Instructions</em>
                                                            </td>

                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td style="width:10%"></td>
                                                            <td colspan="8">
                                                                <ul>
                                                                    <li>Do not Feed your pet 12-18 hours prior to
                                                                        surgery, provide only
                                                                        clean drinking water</li>
                                                                    <li>Ensure that your pet is secured with a leash
                                                                        and/or a cage before
                                                                        transporting to the surgical area/office.</li>
                                                                    <li>Bring used towels or old newspapers to be used
                                                                        as bedding for the
                                                                        animal after the surgery.</li>
                                                                    <li>Your pet must be vaccinated against Rabies at
                                                                        least 14 days prior to
                                                                        surgery (provide the vaccination
                                                                        card/certificate).</li>
                                                                </ul>
                                                            </td>
                                                            <td style="width:10%"></td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td colspan="10"
                                                                style="text-align: left; padding-top: 10px;">
                                                                <span
                                                                    style="margin-left:40px; text-decoration: underline; font-weight:bold;">Needed
                                                                    materials per animal</span> <em>(Must be provided by
                                                                    the owner prior or
                                                                    during the surgery):</em>
                                                            </td>

                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td style="width:10%"></td>
                                                            <td colspan="8">
                                                                <ul>
                                                                    <li>2 pcs Surgical gloves size 7.5</li>
                                                                    <li>10 pcs Sterile gauze pads (any size)</li>
                                                                    <li>3 pcs 1ml Syringes</li>
                                                                    <li>1-2 pcs polygalactin/novosyn/vicryl stutures
                                                                        (size 2-0 or 3-0)</li>
                                                                    <li>1 bottle 60ml Bactidol</li>
                                                                    <li>1 Ampule Tramadol</li>
                                                                </ul>
                                                            </td>
                                                            <td style="width:10%"></td>
                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td colspan="10"
                                                                style="text-align: left; text-decoration: underline; font-weight:bold; padding-top: 10px;">
                                                                <em style="margin-left:40px;">Post-Operative Care</em>
                                                            </td>

                                                        </tr>
                                                        <tr style="font-size:20px;">
                                                            <td style="width:10%"></td>
                                                            <td colspan="8">
                                                                <ul>
                                                                    <li>Do not feed the animal for 6 to 8 hours after
                                                                        the surgery. After
                                                                        that, provide soft food diet for the animal</li>
                                                                    <li>Provide clean drinking water all the time</li>
                                                                    <li>Restrain the animal in a cage or with a leash
                                                                    </li>
                                                                    <li>Avoid strenuous activity and other stressful
                                                                        exercises</li>
                                                                    <li>Do not bath the animal for 14 days following the
                                                                        surgery</li>
                                                                    <li>Cleanse the area around the wound with
                                                                        betadine(iodine) and clean
                                                                        gauze or cotton</li>
                                                                    <li>If wounds continuously bleed or mutilated,
                                                                        please contact the local
                                                                        veterinarian</li>
                                                                </ul>
                                                            </td>
                                                            <td style="width:10%"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div>
                                                <img src="{{ url('frontend/guestlayout/images/letterfoot.png') }}"
                                                    style="width: 100%;" alt="">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                        <div class="row mt-3">
                            <h5 class="text-primary fw-bold p-3 text-lg">Attached Vaccination Card</h5>
                            <div class="col-lg-12">
                                <a href="{{ asset('storage/' . $formData->vaccination_card) }}" target="_blank">
                                    <img alt="lightbox" src="{{ asset('storage/' . $formData->vaccination_card) }}"
                                        class="card-img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-userlayout.layout>
