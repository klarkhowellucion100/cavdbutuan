<x-userlayout.layout>

    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                @if ($clientForm)
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

                    <div style="text-align:left">
                        <a href="{{ route('farmmechanization.user.scheduled.index') }}"
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
                                                    <button class="btn btn-primary"
                                                        onclick="printDiv('content')">Print</button>
                                                </div>
                                                <div id="content"
                                                    style="border: 1px solid #357ae8; padding: 10px; width: 100%;">
                                                    <div
                                                        style="display:flex; justify-content:center; align-items:center;">
                                                        <img src="{{ url('frontend/guestlayout/images/letterhead.png') }}"
                                                            style="width: 80%;" alt="">
                                                    </div>
                                                    <div
                                                        style="padding-left:30px;font-size: 15px; color:crimson; font-weight:bold; margin-top: 10px; font-style:italic; text-align:right; margin-right: 30px;">
                                                        FILE COPY
                                                    </div>
                                                    <div class="pt-5">
                                                        <table
                                                            style="width:100%; border: 1px solid black; border-collapse: collapse;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align:center; border: 1px solid black;"
                                                                        colspan="4">
                                                                        <p
                                                                            style="font-size: 20px; font-weight:bold; color: black">
                                                                            REQUEST FORM
                                                                            <br>
                                                                            {{ $currentYear = now()->year }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Name</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->full_name }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Date Requested
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ \Carbon\Carbon::parse($clientForm->created_at)->toFormattedDateString() }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Address</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->specific_location ?? 'N/A' }},
                                                                        {{ $clientForm->barangay ?? 'N/A' }},
                                                                        {{ $clientForm->municipality }},
                                                                        {{ $clientForm->province }},
                                                                        {{ $clientForm->region }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Tel/Cel No.
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->contact_number }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Category</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->category }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Email
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->email }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td colspan="4"
                                                                        style="text-align: center; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Details of Request</td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td colspan="4"
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black; height:50px;">
                                                                        {{ $clientForm->details }}
                                                                    </td>
                                                                </tr>

                                                                <tr style="font-size:18px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="1"
                                                                        style="text-align: center; width: 25%;height:70px; vertical-align:bottom; color:black">
                                                                        {{ $clientForm->full_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="1"
                                                                        style="text-align: center; width: 25%; border-top: 1px solid black; color:black; font-weight:bold; font-size:15px;">
                                                                        <em>Client Signature over Printed Name</em>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div
                                                        style="font-weight: bold; text-align: center; color:black; font-size:18px;">
                                                        <em>For CAVD use only</em>
                                                    </div>
                                                    <div style="font-weight: bold; text-align: right; color:black">
                                                        <em>Tracking No. <span
                                                                style="text-decoration:underline; font-weight:normal; font-style:normal;margin-right:50px;">{{ $clientForm->transaction_number }}</span></em>
                                                    </div>
                                                    <table
                                                        style="width:100%; border: 1px solid black; border-collapse: collapse; color: black; font-size:18px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Endorsed to</th>
                                                                <th style="border: 1px solid black;height:30px;">Date
                                                                    Endorsed</th>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Remarks/Action
                                                                    Taken</th>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Responsible Person
                                                                </th>
                                                                <th style="border: 1px solid black;height:30px;">Date
                                                                    Action</th>
                                                                <th style="border: 1px solid black;height:30px;">Approve
                                                                    by</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="border: 1px solid black;height:30px;"><span
                                                                        style="font-weight:bold;">{{ $clientForm->endorsed_name }}</span>
                                                                    <br>
                                                                    {{ $clientForm->endorsed_position }}
                                                                </td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ \Carbon\Carbon::parse($clientForm->date_endorsed)->toFormattedDateString() }}
                                                                </td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ $clientForm->remarks }}</td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ $clientForm->responsible_name }}</td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ \Carbon\Carbon::parse($clientForm->date_approved)->toFormattedDateString() }}
                                                                </td>
                                                                <td
                                                                    style="border: 1px solid black;height:30px; font-weight:bold;">
                                                                    {{ $clientForm->approved_name }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                    <hr
                                                        style="border: none; border-top: 5px dashed #007bff; margin: 20px 0;">

                                                    <div
                                                        style="display:flex; justify-content:center; align-items:center;">
                                                        <img src="{{ url('frontend/guestlayout/images/letterhead.png') }}"
                                                            style="width: 80%;" alt="">
                                                    </div>

                                                    <div class="pt-5">
                                                        <table
                                                            style="width:100%; border: 1px solid black; border-collapse: collapse;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="text-align:center; border: 1px solid black;"
                                                                        colspan="4">
                                                                        <p
                                                                            style="font-size: 20px; font-weight:bold; color: black">
                                                                            REQUEST FORM
                                                                            <br>
                                                                            {{ $currentYear = now()->year }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Name</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->full_name }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Date Requested
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ \Carbon\Carbon::parse($clientForm->created_at)->format('Y-m-d') }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Address</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->specific_location ?? 'N/A' }},
                                                                        {{ $clientForm->barangay ?? 'N/A' }},
                                                                        {{ $clientForm->municipality }},
                                                                        {{ $clientForm->province }},
                                                                        {{ $clientForm->region }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Tel/Cel No.
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->contact_number }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Category</td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->category }}
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Email
                                                                    </td>
                                                                    <td
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black">
                                                                        {{ $clientForm->email }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td colspan="4"
                                                                        style="text-align: center; width: 25%;border: 1px solid black; font-weight:bold; color:black">
                                                                        Details of Request</td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td colspan="4"
                                                                        style="text-align: left; width: 25%;border: 1px solid black; color:black; height:50px;">
                                                                        {{ $clientForm->details }}
                                                                    </td>
                                                                </tr>

                                                                <tr style="font-size:18px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="1"
                                                                        style="text-align: center; width: 25%;height:70px; vertical-align:bottom; color:black">
                                                                        {{ $clientForm->full_name }}
                                                                    </td>
                                                                </tr>
                                                                <tr style="font-size:18px;">
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td colspan="1"
                                                                        style="text-align: center; width: 25%; border-top: 1px solid black; color:black; font-weight:bold; font-size:15px;">
                                                                        <em>Client Signature over Printed Name</em>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div
                                                        style="font-weight: bold; text-align: center; color:black; font-size:18px;">
                                                        <em>For CAVD use only</em>
                                                    </div>
                                                    <div style="font-weight: bold; text-align: right; color:black">
                                                        <em>Tracking No. <span
                                                                style="text-decoration:underline; font-weight:normal; font-style:normal;margin-right:50px;">{{ $clientForm->transaction_number }}</span></em>
                                                    </div>
                                                    <table
                                                        style="width:100%; border: 1px solid black; border-collapse: collapse; color: black; font-size:18px;">
                                                        <thead>
                                                            <tr>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Endorsed to</th>
                                                                <th style="border: 1px solid black;height:30px;">Date
                                                                    Endorsed</th>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Remarks/Action
                                                                    Taken</th>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Responsible Person
                                                                </th>
                                                                <th style="border: 1px solid black;height:30px;">Date
                                                                    Action</th>
                                                                <th style="border: 1px solid black;height:30px;">
                                                                    Approve by</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="border: 1px solid black;height:30px;"><span
                                                                        style="font-weight:bold;">{{ $clientForm->endorsed_name }}</span>
                                                                    <br>
                                                                    {{ $clientForm->endorsed_position }}
                                                                </td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ \Carbon\Carbon::parse($clientForm->date_endorsed)->toFormattedDateString() }}
                                                                </td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ $clientForm->remarks }}</td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ $clientForm->responsible_name }}</td>
                                                                <td style="border: 1px solid black;height:30px;">
                                                                    {{ \Carbon\Carbon::parse($clientForm->date_approved)->toFormattedDateString() }}
                                                                </td>
                                                                <td
                                                                    style="border: 1px solid black;height:30px; font-weight:bold;">
                                                                    {{ $clientForm->approved_name }}</td>
                                                            </tr>

                                                        </tbody>
                                                    </table>

                                                    <div class="pt-3">
                                                        <h4 style="font-weight:bold; color:black">Instructions:</h4>
                                                        <ol style="padding-left: 20px;">
                                                            <li>
                                                                After receiving the Cash Collection Slip, proceed with
                                                                the <span style="font-weight: bold"> payment </span>
                                                                to the <span style="font-weight: bold"> City Treasury
                                                                    Department at Butuan City
                                                                    Hall. </span>
                                                            </li>
                                                            {{-- <li>
                                                                Once you have the Official Receipt, upload it
                                                                in this link <br>
                                                                <span
                                                                    style="font-weight: bold; color:crimson">https://cavdbutuan.com/farmmech/{{ $clientForm->transaction_number }}/userupload</span>
                                                                <br>
                                                                or visit <span
                                                                    style="font-weight:bold; color:#007bff;">CAVD</span>
                                                                to assist you in uploading
                                                                <br>
                                                                to proceed with the scheduling.
                                                                We will respond within 2-3 working days after the
                                                                receipt has been
                                                                uploaded.
                                                            </li> --}}
                                                            <li>The <span style="font-weight: bold">requestor</span>
                                                                will
                                                                <span style="font-weight: bold"> cover the fuel costs
                                                                    for transporting
                                                                    the machinery from the office to the designated
                                                                    area</span>.
                                                                Additionally,
                                                                the <span style="font-weight: bold">requestor</span> is
                                                                responsible for <span
                                                                    style="font-weight: bold">providing the required 35
                                                                    liters of fuel
                                                                    per hectare </span>
                                                                at the start of the
                                                                service.
                                                            </li>
                                                            <li>
                                                                In the event that the machinery is under repair,
                                                                encounters issues,
                                                                or becomes damaged,
                                                                we will promptly contact you to discuss potential
                                                                rescheduling of
                                                                the request.
                                                            </li>
                                                            <li>
                                                                If fortuitous events occur, we will promptly contact you
                                                                to discuss
                                                                the possibility of
                                                                rescheduling the service.
                                                            </li>
                                                            <li>
                                                                For concerns and inquiries, transact with authorized
                                                                CAVD personnel only.
                                                            </li>
                                                        </ol>
                                                        <p>Thank you!</p>
                                                    </div>

                                                    <hr
                                                        style="border: none; border-top: 5px dashed #007bff; margin: 20px 0;">

                                                    <div class="row"
                                                        style="margin-top: 30px; padding: 10px; gap:10px;">
                                                        <table
                                                            style="width:100%; border: 1px solid black; border-collapse: collapse;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="border: 1px solid black;height:30px;">
                                                                        <div>
                                                                            <img src="{{ url('frontend/guestlayout/images/letterhead.png') }}"
                                                                                style="width: 100%;" alt="">
                                                                        </div>
                                                                        <div
                                                                            style="text-align:center; border: 1px solid black;">
                                                                            <p
                                                                                style="font-size: 20px; font-weight:bold; color: black">
                                                                                CASH
                                                                                COLLECTION SLIP
                                                                                <br>
                                                                                {{ $currentYear = now()->year }}
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 15px; color:crimson; font-weight:bold; margin-top: 10px; font-style:italic; text-align:right; margin-right: 30px;">
                                                                            FILE COPY
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 15px; color:black; font-weight:bold;">
                                                                            Control No. <span
                                                                                style="text-decoration: underline; font-weight:normal">{{ $clientForm->control_number }}</span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 15px; color:black; font-weight:bold;margin-top: 10px;">
                                                                            Date: <span
                                                                                style="text-decoration: underline; font-weight:normal">
                                                                                {{ \Carbon\Carbon::parse($clientForm->date_approved)->toFormattedDateString() }}
                                                                            </span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 20px; color:black; font-weight:normal;margin-top: 30px;">
                                                                            To: <span style="font-weight:bold">CITY
                                                                                TREASURY DEPARTMENT</span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 18px; color:black; font-weight:normal;margin-top: 30px;">
                                                                            Kindly collect the amount and issue the
                                                                            corresponding
                                                                            <br> Official
                                                                            Receipt
                                                                            (OR) to the client based on the particulars
                                                                            stated
                                                                            below:
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px; font-size: 18px; color: black; font-weight: normal; margin-top: 30px;">
                                                                            <!-- Name of Client -->
                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span style="margin-right: 10px;">Name
                                                                                    of
                                                                                    Client:</span>
                                                                                <span
                                                                                    style="font-weight: bold;text-decoration:underline;">{{ $clientForm->full_name }}</span>
                                                                            </div>

                                                                            <!-- Address -->
                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span
                                                                                    style="margin-right: 10px;">Address:</span>
                                                                                <span
                                                                                    style="font-weight: bold; text-decoration:underline;">
                                                                                    {{ $clientForm->specific_location ?? 'N/A' }},
                                                                                    {{ $clientForm->barangay ?? 'N/A' }},
                                                                                    {{ $clientForm->municipality }}
                                                                                </span>
                                                                            </div>

                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span style="margin-right: 10px;">No of
                                                                                    Hectares:</span>
                                                                                <span
                                                                                    style="font-weight: bold; text-decoration:underline;">
                                                                                    {{ number_format($clientForm->area_size, 2) }}
                                                                                    has
                                                                                </span>
                                                                            </div>

                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 50px;">
                                                                                <span style="margin-right: 10px;">Fees
                                                                                    and
                                                                                    Charge:</span>
                                                                                <span
                                                                                    style="font-weight: bold;text-decoration:underline;">
                                                                                    PhP
                                                                                    {{ number_format($clientForm->fees_charge, 2) }}
                                                                                </span>
                                                                            </div>
                                                                            <div style="margin-bottom: 20px;">

                                                                                <span
                                                                                    style="font-weight: bold; text-decoration: underline">
                                                                                    {{ $clientForm->issuer_name }}
                                                                                </span>
                                                                                <br>
                                                                                <span style="font-weight: normal;">
                                                                                    {{ $clientForm->issuer_position }}
                                                                                </span>
                                                                                <br>
                                                                                <div style="text-align: right;">
                                                                                    <span
                                                                                        style="font-weight: bold; margin-right: 30px; font-size:15px">
                                                                                        CAVD.ASU.F.048.REV01
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td style="border: 1px solid black;height:30px;">
                                                                        <div>
                                                                            <img src="{{ url('frontend/guestlayout/images/letterhead.png') }}"
                                                                                style="width: 100%;" alt="">
                                                                        </div>
                                                                        <div
                                                                            style="text-align:center; border: 1px solid black;">
                                                                            <p
                                                                                style="font-size: 20px; font-weight:bold; color: black">
                                                                                CASH
                                                                                COLLECTION SLIP
                                                                                <br>
                                                                                {{ $currentYear = now()->year }}
                                                                            </p>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 15px; color:black; font-weight:bold; margin-top: 20px;">
                                                                            Control No. <span
                                                                                style="text-decoration: underline; font-weight:normal">{{ $clientForm->control_number }}</span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 15px; color:black; font-weight:bold;margin-top: 10px;">
                                                                            Date: <span
                                                                                style="text-decoration: underline; font-weight:normal">
                                                                                {{ \Carbon\Carbon::parse($clientForm->date_approved)->toFormattedDateString() }}</span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 20px; color:black; font-weight:normal;margin-top: 30px;">
                                                                            To: <span style="font-weight:bold">CITY
                                                                                TREASURY DEPARTMENT</span>
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px;font-size: 18px; color:black; font-weight:normal;margin-top: 30px;">
                                                                            Kindly collect the amount and issue the
                                                                            corresponding
                                                                            <br> Official
                                                                            Receipt
                                                                            (OR) to the client based on the particulars
                                                                            stated
                                                                            below:
                                                                        </div>
                                                                        <div
                                                                            style="padding-left:30px; font-size: 18px; color: black; font-weight: normal; margin-top: 30px;">
                                                                            <!-- Name of Client -->
                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span style="margin-right: 10px;">Name
                                                                                    of
                                                                                    Client:</span>
                                                                                <span
                                                                                    style="font-weight: bold;text-decoration:underline;">{{ $clientForm->full_name }}</span>
                                                                            </div>

                                                                            <!-- Address -->
                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span
                                                                                    style="margin-right: 10px;">Address:</span>
                                                                                <span
                                                                                    style="font-weight: bold; text-decoration:underline;">
                                                                                    {{ $clientForm->specific_location ?? 'N/A' }},
                                                                                    {{ $clientForm->barangay ?? 'N/A' }},
                                                                                    {{ $clientForm->municipality }}
                                                                                </span>
                                                                            </div>

                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 20px;">
                                                                                <span style="margin-right: 10px;">No of
                                                                                    Hectares:</span>
                                                                                <span
                                                                                    style="font-weight: bold; text-decoration:underline;">
                                                                                    {{ number_format($clientForm->area_size, 2) }}
                                                                                    has
                                                                                </span>
                                                                            </div>

                                                                            <div
                                                                                style="display: flex; align-items: baseline; margin-bottom: 50px;">
                                                                                <span style="margin-right: 10px;">Fees
                                                                                    and
                                                                                    Charge:</span>
                                                                                <span
                                                                                    style="font-weight: bold;text-decoration:underline;">
                                                                                    PhP
                                                                                    {{ number_format($clientForm->fees_charge, 2) }}
                                                                                </span>
                                                                            </div>
                                                                            <div style="margin-bottom: 20px;">

                                                                                <span
                                                                                    style="font-weight: bold; text-decoration: underline">
                                                                                    {{ $clientForm->issuer_name }}
                                                                                </span>
                                                                                <br>
                                                                                <span style="font-weight: normal;">
                                                                                    {{ $clientForm->issuer_position }}
                                                                                </span>
                                                                                <div style="text-align: right;">
                                                                                    <span
                                                                                        style="font-weight: bold; margin-right: 30px; font-size:15px">
                                                                                        CAVD.ASU.F.048.REV01
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-userlayout.layout>
