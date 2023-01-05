@php

    $parentCategories = [];
    $childCategories = [];
    $allCategories = [];

    foreach ($categories as $category){
        array_push($allCategories, $category);
        foreach ($categories as $cat){
            if ($category->id == $cat->parent_id){
                array_push($parentCategories, $category);
                break;
            }
        }
    }
    $writableCategories = array_diff($allCategories, $parentCategories);
@endphp
<form class="row g-3" method="POST"
    action="{{ isset($article_title) ? route('backend.article_title-update', ['article_title' => $article_title]) : route('backend.article_title-store') }}"
    enctype="multipart/form-data">
    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <h6 class="mb-0 text-uppercase">
                            {{ (isset($article_title) ? 'Update' : 'Create') . ' Article Topic' }}
                        </h6>
                        <hr>
                        @csrf

                        <div class="col-12 mb-2 ">
                            <label class="form-label">Topic *</label>
                            <input type="text"
                                class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                name="title"
                                value="{{ isset($article_title) ? $article_title->title : old('title') }}">
                            @if (isset($errors) && $errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-12 mb-2 ">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-control">
                                <option value="" disabled>Select Category</option>
                                @foreach ($writableCategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ isset($article_title) && $article_title->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @if (isset($errors) && $errors->has('category_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
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
                            {{ isset($article_title) ? 'Update' : 'Save' }}
                        </button>
                        <a href="{{ route('backend.article_title-view') }}" class="btn btn-danger btn-block">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
