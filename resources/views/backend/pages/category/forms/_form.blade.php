<form class="row g-3" method="POST"
    action="{{ isset($category) ? route('backend.category-update', ['category' => $category]) : route('backend.category-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-6 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">{{ (isset($category) ? 'Update' : 'Create') . ' Category' }}</h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Title *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($category) ? $category->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>

                        {{-- <div class="col-12 mb-2 ">
                            <label class="form-label">Slug</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title" value="{{ isset($category) ? $category->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div> --}}

                        <div class="row mb-1">
                            <div class="col-xl-8">
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
                            <div class="col-xl-4">
                                <div class="border p-3 rounded">
                                    <h6 class="mb-0 text-uppercase">Image Preiew</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <img height="50px" width="100px" id="preview-image"
                                                src="{{ isset($category) ? asset($category->image) : '' }}"
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

        <div class="col-xl-6">
            @include('backend.layouts.partials.seoform', [
                'meta' => isset($category) ? $category->seo : null,
            ])
            <div class="card">
                <div class="card-body">
                    <div class="border p-3 rounded mb-2">
                        <h6 class="mb-0 text-uppercase">Action</h6>
                        <hr>
                        <button type="submit" class="btn btn-success btn-block">
                            {{ isset($category) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('backend.category-view') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
