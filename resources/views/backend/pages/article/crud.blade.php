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

        tinymce.init({
            selector: 'textarea.editor',
            height: 800,
            menubar: true,
            plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker image code',
            toolbar: 'undo redo | link image | code a11ycheck addcomment showcomments casechange checklist code export formatpainter  editimage pageembed permanentpen table tableofcontents',

            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',

            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
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
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
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
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
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
