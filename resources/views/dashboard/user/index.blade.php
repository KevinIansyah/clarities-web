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
                <h3 class="font-weight-bold">Data Pengguna</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Pengguna anda disini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Pengguna</li>
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
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 mb-4">
              <p class="card-title mb-0">Tabel Pengguna</p>
              <button type="button" class="btn btn-primary btn-icon-text btn-sm" data-bs-toggle="modal"
                data-bs-target="#addUserModal">
                <i class="ti-plus btn-icon-prepend"></i>
                Tambah Pengguna
              </button>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="user-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
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

  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="{{ route('dashboard.user.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="addUserModalLabel">Tambah Pengguna</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="status" value="active">
          <div class="form-group">
            <label for="name_add">Nama</label>
            <input type="text" class="form-control" id="name_add" name="name" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="email_add">Email</label>
            <input type="email" class="form-control" id="email_add" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="gender_add">Gender</label>
            <select class="form-control" id="gender_add" name="gender" required>
              <option selected disabled>Pilih gender</option>
              <option value="laki-laki">Laki-Laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="access_add">Role</label>
            <select class="form-control" id="access_add" name="access" required>
              <option value="" disabled selected>Choose role</option>
              @foreach ($roles as $role)
                <option class="text-capitalize" value="{{ $role->name }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="password_add">Password</label>
            <input type="password" class="form-control" id="password_add" name="password" placeholder="Password" required>
          </div>
          <div class="form-group mb-0">
            <label for="confirm_password_add">Ulang Password</label>
            <input type="password" class="form-control" id="confirm_password_add" name="confirm_password"
              placeholder="Password" required>
          </div>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary m-0">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="editUserModalLabel">Edit Pengguna</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="status_edit">Status</label>
            <select class="form-control" id="status_edit" name="status" required>

            </select>
          </div>
          <div class="form-group">
            <label for="name_edit">Nama</label>
            <input type="text" class="form-control" id="name_edit" name="name" placeholder="Name" required>
          </div>
          <div class="form-group">
            <label for="email_edit">Email</label>
            <input type="email" class="form-control" id="email_edit" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="gender_edit">Gender</label>
            <select class="form-control" id="gender_edit" name="gender" required>

            </select>
          </div>
          <div class="form-group">
            <label for="access_edit">Role</label>
            <select class="form-control" id="access_edit" name="access" required>

            </select>
          </div>
          <div class="form-check form-check-flat form-check-primary mb-3">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" id="confirm_change_password">
              Edit Password
            </label>
          </div>
          <div class="d-none mt-4 pt-3" id="hidden-edit-password">
            <div class="form-group">
              <label for="password_edit">Password</label>
              <input type="password" class="form-control" id="password_edit" name="password_edit"
                placeholder="Password">
            </div>
            <div class="form-group mb-0">
              <label for="confirm_password_edit">Ulang Password</label>
              <input type="password" class="form-control" id="confirm_password_edit" name="confirm_password_edit"
                placeholder="Password">
            </div>
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
    const hiddenElement = document.getElementById('hidden-edit-password');
    const confirmChangePassword = document.getElementById('confirm_change_password');
    const passwordEdit = document.getElementById('password_edit');
    const password2Edit = document.getElementById('confirm_password_edit');

    confirmChangePassword.addEventListener('change', function() {
      if (this.checked) {
        hiddenElement.classList.remove('d-none');
        passwordEdit.removeAttribute('hidden');
        password2Edit.removeAttribute('hidden');
        passwordEdit.setAttribute('required', 'true');
        password2Edit.setAttribute('required', 'true');
      } else {
        hiddenElement.classList.add('d-none');
        passwordEdit.setAttribute('hidden', 'true');
        password2Edit.setAttribute('hidden', 'true');
        passwordEdit.removeAttribute('required', 'true');
        password2Edit.removeAttribute('required', 'true');
      }
    });

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#user-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#user-table').DataTable({
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
        url: "/dashboard/user/data",
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
          data: 'email',
          name: 'email'
        },
        {
          data: 'gender',
          name: 'gender'
        },
        {
          data: 'access',
          name: 'access'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyUser(id) {
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
            url: "/dashboard/user/" + id,
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
                    $('#user-table').DataTable().ajax.reload();
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

    function updateUser(id) {
      $.ajax({
        url: "/dashboard/user/" + id + "/edit",
        type: 'GET',
        success: function(response) {
          if (response.success) {
            $('#editUserModal form').attr('action', "/dashboard/user/" + id);

            $('#editUserModal #status_edit').empty();
            const statusOptions = {
              'active': 'Active',
              'inactive': 'Inactive'
            };
            for (const [value, label] of Object.entries(statusOptions)) {
              const selected = response.user.status == value ? 'selected' : '';
              $('#editUserModal #status_edit').append(`<option value="${value}" ${selected}>${label}</option>`);
            }

            $('#editUserModal #name_edit').val(response.user.name);
            $('#editUserModal #email_edit').val(response.user.email);

            $('#editUserModal #gender_edit').empty();
            const genderOptions = {
              'laki-laki': 'Laki-Laki',
              'perempuan': 'Perempuan'
            };
            for (const [value, label] of Object.entries(genderOptions)) {
              const selected = response.user.gender == value ? 'selected' : '';
              $('#editUserModal #gender_edit').append(`<option value="${value}" ${selected}>${label}</option>`);
            }

            $('#editUserModal #access_edit').empty();
            const selectedRole = response.user.access;
            const roles = response.role;
            roles.forEach(role => {
              const selected = role.name === selectedRole ? 'selected' : '';
              $('#editUserModal #access_edit').append(
                `<option class="text-capitalize" value="${role.name}" ${selected}>${role.name}</option>`);
            });

            $('#editUserModal').modal('show');
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
