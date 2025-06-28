<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create News</h4>
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
                        <a href="{{ route('news.user.index') }}" class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>
                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('news.user.store') }}"
                                        enctype="multipart/form-data",>
                                        @method('POST')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <x-input-label for="published_at" class="text-primary"
                                                    :value="__('Date Published')" />
                                                <x-text-input id="published_at" class="form-control" type="date"
                                                    name="published_at" :value="old('published_at')" autofocus required
                                                    autocomplete="published_at" placeholder="Date Published" />
                                                <x-input-error :messages="$errors->get('published_at')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <x-input-label for="title" class="text-primary" :value="__('Title')" />
                                                <x-text-input id="title" class="form-control" type="text"
                                                    required name="title" :value="old('title')" autofocus
                                                    autocomplete="title" placeholder="Enter Title" />
                                                <x-input-error :messages="$errors->get('title')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <x-input-label for="content" class="text-primary" :value="__('Content')" />
                                                <x-text-input id="content" class="form-control" type="text"
                                                    required name="content" :value="old('content')" autofocus
                                                    autocomplete="content" placeholder="Enter Content" />
                                                <x-input-error :messages="$errors->get('content')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-group col-md-12">
                                                <x-input-label for="title" class="text-primary" :value="__('Upload Image')" />
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="image"
                                                        name="image" required>
                                                    <label class="custom-file-label" for="image">Choose
                                                        file</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('v')" class="mt-2 text-danger" />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Publish
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
