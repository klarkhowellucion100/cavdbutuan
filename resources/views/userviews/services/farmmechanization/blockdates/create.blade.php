<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <section id="page-content">
                    <div class="container">
                        <div class="pb-3">
                            <a href="{{ route('farmmechanization.user.blockdates.index') }}"
                                class="btn btn-primary waves-effect waves-light w-md">
                                Back
                            </a>
                        </div>
                        <div class="row">
                            <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="h4">Block a Date</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('farmmechanization.user.blockdates.store') }}">
                                            @csrf

                                            <div class="wizard-step" id="step-1">
                                                <h5 style="margin-bottom:10px;">Create</h5>
                                                <div class="form-row">
                                                    <div id="calendar"></div>

                                                    <div class="form-group col-md-6">
                                                        <x-input-label for="block_date" class="text-primary"
                                                            :value="__('Block Date')" />
                                                        <x-text-input id="block_date" class="form-control"
                                                            type="text" name="block_date" :value="old('block_date')" required
                                                            autofocus autocomplete="block_date" placeholder="Enter Date"
                                                            min="{{ now()->toDateString() }}" id="block_date" />
                                                        <x-input-error :messages="$errors->get('block_date')" class="mt-2 text-danger" />
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <x-input-label for="reason" class="text-primary"
                                                            :value="__('Reason')" />
                                                        <x-text-input id="reason" class="form-control" type="text"
                                                            name="reason" :value="old('reason')" required autofocus
                                                            autocomplete="reason" placeholder="Enter Reason"
                                                            id="reason" />
                                                        <x-input-error :messages="$errors->get('reason')" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Navigation Buttons -->
                                            <div class="mt-4">
                                                <button type="button" class="btn btn-secondary" id="prevBtn"
                                                    onclick="nextPrev(-1)">Back</button>
                                                <button type="button" class="btn btn-primary" id="nextBtn"
                                                    onclick="nextPrev(1)">Next</button>
                                                <button type="submit" class="btn btn-primary d-none"
                                                    id="submitBtn">Submit</button>
                                            </div>
                                        </form>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                flatpickr("#block_date", {
                                                    dateFormat: "Y-m-d",
                                                });
                                                const dateInputs = document.querySelectorAll('#block_date');
                                                dateInputs.forEach(input => {
                                                    input.addEventListener('input', function() {
                                                        const selectedDate = new Date(this.value);
                                                        const day = selectedDate.getUTCDay();
                                                    });
                                                });
                                            });

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
                                                        // For selects, also check if value is empty string
                                                        if (!field.value || field.value.trim() === "") {
                                                            field.classList.add('is-invalid');
                                                            valid = false;
                                                        } else {
                                                            field.classList.remove('is-invalid');
                                                        }
                                                    }
                                                });
                                                return valid;
                                            }

                                            document.addEventListener('DOMContentLoaded', () => {
                                                showStep(currentStep);
                                            });
                                        </script>

                                    </div>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-userlayout.layout>
