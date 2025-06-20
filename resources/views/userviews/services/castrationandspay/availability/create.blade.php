<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <section id="page-content">
                    <div class="container">
                        <div class="pb-3">
                            <a href="{{ route('castrationandspay.user.availability.index') }}"
                                class="btn btn-primary waves-effect waves-light w-md">
                                Back
                            </a>
                        </div>
                        <div class="row">
                            <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="h4">Add Availability</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('castrationandspay.user.availability.store') }}">
                                            @csrf

                                            <div class="wizard-step" id="step-1">
                                                <h5 style="margin-bottom:10px;">Create</h5>
                                                <div class="form-row">

                                                    <div class="form-group col-md-4">
                                                        <x-input-label for="day_name" class="text-primary"
                                                            :value="__('Day')" />
                                                        <div class="input-group">
                                                            <select class="form-control" name="day_name" required>
                                                                <option value=""
                                                                    {{ old('day_name') === '' ? 'selected' : '' }}>
                                                                    Select Day</option>
                                                                <option value="Monday"
                                                                    {{ old('day_name') === 'Monday' ? 'selected' : '' }}>
                                                                    Monday
                                                                </option>
                                                                <option value="Tuesday"
                                                                    {{ old('day_name') === 'Tuesday' ? 'selected' : '' }}>
                                                                    Tuesday
                                                                </option>
                                                                <option value="Wednesday"
                                                                    {{ old('day_name') === 'Wednesday' ? 'selected' : '' }}>
                                                                    Wednesday
                                                                </option>
                                                                <option value="Thursday"
                                                                    {{ old('day_name') === 'Thursday' ? 'selected' : '' }}>
                                                                    Thursday
                                                                </option>
                                                                <option value="Friday"
                                                                    {{ old('day_name') === 'Friday' ? 'selected' : '' }}>
                                                                    Friday
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <x-input-error :messages="$errors->get('day_name')" class="mt-2 text-danger" />
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <x-input-label for="time_from" class="text-primary"
                                                            :value="__('Time From')" />
                                                        <x-text-input id="time_from" class="form-control" type="time"
                                                            name="time_from" :value="old('time_from')" required autofocus
                                                            autocomplete="time_from" placeholder="Enter Time"
                                                            id="time_from" />
                                                        <x-input-error :messages="$errors->get('time_from')" class="mt-2 text-danger" />
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <x-input-label for="time_to" class="text-primary"
                                                            :value="__('Time To')" />
                                                        <x-text-input id="time_to" class="form-control" type="time"
                                                            name="time_to" :value="old('time_to')" required autofocus
                                                            autocomplete="time_to" placeholder="Enter Time"
                                                            id="time_to" />
                                                        <x-input-error :messages="$errors->get('time_to')" class="mt-2 text-danger" />
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
