<form class="row g-3" method="POST"
    action="{{ isset($slider) ? route('backend.edit-slider.post', ['slider' => $slider->id]) : route('backend.add-slider.post') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-8 mx-auto">

            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Add Slider</h6>
                        <hr>
                        {{--  --}}

                        @csrf
                        <div class="col-12">
                            <label class="form-label">Ttile</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($slider) ? $slider->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="formFile" class="form-label">Slider Image</label>
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
                            <div class="row">
                                <div class="col-6">
                                    <label for="formFile" class="form-label">Button first</label>
                                    <div class="col-12 mb-2">
                                        <label for="formFile" class="form-label">Button Text</label>
                                        <input
                                            class="form-control {{ isset($errors) && $errors->has('btn_1_text') ? 'is-invalid' : '' }}"
                                            type="text" name="btn_1_text"
                                            value="{{ isset($slider) ? $slider->btn_1_text : old('btn_1_text') }}">
                                        @if (isset($errors) && $errors->has('btn_1_text'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('btn_1_text') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <label for="formFile" class="form-label">Button Url</label>
                                        <select
                                            class="form-select mb-3 {{ isset($errors) && $errors->has('btn_1_url') ? 'is-invalid' : '' }}"
                                            name="btn_1_url">
                                            <option value="" selected="">Select Link</option>
                                            <option value="https://google.com">Google (https://google.com)</option>
                                        </select>
                                        @if (isset($errors) && $errors->has('btn_1_url'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('btn_1_url') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label for="formFile" class="form-label">Button Second</label>
                                    <div class="col-12 mb-2">
                                        <label for="formFile" class="form-label">Button Text</label>
                                        <input
                                            class="form-control {{ isset($errors) && $errors->has('btn_2_text') ? 'is-invalid' : '' }}"
                                            type="text" name="btn_2_text"
                                            value="{{ isset($slider) ? $slider->btn_2_text : old('btn_2_text') }}">
                                        @if (isset($errors) && $errors->has('btn_2_text'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('btn_2_text') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <label for="formFile" class="form-label">Button Url</label>
                                        <select
                                            class="form-select mb-3 {{ isset($errors) && $errors->has('btn_2_url') ? 'is-invalid' : '' }}"
                                            name="btn_2_url">
                                            <option value="" selected="">Select Link</option>
                                            <option value="https://google.com">Google (https://google.com)</option>
                                        </select>
                                        @if (isset($errors) && $errors->has('btn_2_url'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('btn_2_url') }}
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
                            {{ isset($slider) ? 'Update' : 'Save' }}
                        </button>

                        <a href="{{ route('backend.slider') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>

                    </div>

                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <img id="preview-image" src="{{ isset($slider) ? asset($slider->image) : '' }}"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
