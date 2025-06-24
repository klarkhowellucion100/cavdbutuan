<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon bg-primary" href="#">
                                Scheduled
                                <p class="mb-0 w-6 badge badge-pill badge-warning">
                                    {{ $scheduledOperationCount->total_count }}
                                </p>
                            </a>
                            <a class="button btn button-icon btn-outline-primary fw-bold" href="#">
                                Served
                                <p class="mb-0 w-6 badge badge-pill badge-success">
                                    {{ $servedClientsCount->total_count }}
                                </p>
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
                        <h5 class="p-3">Client Operation Schedule</h5>

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
                                        @foreach ($scheduledOperation as $schedule)
                                            {
                                                title: 'Client: {{ number_format($schedule->total_count) }}',
                                                start: '{{ \Carbon\Carbon::parse($schedule->visitation_schedule)->toDateString() }}',
                                                color: '#007bff',
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
                        <h5 class="p-3">Scheduled Clients (Castration and Spay)</h5>
                        <form method="GET" action="{{ route('castrationandspay.user.scheduled.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('castrationandspay.user.scheduled.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="operationForm" method="POST">
                                @csrf

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                                    <button type="button" class="btn btn-success ml-1" id="servedBtn">Served</button>
                                </div>
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Transaction No.</th>
                                            <th>Operation Date</th>
                                            <th>Service</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Pet Type</th>
                                            <th>Pet Name</th>
                                            <th>Pet Sex</th>
                                            <th>Pet Specie</th>
                                            <th>Pet Age</th>
                                            <th>Pet Color</th>
                                            <th>Vaccination Card</th>
                                            <th>Form</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($scheduledOperationList as $operationList)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $operationList->id }}">
                                                </td>
                                                <td>
                                                    {{ $operationList->transaction_number }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($operationList->visitation_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ $operationList->service_type }}</td>
                                                <td>{{ $operationList->full_name }}</td>
                                                <td>{{ $operationList->contact_number }}</td>
                                                <td>{{ $operationList->email }}</td>
                                                <td>{{ $operationList->barangay }}
                                                    {{ $operationList->municipality }}
                                                    {{ $operationList->province }} {{ $operationList->region }}
                                                </td>
                                                <td>{{ $operationList->animal_type }}</td>
                                                <td>{{ $operationList->animal_name }}</td>
                                                <td>{{ $operationList->animal_sex }}</td>
                                                <td>{{ $operationList->animal_specie }}</td>
                                                <td>
                                                    Year:{{ $operationList->animal_age_year }}
                                                    <br>
                                                    Month:{{ $operationList->animal_age_month }}
                                                </td>
                                                <td>{{ $operationList->animal_color }}</td>
                                                <td>
                                                    <a href="{{ route('castrationandspay.user.scheduled.card', $operationList->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0
                                                                0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5
                                                                7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3
                                                                3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125
                                                                1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0
                                                                1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />

                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('castrationandspay.user.scheduled.form', $operationList->id) }}"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                                            </svg>
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <x-paginationlayout>
                            {{ $scheduledOperationList->appends(request()->query())->links() }}
                        </x-paginationlayout>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="customDeleteModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="deleteCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Deletion</div>
            <div>Are you sure you want to delete the selected data?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="deleteCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="customServedModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="servedCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Served</div>
            <div>Are you sure you want to approve the selected items?</div>
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
        const deleteModal = document.getElementById('customDeleteModal');
        const servedModal = document.getElementById('customServedModal');

        // Select all / checkboxes logic (assuming you have these buttons and checkboxes)
        document.getElementById('selectAll').addEventListener('click', function(e) {
            const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
            checkboxes.forEach(cb => cb.checked = e.target.checked);
        });

        // Delete button - show modal
        document.getElementById('deleteBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Please select at least one item to delete.');
            } else {
                showModal(deleteModal);
            }
        });

        // Served button - show modal
        document.getElementById('servedBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Please select at least one item to update the status.');
            } else {
                showModal(servedModal);
            }
        });

        // Delete Modal close buttons
        document.getElementById('deleteCloseBtn').addEventListener('click', () => hideModal(deleteModal));
        document.getElementById('deleteCancelBtn').addEventListener('click', () => hideModal(deleteModal));

        // Served Modal close buttons
        document.getElementById('servedCloseBtn').addEventListener('click', () => hideModal(servedModal));
        document.getElementById('servedCancelBtn').addEventListener('click', () => hideModal(servedModal));

        // Confirm Delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const form = document.getElementById('operationForm');
            form.action = "{{ route('castrationandspay.user.scheduled.bulkdelete') }}";
            form.submit();
        });

        // Confirm Served
        document.getElementById('confirmServedBtn').addEventListener('click', function() {
            const form = document.getElementById('operationForm');
            form.action = "{{ route('castrationandspay.user.scheduled.bulkserved') }}";
            form.submit();
        });

        // Optional: Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                hideModal(deleteModal);
            }
            if (event.target === servedModal) {
                hideModal(servedModal);
            }
        });
    </script>

</x-userlayout.layout>
