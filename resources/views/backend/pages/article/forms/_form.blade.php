<form class="row g-3" method="POST"
    action="{{ isset($article) ? route('backend.article-update', ['article' => $article]) : route('backend.article-store') }}"
    enctype="multipart/form-data">
    @csrf
    <div class="row">

        @include('error')


        <div class="col-xl-4">
            <div class="mx-auto">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <h6 class="mb-0 text-uppercase"> Tables
                            </h6>
                            <hr>
                            {{-- {{ dd(getArticleTables($article)) }} --}}

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

        <div class="col-xl-8 mx-auto">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="border p-3 rounded">
                                <h6 class="mb-0 text-uppercase">
                                    {{ (isset($article) ? 'Update' : 'Create') . ' Category' }}</h6>
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
                                        {{ isset($article) ? 'disabled=disabled' : '' }}>
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="" disabled>Select Category</option>
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

                                        <select class="form-control tag-select" multiple="multiple" name="tags[]"
                                            aria-placeholder="Enter  Tags">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}">{{ $tag->title }}</option>
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

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-3 rounded mb-2">
                                    <h6 class="mb-0 text-uppercase">Action</h6>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ isset($article) ? 'Update' : 'Save' }}
                                    </button>
                                    <a href="{{ route('backend.article-list') }}" class="btn btn-danger btn-block">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</form>



@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            var tags = @json(
    $article
        ->tags()
        ->select('tag_id as id', 'title')
        ->get()
        ->toArray() ?? [],
);
            $('.tag-select').select2({
                placeholder: 'Enter Tags',
                tags: true,
            });

            console.log(tags);
            $('.tag-select').select2().val(tags.map(function(tag) {
                return {
                    id: tag.id,
                    text: tag.title,
                };
            }), ).trigger('change');
        });
    </script> --}}




    <script>
        $(document).ready(function() {

            // window.data = @json(isset($user) ? $user->permission?->permissions : []);

            var data = @json(
    $article
        ->tags()
        ->select('tag_id as id', 'title as text')
        ->get()
        ->toArray() ?? [],
);

            function formatState(item) {
                return item.text.trim();
            }

            const select2 = $('.tag-select').select2({
                placeholder: 'Select Tags',
                allowClear: true,
                // tags: true,
                templateResult: formatState,
                templateSelection: formatState,
                data
            });
            console.log(select2.val(data).trigger('change'));
        });
    </script>
@endpush
