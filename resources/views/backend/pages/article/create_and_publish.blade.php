@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->

    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('backend/assets/plugins/datetime/jquery.datetimepicker.min.css') }}">
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('backend/assets/plugins/datetime/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/xbw872gf05l003xyag73l4fuxlcse5ggqre8dxhqd72fmil6/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.PluginManager.add('readmore', function(editor, url) {
            var addHtml = function() {
                editor.insertContent('<div class="readmore"><pre class="">Read More Section</pre></div>');
            };
            /* Add a button that opens a window */
            editor.ui.registry.addButton('readmore', {
                text: 'Add Read More',
                class: "btn btn-primary",
                onAction: function() {
                    /* Open window */
                    addHtml();
                }
            });
            /* Adds a menu item, which can then be included in any menu via the menu/menubar configuration */
            editor.ui.registry.addMenuItem('readmore', {
                text: 'Read More plugin',
                onAction: function() {
                    /* Open window */
                    addHtml();
                }
            });
            /* Return the metadata for the help plugin */
            return {
                getMetadata: function() {
                    return {
                        name: 'ReadMore plugin',
                        url: "{{ url('') }}"
                    };
                }
            };
        });



        const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/backend/article/upload-content-image');

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: 'HTTP Error: ' + xhr.status,
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob());
            xhr.send(formData);
        });



        tinymce.init({
            selector: 'textarea.editor',

            plugins: 'readmore preview advlist link importcss searchreplace autosave save directionality code visualblocks visualchars fullscreen image media template codesample table charmap pagebreak nonbreaking anchor insertdatetime lists wordcount help charmap emoticons',

            imagetools_cors_hosts: ['picsum.photos'],
            image_caption: true,


            relative_urls: false,
            convert_urls: false,
            menubar: '',

            toolbar: 'blocks code bold italic underline insertfile image media link blockquote alignleft aligncenter alignjustify save numlist bullist charmap fullscreen table preview readmore',

            link_context_toolbar: true,
            link_rel_list:[
                {
                    title: 'Follow',
                    value: ''
                },
                {
                    title: 'No Follow',
                    value: 'nofollow'
                },
                {
                    title: 'Sponsored',
                    value: 'sponsored'
                },
                {
                    title: 'Combined',
                    value: 'nofollow sponsored'
                }
            ],

            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "5s",
            autosave_prefix: "{{ route('backend.article-update', $article->id) }}",
            autosave_restore_when_empty: false,
            autosave_retention: "5s",

            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            images_upload_handler: image_upload_handler_callback,


            // file_picker_types: 'image',
            /* and here's our custom image picker*/


            // success color
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; width: 95%; } .readmore{ border: solid 1px #ccc;background-color: #eee; font-size: 17px; font-weight:bold; border-radius:7px; width:35%; color:black; padding: 5px 10px; margin: 10px 0; }',


            importcss_append: true,

            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 700,
            image_caption: true,
            quickbars_selection_toolbar: '',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "table",

        });
    </script>
@endpush


@section('content')
    <form class="row g-3" method="POST"
    action="{{ isset($article) ? route('backend.article-update', ['article' => $article]) : route('backend.article-store') }}"
    enctype="multipart/form-data" id="article_form">
    @csrf



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

                            <button type="submit" class="btn btn-primary btn-block form-submit" id="save">
                                {{ isset($article) ? 'Update' : 'Save' }}
                            </button>

                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#publish-article">
                                Publish
                            </button>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4 mt-2" style="position:sticky; top:15rem;">
                <label class="form-label mx-2">Category *</label>
                <select name="category_id" class="form-control">
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

    @if (auth()->user()->role->slug != 'writer' && $article->task_status == 'editing')
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

@endsection
