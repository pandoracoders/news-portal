<form class="row g-3" method="POST" action="{{ route('backend.page-update', ['page' => $page->key]) }}"
    enctype="multipart/form-data" id="page_form">
    @csrf

    <input type="hidden" name="task_status" id="task_status">

    <div class="row">
        @include('error')
        <div class="col-xl-12 mx-auto">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">
                                    {{ (isset($page) ? 'Update' : 'Create') . ' Page' }}</h6>
                                <hr>


                                <div class="col-12 mb-2 ">
                                    <label class="form-label">Title *</label>
                                    <input type="text" {{ isset($page) ? 'readonly=readonly' : '' }}
                                        class="form-control {{ isset($errors) && $errors->has('key') ? 'is-invalid' : '' }}"
                                        value="{{ isset($page) ? unSlug($page->key) : old('key') }}">
                                    @if (isset($errors) && $errors->has('key'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('key') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12 mb-2 ">
                                    <label class="form-label">Slug *</label>
                                    <input type="text" {{ isset($page) ? 'readonly=readonly' : '' }}
                                        class="form-control {{ isset($errors) && $errors->has('key') ? 'is-invalid' : '' }}"
                                        value="{{ isset($page) ? $page->key : old('key') }}">
                                    @if (isset($errors) && $errors->has('key'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('key') }}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12 mb-2">
                                    <label for="" class="form-label">Body</label>
                                    <textarea name="value" id="editor" class="form-control editor" rows="10">{{ isset($page) ? $page->value : old('value') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        @include('backend.layouts.partials.seoform', [
                            'meta' => isset($page) ? $page->seo : null,
                        ])
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>

                        <button type="submit" class="btn btn-success btn-block">
                            {{ isset($page) ? 'Update' : 'Save' }}
                        </button>

                        <button type="submit" class="btn btn-primary btn-block back-to-top" style="display: inline;">
                            {{ isset($page) ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>





</form>
