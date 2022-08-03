@extends('backend.layouts.index')


@push('styles')
    <!--plugins-->

    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <script src="{{ asset('backend') }}/assets/plugins/select2/js/select2.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/j13mw8eat9x0mct0dhgcxkzjhazjsq0ck1acz86lodyv52w7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        // tinymce.init({
        //     selector: '.editor',
        //     plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
        //     toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
        //     toolbar_mode: 'floating',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',
        // });



        // tinymce.init({
        //     selector: 'textarea.editor',
        //     height: 800,
        //     menubar: true,
        //     plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker image code',
        //     toolbar: 'undo redo | link image | code | table | heading',

        //     toolbar_mode: 'floating',
        //     tinycomments_mode: 'embedded',
        //     tinycomments_author: 'Author name',

        //     /* enable title field in the Image dialog*/
        //     image_title: true,

        //     image_caption: true,
        //     /* enable automatic uploads of images represented by blob or data URIs*/
        //     automatic_uploads: true,
        //     /*
        //       URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        //       images_upload_url: 'postAcceptor.php',
        //       here we add custom filepicker only to Image dialog
        //     */
        //     file_picker_types: 'image',
        //     /* and here's our custom image picker*/
        //     file_picker_callback: function(cb, value, meta) {
        //         var input = document.createElement('input');
        //         input.setAttribute('type', 'file');
        //         input.setAttribute('accept', 'image/*');


        //         input.onchange = function() {
        //             var file = this.files[0];

        //             var reader = new FileReader();
        //             reader.onload = function() {
        //                 /*
        //                   Note: Now we need to register the blob in TinyMCEs image blob
        //                   registry. In the next release this part hopefully won't be
        //                   necessary, as we are looking to handle it internally.
        //                 */
        //                 var id = 'blobid' + (new Date()).getTime();
        //                 var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        //                 var base64 = reader.result.split(',')[1];
        //                 var blobInfo = blobCache.create(id, file, base64);
        //                 blobCache.add(blobInfo);

        //                 /* call the callback and populate the Title field with the file name */
        //                 cb(blobInfo.blobUri(), {
        //                     title: file.name
        //                 });
        //             };
        //             reader.readAsDataURL(file);
        //         };

        //         input.click();
        //     },
        //     content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        // });



        tinymce.init({
            selector: 'textarea.editor',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo |  fontfamily fontsize blocks | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: "30s",
            autosave_prefix: "{path}{query}-{id}-",
            autosave_restore_when_empty: false,
            autosave_retention: "2m",
            image_advtab: true,
            content_css: '//www.tiny.cloud/css/codepen.min.css',
            link_list: [{
                    title: 'My page 1',
                    value: 'http://www.tinymce.com'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_list: [{
                    title: 'My page 1',
                    value: 'http://www.tinymce.com'
                },
                {
                    title: 'My page 2',
                    value: 'http://www.moxiecode.com'
                }
            ],
            image_class_list: [{
                    title: 'None',
                    value: ''
                },
                {
                    title: 'Some class',
                    value: 'class-name'
                }
            ],
            importcss_append: true,
            file_picker_callback: function(callback, value, meta) {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', {
                        text: 'My text'
                    });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', {
                        alt: 'My alt text'
                    });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', {
                        source2: 'alt.ogg',
                        poster: 'https://www.google.com/logos/google.jpg'
                    });
                }
            },
            templates: [{
                    title: 'New Table',
                    description: 'creates a new table',
                    content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                },
                {
                    title: 'Starting my story',
                    description: 'A cure for writers block',
                    content: 'Once upon a time...'
                },
                {
                    title: 'New list with dates',
                    description: 'New List with dates',
                    content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                }
            ],
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 520,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>
@endpush


@section('content')
    {{-- @include("backend.layouts.partials.breadcrumb", [
        "title" => "DataTable Import",
        "items" => [
            [
                "text" => "Home",
                "url" => "#",
                "active" => false
            ],
            [
                "text" => "Components",
                "url" => "#",
                "active" => false
            ],
            [
                "text" => "DataTable Import",
                "url" => "#",
                "active" => true
            ]
        ]
    ]) --}}

    @include('backend.pages.article.forms._form')
@endsection
