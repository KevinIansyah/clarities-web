CKEDITOR.ClassicEditor.create(document.getElementById("editorRoom"), {
    toolbar: {
        items: [
            "heading",
            "|",
            "bold",
            "italic",
            "underline",
            "subscript",
            "superscript",
            "link",
            "uploadImage",
            "|",
            "bulletedList",
            "numberedList",
            "|",
            "undo",
            "redo",
            "-",
        ],
        shouldNotGroupWhenFull: true,
    },
    ckfinder: {
        uploadUrl: "{{ route('dashboard.ckeditor.upload', ['_token' => csrf_token()]) }}",
    },
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true,
        },
    },
    heading: {
        options: [
            {
                model: "paragraph",
                title: "Paragraph",
                class: "ck-heading_paragraph",
            },
            // {
            //     model: "heading1",
            //     view: "h1",
            //     title: "Heading 1",
            //     class: "ck-heading_heading1",
            // },
            // {
            //     model: "heading2",
            //     view: "h2",
            //     title: "Heading 2",
            //     class: "ck-heading_heading2",
            // },
            // {
            //     model: "heading3",
            //     view: "h3",
            //     title: "Heading 3",
            //     class: "ck-heading_heading3",
            // },
            // {
            //     model: "heading4",
            //     view: "h4",
            //     title: "Heading 4",
            //     class: "ck-heading_heading4",
            // },
            // {
            //     model: "heading5",
            //     view: "h5",
            //     title: "Heading 5",
            //     class: "ck-heading_heading5",
            // },
            {
                model: "heading6",
                view: "h6",
                title: "Heading 6",
                class: "ck-heading_heading6",
            },
        ],
    },
    placeholder: "Write Drescription",
    link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: "https://",
            toggleDownloadable: {
                mode: "manual",
                label: "Downloadable",
                attributes: {
                    download: "file",
                },
            },
        },
    },
    removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        "AIAssistant",
        // "CKBox",
        // "CKFinder",
        // "EasyImage",
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        "RealTimeCollaborativeComments",
        "RealTimeCollaborativeTrackChanges",
        "RealTimeCollaborativeRevisionHistory",
        "PresenceList",
        "Comments",
        "TrackChanges",
        "TrackChangesData",
        "RevisionHistory",
        "Pagination",
        "WProofreader",
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        "MathType",
        // The following features are part of the Productivity Pack and require additional license.
        "SlashCommand",
        "Template",
        "DocumentOutline",
        "FormatPainter",
        "TableOfContents",
        "PasteFromOfficeEnhanced",
        "CaseChange",
    ],
});
