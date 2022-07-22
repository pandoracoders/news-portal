<form class="row g-3" method="POST"
    action="{{ isset($service) ? route('backend.edit-service.post', ['service' => $service->id]) : route('backend.add-service.post') }}"
    enctype="multipart/form-data">

    @if (isset($errors))
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Add Service</h6>
                        <hr>
                        {{--  --}}

                        @csrf
                        <div class="col-12">
                            <label class="form-label">Ttile</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($service) ? $service->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Service Image</label>
                            <input
                                onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])"
                                class="form-control {{ isset($errors) && $errors->has('image') ? 'is-invalid' : '' }}"
                                type="file" id="formFile" name="image">
                            @if (isset($errors) && $errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">Excerpt</label>
                            <textarea class="form-control {{ isset($errors) && $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt">{{ isset($service) ? $service->excerpt : old('excerpt') }}</textarea>
                            @if (isset($errors) && $errors->has('excerpt'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('excerpt') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control {{ isset($errors) && $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description" id="editor">{{ isset($service) ? $service->description : old('description') }}</textarea>
                            @if (isset($errors) && $errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded mb-2">
                                <h6 class="mb-0 text-uppercase">Meta Data</h6>
                                <hr>
                                <div class="col-12">
                                    <label class="form-label">Meta Ttile</label>
                                    <input type="text"
                                        class="form-control {{ isset($errors) && $errors->has('meta_title') ? 'is-invalid' : '' }}"
                                        name="meta_title"
                                        value="{{ isset($service) ? $service->meta_title : old('meta_title') }}">
                                    @if (isset($errors) && $errors->has('meta_title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_title') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Meta Description</label>
                                    <textarea class="form-control {{ isset($errors) && $errors->has('meta_description') ? 'is-invalid' : '' }}"
                                        name="meta_description">{{ isset($service) ? $service->meta_description : old('meta_description') }}</textarea>
                                    @if (isset($errors) && $errors->has('meta_description'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_description') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label">Meta Kewords</label>
                                    {{-- {{ dd($service->meta_keywords) }} --}}
                                    <input type="text"
                                        class="form-control {{ isset($errors) && $errors->has('meta_keywords') ? 'is-invalid' : '' }}"
                                        data-role="tagsinput" name="meta_keywords" value="{{ isset($service) ? $service->meta_keywords : old('meta_keywords') }}" >


                                    @if (isset($errors) && $errors->has('meta_keywords'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('meta_keywords') }}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded mb-2">
                                <h6 class="mb-0 text-uppercase">Icon Selector</h6>
                                <hr>
                                <div class="col-12">
                                    <label for="formFile" class="form-label">Icon Selector</label>
                                    <select
                                        class="form-select mb-3 {{ isset($errors) && $errors->has('icon') ? 'is-invalid' : '' }}"
                                        name="icon">
                                        <option value="" selected="">Select Icon</option>
                                    </select>
                                    @if (isset($errors) && $errors->has('icon'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('icon') }}
                                        </div>
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>


                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-3 rounded mb-2">
                                <h6 class="mb-0 text-uppercase">Action</h6>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ isset($service) ? 'Update' : 'Save' }}
                                </button>

                                <a href="{{ route('backend.service') }}" class="btn btn-danger btn-block">
                                    Cancel
                                </a>

                            </div>

                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <img id="preview-image"
                                            src="{{ isset($service) ? asset($service->image) : '' }}"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>


</form>
