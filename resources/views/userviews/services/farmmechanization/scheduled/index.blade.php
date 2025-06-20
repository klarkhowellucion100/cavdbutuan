<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon btn-outline-primary"
                                href="{{ route('farmmechanization.user.pending.index') }}">
                                Pending
                                <p class="mb-0 w-6 badge badge-pill badge-danger">
                                    {{ $pendingVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('farmmechanization.user.approved.index') }}">
                                Approved
                                <p class="mb-0 w-6 badge badge-pill badge-warning">
                                    {{ $approvedVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon bg-primary fw-bold"
                                href="{{ route('farmmechanization.user.scheduled.index') }}">
                                Scheduled
                                <p class="mb-0 w-6 badge badge-pill badge-success">
                                    {{ $scheduledVisitationCount->total_count }}</p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold"
                                href="{{ route('farmmechanization.user.served.index') }}">
                                Served
                                <p class="mb-0 w-6 badge badge-pill badge-secondary">
                                    {{ $servedClientsCount->total_count }}</p>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Service Schedule</h5>

                        <div id="calendar"></div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const calendarEl = document.getElementById('calendar');

                                const calendar = new FullCalendar.Calendar(calendarEl, {
                                    initialView: 'dayGridMonth',
                                    height: 'auto',
                                    contentHeight: 'auto',
                                    aspectRatio: 1.5,
                                    events: [
                                        @foreach ($scheduledVisitation as $schedule)
                                            {
                                                title: 'Client: {{ number_format($schedule->total_count) }}; Area: {{ number_format($schedule->total_area) }} ha',
                                                start: '{{ $schedule->final_schedule }}',
                                                color: '#28a745',
                                                extendedProps: {
                                                    priority: 1
                                                }
                                            },
                                        @endforeach
                                    ],
                                    eventOrder: function(a, b) {
                                        return a.extendedProps.priority - b.extendedProps.priority;
                                    },
                                    eventDidMount: function(info) {
                                        new bootstrap.Tooltip(info.el, {
                                            title: info.event.title,
                                            placement: 'top',
                                            trigger: 'hover',
                                            container: 'body'
                                        });
                                    },
                                    dateClick: function(info) {
                                        const selectedDate = info.dateStr;
                                        const url = new URL(window.location.href);
                                        url.searchParams.set('filter_date', selectedDate);
                                        window.location.href = url.toString();
                                    }
                                });

                                calendar.render();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Scheduled Clients (Farm Mechanization)</h5>
                        <form method="GET" action="{{ route('farmmechanization.user.scheduled.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('farmmechanization.user.scheduled.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="servedForm" method="POST">
                                @csrf

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success ml-1" id="servedBtn">Served</button>
                                </div>

                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Transaction No.</th>
                                            <th>Service Schedule</th>
                                            <th>Area (Ha)</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Request Form and Cash Collection Slip</th>
                                            <th>Reschedule</th>
                                            <th>Upload OR</th>
                                            <th>Delete Transaction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scheduledVisitationList as $visitationList)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $visitationList->id }}">
                                                </td>
                                                <td>
                                                    {{ $visitationList->transaction_number }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($visitationList->final_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ number_format($visitationList->area_size, 2) }}</td>
                                                <td>{{ $visitationList->full_name }}</td>
                                                <td>{{ $visitationList->contact_number }}</td>
                                                <td>{{ $visitationList->email }}</td>
                                                <td>{{ $visitationList->barangay }}
                                                    {{ $visitationList->municipality }}
                                                    {{ $visitationList->province }} {{ $visitationList->region }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('farmmechanization.user.scheduled.form', $visitationList->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('farmmechanization.user.scheduled.edit', $visitationList->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('farmmechanization.user.scheduled.upload', $visitationList->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-id="{{ $visitationList->id }}"
                                                        data-bs-target="#deleteModal"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <x-paginationlayout>
                            {{ $scheduledVisitationList->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Deletion</h5>
                                    <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this record? This action cannot be undone.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>

                                    <form method="POST" id="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const deleteModal = document.getElementById('deleteModal');
                            deleteModal.addEventListener('show.bs.modal', function(event) {
                                const button = event.relatedTarget;
                                const id = button.getAttribute('data-id');

                                const form = document.getElementById('deleteForm');
                                const action =
                                    `{{ url('farmmechanization/user/scheduled/admindelete') }}/${id}`;
                                form.setAttribute('action', action);
                            });
                        });
                    </script>

                    <!-- Approve Confirmation Modal -->
                    <div id="customServedModal" class="custom-modal">
                        <div class="custom-modal-content">
                            <button class="custom-close-btn" id="servedCloseBtn">&times;</button>
                            <div class="custom-modal-header">Confirm Served</div>
                            <div>Are you sure you want to change ths status of the selected items?</div>
                            <div class="custom-modal-footer">
                                <button class="btn btn-secondary" id="servedCancelBtn">Cancel</button>
                                <button class="btn btn-success" id="confirmServedBtn">Yes, Approve</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Helper function to show modal
                        function showModal(modal) {
                            modal.style.display = 'block';
                        }
                        // Helper function to hide modal
                        function hideModal(modal) {
                            modal.style.display = 'none';
                        }

                        // Elements
                        const servedModal = document.getElementById('customServedModal');

                        // Select all / checkboxes logic (assuming you have these buttons and checkboxes)
                        document.getElementById('selectAll').addEventListener('click', function(e) {
                            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
                            checkboxes.forEach(cb => cb.checked = e.target.checked);
                        });

                        // Approve button - show modal
                        document.getElementById('servedBtn').addEventListener('click', function() {
                            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
                            if (selected.length === 0) {
                                alert('Please select at least one item to approve.');
                            } else {
                                showModal(servedModal);
                            }
                        });

                        // Served Modal close buttons
                        document.getElementById('servedCloseBtn').addEventListener('click', () => hideModal(servedModal));
                        document.getElementById('servedCancelBtn').addEventListener('click', () => hideModal(servedModal));

                        // Confirm served
                        document.getElementById('confirmServedBtn').addEventListener('click', function() {
                            const form = document.getElementById('servedForm');
                            form.action = "{{ route('farmmechanization.user.served.bulkserved') }}";
                            form.submit();
                        });

                        // Optional: Close modal if user clicks outside the modal content
                        window.addEventListener('click', function(event) {
                            if (event.target === deleteModal) {
                                hideModal(deleteModal);
                            }
                            if (event.target === approveModal) {
                                hideModal(approveModal);
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

</x-userlayout.layout>
