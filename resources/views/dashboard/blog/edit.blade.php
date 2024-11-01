@extends('dashboard.layouts.main')

@section('main')
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 mb-4 mb-xl-0">
            <div
              class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center w-100">
              <div>
                <h3 class="font-weight-bold">Edit Data Blog</h3>
                <h6 class="font-weight-normal mb-0">Edit data Blog Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.blog.index') }}">Blog</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('dashboard.blog.update', ['blog' => $blog->id]) }}" class="form-sample">
              @csrf
              @method('PUT')

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Judul blog"
                      value="{{ $blog->title }}" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                      <option value="active" {{ $blog->status == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ $blog->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="read">Waktu Baca</label>
                    <input type="text" class="form-control" id="read" name="read"
                      placeholder="Dalam menit, contoh: 2 / 5 / 10" value="{{ $blog->read }}" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tag">Tag</label>
                    <input type="text" class="form-control" id="tag" name="tag"
                      placeholder="Pendidikan, Hukum, UPN, ...." value="{{ $blog->tag }}" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="overview">Overview</label>
                    <textarea class="form-control" id="overview" name="overview" rows="5"
                      placeholder="Tulis overview singkat dari blog" required>{{ $blog->overview }}</textarea>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="w-100">Unggah Cover</label>
                    <input type="file" class="filepond image" name="image" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="content">Konten</label>
                    <textarea id="editorBlog" name="content"></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    FilePond.create(
      document.querySelector('.image'), {
        server: {
          load: (source, load, error, progress, abort, headers) => {
            const myRequest = new Request(source);
            fetch(myRequest).then((res) => {
              return res.blob();
            }).then(load);
          },
          process: "/dashboard/upload-image",
          revert: "/dashboard/cancel-image",
          remove: (source, load, error) => {
            fetch('/dashboard/blog/remove-image', {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': CSRF_TOKEN,
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                  source: source
                })
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  load();
                } else {
                  error('An error occurred while removing the file.');
                }
              })
              .catch(err => {
                error(err.message);
              });
          },
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          },
        },
        allowMultiple: false,
        allowReorder: false,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 1,
        maxFileSize: '2MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PNG, JPG, or JPEG files only.',
        files: [
          @if ($blog->image)
            {
              source: "{{ asset('storage/filepond-image/' . $blog->image) }}",
              options: {
                type: 'local'
              }
            }
          @endif
        ],
      }
    );

    CKEDITOR.ClassicEditor.create(document.getElementById("editorBlog"), {
      toolbar: {
        items: [
          'heading', '|',
          'bold', 'italic', 'underline', 'fontColor', 'fontBackgroundColor', 'subscript', 'superscript', 'link',
          "uploadImage", '|',
          'bulletedList', 'numberedList', 'blockQuote', '|',
          'undo', 'redo', 'sourceEditing',
          '-',
        ],
        shouldNotGroupWhenFull: true
      },
      list: {
        properties: {
          styles: true,
          startIndex: true,
          reversed: true
        }
      },
      heading: {
        options: [{
            model: 'paragraph',
            title: 'Paragraph',
            class: 'ck-heading_paragraph'
          },
          {
            model: 'heading6',
            view: 'h6',
            title: 'Heading 6',
            class: 'ck-heading_heading6'
          }
        ]
      },
      placeholder: 'Write Drescription',
      link: {
        decorators: {
          addTargetToExternalLinks: true,
          defaultProtocol: 'https://',
          toggleDownloadable: {
            mode: 'manual',
            label: 'Downloadable',
            attributes: {
              download: 'file'
            }
          }
        }
      },
      image: {
        resizeOptions: [{
            name: 'resizeImage:original',
            value: null,
            icon: 'original'
          },
          {
            name: 'resizeImage:75',
            value: '75',
            icon: 'large'
          },
          {
            name: 'resizeImage:50',
            value: '50',
            icon: 'medium'
          },
        ],
        styles: {
          options: [{
              name: 'alignLeft',
              title: 'Align Left',
              icon: 'left',
              className: 'image-align-left'
            },
            {
              name: 'alignCenter',
              title: 'Align Center',
              icon: 'center',
              className: 'image-align-center'
            },
            {
              name: 'alignRight',
              title: 'Align Right',
              icon: 'right',
              className: 'image-align-right'
            },
          ]
        },
        toolbar: [
          'imageStyle:alignLeft',
          'imageStyle:alignCenter',
          'imageStyle:alignRight',
          '|', 'resizeImage', 'toggleImageCaption', 'linkImage'
        ],
      },
      ckfinder: {
        uploadUrl: "{{ route('dashboard.ckeditor', ['_token' => csrf_token()]) }}",
      },
      removePlugins: [
        // 'ExportPdf',
        // 'ExportWord',
        "AIAssistant",
        // "CKBox",
        // "CKFinder",
        // "EasyImage",
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
        "MathType",
        "SlashCommand",
        "Template",
        "DocumentOutline",
        "FormatPainter",
        "TableOfContents",
        "PasteFromOfficeEnhanced",
        "CaseChange",
      ],
    }).then(editor => {
      editor.setData(`
        {!! $blog->content !!}
      `);
    }).catch(error => {
      console.error(error);
    });
  </script>
@endpush
