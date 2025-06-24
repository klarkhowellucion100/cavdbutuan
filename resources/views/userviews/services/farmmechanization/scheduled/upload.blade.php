<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">OR Uploaded</h4>
                    </div>
                    <div class="header-action">
                        <i data-toggle="collapse" data-target="#images-1">
                            <svg width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="pb-3">
                        <a href="{{ route('farmmechanization.user.scheduled.index') }}"
                            class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    @if ($fileExists)
                        @if ($fileExists->id === null)
                        @else
                            <!-- Show the uploaded image -->
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-primary" style="font-weight: bold">OR Number</td>
                                        <td>{{ $fileExists->or_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-primary" style="font-weight: bold">OR Date</td>
                                        <td>{{ $fileExists->or_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-body text-center">
                                <div class="container mb-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="list-inline p-0 m-0 text-center">
                                                <li class="">
                                                    <!-- Delete Button triggers Modal -->
                                                    <button type="button"
                                                        class="button btn button-icon bg-danger fw-bold"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                <button type="button" class="custom-close-btn" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this record? This action cannot be
                                                undone.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>

                                                <!-- Form to delete record -->
                                                <form method="POST"
                                                    action="{{ route('farmmechanization.user.scheduled.delete', $fileExists->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <img src="{{ asset('storage/' . $fileExists->uploaded_file) }}"
                                    class="img-fluid rounded" alt="Responsive image">
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <span class="h4">Upload OR</span>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST"
                                            action="{{ route('farmmechanization.user.scheduled.uploadstore') }}"
                                            enctype="multipart/form-data",>
                                            @method('POST')
                                            @csrf
                                            <input type="hidden" name="farm_mechanization_id"
                                                value="{{ $uploadFile->id }}">
                                            <input type="hidden" name="transaction_number"
                                                value="{{ $uploadFile->transaction_number }}">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <x-input-label for="or_number" class="text-primary"
                                                        :value="__('Or Number')" />
                                                    <x-text-input id="or_number" class="form-control" type="text"
                                                        name="or_number" :value="old('or_number')" autofocus required
                                                        autocomplete="or_number" placeholder="Enter Or Number" />
                                                    <x-input-error :messages="$errors->get('or_number')" class="mt-2 text-danger" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <x-input-label for="or_date" class="text-primary"
                                                        :value="__('OR Date')" />
                                                    <x-text-input id="or_date" class="form-control" type="date"
                                                        name="or_date" :value="old('or_date')" autofocus
                                                        autocomplete="or_date" placeholder="Enter Details" required />
                                                    <x-input-error :messages="$errors->get('or_date')" class="mt-2 text-danger" />
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-file mb-3">
                                                        <input type="file" class="custom-file-input"
                                                            id="uploaded_file" name="uploaded_file">
                                                        <label class="custom-file-label" for="uploaded_file">Choose
                                                            file</label>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('uploaded_file')" class="mt-2 text-danger" />
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="submitBtn">Upload
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="line"></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
