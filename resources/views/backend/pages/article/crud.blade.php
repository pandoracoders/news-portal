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
    @include('backend.pages.article.forms._form')
@endsection
