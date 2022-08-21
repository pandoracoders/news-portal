<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="mb-2">
            <div class="">
                <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Social Media Auto-Publish</h6>
                    <hr>
                    @csrf
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Facebook Token</label>
                        <input type="text" class="form-control " name="facebook_token"
                            value="{{ $webSetting['facebook_token']->value ?? old('facebook_token') }}">
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Twitter Token</label>
                        <input type="text" class="form-control " name="twitter_token"
                            value="{{ $webSetting['twitter_token']->value ?? old('twitter_token') }}">
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Pinterest Token</label>
                        <input type="text" class="form-control " name="pinterest_token"
                            value="{{ $webSetting['pinterest_token']->value ?? old('pinterest_token') }}">
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
