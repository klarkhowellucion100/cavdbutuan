<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Upload Banner</h4>
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
                        <a href="{{ route('banners.user.index') }}"
                            class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('banners.user.store') }}"
                                        enctype="multipart/form-data",>
                                        @method('POST')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="banner_picture"
                                                        name="banner_picture">
                                                    <label class="custom-file-label" for="banner_picture">Choose
                                                        file</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('banner_picture')" class="mt-2 text-danger" />
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
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
