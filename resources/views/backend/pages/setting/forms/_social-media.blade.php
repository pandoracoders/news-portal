<div class="row">
    <div class="col-xl-8 mx-auto">
        <div class="mb-2">
            <div class="">
                <div class="border p-3 rounded">
                    <h6 class="mb-0 text-uppercase">Branding Setting</h6>
                    <hr>
                    @csrf
                    @foreach (config('constants.social_media') as $social)
                        <div class="col-12 mb-2 ">
                            <label class="form-label"> <i class="bi bi-{{ $social }}"></i> {{ unSlug($social) }}</label>
                            <input type="url" class="form-control " name="{{ $social }}"
                                value="{{ $webSetting[$social]->value ?? old($social) }}">
                        </div>
                    @endforeach
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
