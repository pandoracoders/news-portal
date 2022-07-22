<form class="row g-3" method="POST"
    action="{{ isset($testimonial) ? route('backend.edit-testimonial.post', ['testimonial' => $testimonial->id]) : route('backend.add-testimonial.post') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ isset($testimonial) ? 'Update' : 'Add' }} Testimonial</h6>
                        <hr>



                        @csrf
                        <div class="col-12">
                            <label class="form-label">Client Name</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('client_name') ? 'is-invalid' : '' }}"
                                name="client_name"
                                value="{{ isset($testimonial) ? $testimonial->client_name : old('client_name') }}">
                            @if (isset($errors) && $errors->has('client_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client_name') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Client Image</label>
                            <input
                                class="form-control {{ isset($errors) && $errors->has('client_image') ? 'is-invalid' : '' }}"
                                type="file" id="formFile" name="client_image"
                                onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                            @if (isset($errors) && $errors->has('client_image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client_image') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">Client Designation</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('client_designation') ? 'is-invalid' : '' }}"
                                client_designation="client_designation"
                                value="{{ isset($testimonial) ? $testimonial->client_designation : old('client_designation') }}">
                            @if (isset($errors) && $errors->has('client_designation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('client_designation') }}
                                </div>
                            @endif
                        </div>




                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <div class="col-12">
                            <label class="form-label">Title</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title"
                                value="{{ isset($testimonial) ? $testimonial->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label class="form-label">Testimonial</label>
                            <textarea class="form-control {{ isset($errors) && $errors->has('testimonial') ? 'is-invalid' : '' }}"
                                name="testimonial">{{ isset($testimonial) ? $testimonial->testimonial : old('testimonial') }}</textarea>
                            @if (isset($errors) && $errors->has('testimonial'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('testimonial') }}
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
                            {{ isset($testimonial) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.testimonial') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>

                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <img id="preview-image"
                                    src="{{ isset($testimonial) ? asset($testimonial->image) : '' }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
