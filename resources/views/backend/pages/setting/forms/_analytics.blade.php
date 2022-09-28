<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="mb-2">
            <div class="">
                <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Analytics</h6>
                    <hr>
                    @csrf
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Google Analytics Code</label>
                        <textarea class="form-control" rows="7" name="google_analytics_code" >
                            {{ $webSetting['google_analytics_code']->value ?? old('google_analytics_code') }}
                        </textarea>
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Google Tag Manager Code</label>
                        <textarea class="form-control" rows="7" name="google_tag_manager_code" >
                            {{ $webSetting['google_tag_manager_code']->value ?? old('google_tag_manager_code') }}
                        </textarea>
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">GTM Body Code</label>
                        <textarea class="form-control" rows="7" name="gtm_body_code" >
                            {{ $webSetting['gtm_body_code']->value ?? old('gtm_body_code') }}
                        </textarea>
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Google Search Console Code</label>
                        <textarea class="form-control" rows="7" name="google_search_console_code" >
                            {{ $webSetting['google_search_console_code']->value ?? old('google_search_console_code') }}
                        </textarea>
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
