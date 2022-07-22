<form class="row g-3" method="POST"
    action="{{ isset($affiliate) ? route('backend.edit-affiliate.post', ['affiliate' => $affiliate->id]) : route('backend.add-affiliate.post') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ isset($affiliate) ? 'Update' : 'Add' }} Slider</h6>
                        <hr>

                        @if ($errors)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        @csrf
                        <div class="col-12">
                            <label class="form-label">Company Name</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ isset($affiliate) ? $affiliate->name : old('name') }}">
                            @if (isset($errors) && $errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Company Image</label>
                            <input
                                class="form-control {{ isset($errors) && $errors->has('image') ? 'is-invalid' : '' }}"
                                type="file" id="formFile" name="image"
                                onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                            @if (isset($errors) && $errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">URL</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('link') ? 'is-invalid' : '' }}"
                                name="link" value="{{ isset($affiliate) ? $affiliate->link : old('link') }}">
                            @if (isset($errors) && $errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ isset($affiliate) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.affiliate') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>

                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <img id="preview-image" src="{{ isset($affiliate) ? asset($affiliate->image) : '' }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
