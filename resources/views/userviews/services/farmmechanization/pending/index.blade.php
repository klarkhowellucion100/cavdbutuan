<x-userlayout.layout>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline p-0 m-0 text-center">
                    <li class="">
                        <div class="btn-group btn-group-toggle">
                            <a class="button btn button-icon bg-primary"
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
                            <a class="button btn button-icon btn-outline-primary fw-bold"
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
                        <h5 class="p-3">Client Visitation Schedule</h5>

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
                                        @foreach ($pendingVisitation as $schedule)
                                            {
                                                title: 'Client: {{ number_format($schedule->total_count) }} : Area: {{ number_format($schedule->total_area, 2) }} ha',
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
                        <h5 class="p-3">Pending Clients (Farm Mechanization)</h5>
                        <form method="GET" action="{{ route('farmmechanization.user.pending.index') }}"
                            class="mb-3 d-flex gap-2 align-items-center">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by name, transaction no., etc." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                            @if (request('search'))
                                <a href="{{ route('farmmechanization.user.pending.index') }}"
                                    class="btn btn-secondary">Clear</a>
                            @endif
                        </form>
                        <div class="table-responsive">
                            <form id="visitationForm" method="POST">
                                @csrf

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                                    <button type="button" class="btn btn-success ml-1" id="approveBtn">Approve</button>
                                </div>
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Transaction No.</th>
                                            <th>Visit Date</th>
                                            <th>Proposed Land Preparation Date</th>
                                            <th>Area (Ha)</th>
                                            <th>Name</th>
                                            <th>Contact No.</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingVisitationList as $visitationList)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $visitationList->id }}">
                                                </td>
                                                <td>
                                                    {{ $visitationList->transaction_number }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($visitationList->visitation_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($visitationList->proposed_schedule)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ number_format($visitationList->area_size, 2) }}</td>
                                                <td>{{ $visitationList->full_name }}</td>
                                                <td>{{ $visitationList->contact_number }}</td>
                                                <td>{{ $visitationList->email }}</td>
                                                <td>{{ $visitationList->barangay }}
                                                    {{ $visitationList->municipality }}
                                                    {{ $visitationList->province }} {{ $visitationList->region }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <x-paginationlayout>
                            {{ $pendingVisitationList->appends(request()->query())->links() }}
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
            <div>Are you sure you want to delete the selected items?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="deleteCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div>

    <!-- Approve Confirmation Modal -->
    <div id="customApproveModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="approveCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Approval</div>
            <div>Are you sure you want to approve the selected items?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="approveCancelBtn">Cancel</button>
                <button class="btn btn-success" id="confirmApproveBtn">Yes, Approve</button>
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
        const approveModal = document.getElementById('customApproveModal');

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

        // Approve button - show modal
        document.getElementById('approveBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Please select at least one item to approve.');
            } else {
                showModal(approveModal);
            }
        });

        // Delete Modal close buttons
        document.getElementById('deleteCloseBtn').addEventListener('click', () => hideModal(deleteModal));
        document.getElementById('deleteCancelBtn').addEventListener('click', () => hideModal(deleteModal));

        // Approve Modal close buttons
        document.getElementById('approveCloseBtn').addEventListener('click', () => hideModal(approveModal));
        document.getElementById('approveCancelBtn').addEventListener('click', () => hideModal(approveModal));

        // Confirm Delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const form = document.getElementById('visitationForm');
            form.action = "{{ route('farmmechanization.user.pending.bulkdelete') }}";
            form.submit();
        });

        // Confirm Approve
        document.getElementById('confirmApproveBtn').addEventListener('click', function() {
            const form = document.getElementById('visitationForm');
            form.action = "{{ route('farmmechanization.user.pending.bulkapprove') }}";
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

</x-userlayout.layout>
