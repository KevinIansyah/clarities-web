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
                <h3 class="font-weight-bold">Data Visi Misi</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Visi Misi Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Visi Misi</li>
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
              @can('tambah visimisi')
                <button class="btn btn-primary btn-icon-text btn-sm" data-bs-toggle="modal"
                  data-bs-target="#addVisiMisiModal">
                  <i class="ti-plus btn-icon-prepend"></i>
                  Tambah Visi Misi
                </button>
              @endcan
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="visi-misi-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Konten</th>
                        <th>Tipe</th>
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

  <div class="modal fade" id="addVisiMisiModal" tabindex="-1" aria-labelledby="addVisiMisiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="{{ route('dashboard.pages.visi-misi.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="addVisiMisiModalLabel">Tambah Visi Misi</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="type_add">Tipe</label>
            <select class="form-control" id="type_add" name="type" required>
              <option selected disabled>Pilih tipe</option>
              <option value="visi">Visi</option>
              <option value="misi">Misi</option>
            </select>
          </div>
          <div class="form-group">
            <label for="content_add">Visi / Misi</label>
            <textarea class="form-control" id="content_add" name="content" placeholder="Visi / misi clarities" rows="5"
              required></textarea>
          </div>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editVisiMisiModal" tabindex="-1" aria-labelledby="editVisiMisiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="editVisiMisiModalLabel">Edit Visi Misi</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="type_edit">Tipe</label>
            <select class="form-control" id="type_edit" name="type" required>

            </select>
          </div>
          <div class="form-group">
            <label for="content_edit">Visi / Misi</label>
            <textarea class="form-control" id="content_edit" name="content" placeholder="Visi / misi clarities" rows="5"
              required></textarea>
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

    $('#visi-misi-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#visi-misi-table').DataTable({
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
        url: "/dashboard/pages/visi-misi/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'content',
          name: 'content'
        },
        {
          data: 'type',
          name: 'type'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyVisiMisi(id) {
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
            url: "/dashboard/pages/visi-misi/" + id,
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
                    $('#visi-misi-table').DataTable().ajax.reload();
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

    function updateVisiMisi(id) {
      $.ajax({
        url: "/dashboard/pages/visi-misi/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#editVisiMisiModal form').attr('action', "/dashboard/pages/visi-misi/" + id);

            $('#editVisiMisiModal #type_edit').empty();
            const typeOptions = {
              'visi': 'Visi',
              'misi': 'Misi'
            };
            for (const [value, label] of Object.entries(typeOptions)) {
              const selected = response.data.type == value ? 'selected' : '';
              $('#editVisiMisiModal #type_edit').append(`<option value="${value}" ${selected}>${label}</option>`);
            }

            $('#editVisiMisiModal #content_edit').val(response.data.content);

            $('#editVisiMisiModal').modal('show');
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
  </script>
@endpush
