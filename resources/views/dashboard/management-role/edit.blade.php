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
                <h3 class="font-weight-bold">Edit Data Role</h3>
                <h6 class="font-weight-normal mb-0">Edit data Role Anda disini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active"><a href="{{ route('dashboard.management-role.index') }}">Management
                      Role</a></li>
                  <li class="breadcrumb-item active">Edit</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Role</h4>
            <form method="POST" action="{{ route('dashboard.management-role.update', $role->id) }}"
              class="form-sample d-flex gap-2 room-status">
              @csrf
              @method('PUT')
              <input name="name" type="text" class="form-control" value="{{ $role->name }}"
                @if ($role->name == 'admin' || $role->name == 'admin tanaman' || $role->name == 'user') readonly @endif>
              <button type="submit" class="btn btn-primary">
                Simpan
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <form method="POST" action="{{ route('dashboard.management-role.permissions', $role->id) }}">
              @csrf
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Permission</th>
                      <th>Semua</th>
                      <th>Lihat</th>
                      <th>Tambah</th>
                      <th>Edit</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Blog</td>
                      <td>
                        <label class="toggle" for="blogCheckbox">
                          <input type="checkbox" class="toggle__input" id="blogCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_blog">
                          <input type="checkbox" class="toggle__input" id="lihat_blog" name="permissions[]"
                            value="lihat blog" data-blog {{ in_array('lihat blog', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_blog">
                          <input type="checkbox" class="toggle__input" id="tambah_blog" name="permissions[]"
                            value="tambah blog" data-blog
                            {{ in_array('tambah blog', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_blog">
                          <input type="checkbox" class="toggle__input" id="edit_blog" name="permissions[]"
                            value="edit blog" data-blog {{ in_array('edit blog', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_blog">
                          <input type="checkbox" class="toggle__input" id="hapus_blog" name="permissions[]"
                            value="hapus blog" data-blog {{ in_array('hapus blog', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Kurikulum Lab</td>
                      <td>
                        <label class="toggle" for="kurikulumLabCheckbox">
                          <input type="checkbox" class="toggle__input" id="kurikulumLabCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_kurikulumlab">
                          <input type="checkbox" class="toggle__input" id="lihat_kurikulumlab" name="permissions[]"
                            value="lihat kurikulumlab" data-kurikulumlab
                            {{ in_array('lihat kurikulumlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_kurikulumlab">
                          <input type="checkbox" class="toggle__input" id="tambah_kurikulumlab" name="permissions[]"
                            value="tambah kurikulumlab" data-kurikulumlab
                            {{ in_array('tambah kurikulumlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_kurikulumlab">
                          <input type="checkbox" class="toggle__input" id="edit_kurikulumlab" name="permissions[]"
                            value="edit kurikulumlab" data-kurikulumlab
                            {{ in_array('edit kurikulumlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_kurikulumlab">
                          <input type="checkbox" class="toggle__input" id="hapus_kurikulumlab" name="permissions[]"
                            value="hapus kurikulumlab" data-kurikulumlab
                            {{ in_array('hapus kurikulumlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Booking Lab</td>
                      <td>
                        <label class="toggle" for="bookingLabCheckbox">
                          <input type="checkbox" class="toggle__input" id="bookingLabCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_bookinglab">
                          <input type="checkbox" class="toggle__input" id="lihat_bookinglab" name="permissions[]"
                            value="lihat bookinglab" data-bookinglab
                            {{ in_array('lihat bookinglab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_bookinglab">
                          <input type="checkbox" class="toggle__input" id="tambah_bookinglab" name="permissions[]"
                            value="tambah bookinglab" data-bookinglab
                            {{ in_array('tambah bookinglab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_bookinglab">
                          <input type="checkbox" class="toggle__input" id="edit_bookinglab" name="permissions[]"
                            value="edit bookinglab" data-bookinglab
                            {{ in_array('edit bookinglab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_bookinglab">
                          <input type="checkbox" class="toggle__input" id="hapus_bookinglab" name="permissions[]"
                            value="hapus bookinglab" data-bookinglab
                            {{ in_array('hapus bookinglab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Ruangan Lab</td>
                      <td>
                        <label class="toggle" for="ruanganLabCheckbox">
                          <input type="checkbox" class="toggle__input" id="ruanganLabCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_ruanganlab">
                          <input type="checkbox" class="toggle__input" id="lihat_ruanganlab" name="permissions[]"
                            value="lihat ruanganlab" data-ruanganlab
                            {{ in_array('lihat ruanganlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_ruanganlab">
                          <input type="checkbox" class="toggle__input" id="tambah_ruanganlab" name="permissions[]"
                            value="tambah ruanganlab" data-ruanganlab
                            {{ in_array('tambah ruanganlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_ruanganlab">
                          <input type="checkbox" class="toggle__input" id="edit_ruanganlab" name="permissions[]"
                            value="edit ruanganlab" data-ruanganlab
                            {{ in_array('edit ruanganlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_ruanganlab">
                          <input type="checkbox" class="toggle__input" id="hapus_ruanganlab" name="permissions[]"
                            value="hapus ruanganlab" data-ruanganlab
                            {{ in_array('hapus ruanganlab', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Modul Praktikum</td>
                      <td>
                        <label class="toggle" for="modulPraktikumCheckbox">
                          <input type="checkbox" class="toggle__input" id="modulPraktikumCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_modulpraktikum">
                          <input type="checkbox" class="toggle__input" id="lihat_modulpraktikum" name="permissions[]"
                            value="lihat modulpraktikum" data-modulpraktikum
                            {{ in_array('lihat modulpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_modulpraktikum">
                          <input type="checkbox" class="toggle__input" id="tambah_modulpraktikum" name="permissions[]"
                            value="tambah modulpraktikum" data-modulpraktikum
                            {{ in_array('tambah modulpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_modulpraktikum">
                          <input type="checkbox" class="toggle__input" id="edit_modulpraktikum" name="permissions[]"
                            value="edit modulpraktikum" data-modulpraktikum
                            {{ in_array('edit modulpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_modulpraktikum">
                          <input type="checkbox" class="toggle__input" id="hapus_modulpraktikum" name="permissions[]"
                            value="hapus modulpraktikum" data-modulpraktikum
                            {{ in_array('hapus modulpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Jadwal Praktikum</td>
                      <td>
                        <label class="toggle" for="jadwalPraktikumCheckbox">
                          <input type="checkbox" class="toggle__input" id="jadwalPraktikumCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_jadwalpraktikum">
                          <input type="checkbox" class="toggle__input" id="lihat_jadwalpraktikum" name="permissions[]"
                            value="lihat jadwalpraktikum" data-jadwalpraktikum
                            {{ in_array('lihat jadwalpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_jadwalpraktikum">
                          <input type="checkbox" class="toggle__input" id="tambah_jadwalpraktikum" name="permissions[]"
                            value="tambah jadwalpraktikum" data-jadwalpraktikum
                            {{ in_array('tambah jadwalpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_jadwalpraktikum">
                          <input type="checkbox" class="toggle__input" id="edit_jadwalpraktikum" name="permissions[]"
                            value="edit jadwalpraktikum" data-jadwalpraktikum
                            {{ in_array('edit jadwalpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_jadwalpraktikum">
                          <input type="checkbox" class="toggle__input" id="hapus_jadwalpraktikum" name="permissions[]"
                            value="hapus jadwalpraktikum" data-jadwalpraktikum
                            {{ in_array('hapus jadwalpraktikum', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Tujuan</td>
                      <td>
                        <label class="toggle" for="tujuanCheckbox">
                          <input type="checkbox" class="toggle__input" id="tujuanCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_tujuan">
                          <input type="checkbox" class="toggle__input" id="lihat_tujuan" name="permissions[]"
                            value="lihat tujuan" data-tujuan
                            {{ in_array('lihat tujuan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_tujuan">
                          <input type="checkbox" class="toggle__input" id="tambah_tujuan" name="permissions[]"
                            value="tambah tujuan" data-tujuan
                            {{ in_array('tambah tujuan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_tujuan">
                          <input type="checkbox" class="toggle__input" id="edit_tujuan" name="permissions[]"
                            value="edit tujuan" data-tujuan
                            {{ in_array('edit tujuan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_tujuan">
                          <input type="checkbox" class="toggle__input" id="hapus_tujuan" name="permissions[]"
                            value="hapus tujuan" data-tujuan
                            {{ in_array('hapus tujuan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Visi Misi</td>
                      <td>
                        <label class="toggle" for="visiMisiCheckbox">
                          <input type="checkbox" class="toggle__input" id="visiMisiCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_visimisi">
                          <input type="checkbox" class="toggle__input" id="lihat_visimisi" name="permissions[]"
                            value="lihat visimisi" data-visimisi
                            {{ in_array('lihat visimisi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_visimisi">
                          <input type="checkbox" class="toggle__input" id="tambah_visimisi" name="permissions[]"
                            value="tambah visimisi" data-visimisi
                            {{ in_array('tambah visimisi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_visimisi">
                          <input type="checkbox" class="toggle__input" id="edit_visimisi" name="permissions[]"
                            value="edit visimisi" data-visimisi
                            {{ in_array('edit visimisi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_visimisi">
                          <input type="checkbox" class="toggle__input" id="hapus_visimisi" name="permissions[]"
                            value="hapus visimisi" data-visimisi
                            {{ in_array('hapus visimisi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Struktur Organisasi</td>
                      <td>
                        <label class="toggle" for="strukturOrganisasiCheckbox">
                          <input type="checkbox" class="toggle__input" id="strukturOrganisasiCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_strukturorganisasi">
                          <input type="checkbox" class="toggle__input" id="lihat_strukturorganisasi"
                            name="permissions[]" value="lihat strukturorganisasi" data-strukturorganisasi
                            {{ in_array('lihat strukturorganisasi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_strukturorganisasi">
                          <input type="checkbox" class="toggle__input" id="tambah_strukturorganisasi"
                            name="permissions[]" value="tambah strukturorganisasi" data-strukturorganisasi
                            {{ in_array('tambah strukturorganisasi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_strukturorganisasi">
                          <input type="checkbox" class="toggle__input" id="edit_strukturorganisasi"
                            name="permissions[]" value="edit strukturorganisasi" data-strukturorganisasi
                            {{ in_array('edit strukturorganisasi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_strukturorganisasi">
                          <input type="checkbox" class="toggle__input" id="hapus_strukturorganisasi"
                            name="permissions[]" value="hapus strukturorganisasi" data-strukturorganisasi
                            {{ in_array('hapus strukturorganisasi', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Unit Bagian</td>
                      <td>
                        <label class="toggle" for="unitBagianCheckbox">
                          <input type="checkbox" class="toggle__input" id="unitBagianCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_unitbagian">
                          <input type="checkbox" class="toggle__input" id="lihat_unitbagian"
                            name="permissions[]" value="lihat unitbagian" data-unitbagian
                            {{ in_array('lihat unitbagian', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_unitbagian">
                          <input type="checkbox" class="toggle__input" id="tambah_unitbagian"
                            name="permissions[]" value="tambah unitbagian" data-unitbagian
                            {{ in_array('tambah unitbagian', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_unitbagian">
                          <input type="checkbox" class="toggle__input" id="edit_unitbagian"
                            name="permissions[]" value="edit unitbagian" data-unitbagian
                            {{ in_array('edit unitbagian', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_unitbagian">
                          <input type="checkbox" class="toggle__input" id="hapus_unitbagian"
                            name="permissions[]" value="hapus unitbagian" data-unitbagian
                            {{ in_array('hapus unitbagian', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Pengelola</td>
                      <td>
                        <label class="toggle" for="pengelolaCheckbox">
                          <input type="checkbox" class="toggle__input" id="pengelolaCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_pengelola">
                          <input type="checkbox" class="toggle__input" id="lihat_pengelola" name="permissions[]"
                            value="lihat pengelola" data-pengelola
                            {{ in_array('lihat pengelola', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_pengelola">
                          <input type="checkbox" class="toggle__input" id="tambah_pengelola" name="permissions[]"
                            value="tambah pengelola" data-pengelola
                            {{ in_array('tambah pengelola', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_pengelola">
                          <input type="checkbox" class="toggle__input" id="edit_pengelola" name="permissions[]"
                            value="edit pengelola" data-pengelola
                            {{ in_array('edit pengelola', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_pengelola">
                          <input type="checkbox" class="toggle__input" id="hapus_pengelola" name="permissions[]"
                            value="hapus pengelola" data-pengelola
                            {{ in_array('hapus pengelola', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Fasilitas</td>
                      <td>
                        <label class="toggle" for="fasilitasCheckbox">
                          <input type="checkbox" class="toggle__input" id="fasilitasCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_fasilitas">
                          <input type="checkbox" class="toggle__input" id="lihat_fasilitas" name="permissions[]"
                            value="lihat fasilitas" data-fasilitas
                            {{ in_array('lihat fasilitas', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_fasilitas">
                          <input type="checkbox" class="toggle__input" id="tambah_fasilitas" name="permissions[]"
                            value="tambah fasilitas" data-fasilitas
                            {{ in_array('tambah fasilitas', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_fasilitas">
                          <input type="checkbox" class="toggle__input" id="edit_fasilitas" name="permissions[]"
                            value="edit fasilitas" data-fasilitas
                            {{ in_array('edit fasilitas', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_fasilitas">
                          <input type="checkbox" class="toggle__input" id="hapus_fasilitas" name="permissions[]"
                            value="hapus fasilitas" data-fasilitas
                            {{ in_array('hapus fasilitas', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>SOP</td>
                      <td>
                        <label class="toggle" for="sopCheckbox">
                          <input type="checkbox" class="toggle__input" id="sopCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_sop">
                          <input type="checkbox" class="toggle__input" id="lihat_sop" name="permissions[]"
                            value="lihat sop" data-sop
                            {{ in_array('lihat sop', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_sop">
                          <input type="checkbox" class="toggle__input" id="tambah_sop" name="permissions[]"
                            value="tambah sop" data-sop
                            {{ in_array('tambah sop', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_sop">
                          <input type="checkbox" class="toggle__input" id="edit_sop" name="permissions[]"
                            value="edit sop" data-sop
                            {{ in_array('edit sop', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_sop">
                          <input type="checkbox" class="toggle__input" id="hapus_sop" name="permissions[]"
                            value="hapus sop" data-sop
                            {{ in_array('hapus sop', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Kerja Sama</td>
                      <td>
                        <label class="toggle" for="kerjaSamaCheckbox">
                          <input type="checkbox" class="toggle__input" id="kerjaSamaCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_kerjasama">
                          <input type="checkbox" class="toggle__input" id="lihat_kerjasama" name="permissions[]"
                            value="lihat kerjasama" data-kerjasama
                            {{ in_array('lihat kerjasama', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_kerjasama">
                          <input type="checkbox" class="toggle__input" id="tambah_kerjasama" name="permissions[]"
                            value="tambah kerjasama" data-kerjasama
                            {{ in_array('tambah kerjasama', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_kerjasama">
                          <input type="checkbox" class="toggle__input" id="edit_kerjasama" name="permissions[]"
                            value="edit kerjasama" data-kerjasama
                            {{ in_array('edit kerjasama', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_kerjasama">
                          <input type="checkbox" class="toggle__input" id="hapus_kerjasama" name="permissions[]"
                            value="hapus kerjasama" data-kerjasama
                            {{ in_array('hapus kerjasama', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Pelatihan</td>
                      <td>
                        <label class="toggle" for="pelatihanCheckbox">
                          <input type="checkbox" class="toggle__input" id="pelatihanCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_pelatihan">
                          <input type="checkbox" class="toggle__input" id="lihat_pelatihan" name="permissions[]"
                            value="lihat pelatihan" data-pelatihan
                            {{ in_array('lihat pelatihan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_pelatihan">
                          <input type="checkbox" class="toggle__input" id="tambah_pelatihan" name="permissions[]"
                            value="tambah pelatihan" data-pelatihan
                            {{ in_array('tambah pelatihan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_pelatihan">
                          <input type="checkbox" class="toggle__input" id="edit_pelatihan" name="permissions[]"
                            value="edit pelatihan" data-pelatihan
                            {{ in_array('edit pelatihan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_pelatihan">
                          <input type="checkbox" class="toggle__input" id="hapus_pelatihan" name="permissions[]"
                            value="hapus pelatihan" data-pelatihan
                            {{ in_array('hapus pelatihan', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                    <tr>
                      <td>Kalender Akademik</td>
                      <td>
                        <label class="toggle" for="kalenderAkademikCheckbox">
                          <input type="checkbox" class="toggle__input" id="kalenderAkademikCheckbox">
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="lihat_kalenderakademik">
                          <input type="checkbox" class="toggle__input" id="lihat_kalenderakademik" name="permissions[]"
                            value="lihat kalenderakademik" data-kalenderakademik
                            {{ in_array('lihat kalenderakademik', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="tambah_kalenderakademik">
                          <input type="checkbox" class="toggle__input" id="tambah_kalenderakademik" name="permissions[]"
                            value="tambah kalenderakademik" data-kalenderakademik
                            {{ in_array('tambah kalenderakademik', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="edit_kalenderakademik">
                          <input type="checkbox" class="toggle__input" id="edit_kalenderakademik" name="permissions[]"
                            value="edit kalenderakademik" data-kalenderakademik
                            {{ in_array('edit kalenderakademik', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                      <td>
                        <label class="toggle" for="hapus_kalenderakademik">
                          <input type="checkbox" class="toggle__input" id="hapus_kalenderakademik" name="permissions[]"
                            value="hapus kalenderakademik" data-kalenderakademik
                            {{ in_array('hapus kalenderakademik', $role_permissions) ? 'checked' : '' }}>
                          <span class="toggle-track">
                            <span class="toggle-indicator">
                              <span class="checkMark">
                                <svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
                                  <path
                                    d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z">
                                  </path>
                                </svg>
                              </span>
                            </span>
                          </span>
                        </label>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <div class="d-flex">
                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
  <script>
    document.getElementById('blogCheckbox').addEventListener('change', function() {
      var blogCheckboxes = document.querySelectorAll('[name="permissions[]"][data-blog]');
      blogCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('blogCheckbox').checked;
      });
    });

    document.getElementById('kurikulumLabCheckbox').addEventListener('change', function() {
      var kurikulumLabCheckboxes = document.querySelectorAll('[name="permissions[]"][data-kurikulumlab]');
      kurikulumLabCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('kurikulumLabCheckbox').checked;
      });
    });

    document.getElementById('bookingLabCheckbox').addEventListener('change', function() {
      var bookingLabCheckboxes = document.querySelectorAll('[name="permissions[]"][data-bookinglab]');
      bookingLabCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('bookingLabCheckbox').checked;
      });
    });

    document.getElementById('ruanganLabCheckbox').addEventListener('change', function() {
      var ruanganLabCheckboxes = document.querySelectorAll('[name="permissions[]"][data-ruanganlab]');
      ruanganLabCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('ruanganLabCheckbox').checked;
      });
    });

    document.getElementById('modulPraktikumCheckbox').addEventListener('change', function() {
      var modulPraktikumCheckboxes = document.querySelectorAll('[name="permissions[]"][data-modulpraktikum]');
      modulPraktikumCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('modulPraktikumCheckbox').checked;
      });
    });

    document.getElementById('jadwalPraktikumCheckbox').addEventListener('change', function() {
      var jadwalPraktikumCheckboxes = document.querySelectorAll('[name="permissions[]"][data-jadwalpraktikum]');
      jadwalPraktikumCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('jadwalPraktikumCheckbox').checked;
      });
    });

    document.getElementById('tujuanCheckbox').addEventListener('change', function() {
      var tujuanCheckboxes = document.querySelectorAll('[name="permissions[]"][data-tujuan]');
      tujuanCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('tujuanCheckbox').checked;
      });
    });

    document.getElementById('visiMisiCheckbox').addEventListener('change', function() {
      var visiMisiCheckboxes = document.querySelectorAll('[name="permissions[]"][data-visimisi]');
      visiMisiCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('visiMisiCheckbox').checked;
      });
    });

    document.getElementById('strukturOrganisasiCheckbox').addEventListener('change', function() {
      var strukturOrganisasiCheckboxes = document.querySelectorAll('[name="permissions[]"][data-strukturorganisasi]');
      strukturOrganisasiCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('strukturOrganisasiCheckbox').checked;
      });
    });

    document.getElementById('unitBagianCheckbox').addEventListener('change', function() {
      var unitBagianCheckboxes = document.querySelectorAll('[name="permissions[]"][data-unitbagian]');
      unitBagianCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('unitBagianCheckbox').checked;
      });
    });

    document.getElementById('pengelolaCheckbox').addEventListener('change', function() {
      var pengelolaCheckboxes = document.querySelectorAll('[name="permissions[]"][data-pengelola');
      pengelolaCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('pengelolaCheckbox').checked;
      });
    });

    document.getElementById('fasilitasCheckbox').addEventListener('change', function() {
      var fasilitasCheckboxes = document.querySelectorAll('[name="permissions[]"][data-fasilitas]');
      fasilitasCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('fasilitasCheckbox').checked;
      });
    });

    document.getElementById('sopCheckbox').addEventListener('change', function() {
      var sopCheckboxes = document.querySelectorAll('[name="permissions[]"][data-sop]');
      sopCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('sopCheckbox').checked;
      });
    });

    document.getElementById('kerjaSamaCheckbox').addEventListener('change', function() {
      var kerjaSamaCheckboxes = document.querySelectorAll('[name="permissions[]"][data-kerjasama]');
      kerjaSamaCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('kerjaSamaCheckbox').checked;
      });
    });

    document.getElementById('pelatihanCheckbox').addEventListener('change', function() {
      var pelatihanCheckboxes = document.querySelectorAll('[name="permissions[]"][data-pelatihan]');
      pelatihanCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('pelatihanCheckbox').checked;
      });
    });

    document.getElementById('kalenderAkademikCheckbox').addEventListener('change', function() {
      var kalenderAkademikCheckboxes = document.querySelectorAll('[name="permissions[]"][data-kalenderakademik]');
      kalenderAkademikCheckboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('kalenderAkademikCheckbox').checked;
      });
    });
  </script>
@endpush
