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
                <h3 class="font-weight-bold">Data Unit Bagian</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Unit Bagian Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Unit Bagian</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-end gap-3 mb-4">
              @can('tambah unitbagian')
                <button class="btn btn-primary btn-icon-text btn-sm" data-bs-toggle="modal"
                  data-bs-target="#addUnitBagianModal">
                  <i class="ti-plus btn-icon-prepend"></i>
                  Tambah Unit Bagian
                </button>
              @endcan
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="unit-bagian-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Unit</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addUnitBagianModal" tabindex="-1" aria-labelledby="addUnitBagianModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form action="{{ route('dashboard.pages.unit-bagian.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="addUnitBagianModalLabel">Tambah Unit Bagian</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name_add">Nama Unit</label>
            <input type="text" class="form-control" id="name_add" name="name" placeholder="Nama unit" required>
          </div>

          <div class="form-group">
            <label for="content_add">Konten</label>
            <textarea id="content_add" name="content"></textarea>
          </div>

        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editUnitBagianModal" tabindex="-1" aria-labelledby="editUnitBagianModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="editUnitBagianModalLabel">Edit Unit Bagian</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name_edit">Nama Unit</label>
            <input type="text" class="form-control" id="name_edit" name="name" placeholder="Nama unit" required>
          </div>

          <div class="form-group">
            <label for="content_edit">Konten</label>
            <textarea id="content_edit" name="content"></textarea>
          </div>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#unit-bagian-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#unit-bagian-table').DataTable({
      fixedHeader: true,
      pageLength: 25,
      lengthChange: true,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      language: {
        processing: "Loading..."
      },
      ajax: {
        url: "/dashboard/pages/unit-bagian/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyUnitBagian(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/dashboard/pages/unit-bagian/" + id,
            type: 'DELETE',
            data: {
              _token: CSRF_TOKEN
            },
            success: function(response) {
              if (response.success) {
                Swal.fire({
                  title: 'Berhasil!',
                  text: response.message,
                  icon: 'success',
                  timer: 3000,
                  timerProgressBar: true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    $('#unit-bagian-table').DataTable().ajax.reload();
                  }
                });
              } else {
                Swal.fire({
                  title: 'Gagal!',
                  text: response.message,
                  icon: 'error',
                  timer: 3000,
                  timerProgressBar: true,
                });
              }
            },
            error: function(xhr) {
              Swal.fire({
                title: 'Gagal!',
                text: xhr.responseJSON.message,
                icon: 'error',
                timer: 3000,
                timerProgressBar: true,
              });
            }
          });
        }
      });
    };

    let editorInstance = null;

    function updateUnitBagian(id) {
      $.ajax({
        url: "/dashboard/pages/unit-bagian/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#editUnitBagianModal form').attr('action', "/dashboard/pages/unit-bagian/" + id);
            $('#editUnitBagianModal #name_edit').val(response.data.name);

            if (editorInstance) {
              editorInstance.destroy()
                .then(() => {
                  createEditor(response.data.content);
                });
            } else {
              createEditor(response.data.content);
            }

            $('#editUnitBagianModal').modal('show');
          } else {
            Swal.fire({
              title: 'Gagal!',
              text: response.message,
              icon: 'error',
              timer: 3000,
              timerProgressBar: true,
            });
          }
        },
        error: function(response) {
          Swal.fire({
            title: 'Gagal!',
            text: response.error,
            icon: 'error',
            timer: 3000,
            timerProgressBar: true,
          });
        }
      });
    };

    function createEditor(content) {
      CKEDITOR.ClassicEditor.create(document.getElementById("content_edit"), {
        toolbar: {
          items: [
            'heading', '|',
            'bold', 'italic', 'underline', 'fontColor', 'fontBackgroundColor', 'subscript',
            'superscript', 'link',
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
          "AIAssistant",
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
        editorInstance = editor;
        editor.setData(content);
      }).catch(error => {
        console.error(error);
      });
    };

    CKEDITOR.ClassicEditor.create(document.querySelector('#content_add'), {
      toolbar: {
        items: [
          'heading', '|',
          'bold', 'italic', 'underline', 'fontColor', 'fontBackgroundColor', 'subscript', 'superscript', 'link',
          "uploadImage", '|',
          'bulletedList', 'numberedList', 'blockQuote', '|',
          'undo', 'redo', 'sourceEditing',
          '-',
        ],
        shouldNotGroupWhenFull: true,
      },
      list: {
        properties: {
          styles: true,
          startIndex: true,
          reversed: true,
        },
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
    });
  </script>
@endpush
