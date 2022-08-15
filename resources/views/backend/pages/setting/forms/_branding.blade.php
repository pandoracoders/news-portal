<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="mb-2">
            <div class="">
                <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Branding Setting</h6>
                    <hr>
                    @csrf
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Website Title</label>
                        <input type="text" class="form-control " name="website_title"
                            value="{{ $webSetting['website_title']->value ?? old('website_title') }}">
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Slogan</label>
                        <input type="text" class="form-control " name="slogan"
                            value="{{ $webSetting['slogan']->value ?? old('slogan') }}">
                    </div>

                    <div class="col-12 mb-2 ">
                        <label class="form-label">Contact Email</label>
                        <input type="text" class="form-control " name="contact_email"
                            value="{{ $webSetting['contact_email']->value ?? old('contact_email') }}">
                    </div>


                    <div class="row mb-1">
                        <div class="col-xl-8">
                            <label for="formFile" class="form-label">Logo</label>
                            <input class="form-control " type="file" id="formFile" name="logo"
                                onchange="document.getElementById('preview-logo').src = window.URL.createObjectURL(this.files[0])">

                        </div>
                        <div class="col-xl-4">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <img height="50px" width="100px" id="preview-logo"
                                            src="{{ asset($webSetting['logo']->value ?? '') }}" class="img-fluid"
                                            alt="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-xl-8">
                            <label for="formFile" class="form-label">Favicon</label>
                            <input class="form-control " type="file" id="formFile" name="favicon"
                                onchange="document.getElementById('preview-favicon').src = window.URL.createObjectURL(this.files[0])">

                        </div>
                        <div class="col-xl-4">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <img height="50px" width="100px" id="preview-favicon"
                                            src="{{ asset($webSetting['favicon']->value ?? '') }}" class="img-fluid"
                                            alt="">
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
        <div class="">
            <div class="">
                <div class="border p-3 rounded mb-2">
                    <h6 class="mb-0 text-uppercase">Action</h6>
                    <hr>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
