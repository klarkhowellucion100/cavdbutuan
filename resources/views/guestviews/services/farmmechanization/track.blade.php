<x-guestlayout.layout>
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Farm Mechanization Service Tracker</span>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                <form method="POST" action="{{ route('farmmechanization.tracksearch') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <x-input-label for="tracking_number" :value="__('Tracking Number')" />
                                            <div class="input-group">
                                                <x-text-input id="tracking_number" class="form-control"
                                                    type="tracking_number" name="tracking_number" required
                                                    autocomplete="tracking_number" placeholder="Enter Tracking No." />

                                                <x-input-error :messages="$errors->get('tracking_number')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-3">Search</button>
                                </form>
                            </div>

                            <div class="col-md-12 text-primary" style="font-weight:bold;">
                                OR
                            </div>

                            <div class="col-md-12">
                                <!-- QR Scanner Option -->
                                <button type="button" class="btn btn-outline-secondary mt-3" onclick="toggleScanner()">
                                    📷 Scan QR Code
                                </button>

                                <!-- QR Scanner UI -->
                                <div id="qr-reader" style="width:100%; max-width:400px;" class="mt-3 d-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- QR Scanner Script -->
    <script>
        let scannerVisible = false;
        let html5QrCode;

        function toggleScanner() {
            const qrReader = document.getElementById('qr-reader');

            if (!scannerVisible) {
                qrReader.classList.remove('d-none');

                html5QrCode = new Html5Qrcode("qr-reader");
                html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    qrCodeMessage => {
                        document.getElementById('tracking_number').value = qrCodeMessage;

                        html5QrCode.stop().then(() => {
                            qrReader.classList.add('d-none');
                            scannerVisible = false;
                        });
                    },
                    errorMessage => {
                        // You can handle scan errors if needed
                        console.warn("QR Scan error: ", errorMessage);
                    }
                ).catch(err => {
                    console.error("Camera start failed: ", err);
                });

                scannerVisible = true;
            } else {
                html5QrCode.stop().then(() => {
                    qrReader.classList.add('d-none');
                    scannerVisible = false;
                });
            }
        }
    </script>
</x-guestlayout.layout>
