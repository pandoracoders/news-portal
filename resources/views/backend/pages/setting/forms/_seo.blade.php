<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="mb-2">
            <div class="">
                <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">SEO Setting</h6>
                    <hr>
                    @csrf
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Meta Title</label>
                        <input type="text" class="form-control " name="meta_title"
                            value="{{ $webSetting['meta_title']->value ?? old('meta_title') }}">
                    </div>
                    <div class="col-12 mb-2 ">
                        <label class="form-label">Meta Description</label>
                        <input type="text" class="form-control " name="meta_description"
                            value="{{ $webSetting['meta_description']->value ?? old('meta_description') }}">
                    </div>

                    <div class="col-12 mb-2 ">
                        <label class="form-label">Meta Keyword</label>
                        <input type="text" class="form-control " name="meta_keyword"
                            value="{{ $webSetting['meta_keyword']->value ?? old('meta_keyword') }}">
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
