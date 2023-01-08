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
    action="{{ isset($article) ? route('backend.article-update', ['article' => $article]) : route('backend.article-store') }}"
    enctype="multipart/form-data" id="article_form">
    @csrf

    <input type="hidden" name="task_status" id="task_status">

    <div class="row">
        @include('error')
        <div class="col-xl-9">
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
                                    <input type="text"
                                        {{ isset($article) ? (auth()->user()->isWriter ? 'readonly=readonly' : '') : '' }}
                                        class="form-control {{ isset($errors) && $errors->has('title') ? 'is-invalid' : '' }}"
                                        name="title" value="{{ old('title') ? old('title') : ( isset($article) ? $article->title : '' ) }}">
                                    @if (isset($errors) && $errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>


                                <div class="col-12 mb-2">

                                    <label for="" class="form-label">Body</label>
                                    <textarea name="body" id="editor" class="form-control editor" rows="10">{{ old('body') ? old('body') : ( isset($article) ? $article->body : '' ) }}</textarea>
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="" class="form-label">Summary</label>

                                    <textarea data-validation="required|min:100" name="summary" class="form-control" rows="5">{{ old('summary') ? old('summary') : ( isset($article) ? $article->summary : '' ) }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="">
                        @include('backend.layouts.partials.seoform', [
                            'meta' => isset($article) ? $article->seo : null,
                        ])
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-3 rounded mb-2">
                                        <h6 class="mb-0 text-uppercase">Revisions</h6>
                                        <hr>
                                        @foreach ($articleLog as $ar)
                                            <p>
                                                <a style="color:#008d7e; font-weight:500; font-size:16px;" href="{{ route('backend.article-revisions', $ar->id) }}">{{ $ar->action }} </a>-&nbsp;<span style="color: #37be2d; font-weight:500; font-size:15px;">{{ $ar->log_at }}</span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div style="position:sticky; top:4rem;">
                <div class="card">
                    <div class="card-body">
                        <div class="border p-3 rounded mb-2">
                            <h6 class="mb-0 text-uppercase">Action</h6>
                            <hr>


                            @if ($article->discussions)
                                <a data-bs-toggle="modal" href="#discussion-model" class="back-to-top"
                                    style="display: inline; bottom:120px; background-color: #de001e">
                                    <i class="bi bi-chat-dots"></i>
                                </a>
                            @endif

                            {{-- <a href="javaScript:;" class="back-to-top save-post" style="display: inline;">
                                <small style="font-size:14px">Save </small>
                            </a> --}}

                            <button type="submit" class="btn btn-primary btn-block form-submit" id="save">
                                {{ isset($article) ? 'Update' : 'Save' }}
                            </button>
                            @if ($article->task_status == 'writing' || $article->task_status == 'modifying' )
                                <button type="button" class="btn btn-success btn-block form-submit" id="submit">
                                    Submit
                                </button>
                            @elseif($article->task_status == 'autopublish')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#publish-article">
                                    Publish
                                </button>
                            @elseif(auth()->user()->role->slug != 'writer' && $article->task_status == 'editing')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#publish-article">
                                    Publish
                                </button>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modify-article">
                                    Modify
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4 mt-2" style="position:sticky; top:15rem;">
                <label class="form-label mx-2">Category *</label>
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

            <div class="row mb-1" style="position:sticky; top:20rem;">
                <div>
                    <label for="formFile" class="form-label">Featured Image</label>
                    <input
                        class="form-control {{ isset($errors) && $errors->has('image') ? 'is-invalid' : '' }}"
                        type="file" id="formFile" name="image"
                        onchange="document.getElementById('preview-image').src = window.URL.createObjectURL(this.files[0])">
                        <input type="text" name="featured_image_alt_text" class="form-control mt-2 mb-2" value="{{ old('featured_image_alt_text') ? old('featured_image_alt_text') : ( isset($article) ? $article->featured_image_alt_text : '' ) }}" placeholder="Featured image alt-text">
                    @if (isset($errors) && $errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>
                <div>
                    <div class="border p-3 rounded">
                        <div class="row">
                            <div class="col-12">
                                <img height="150" width="300" id="preview-image"
                                    src="{{ isset($article) ? asset($article->image) : '' }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 mb-2 mt-2" style="position:sticky; top:25;">
                    <label class="form-label">Tag *</label>

                    <select class="form-control tag-select" id="tags" multiple="multiple" name="tags[]"
                        aria-placeholder="Enter  Tags">
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->slug }}">{{ $tag->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mb-2 mt-2">
                    <label style="display:block;" class="form-label">Features</label>
                    <button type="button" data-target=".bd-example-modal-lg" data-bs-toggle="modal"
                        href="#facts-modal" class="btn btn-md btn-secondary col-md-5 mb-1">
                        Add Facts
                    </button>


                    <a data-bs-toggle="modal" href="#more-article" class="btn btn-md btn-primary col-md-5 mb-1">
                        Read More
                    </a>

                    <a data-bs-toggle="modal" href="#linkable-article" class="btn btn-md btn-secondary col-md-5 mb-1">
                        Find Links
                    </a>
                </div>

            </div>

        </div>
    </div>
    </div>

    @if (auth()->user()->role->slug != 'writer' && $article->task_status == 'editing' || in_array('autopublish', auth()->user()->permission['permissions']))
        <div class="modal fade" id="modify-article" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Any Message ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="" class="form-label">Message</label>
                                <textarea name="discussion" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-block" id="modify">
                            Modify
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="publish-article" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Publish Date</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <input id="datetimepicker" type="text" class="form-control" name="published_at">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-block" id="publish">
                            Publish
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="modal fade" id="linkable-article" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Linkable Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <input type="text" class="form-control" placeholder="Search for article"
                                id="search">
                        </div>
                        <div class="col-12 mb-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <ul class="list-group" id="search-append">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="more-article" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Read More Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2 ">
                            <label class="form-label">Read More Articles</label>
                            <select class="form-control tag-select" id="read-more" multiple="multiple"
                                name="read_more_articles[]" aria-placeholder="Select Articles">
                                @php
                                    $read_more_articles = $article->readMoreArticles?->pluck('id')->toArray();
                                @endphp
                                @foreach ($articles as $a)
                                    <option value="{{ $a->id }}"
                                        {{ in_array($a->id, $read_more_articles ?? []) ? 'selected' : '' }}
                                        data-image="{{ asset($a->image) }}">
                                        {{ $a->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>


    @if ($article->discussions)
        <div class="modal fade bd-example-modal-lg" id="discussion-model" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Messages</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mx-auto">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="border p-3 rounded">
                                        {!! '<p>' . implode('</p> <hr/> <p>', $article->discussions) . '</p>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                            aria-label="Close">Close</button>
                    </div>


                </div>
            </div>
        </div>
    @endif

    {{-- Quick Facts Modal --}}
    <div class="modal fade bd-example-modal-lg" style="margin-left: -200px;" id="facts-modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header">
                    <h5 class="modal-title">Quick Facts</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mx-auto">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="border p-3 rounded">
                                    {{-- <h6 class="mb-0 text-uppercase"> Tables
                                    </h6>
                                    <hr> --}}
                                    @php
                                        $oldTable = $article->tables;
                                    @endphp
                                    @foreach ($article->category->tables as $table)
                                        @php
                                            $key = str_slug($table->title);
                                        @endphp
                                        <div class="mb-2">
                                            <div class="row">
                                                @foreach ($table->tableFields as $field)
                                                    @php
                                                        $value = $oldTable[$key][str_slug($field->title)]['value'] ?? '';
                                                    @endphp
                                                    <div class="form-group mb-1 col-md-6">
                                                        <label for="">{{ $field->title }}</label>
                                                        @if (str_contains($field->title, 'Month'))
                                                            <select class="form-control"
                                                                name="{{ str_slug($key) . '_' . str_slug($field->title) }}">
                                                                <option value="">Select Month</option>
                                                                @foreach (getMonths() as $month)
                                                                    <option value="{{ $month }}"
                                                                        {{ $value === $month ? 'selected' : '' }}>
                                                                        {{ $month }} </option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="{{ $field['type'] ?? 'text' }}"
                                                                class="form-control"
                                                                name="{{ str_slug($key) . '_' . str_slug($field->title) }}"
                                                                value="{{ $field['type'] == 'date' ? carbon($value)->format('Y-m-d') : $value }}">
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach (getArticleTables($article) ?? [] as $key => $table)
                                        <div class="mb-2">
                                            <div class="row">
                                                @foreach ($table as $field)
                                                    {{-- <div class="form-group mb-1 col-md-6">
                                                        <label for="">{{ $field['title'] }}</label>
                                                        @if (str_contains($field['title'], 'Month'))
                                                            <select class="form-control"
                                                                name="{{ str_slug($key) . '_' . str_slug($field['title']) }}">
                                                                @foreach (getMonths() as $month)
                                                                    <option value="{{ str_slug($month) }}"
                                                                        {{ $field['value'] == $month ? 'selected' : '' }}>
                                                                        {{ $month }}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <input type="{{ $field['type'] ?? 'text' }}"
                                                                class="form-control"
                                                                name="{{ str_slug($key) . '_' . str_slug($field['title']) }}"
                                                                value="{{ $field['type'] == 'date' ? carbon($field['value'])->format('Y-m-d') : $field['value'] }}">
                                                        @endif
                                                    </div> --}}
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javaScript:;" class="btn btn-md btn-success save-post" style="display: inline;">
                        Save
                    </a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                </div>


            </div>
        </div>
    </div>
</form>

@push('styles')
    <style>
        .image-parent {
            max-width: 40px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".save-post", function() {
                $("#save").trigger("click");
            })


            $(document).on("click", "#submit", function() {
                // check if required validation
                if (window.formValidation($(this))){
                    $("#task_status").val('submitted');
                    $("#save").trigger("click");
                }
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
                window.data = @json(isset($article) ? articleTag($article) : []);
                const select2 = $('#tags').select2({
                    placeholder: 'Tags',
                    allowClear: true,
                    tags: true,
                });
                (select2.val(window.data).trigger('change'));
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            const format = function(state) {

                if (!state.id) {
                    return state.text;
                }
                const baseUrl = '{{ asset('/') }}';
                var image = $(state.element).data('image');

                // if image do not contain http:// or https://

                if (image.indexOf('http://') == -1 && image.indexOf('https://') == -1) {
                    image = baseUrl + image;
                }
                return $(
                    `<span><img class="image-parent" src="${image}"
                        style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">${state.text}</span>`
                );

            };

            if (window) {
                // window.readmore = @json(isset($article) ? $article->readMore()?->pluck('id') : []);
                // select2 for append select
                const readMore = $('#read-more').select2({
                    placeholder: 'Select Articles',
                    allowClear: true,
                    templateResult: format,
                    templateSelection: format,
                    dropdownParent: $("#more-article")
                });

                // (readMore.val(window.data).trigger('change'));
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            jQuery('#datetimepicker').datetimepicker({});

            const articleHtmlStyle = (articles) => {
                let html = '';
                articles.forEach(article => {
                    html += `<li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center copy-link"
                                data-url="${article.value}">
                                <div class="flex-column">
                                    ${article.title}
                                </div>
                                <div class="image-parent">
                                    <img src="${article.image}" class="img-fluid" alt="quixote" width="100px">
                                </div>
                            </li>`;
                });
                return html;

            }

            const getSearchResult = () => {
                const search = $("#search").val();
                $.ajax({
                    url: "{{ route('backend.article-search') }}",
                    type: "POST",
                    data: {
                        search: search,
                        id: "{{ $article->id ?? 0 }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // $("#search-append").empty();
                        $("#search-append").html(articleHtmlStyle(data));
                    }
                });
            }

            // jQuery debounce function

            const debounce = (func, wait, immediate) => {
                var timeout;

                return function() {
                    var context = this,
                        args = arguments;
                    var later = function() {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            };
            const getSearchResultDebounce = debounce(getSearchResult, 500);
            $("#search").on("keyup", getSearchResultDebounce);

            // on model open
            $('#linkable-article').on('show.bs.modal', function(e) {
                getSearchResult();
            });


        });

        $(document).on("click", ".copy-link", function() {
            const url = $(this).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            navigator.clipboard.writeText(url);
            $temp.remove();
        })
    </script>
@endpush
