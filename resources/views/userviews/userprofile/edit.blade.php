<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Update Profile</h4>
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
                        <a href="{{ route('dashboard.farmmechanization') }}" class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('editprofile.userviews.update', $userProfile->id) }}"
                                        enctype="multipart/form-data",>
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <x-input-label for="name" class="text-primary" :value="__('Name')" />
                                                <x-text-input id="name" class="form-control" type="text"
                                                    required name="name" :value="$userProfile->name" autofocus
                                                    autocomplete="name" placeholder="Enter Name" />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <x-input-label for="email" class="text-primary" :value="__('Email')" />
                                                <x-text-input id="email" class="form-control" type="email"
                                                    required name="email" :value="$userProfile->email" autofocus
                                                    autocomplete="email" placeholder="Enter Email" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <x-input-label for="position" class="text-primary" :value="__('Position')" />
                                                <x-text-input id="position" class="form-control" type="position"
                                                    required name="position" :value="$userProfile->position" autofocus
                                                    autocomplete="position" placeholder="Enter Content" />
                                                <x-input-error :messages="$errors->get('position')" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Update
                                        </button>
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
