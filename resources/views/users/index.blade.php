<x-userlayout.layout>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="p-3">Users</h5>
                        <div class="table-responsive">
                            <form id="operationForm" method="POST">
                                @csrf

                                <div class="d-flex gap-2">
                                    {{-- <a class="btn btn-primary mr-2" href="{{ route('banners.user.create') }}">Create</a> --}}
                                    <button type="button" class="btn btn-danger" id="deleteBtn">Delete</button>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_ids[]"
                                                        value="{{ $user->id }}">
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                <td>
                                                    @if ($user->reg_status == 1)
                                                        <div class="text-success fw-bold" style="font-weight:bold;">
                                                            Accepted</div>
                                                    @elseif ($user->reg_status == 2)
                                                        <div class="text-danger fw-bold" style="font-weight:bold;">
                                                            Declined</div>
                                                    @else
                                                        <div class="text-warning fw-bold" style="font-weight:bold;">
                                                            Pending</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->role == 1)
                                                        <div class="text-success fw-bold" style="font-weight:bold;">
                                                            Admin</div>
                                                    @elseif ($user->role == 2)
                                                        <div class="text-primary fw-bold" style="font-weight:bold;">User
                                                        </div>
                                                    @else
                                                        <div class="text-warning fw-bold" style="font-weight:bold;">
                                                            Pending</div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('manageusers.edit', $user->id) }}"
                                                        class="btn btn-sm btn-outline-warning">
                                                        <i class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                fill="none" viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
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
                            {{ $users->appends(request()->query())->links() }}
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
            <div>Are you sure you want to delete the selected User?</div>
            <div class="custom-modal-footer">
                <button class="btn btn-secondary" id="deleteCancelBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
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

        // Delete Modal close buttons
        document.getElementById('deleteCloseBtn').addEventListener('click', () => hideModal(deleteModal));
        document.getElementById('deleteCancelBtn').addEventListener('click', () => hideModal(deleteModal));

        // Confirm Delete
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const form = document.getElementById('operationForm');
            form.action = "{{ route('manageusers.bulkdelete') }}";
            form.submit();
        });

        // Optional: Close modal if user clicks outside the modal content
        window.addEventListener('click', function(event) {
            if (event.target === deleteModal) {
                hideModal(deleteModal);
            }
        });
    </script>

</x-userlayout.layout>
