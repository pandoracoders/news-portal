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

        tinymce.init({
            selector: 'textarea.editor',
            plugins: 'readmore preview advlist autolink importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            image_caption: true,
            image_show_caption: true,
            relative_urls: false,
            convert_urls: false,
            menubar: '',
            toolbar: 'blocks code bold italic underline insertfile image media link blockquote alignleft aligncenter alignjustify save numlist bullist charmap fullscreen  preview readmore',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "5s",
            autosave_prefix: "{{ route('backend.article-update', $article->id) }}",
            autosave_restore_when_empty: false,
            autosave_retention: "5s",
            image_advtab: true,

            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            // success color
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px; width: 100%; } .readmore{ border: solid 1px #ccc;background-color: #eee; font-size: 17px; font-weight:bold; border-radius:7px; width:35%; color:black; padding: 5px 10px; margin: 10px 0; }',


            importcss_append: true,

            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 1000,
            image_caption: true,
            quickbars_selection_toolbar: 'quicklink',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",

        });
    </script>
@endpush


@section('content')
    @include('backend.pages.article.forms._form')
@endsection
