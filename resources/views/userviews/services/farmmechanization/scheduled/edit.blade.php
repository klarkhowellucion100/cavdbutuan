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

        <div class="row">
            <div class="col-lg-12">
                <section id="page-content">
                    <div class="container">
                        <div class="pb-3">
                            <a href="{{ route('farmmechanization.user.scheduled.index') }}"
                                class="btn btn-primary waves-effect waves-light w-md">
                                Back
                            </a>
                        </div>
                        <div class="row">
                            <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="h4">Rescheduling of Service</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('farmmechanization.user.scheduled.update', $updateSchedule->id) }}">
                                            @method('PUT')
                                            @csrf

                                            <div class="wizard-step" id="step-1">
                                                <h5 style="margin-bottom:10px;">Step 1: Reschedule</h5>
                                                <div class="form-row">
                                                    <div id="calendar" class="mb-3"></div>

                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const calendarEl = document.getElementById('calendar');
                                                            const finalScheduleInput = document.getElementById('final_schedule');
                                                            const rescheduleHtml = document.getElementById('resched');
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
                                                                        rescheduleHtml.innerHTML = clickedDate;
                                                                    }
                                                                }
                                                            });

                                                            calendar.render();
                                                        });
                                                    </script>

                                                    <div class="col-md-6">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-primary"
                                                                            style="font-weight: bold;">Original Date
                                                                        </td>
                                                                        <td>{{ $updateSchedule->final_schedule }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-primary"
                                                                            style="font-weight: bold;">Rescheduled
                                                                            Date</td>
                                                                        <td><span id="resched"></span></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 d-none">
                                                        <x-input-label for="final_schedule" class="text-primary"
                                                            :value="__('Rescheduled Date')" />
                                                        <x-input-label for="final_schedule" :value="__('Rescheduled Date for Servicing)')" />
                                                        <x-text-input id="final_schedule" class="form-control"
                                                            type="text" name="final_schedule" :value="$updateSchedule->final_schedule"
                                                            required autofocus autocomplete="final_schedule"
                                                            placeholder="Enter Date" id="final_schedule" />
                                                        <x-input-error :messages="$errors->get('final_schedule')" class="mt-2 text-danger" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wizard-step d-none" id="step-2">
                                                <h5>Step 2: Changes in Cash Collection Details</h5>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <x-input-label for="fees_charge" class="text-primary"
                                                            :value="__('Fee')" />
                                                        <x-text-input id="fees_charge" class="form-control"
                                                            type="text" name="fees_charge" :value="$updateSchedule->fees_charge" required
                                                            autofocus autocomplete="fees_charge"
                                                            placeholder="Enter Fee" />
                                                        <x-input-error :messages="$errors->get('fees_charge')" class="mt-2 text-danger" />
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
