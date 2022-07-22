<form class="row g-3" method="POST"
    action="{{ isset($team) ? route('backend.edit-team.post', ['team' => $team->id]) : route('backend.add-team.post') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ isset($team) ? 'Update' : 'Add' }} Testimonial</h6>
                        <hr>



                        @csrf
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('name') ? 'is-invalid' : '' }}"
                                name="name" value="{{ isset($team) ? $team->name : old('name') }}">
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
                            <label class="form-label">Designation</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('designation') ? 'is-invalid' : '' }}"
                                name="designation"
                                value="{{ isset($team) ? $team->designation : old('designation') }}">
                            @if (isset($errors) && $errors->has('designation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('designation') }}
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
                            <label class="form-label">Facebook Profile</label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('facebook') ? 'is-invalid' : '' }}"
                                name="facebook" value="{{ isset($team) ? $team->facebook : old('facebook') }}">
                            @if (isset($errors) && $errors->has('facebook'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facebook') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label class="form-label">Twitter Profile</label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('twitter') ? 'is-invalid' : '' }}"
                                name="twitter" value="{{ isset($team) ? $team->twitter : old('twitter') }}">
                            @if (isset($errors) && $errors->has('twitter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('twitter') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <label class="form-label">Linkedin Profile</label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('linkedin') ? 'is-invalid' : '' }}"
                                name="linkedin" value="{{ isset($team) ? $team->linkedin : old('linkedin') }}">
                            @if (isset($errors) && $errors->has('linkedin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('linkedin') }}
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
                            {{ isset($team) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.team') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>

                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <img id="preview-image" src="{{ isset($team) ? asset($team->image) : '' }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
