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
                <h3 class="font-weight-bold">Data Kalender Akademik</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Kalender Akademik Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Kalender Akademik</li>
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
              @can('tambah kalenderakademik')
                <button class="btn btn-primary btn-icon-text btn-sm" data-bs-toggle="modal"
                  data-bs-target="#addKalenderAkademikModal">
                  <i class="ti-plus btn-icon-prepend"></i>
                  Tambah Kalender Akademik
                </button>
              @endcan
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="kalender-akademik-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tahun Akademik</th>
                        <th>Cover</th>
                        <th>File</th>
                        <th>Link Drive</th>
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

  <div class="modal fade" id="addKalenderAkademikModal" tabindex="-1" aria-labelledby="addKalenderAkademikModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="{{ route('dashboard.pages.kalender-akademik.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="addKalenderAkademikModalLabel">Tambah Kalender Akademik</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tahun_akademik_add">Tahun</label>
            <input type="text" class="form-control" id="tahun_akademik_add" name="tahun_akademik"
              placeholder="Tahun akademik, contoh: 2024/2025 etc...">
          </div>

          <div class="form-group">
            <label for="image_add">Cover</label>
            <input type="file" class="filepond image_add" name="image">
          </div>

          <div class="form-group">
            <label for="file_add">File PDF</label>
            <input type="file" class="filepond file_add" name="file">
          </div>

          <div class="form-group">
            <label for="link_add">Link</label>
            <input type="text" class="form-control" id="link_add" name="link" placeholder="Link Drive">
          </div>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editKalenderAkademikModal" tabindex="-1" aria-labelledby="editKalenderAkademikModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="editKalenderAkademikModalLabel">Edit Kalender Akademik</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="tahun_akademik_edit">Tahun</label>
            <input type="text" class="form-control" id="tahun_akademik_edit" name="tahun_akademik"
              placeholder="Tahun akademik, contoh: 2024/2025 etc...">
          </div>

          <div class="form-group">
            <label for="image_edit">Cover</label>
            <input type="file" class="filepond image_edit" name="image">
          </div>

          <div class="form-group">
            <label for="file_edit">File PDF</label>
            <input type="file" class="filepond file_edit" name="file" required>
          </div>

          <div class="form-group">
            <label for="link_edit">Link</label>
            <input type="text" class="form-control" id="link_edit" name="link" placeholder="Link Drive">
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

    FilePond.create(
      document.querySelector('.file_add'), {
        server: {
          process: "/dashboard/upload-file",
          revert: "/dashboard/cancel-file",
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          }
        },
        allowMultiple: false,
        allowReorder: false,
        allowFileSizeValidation: true,
        allowFileTypeValidation: true,
        maxFiles: 1,
        maxFileSize: '10MB',
        labelMaxFileSize: 'Maximum file size is {filesize}',
        acceptedFileTypes: ['application/pdf'],
        labelFileTypeNotAllowed: 'File of invalid type. Please upload PDF files only.',
      }
    );

    FilePond.create(
      document.querySelector('.image_add'), {
        server: {
          process: "/dashboard/upload-image",
          revert: "/dashboard/cancel-image",
          headers: {
            "X-CSRF-TOKEN": CSRF_TOKEN,
          }
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
      }
    );

    $('#kalender-akademik-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#kalender-akademik-table').DataTable({
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
        url: "/dashboard/pages/kalender-akademik/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'tahun_akademik',
          name: 'tahun_akademik'
        },
        {
          data: 'image',
          name: 'image'
        },
        {
          data: 'file',
          name: 'file'
        },
        {
          data: 'link',
          name: 'link'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyKalenderAkademik(id) {
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
            url: "/dashboard/pages/kalender-akademik/" + id,
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
                    $('#kalender-akademik-table').DataTable().ajax.reload();
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

    function updateKalenderAkademik(id) {
      $.ajax({
        url: "/dashboard/pages/kalender-akademik/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#editKalenderAkademikModal form').attr('action', "/dashboard/pages/kalender-akademik/" + id);

            $('#editKalenderAkademikModal #tahun_akademik_edit').val(response.data.tahun_akademik);
            $('#editKalenderAkademikModal #link_edit').val(response.data.link);

            const pondImage = FilePond.create(
              document.querySelector('.image_edit'), {
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
                    fetch('/dashboard/pages/kalender-akademik/remove-image', {
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
                  }
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
              }
            );

            if (response.data.image) {
              const imageUrl = "{{ asset('storage/filepond-image') }}/" + response.data.image;
              pondImage.files = [{
                source: imageUrl,
                options: {
                  type: 'local'
                }
              }];
            }

            const pondFile = FilePond.create(
              document.querySelector('.file_edit'), {
                server: {
                  load: (source, load, error, progress, abort, headers) => {
                    const myRequest = new Request(source);
                    fetch(myRequest).then((res) => {
                      return res.blob();
                    }).then(load);
                  },
                  process: "/dashboard/upload-file",
                  revert: "/dashboard/cancel-file",
                  remove: (source, load, error) => {
                    fetch('/dashboard/pages/kalender-akademik/remove-file', {
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
                  }
                },
                allowMultiple: false,
                allowReorder: false,
                allowFileSizeValidation: true,
                allowFileTypeValidation: true,
                maxFiles: 1,
                maxFileSize: '10MB',
                labelMaxFileSize: 'Maximum file size is {filesize}',
                acceptedFileTypes: ['application/pdf'],
                labelFileTypeNotAllowed: 'File of invalid type. Please upload PDF files only.',
              }
            );

            if (response.data.file) {
              const fileUrl = "{{ asset('storage/filepond-file') }}/" + response.data.file;
              pondFile.files = [{
                source: fileUrl,
                options: {
                  type: 'local'
                }
              }];
            }

            $('#editKalenderAkademikModal').modal('show');
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
    };
  </script>
@endpush
