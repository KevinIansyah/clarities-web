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
                <h3 class="font-weight-bold">Data Pengelola</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Pengelola Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Pengelola</li>
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
              @can('tambah pengelola')
                <button class="btn btn-primary btn-icon-text btn-sm" data-bs-toggle="modal"
                  data-bs-target="#addPengelolaModal">
                  <i class="ti-plus btn-icon-prepend"></i>
                  Tambah Pengelola
                </button>
              @endcan
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="pengelola-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Foto</th>
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

  <div class="modal fade" id="addPengelolaModal" tabindex="-1" aria-labelledby="addPengelolaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="{{ route('dashboard.pages.pengelola.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="addPengelolaModalLabel">Tambah Pengelola</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name_add">Nama</label>
            <input type="text" class="form-control" id="name_add" name="name" placeholder="Nama pengelola"
              required>
          </div>

          <div class="form-group">
            <label for="position_add">Jabatan</label>
            <input type="text" class="form-control" id="position_add" name="position" placeholder="Jabatan pengelola"
              required>
          </div>

          <div class="form-group">
            <label for="image_add">Foto</label>
            <input type="file" class="filepond image_add" name="image" required>
          </div>

          <div class="form-group">
            <label for="instagram_add">Instagram</label>
            <input type="text" class="form-control" id="instagram_add" name="instagram" placeholder="Link Instagram">
          </div>

          <div class="form-group">
            <label for="facebook_add">Facebook</label>
            <input type="text" class="form-control" id="facebook_add" name="facebook" placeholder="Link Facebook">
          </div>

          <div class="form-group">
            <label for="twitter_add">Twitter</label>
            <input type="text" class="form-control" id="twitter_add" name="twitter" placeholder="Link Twitter">
          </div>

          <div class="form-group">
            <label for="linkedin_add">Linkedin</label>
            <input type="text" class="form-control" id="linkedin_add" name="linkedin" placeholder="Link Linkedin">
          </div>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editPengelolaModal" tabindex="-1" aria-labelledby="editPengelolaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="editPengelolaModalLabel">Edit Pengelola</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name_edit">Nama</label>
            <input type="text" class="form-control" id="name_edit" name="name" placeholder="Nama pengelola"
              required>
          </div>

          <div class="form-group">
            <label for="position_edit">Jabatan</label>

            <input type="text" class="form-control" id="position_edit" name="position"
              placeholder="Jabatan pengelola" required>
          </div>

          <div class="form-group">
            <label for="image_edit">Foto</label>
            <input type="file" class="filepond image_edit" name="image" required>
          </div>

          <div class="form-group">
            <label for="instagram_edit">Instagram</label>
            <input type="text" class="form-control" id="instagram_edit" name="instagram"
              placeholder="Link Instagram">
          </div>

          <div class="form-group">
            <label for="facebook_edit">Facebook</label>
            <input type="text" class="form-control" id="facebook_edit" name="facebook"
              placeholder="Link Facebook">
          </div>

          <div class="form-group">
            <label for="twitter_edit">Twitter</label>
            <input type="text" class="form-control" id="twitter_edit" name="twitter" placeholder="Link Twitter">
          </div>

          <div class="form-group">
            <label for="linkedin_edit">Linkedin</label>
            <input type="text" class="form-control" id="linkedin_edit" name="linkedin"
              placeholder="Link Linkedin">
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

    $('#pengelola-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#pengelola-table').DataTable({
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
        url: "/dashboard/pages/pengelola/data",
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
          data: 'position',
          name: 'position'
        },
        {
          data: 'image',
          name: 'image'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyPengelola(id) {
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
            url: "/dashboard/pages/pengelola/" + id,
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
                    $('#pengelola-table').DataTable().ajax.reload();
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

    function updatePengelola(id) {
      $.ajax({
        url: "/dashboard/pages/pengelola/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#editPengelolaModal form').attr('action', "/dashboard/pages/pengelola/" + id);

            $('#editPengelolaModal #name_edit').val(response.data.name);
            $('#editPengelolaModal #position_edit').val(response.data.position);
            $('#editPengelolaModal #instagram_edit').val(response.data.instagram);
            $('#editPengelolaModal #facebook_edit').val(response.data.facebook);
            $('#editPengelolaModal #twitter_edit').val(response.data.twitter);
            $('#editPengelolaModal #linkedin_edit').val(response.data.linkedin);

            const pond = FilePond.create(
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
                    fetch('/dashboard/pages/pengelola/remove-image', {
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
              pond.files = [{
                source: imageUrl,
                options: {
                  type: 'local'
                }
              }];
            }

            $('#editPengelolaModal').modal('show');
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
