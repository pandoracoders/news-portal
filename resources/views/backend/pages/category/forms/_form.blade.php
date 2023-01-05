<form class="row g-3" method="POST"
    action="{{ isset($category) ? route('backend.category-update', ['category' => $category]) : route('backend.category-store') }}"
    enctype="multipart/form-data">
    <div class="row">

        @include('error')

        <div class="col-xl-8">
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
                        <div class="col-12 mb-2 ">
                            <label class="form-label">Parent Category</label>
                            <select class="form-control" name="parent_id" value="">
                                <option value="">Select Parent Category</option>
                                @foreach ($parentCategories as $cat )
                                    <option {{ isset($category)? (($category->parent_id == $cat->id)? 'selected' : ''):'' }} value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>


                        <div class="col-12">
                            <label class="form-label">Category Meta Description</label>
                            <textarea data-validation="required" class="form-control {{ isset($errors) && $errors->has('description') ? 'is-invalid' : '' }}"
                                name="description">{{ old('description') ? old('description') :  (isset($category) ? $category->description : '' ) }}</textarea>
                            @if (isset($errors) && $errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>


                        <div class="border p-3 rounded mt-2">
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
