<x-userlayout.layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Blocked Dates</h5>

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
                                        @foreach ($blockedDates as $schedule)
                                            {
                                                title: '{{ $schedule->reason }}',
                                                start: '{{ \Carbon\Carbon::parse($schedule->block_date)->toDateString() }}',
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
                        <h5 class="p-3">Blocked Dates</h5>
                        <div class="table-responsive">
                            <form id="blockdatesform" method="POST">
                                @csrf
                                <div class="d-flex gap-2">
                                    <a type="button" class="btn btn-success"
                                        href="{{ route('castrationandspay.user.blockdates.create') }}">Block Date</a>
                                    <button type="button" class="btn btn-danger ml-1" id="deleteBtn">Delete</button>
                                </div>
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Date</th>
                                            <th>Reason</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allBlockedDates as $datesBlocked)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $datesBlocked->id }}">
                                                </td>
                                                <td> {{ \Carbon\Carbon::parse($datesBlocked->block_date)->format('l, F j, Y') }}
                                                </td>
                                                <td>{{ $datesBlocked->reason }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <x-paginationlayout>
                            {{ $allBlockedDates->appends(request()->query())->links() }}
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
    {{--
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
    </div> --}}
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
        // const approveModal = document.getElementById('customApproveModal');

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

        // // Approve button - show modal
        // document.getElementById('approveBtn').addEventListener('click', function() {
        //     const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
        //     if (selected.length === 0) {
        //         alert('Please select at least one item to approve.');
        //     } else {
        //         showModal(approveModal);
        //     }
        // });

        // Delete Modal close buttons
        document.getElementById('deleteCloseBtn').addEventListener('click', () => hideModal(deleteModal));
        document.getElementById('deleteCancelBtn').addEventListener('click', () => hideModal(deleteModal));

        // Approve Modal close buttons
        // document.getElementById('approveCloseBtn').addEventListener('click', () => hideModal(approveModal));
        // document.getElementById('approveCancelBtn').addEventListener('click', () => hideModal(approveModal));

        // Confirm Delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const form = document.getElementById('blockdatesform');
            form.action = "{{ route('castrationandspay.user.blockdates.bulkdelete') }}";
            form.submit();
        });

        // Confirm Approve
        // document.getElementById('confirmApproveBtn').addEventListener('click', function() {
        //     const form = document.getElementById('blockdatesform');
        //     form.action = "{{ route('farmmechanization.user.pending.bulkapprove') }}";
        //     form.submit();
        // });

        // Optional: Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                hideModal(deleteModal);
            }
            // if (event.target === approveModal) {
            //     hideModal(approveModal);
            // }
        });
    </script>
</x-userlayout.layout>
