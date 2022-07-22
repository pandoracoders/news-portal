<form class="row g-3" method="POST" action="{{ route('backend.update-setting.post', ['setting' => $setting->id]) }}"
    enctype="multipart/form-data">
    <div class="row">

        <div class="col-xl-8 mx-auto">

            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Background Images ( 1920 X 463 )</h6>
                        <hr>
                        @csrf

                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">Contact Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('contact_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="contact_bg_image"
                                    onchange="document.getElementById('preview-contact_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('contact_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('contact_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-contact_bg_image"
                                                src="{{ isset($setting) ? asset($setting->contact_bg_image) : '' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">Service Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('setting_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="setting_bg_image"
                                    onchange="document.getElementById('preview-setting_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('setting_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('setting_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-setting_bg_image"
                                                src="{{ isset($setting) ? asset($setting->setting_bg_image) : '' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">Team Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('team_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="team_bg_image"
                                    onchange="document.getElementById('preview-team_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('team_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('team_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-team_bg_image"
                                                src="{{ isset($setting) ? asset($setting->team_bg_image) : '' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">About Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('about_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="about_bg_image"
                                    onchange="document.getElementById('preview-about_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('about_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('about_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-about_bg_image"
                                                src="{{ isset($setting) ? asset($setting->about_bg_image) : '' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">Project Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('project_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="project_bg_image"
                                    onchange="document.getElementById('preview-project_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('project_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('project_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-project_bg_image"
                                                src="{{ isset($setting) ? asset($setting->project_bg_image) : '' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-xl-8">
                                <label for="formFile" class="form-label">Career Background Image </label>
                                <input
                                    class="form-control {{ isset($errors) && $errors->has('career_bg_image') ? 'is-invalid' : '' }}"
                                    type="file" id="formFile" name="career_bg_image"
                                    onchange="document.getElementById('preview-career_bg_image').src = window.URL.createObjectURL(this.files[0])">
                                @if (isset($errors) && $errors->has('career_bg_image'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('career_bg_image') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-career_bg_image"
                                                src="{{ isset($setting) ? asset($setting->career_bg_image) : '' }}"
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

        <div class="col-xl-4">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Contact Details</h6>
                        <hr>

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Phone</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('phone') ? 'is-invalid' : '' }}"
                                name="phone" value="{{ isset($setting) ? $setting->phone : old('phone') }}">
                            @if (isset($errors) && $errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">Email</label>
                            <input type="email"
                                class="form-control {{ isset($errors) && $errors->has('email') ? 'is-invalid' : '' }}"
                                name="email" value="{{ isset($setting) ? $setting->email : old('email') }}">
                            @if (isset($errors) && $errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">Map</label>
                            <textarea class="form-control {{ isset($errors) && $errors->has('map') ? 'is-invalid' : '' }}"
                              rows="6"   name="map">{{ isset($setting) ? $setting->map : old('map') }}</textarea>
                            @if (isset($errors) && $errors->has('map'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('map') }}
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Contact Details</h6>
                        <hr>

                        <div class="col-12 mb-2 ">
                            <label class="form-label"> <i class="bi bi-facebook"></i> Facebook  </label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('facebook') ? 'is-invalid' : '' }}"
                                name="facebook" value="{{ isset($setting) ? $setting->facebook : old('facebook') }}">
                            @if (isset($errors) && $errors->has('facebook'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facebook') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 mb-2 ">
                            <label class="form-label"> <i class="bi bi-twitter"></i> Twitter   </label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('twitter') ? 'is-invalid' : '' }}"
                                name="twitter" value="{{ isset($setting) ? $setting->twitter : old('twitter') }}">
                            @if (isset($errors) && $errors->has('twitter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('twitter') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-12 mb-2 ">
                            <label class="form-label"> <i class="bi bi-linkedin"></i> Linkedin  </label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('linkedin') ? 'is-invalid' : '' }}"
                                name="linkedin" value="{{ isset($setting) ? $setting->linkedin : old('linkedin') }}">
                            @if (isset($errors) && $errors->has('linkedin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('linkedin') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12 mb-2 ">
                            <label class="form-label"> <i class="bi bi-youtube"></i> Youtube  </label>
                            <input type="url"
                                class="form-control {{ isset($errors) && $errors->has('youtube') ? 'is-invalid' : '' }}"
                                name="youtube" value="{{ isset($setting) ? $setting->youtube : old('youtube') }}">
                            @if (isset($errors) && $errors->has('youtube'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('youtube') }}
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ isset($setting) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.setting') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </div>
</form>
