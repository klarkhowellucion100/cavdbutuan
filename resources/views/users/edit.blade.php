<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Update User ({{ $user->name }})</h4>
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
                        <a href="{{ route('manageusers.index') }}"
                            class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('manageusers.update', $user->id) }}"
                                        enctype="multipart/form-data",>
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <x-input-label for="reg_status" class="text-primary"
                                                    :value="__('Status')" />
                                                <div class="input-group">
                                                    <select class="form-control" style="color:grey;" name="reg_status"
                                                        required>
                                                        <option value="{{ $user->reg_status }}">
                                                            @if ($user->reg_status == 1)
                                                                <div class="text-info fw-bold">{{ 'Accepted' }}</div>
                                                            @elseif ($user->reg_status == 2)
                                                                <div class="text-danger fw-bold">
                                                                    {{ 'Declined' }}
                                                                </div>
                                                            @else
                                                                <div class="text-warning fw-bold">
                                                                    {{ 'Pending' }}
                                                                </div>
                                                            @endif
                                                        </option>
                                                        <option value="1">Accept</option>
                                                        <option value="2">Decline</option>
                                                    </select>
                                                </div>
                                                <x-input-error :messages="$errors->get('reg_status')" class="mt-2 text-danger" />
                                            </div>

                                            <div class="form-group col-md-6">
                                                <x-input-label for="role" class="text-primary" :value="__('Role')" />
                                                <div class="input-group">
                                                    <select class="form-control" style="color:grey;" name="role"
                                                        required>
                                                        <option value="{{ $user->role }}">
                                                            @if ($user->role == 1)
                                                                <div class="text-info fw-bold">{{ 'Admin' }}</div>
                                                            @elseif ($user->role == 2)
                                                                <div class="text-info fw-bold">{{ 'User' }}
                                                                </div>
                                                            @else
                                                                <div class="text-primary fw-bold">
                                                                    {{ 'Pending' }}
                                                                </div>
                                                            @endif
                                                        </option>
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                    </select>
                                                </div>
                                                <x-input-error :messages="$errors->get('role')" class="mt-2 text-danger" />
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="submitBtn">Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
