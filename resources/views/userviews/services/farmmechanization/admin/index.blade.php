<x-userlayout.layout>
    <div class="container mb-3">
        <div id="customApproveModal" class="custom-modal">
            <div class="custom-modal-content">
                <button class="custom-close-btn" id="approveCloseBtn">&times;</button>
                <div class="custom-modal-header">Confirm Approval</div>
                <div>Total land ara for service already reached the limit (4
                    Hectares). Do you still want to proceed?
                </div>
                <div class="custom-modal-footer">
                    <button class="btn btn-secondary" id="approveCancelBtn">Cancel</button>
                    <button class="btn btn-success" id="confirmApproveBtn">Yes</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Create</h3>
                        <form method="POST" action="{{ route('farmmechanization.user.scheduled.adminpost') }}">
                            @csrf

                            <div class="wizard-step" id="step-1">
                                <h5 class="mt-3">Step 1: Personal Information</h5>

                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="full_name" class="text-primary" :value="__('Full Name')" />
                                        <x-text-input id="full_name" class="form-control" type="text"
                                            list="fullNameOptions" name="full_name" :value="old('full_name')" required autofocus
                                            autocomplete="full_name" placeholder="Enter Full Name" />
                                        <datalist id="fullNameOptions">
                                            @foreach ($oldClients as $clients)
                                                <option value="{{ $clients->full_name }}">
                                                    {{ $clients->full_name }}</option>
                                            @endforeach
                                        </datalist>
                                        <x-input-error :messages="$errors->get('full_name')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="sex" class="text-primary" :value="__('Sex')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="sex" required>
                                                <option value="" {{ old('sex') === '' ? 'selected' : '' }}>
                                                    Select Sex</option>
                                                <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>
                                                    Female
                                                </option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('sex')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="birthdate" class="text-primary" :value="__('Birthdate')" />
                                        <x-text-input id="birthdate" class="form-control" type="date"
                                            name="birthdate" :value="old('birthdate')" autofocus autocomplete="birthdate"
                                            placeholder="Enter Birthdate" />
                                        <x-input-error :messages="$errors->get('birthdate')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="contact_number" class="text-primary" :value="__('Contact Number')" />
                                        <x-text-input id="contact_number" class="form-control" type="text"
                                            name="contact_number" :value="old('contact_number')" autofocus
                                            autocomplete="contact_number" placeholder="Enter Contact No." />
                                        <x-input-error :messages="$errors->get('contact_number')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <x-input-label for="email" class="text-primary" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            :value="old('email')" autofocus autocomplete="email"
                                            placeholder="Enter Email" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="region_id" class="text-primary" :value="__('Region')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="region_id"
                                                id="region_id" required>
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
                                            <select class="form-control" style="color:grey;" name="province_id"
                                                id="province_id" required>
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
                                            <select class="form-control" style="color:grey;" name="municipality_id"
                                                id="municipality_id" required>
                                                <option value="">Select City/Municipality</option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('municipality_id')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <x-input-label for="barangay_id" class="text-primary" :value="__('Barangay')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="barangay_id"
                                                id="barangay_id" required>
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
                                        resetDropdown('municipality_id', 'Select Municipality');
                                        resetDropdown('barangay_id', 'Select Barangay');

                                        if (region_id) {
                                            fetchDropdown(`/get-provinces/${region_id}`, 'province_id', 'province_id', 'province_name');
                                        }
                                    });

                                    document.getElementById('province_id').addEventListener('change', function() {
                                        const province_id = this.value;
                                        resetDropdown('municipality_id', 'Select Municipality');
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
                            <div class="wizard-step d-none" id="step-2">
                                <h5 class="mt-3">Step 2: Details of Request</h5>
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="proposed_schedule" class="text-primary"
                                            :value="__('Proposed Land Preparation Schedule')" />
                                        <x-text-input id="proposed_schedule" class="form-control" type="date"
                                            name="proposed_schedule" :value="old('proposed_schedule')" required autofocus
                                            autocomplete="proposed_schedule" placeholder="Enter Date"
                                            {{-- min="{{ now()->toDateString() }}" --}} id="proposed_schedule" />
                                        <x-input-error :messages="$errors->get('proposed_schedule')" class="mt-2 text-danger" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <x-input-label for="visitation_schedule" class="text-primary"
                                            :value="__('Schedule of Visit to Office')" />
                                        <x-text-input id="visitation_schedule" class="form-control" type="date"
                                            name="visitation_schedule" :value="old('visitation_schedule')" required autofocus
                                            autocomplete="visitation_schedule" placeholder="Enter Date"
                                            {{-- min="{{ now()->toDateString() }}"  --}} id="visitation_schedule" />
                                        <x-input-error :messages="$errors->get('visitation_schedule')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="machinery" class="text-primary" :value="__('Type of Machinery')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="machinery"
                                                required>
                                                <option value="Farmall"
                                                    {{ old('machinery') === 'Farmall' ? 'selected' : '' }}>
                                                    Farmall
                                                </option>
                                            </select>

                                        </div>
                                        <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="area_size" class="text-primary" :value="__('Area Size')" />
                                        <x-text-input id="area_size" class="form-control" type="text"
                                            name="area_size" :value="old('area_size')" required autofocus
                                            autocomplete="area_size" placeholder="Enter Area Size (Hectare)" />
                                        <x-input-error :messages="$errors->get('area_size')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="category" class="text-primary" :value="__('Category of Requestor')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="category"
                                                required>
                                                <option value="Individual"
                                                    {{ old('category') === 'Individual' ? 'selected' : '' }}>
                                                    Individual</option>
                                                <option value="Group"
                                                    {{ old('category') === 'Group' ? 'selected' : '' }}>
                                                    Group
                                                </option>
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('category')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="details" class="text-primary" :value="__('Details of Request')" />
                                        <x-text-input id="details" class="form-control" type="text"
                                            name="details" :value="old('details')" autofocus autocomplete="details"
                                            placeholder="Enter Details" />
                                        <x-input-error :messages="$errors->get('details')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                            </div>
                            <div class="wizard-step d-none" id="step-3">
                                <h5 class="mt-3">Step 3: Approval of Request</h5>
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="endorsed_to_id" class="text-primary" :value="__('Endorsed to')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="endorsed_to_id"
                                                required>
                                                <option value="{{ $approvingOfficer->id }}"
                                                    {{ old('endorsed_to_id') == $approvingOfficer->id ? 'selected' : '' }}>
                                                    {{ $approvingOfficer->name }}</option>
                                                @foreach ($allUsers as $users)
                                                    <option value="{{ $users->id }}"
                                                        {{ old('endorsed_to_id') == $users->id ? 'selected' : '' }}>
                                                        {{ $users->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('endorsed_to_id')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="date_endorsed" class="text-primary" :value="__('Date Endorsed')" />
                                        <x-text-input id="date_endorsed" class="form-control" type="date"
                                            name="date_endorsed" :value="old('date_endorsed')" required autofocus
                                            autocomplete="date_endorsed" placeholder="Enter Date"
                                            {{-- min="{{ now()->toDateString() }}"  --}} id="date_endorsed" />
                                        <x-input-error :messages="$errors->get('date_endorsed')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="responsible_person_id" class="text-primary"
                                            :value="__('Reponsible Person')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;"
                                                name="responsible_person_id" required>
                                                <option value="{{ $approvingOfficer->id }}"
                                                    {{ old('responsible_person_id') == $approvingOfficer->id ? 'selected' : '' }}>
                                                    {{ $approvingOfficer->name }}</option>
                                                @foreach ($allUsers as $users)
                                                    <option value="{{ $users->id }}"
                                                        {{ old('responsible_person_id') == $users->id ? 'selected' : '' }}>
                                                        {{ $users->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('responsible_person_id')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="remarks" class="text-primary" :value="__('Remarks')" />
                                        <x-text-input id="remarks" class="form-control" type="text"
                                            name="remarks" :value="old('remarks')" autocomplete="remarks"
                                            placeholder="Enter Remarks" />
                                        <x-input-error :messages="$errors->get('remarks')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="approved_by_id" class="text-primary" :value="__('Approved by')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;" name="approved_by_id"
                                                required>
                                                <option value="{{ $approvingOfficer->id }}"
                                                    {{ old('approved_by_id') == $approvingOfficer->id ? 'selected' : '' }}>
                                                    {{ $approvingOfficer->name }}</option>
                                                @foreach ($allUsers as $users)
                                                    <option value="{{ $users->id }}"
                                                        {{ old('approved_by_id') == $users->id ? 'selected' : '' }}>
                                                        {{ $users->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('approved_by_id')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="date_approved" class="text-primary" :value="__('Date Approved')" />
                                        <x-text-input id="date_approved" class="form-control" type="date"
                                            name="date_approved " :value="old('date_approved')" required autofocus
                                            autocomplete="date_approved" placeholder="Enter Date"
                                            {{-- min="{{ now()->toDateString() }}"  --}} id="date_approved" />
                                        <x-input-error :messages="$errors->get('date_approved')" class="mt-2 text-danger" />
                                    </div>
                                </div>
                            </div>

                            <div class="wizard-step d-none" id="step-4">
                                <h5 class="mt-3">Step 4: Cash Collection Details</h5>
                                <div class="form-row mt-3">
                                    <div class="form-group col-md-6">
                                        <x-input-label for="fees_charge" class="text-primary" :value="__('Fee')" />
                                        <x-text-input id="fees_charge" class="form-control" type="text"
                                            name="fees_charge" :value="old('fees_charge')" required autofocus
                                            autocomplete="fees_charge" placeholder="Enter Fee" />
                                        <x-input-error :messages="$errors->get('fees_charge')" class="mt-2 text-danger" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <x-input-label for="issuance_officer_id" class="text-primary"
                                            :value="__('Issued by')" />
                                        <div class="input-group">
                                            <select class="form-control" style="color:grey;"
                                                name="issuance_officer_id" required>
                                                <option value="{{ $approvingOfficer->id }}"
                                                    {{ old('issuance_officer_id') == $approvingOfficer->id ? 'selected' : '' }}>
                                                    {{ $approvingOfficer->name }}</option>
                                                @foreach ($allUsers as $users)
                                                    <option value="{{ $users->id }}"
                                                        {{ old('issuance_officer_id') == $users->id ? 'selected' : '' }}>
                                                        {{ $users->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-input-error :messages="$errors->get('issuance_officer_id')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                            </div>
                            <div class="wizard-step d-none" id="step-5">
                                <h5 class="mt-3">Step 5: Final Schedule</h5>
                                <div class="form-row mt-3">
                                    <div id="calendar"></div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const calendarEl = document.getElementById('calendar');
                                            const finalScheduleInput = document.getElementById('final_schedule');
                                            let selectedDateEl = null; // To track the selected date element

                                            const calendar = new FullCalendar.Calendar(calendarEl, {
                                                initialView: 'dayGridMonth',
                                                height: 'auto',
                                                contentHeight: 'auto',
                                                aspectRatio: 1.5,
                                                // validRange: {
                                                //     start: new Date().toISOString().split('T')[0] // Start from today
                                                // },
                                                events: [
                                                    @foreach ($scheduled as $schedule)
                                                        {
                                                            title: 'Client: {{ number_format($schedule->total_count) }}; Area: {{ number_format($schedule->total_size) }} ha',
                                                            start: '{{ $schedule->final_schedule }}',
                                                            color: '#007bff',
                                                            extendedProps: {
                                                                total_size: {{ $schedule->total_size }},
                                                                priority: 1
                                                            }
                                                        },
                                                    @endforeach
                                                ],
                                                eventOrder: (a, b) => a.extendedProps.priority - b.extendedProps.priority,
                                                eventDidMount: function(info) {
                                                    new bootstrap.Tooltip(info.el, {
                                                        title: info.event.title,
                                                        placement: 'top',
                                                        trigger: 'hover',
                                                        container: 'body'
                                                    });
                                                },
                                                dateClick: function(info) {
                                                    const clickedDate = info.dateStr;
                                                    const events = calendar.getEvents().filter(event => event.startStr === clickedDate);
                                                    let totalSize = 0;

                                                    events.forEach(event => {
                                                        if (event.extendedProps.total_size) {
                                                            totalSize += event.extendedProps.total_size;
                                                        }
                                                    });

                                                    // Remove highlight from previous selection
                                                    if (selectedDateEl) {
                                                        selectedDateEl.classList.remove('selected-date-highlight');
                                                    }

                                                    // Find the clicked date cell and highlight it
                                                    selectedDateEl = info.dayEl;
                                                    selectedDateEl.classList.add('selected-date-highlight');

                                                    if (totalSize >= 4) {
                                                        const modal = document.getElementById('customApproveModal');
                                                        modal.style.display = 'block';

                                                        document.getElementById('approveCloseBtn').onclick = closeModal;
                                                        document.getElementById('approveCancelBtn').onclick = closeModal;
                                                        document.getElementById('confirmApproveBtn').onclick = function() {
                                                            finalScheduleInput.value = clickedDate;
                                                            finalScheduleInput.dispatchEvent(new Event('change'));
                                                            closeModal();
                                                        };

                                                        function closeModal() {
                                                            modal.style.display = 'none';
                                                        }
                                                    } else {
                                                        finalScheduleInput.value = clickedDate;
                                                        finalScheduleInput.dispatchEvent(new Event('change'));
                                                    }
                                                }
                                            });

                                            calendar.render();
                                        });
                                    </script>

                                    <div class="form-group col-md-12 mt-3">
                                        <x-input-label for="final_schedule" class="text-primary" :value="__('Final Schedule')" />
                                        <x-input-label for="final_schedule" :value="__('(Final Schedule for Servicing)')" />
                                        <x-text-input id="final_schedule" class="form-control" type="text"
                                            name="final_schedule" :value="old('final_schedule')" required autofocus
                                            autocomplete="final_schedule" placeholder="Enter Date"
                                            min="{{ now()->toDateString() }}" id="final_schedule" />
                                        <x-input-error :messages="$errors->get('final_schedule')" class="mt-2 text-danger" />
                                    </div>
                                </div>

                            </div>
                            <!-- Navigation Buttons -->
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
