<form class="row g-3" method="POST"
    action="{{ isset($project) ? route('backend.edit-project.post', ['project' => $project->id]) : route('backend.add-project.post') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ isset($project) ? 'Update' : 'Add' }} Testimonial</h6>
                        <hr>

                        {{-- errors --}}
                        @if (isset($errors))
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif


                        @csrf
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ isset($project) ? $project->name : old('name') }}">
                            @if (isset($errors) && $errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Image</label>
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
                            <label class="form-label">Description</label>
                            <textarea class="form-control {{ isset($errors) && $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description" rows="5" cols="10">{{ isset($project) ? $project->description : old('description') }}</textarea>
                            @if (isset($errors) && $errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">Link</label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('link') ? 'is-invalid' : '' }}"
                                name="link" value="{{ isset($project) ? $project->link : old('link') }}">
                            @if (isset($errors) && $errors->has('link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('link') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="services" class="form-label">Services</label>
                            <select
                                class="form-select mb-3 {{ isset($errors) && $errors->has('service_id') ? 'is-invalid' : '' }}"
                                name="service_id">

                                <option value="" selected="">Select Services</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ (isset($project) && $project->service_id == $service->id) || old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->title }}
                                    </option>
                                @endforeach


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

            <div class="card mt-2">
                <div class="card-body">
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
                                            data-role="tagsinput" name="meta_keywords"
                                            value="{{ isset($service) ? $service->meta_keywords : old('meta_keywords') }}">


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
                            {{ isset($project) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.project') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>

                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <img id="preview-image" src="{{ isset($project) ? asset($project->image) : '' }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
