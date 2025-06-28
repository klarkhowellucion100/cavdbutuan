<x-userlayout.layout>
    <div class="row">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="pb-3">
                        <a href="{{ route('news.user.index') }}" class="btn btn-primary waves-effect waves-light w-md">
                            Back
                        </a>
                    </div>

                    <div class="row">
                        <div class="content col-lg-12 col-md-8 col-sm-12 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <span class="h4">Update Image</span>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('news.user.updatepic', $news->id) }}"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="custom-file mb-3">
                                                    <input type="file" class="custom-file-input" id="image"
                                                        name="image">
                                                    <label class="custom-file-label" for="image">Choose
                                                        file</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('image')" class="mt-2 text-danger" />
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
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $news->image) }}" class="img-fluid rounded"
                            alt="Responsive image">
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-userlayout.layout>
