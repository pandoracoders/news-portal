<form class="row g-3" method="POST"
    action="{{ isset($tag) ? route('backend.tag-update', ['tag' => $tag]) : route('backend.tag-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-6 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ (isset($role) ? 'Update' : 'Create') . ' Category' }}</h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Title *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('permission') ? 'is-invalid' : '' }}"
                                name="permission" value="{{ isset($role) ? $role->permission : old('permission') }}">
                            @if (isset($errors) && $errors->has('permission'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('permission') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            @include('backend.layouts.partials.seoform', [
                'meta' => isset($tag) ? $tag->seo : null,
            ])
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ isset($tag) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('backend.tag-list') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
