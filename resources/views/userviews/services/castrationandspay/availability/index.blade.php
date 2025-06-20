<x-userlayout.layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Availability of Services</h5>
                        <div class="table-responsive">
                            <form id="availabilityform" method="POST">
                                @csrf
                                <div class="d-flex gap-2">
                                    <a type="button" class="btn btn-success"
                                        href="{{ route('castrationandspay.user.availability.create') }}">Create</a>
                                    <button type="button" class="btn btn-danger ml-1" id="deleteBtn">Delete</button>
                                    <button type="button" class="btn btn-secondary ml-1"
                                        id="disableBtn">Disable</button>
                                    <button type="button" class="btn btn-primary ml-1" id="enableBtn">Enable</button>
                                </div>
                                <table class="table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Day</th>
                                            <th>Time From</th>
                                            <th>Time To</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($availabilityDates as $available)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $available->id }}">
                                                </td>
                                                <td>{{ $available->day_name }}</td>
                                                <td> {{ \Carbon\Carbon::parse($available->time_from)->format('g:i A') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($available->time_to)->format('g:i A') }}
                                                </td>
                                                <td>
                                                    @if ($available->status === 1)
                                                        <span class="text-primary">Enabled</span>
                                                    @else
                                                        <span class="text-secondary">Disabled</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        {{-- <x-paginationlayout>
                            {{ $allBlockedDates->appends(request()->query())->links() }}
                        </x-paginationlayout> --}}
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

    <div id="customDisableModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="disableCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Disable</div>
            <div>Are you sure you want to disable the selected items?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="disableCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDisableBtn">Yes, Disable</button>
            </div>
        </div>
    </div>

    <div id="customEnableModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="enableCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Enable</div>
            <div>Are you sure you want to enable the selected items?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="enableCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmEnableBtn">Yes, Enable</button>
            </div>
        </div>
    </div>

    {{-- <div id="customDeleteModal" class="custom-modal">
        <div class="custom-modal-content">
            <button class="custom-close-btn" id="deleteCloseBtn">&times;</button>
            <div class="custom-modal-header">Confirm Deletion</div>
            <div>Are you sure you want to delete the selected items?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="deleteCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
            </div>
        </div>
    </div> --}}
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
        const disableModal = document.getElementById('customDisableModal');
        const enableModal = document.getElementById('customEnableModal');

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

        // // Disable button - show modal
        document.getElementById('disableBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Please select at least one item to approve.');
            } else {
                showModal(disableModal);
            }
        });

        // // Enable button - show modal
        document.getElementById('enableBtn').addEventListener('click', function() {
            const selected = document.querySelectorAll('input[name="selected_ids[]"]:checked');
            if (selected.length === 0) {
                alert('Please select at least one item to approve.');
            } else {
                showModal(enableModal);
            }
        });

        // Delete Modal close buttons
        document.getElementById('deleteCloseBtn').addEventListener('click', () => hideModal(deleteModal));
        document.getElementById('deleteCancelBtn').addEventListener('click', () => hideModal(deleteModal));

        // Disable Modal close buttons
        document.getElementById('disableCloseBtn').addEventListener('click', () => hideModal(disableModal));
        document.getElementById('disableCancelBtn').addEventListener('click', () => hideModal(disableModal));

        // Disable Modal close buttons
        document.getElementById('enableCloseBtn').addEventListener('click', () => hideModal(enableModal));
        document.getElementById('enableCancelBtn').addEventListener('click', () => hideModal(enableModal));

        // Confirm Delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const form = document.getElementById('availabilityform');
            form.action = "{{ route('castrationandspay.user.availability.bulkdelete') }}";
            form.submit();
        });

        // Confirm Disable
        document.getElementById('confirmDisableBtn').addEventListener('click', function() {
            const form = document.getElementById('availabilityform');
            form.action = "{{ route('castrationandspay.user.availability.bulkdisable') }}";
            form.submit();
        });

        // Confirm Enable
        document.getElementById('confirmEnableBtn').addEventListener('click', function() {
            const form = document.getElementById('availabilityform');
            form.action = "{{ route('castrationandspay.user.availability.bulkenable') }}";
            form.submit();
        });

        // Optional: Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                hideModal(deleteModal);
            }
            if (event.target === disableModal) {
                hideModal(disableModal);
            }
            if (event.target === enableModal) {
                hideModal(enableModal);
            }
        });
    </script>
</x-userlayout.layout>
