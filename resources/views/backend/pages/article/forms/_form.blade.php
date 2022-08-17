<form class="row g-3" method="POST"
    action="{{ isset($article) ? route('backend.article-update', ['article' => $article]) : route('backend.article-store') }}"
    enctype="multipart/form-data" id="article_form">
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
                                    {{ (isset($article) ? 'Update' : 'Create') . ' Post' }}</h6>
                                <hr>


                                <div class="col-12 mb-2 ">
                                    <label class="form-label">Title *</label>
                                    <input type="text" {{ isset($article) ? 'readonly=readonly' : '' }}
                                        class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                        name="title" value="{{ isset($article) ? $article->title : old('title') }}">
                                    @if (isset($errors) && $errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12 mb-2 ">
                                    <label class="form-label">Category *</label>
                                    <select name="category_id" class="form-control"
                                        {{ isset($article) && auth()->user()->role->slug != 'super-admin' ? 'readonly=readonly' : '' }}>
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ isset($article) && $article->category_id == $category->id ? 'selected' : '' }}>
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




                                <div class="col-12 mb-2">
                                    <label for="" class="form-label">Body</label>
                                    <textarea name="body" id="editor" class="form-control editor" rows="10">{{ isset($article) ? $article->body : old('summary') }}</textarea>
                                </div>



                                <div class="col-12 mb-2">
                                    <label for="" class="form-label">Summary</label>
                                    <textarea name="summary" class="form-control" rows="5">{{ isset($article) ? $article->summary : old('summary') }}</textarea>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-xl-8">
                                        <label for="formFile" class="form-label">Featured Image</label>
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
                                                        src="{{ isset($article) ? asset($article->image) : '' }}"
                                                        class="img-fluid" alt="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12 mb-2 ">
                                        <label class="form-label">Tag *</label>

                                        <select class="form-control tag-select" id="tags" multiple="multiple"
                                            name="tags[]" aria-placeholder="Enter  Tags">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->slug }}">{{ $tag->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        @include('backend.layouts.partials.seoform', [
                            'meta' => isset($article) ? $article->seo : null,
                        ])
                    </div>





                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="mx-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase"> Tables
                            </h6>
                            <hr>

                            @foreach (getArticleTables($article) ?? [] as $key => $table)
                                <div class="mb-2">
                                    <h3 class="text-center"> {{ $key }} </h3>
                                    <hr>

                                    @foreach ($table as $field)
                                        <div class="form-group mb-1">
                                            <label for="">{{ $field['title'] }}</label>
                                            <input type="{{ $field['type'] ?? 'text' }}" class="form-control"
                                                name="{{ str_slug($key) . '_' . str_slug($field['title']) }}"
                                                value="{{ $field['type'] == 'date' ? carbon($field['value'])->format('Y-m-d') : $field['value'] }}">
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
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

                        <button type="submit" class="btn btn-primary btn-block back-to-top" style="display: inline;">
                            {{ isset($article) ? 'Update' : 'Save' }}
                        </button>

                        <a href="javaScript:;" class="back-to-top save-post" style="display: inline;">
                           <small style="font-size:14px">Save </small>
                        </a>

                        <button type="submit" class="btn btn-primary btn-block" id="save">
                            {{ isset($article) ? 'Update' : 'Save' }}
                        </button>

                        @if (auth()->user()->role->slug == 'writer')
                            <button type="button" class="btn btn-success btn-block" id="submit">
                                Submit
                            </button>
                        @elseif(auth()->user()->role->slug != 'writer' && $article->task_status == 'editing')
                            <button type="button" class="btn btn-success btn-block" id="publish">
                                Publish
                            </button>

                            <button type="button" class="btn btn-danger btn-block" id="modify">
                                Modify
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>





</form>

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on("click", ".save-post", function() {

                $("#save").trigger("click");
            })


            $(document).on("click", "#submit", function() {
                $("#task_status").val('submitted');
                $("#save").trigger("click");
            })

            $(document).on("click", "#publish", function() {
                $("#task_status").val('published');
                $("#save").trigger("click");
            })

            $(document).on("click", "#modify", function() {
                $("#task_status").val('modifying');
                $("#save").trigger("click");
            })
        })
    </script>
@endpush


@push('scripts')
    <script>
        $(document).ready(function() {
            if (window) {

                window.data = @json(isset($article) ? articleTag($article) : [])

                const select2 = $('#tags').select2({
                    placeholder: 'Tags',
                    allowClear: true,
                    tags: true,
                });


                console.log(select2.val(window.data).trigger('change'));

                console.log(window.data)
            }


        });
    </script>
@endpush
