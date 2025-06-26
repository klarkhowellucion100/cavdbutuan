<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Banner</h4>
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
                    <div class="card-body text-center">

                        <img src="{{ asset('storage/' . $banner->banner_picture) }}" class="img-fluid rounded"
                            alt="Responsive image">
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
