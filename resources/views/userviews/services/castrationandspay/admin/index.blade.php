<x-userlayout.layout>
    <div class="container mb-3">
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
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        Kindly select the type of animal and service you want to avail.
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="modal fade" id="weekendModal" tabindex="-999" role="dialog" aria-labelledby="weekendModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="weekendModalLabel">Invalid Date</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        Castration and Spay Services are only available on Wednesday. Please Select a valid date.
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="modal fade" id="timeModal" tabindex="-999" role="dialog" aria-labelledby="timeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white" id="timeModalLabel">Time Required</h5>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <div class="modal-body">
                        Please select a valid time slot before proceeding.
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
                    </div> --}}
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Create</h3>
                        <form method="POST" action="{{ route('castrationandspay.user.scheduled.adminpost') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="wizard-step" id="step-1">
                                <h5 class="mt-3">Step 1: Service to Avail</h5>
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
                                                <input type="radio" id="castration" name="service_type" required
                                                    value="Castration">
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
                            <div class="wizard-step d-none" id="step-2">
                                <h5 class="mt-3">Step 2: Scheduled Date and Time of Operation</h5>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="visitation_schedule" class="text-primary"
                                            :value="__('Date of Operation')" />
                                        <x-text-input class="form-control" type="text"
                                            style="background-color:white;" name="visitation_schedule"
                                            :value="old('visitation_schedule')" required autofocus autocomplete="visitation_schedule"
                                            placeholder="Enter Date" id="visitation_schedule" />
                                        <x-input-error :messages="$errors->get('visitation_schedule')" class="mt-2 text-danger" />
                                        <x-input-label for="visitation_schedule" style="font-weight:bold"
                                            :value="__('Service is only available on Wednesday')" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <x-input-label class="text-primary" :value="__('Vacant Schedules')" />
                                        <div id="available-times" class="mt-3" style="font-weight:bold">Please
                                            select a date first to view the
                                            available time slots</div>
                                        <input type="hidden" name="time_from" id="time_from" required autofocus>
                                        <input type="hidden" name="time_to" id="time_to" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step d-none" id="step-3">
                                <h5>Step 4: Vaccination Status</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="vaccination_date" class="text-primary"
                                            :value="__('Date of Last Vaccination')" />
                                        <x-text-input id="vaccination_date" class="form-control" type="text"
                                            style="background-color:white;" name="vaccination_date" :value="old('vaccination_date')"
                                            required autofocus autocomplete="vaccination_date"
                                            placeholder="Date of Last Vaccination" />
                                        <x-input-error :messages="$errors->get('vaccination_date')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="vaccination_card" class="text-primary"
                                            :value="__('Upload Vaccination Card')" />
                                        <x-text-input id="vaccination_card" class="form-control" type="file"
                                            name="vaccination_card" :value="old('vaccination_card')" required autofocus
                                            autocomplete="vaccination_card" placeholder="Upload Vaccination Card" />
                                        <x-input-error :messages="$errors->get('vaccination_card')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step d-none" id="step-4">
                                <h5 class="mt-3">Step 4: Client Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="full_name" class="text-primary" :value="__('Full Name')" />
                                        <x-text-input id="full_name" class="form-control" type="text"
                                            name="full_name" :value="old('full_name')" required autofocus
                                            autocomplete="full_name" placeholder="Enter Full Name" />
                                        <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="sex" class="text-primary" :value="__('Sex')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey; font-size: 12px;"
                                                name="sex" required>
                                                <option value="" {{ old('sex') === '' ? 'selected' : '' }}>
                                                    Select Sex</option>
                                                <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="birthdate" class="text-primary" :value="__('Birthdate')" />
                                        <x-text-input id="birthdate" class="form-control" type="text"
                                            style="background-color: white;" name="birthdate" :value="old('birthdate')"
                                            autofocus autocomplete="birthdate" placeholder="Enter Birthdate" />
                                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="contact_number" class="text-primary" :value="__('Contact Number')" />
                                        <x-text-input id="contact_number" class="form-control" type="text"
                                            name="contact_number" :value="old('contact_number')" autofocus
                                            autocomplete="contact_number" placeholder="Enter Contact No." />
                                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="email" class="text-primary" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email"
                                            name="email" :value="old('email')" autofocus autocomplete="email"
                                            placeholder="Enter Email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="region_id" class="text-primary" :value="__('Region')" />
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
                                        <x-input-label for="province_id" class="text-primary" :value="__('Province')" />
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
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey; font-size: 12px;"
                                                name="municipality_id" id="municipality_id" required>
                                                <option value="">Select City/Municipality</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('municipality_id')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <x-input-label for="barangay_id" class="text-primary" :value="__('Barangay')" />
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
                                        <x-text-input id="specific_location" class="form-control" type="text"
                                            name="specific_location" :value="old('specific_location')"
                                            autocomplete="specific_location"
                                            placeholder="Enter Purok/Street/Village etc." />
                                        <x-input-error :messages="$errors->get('specific_location')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step d-none" id="step-5">
                                <h5>Step 5: Pet Information</h5>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="animal_name" class="text-primary" :value="__('Pet Name')" />
                                        <x-text-input id="animal_name" class="form-control" type="text"
                                            name="animal_name" :value="old('animal_name')" required autofocus
                                            autocomplete="animal_name" placeholder="Enter Full Name" />
                                        <x-input-error :messages="$errors->get('animal_name')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="animal_sex" class="text-primary" :value="__('Pet Sex')" />
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
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label class="text-primary" :value="__('Year/s')" />
                                        <x-text-input id="animal_age_year" class="form-control" type="number"
                                            name="animal_age_year" :value="old('animal_age_year')" autofocus
                                            autocomplete="animal_age_year"
                                            placeholder="How many years? (Pila na ka tuig)" />
                                        <x-input-error :messages="$errors->get('animal_age_year')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label class="text-primary" :value="__('Month/s')" />
                                        <x-text-input id="animal_age_month" class="form-control" type="number"
                                            name="animal_age_month" :value="old('animal_age_month')" autofocus
                                            autocomplete="animal_age_month"
                                            placeholder="How many months? (Pila na ka bulan?)" />
                                        <x-input-error :messages="$errors->get('animal_age_month')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="animal_color" class="text-primary" :value="__('Pet Color')" />
                                        <x-text-input id="animal_color" class="form-control" type="text"
                                            name="animal_color" :value="old('animal_color')" autofocus
                                            autocomplete="animal_color" placeholder="Enter Pet Color" />
                                        <x-input-error :messages="$errors->get('animal_color')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="animal_specie" class="text-primary" :value="__('Pet Breed')" />
                                        <x-text-input id="animal_specie" class="form-control" type="text"
                                            name="animal_specie" :value="old('animal_specie')" autofocus
                                            autocomplete="animal_specie" placeholder="Enter Pet Species" />
                                        <x-input-error :messages="$errors->get('animal_specie')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="button" class="btn btn-secondary" id="prevBtn"
                                    onclick="nextPrev(-1)">Back</button>
                                <button type="button" class="btn btn-primary" id="nextBtn"
                                    onclick="nextPrev(1)">Next</button>
                                <button type="submit" class="btn btn-primary d-none" id="submitBtn">Submit</button>
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

                                return valid;
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
            </div>
        </div>
    </div>

</x-userlayout.layout>
