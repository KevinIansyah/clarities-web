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
                <h3 class="font-weight-bold">Data Booking Lab</h3>
                <h6 class="font-weight-normal mb-0">Kelola data Booking Lab Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Booking Lab</li>
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
              @can('tambah bookinglab')
                <a href="{{ route('dashboard.lab.booking.create') }}" class="btn btn-primary btn-icon-text btn-sm">
                  <i class="ti-plus btn-icon-prepend"></i>
                  Tambah Booking
                </a>
              @endcan
            </div>

            <div class="row">
              <div class="col-12">
                <div class="table-responsive">
                  <table id="booking-table" class="display expandable-table" style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Acara</th>
                        <th>Ruangan</th>
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

  <div class="modal fade" id="showBookingLabModal" tabindex="-1" aria-labelledby="showBookingLabModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h4 class="modal-title fs-6" id="showBookingLabModalLabel">Detail Booking Lab</h4>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <ul>
            <li>
              <p>Nama Mahasiswa : <strong id="nama_mahasiswa"></strong></p>
            </li>
            <li>
              <p>NPM : <strong id="npm"></strong></p>
            </li>
            <li>
              <p>Angkatan : <strong id="angkatan"></strong></p>
            </li>
            <li>
              <p>Acara : <strong id="acara"></strong></p>
            </li>
            <li>
              <p>Peserta : <strong id="peserta"></strong></p>
            </li>
            <li>
              <p>Ruangan : <strong id="ruangan"></strong></p>
            </li>
            <li>
              <p>Tanggal : <strong id="tanggal"></strong></p>
            </li>
            <li>
              <p>Jam Mulai : <strong id="jam_mulai"></strong></p>
            </li>
            <li>
              <p>Jam Selesai : <strong id="jam_selesai"></strong></p>
            </li>
            <li>
              <p>Admin : <strong id="admin"></strong></p>
            </li>
          </ul>

          <p>Fasilitas</p>
          <ul>
            <li>
              <p>Toga Hakim : <strong id="toga_hakim"></strong></p>
            </li>
            <li>
              <p>Toga Jaksa : <strong id="toga_jaksa"></strong></p>
            </li>
            <li>
              <p>Toga Penasihat Hukum : <strong id="toga_penasihat_hukum"></strong></p>
            </li>
            <li>
              <p>Baju Tahanan : <strong id="baju_tahanan"></strong></p>
            </li>
            <li>
              <p>Baju Petugas Kepolisian : <strong id="baju_petugas_kepolisian"></strong></p>
            </li>
          </ul>

          <p>Lainnya</p>
          <p id="lainnya"></p>
        </div>
        <div class="modal-footer py-2 px-4 d-flex flex-row justify-content-center justify-content-md-end gap-2">
          <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#booking-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });

    $('#booking-table').DataTable({
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
        url: "/dashboard/lab/booking/data",
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
          data: 'date',
          name: 'date'
        },
        {
          data: 'time',
          name: 'time'
        },
        {
          data: 'event',
          name: 'event'
        },
        {
          data: 'room',
          name: 'room'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

    function destroyBookingLab(id) {
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
            url: "/dashboard/lab/booking/" + id,
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
                    $('#booking-table').DataTable().ajax.reload();
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

    function formattedDate(dateStart, dateEnd) {
      dateStart = new Date(dateStart);
      dateEnd = new Date(dateEnd);

      if (dateStart.getTime() === dateEnd.getTime()) {
        return dateStart.toLocaleDateString('id-ID', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
      } else {
        return dateStart.toLocaleDateString('id-ID', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        }) + ' - ' + dateEnd.toLocaleDateString('id-ID', {
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
      }
    }

    function showBookingLab(id) {
      $.ajax({
        url: "/dashboard/lab/booking/" + id,
        type: 'GET',
        success: function(response) {
          if (response.success) {
            console.log(response);
            $('#nama_mahasiswa').text(response.data.name);
            $('#npm').text(response.data.npm);
            $('#angkatan').text(response.data.angkatan);
            $('#acara').text(response.data.event);
            $('#peserta').text(response.data.participant);
            $('#ruangan').text(response.data.room_lab.name);
            $('#tanggal').text(formattedDate(response.data.date_start, response.data.date_end));
            $('#jam_mulai').text(response.data.time_start);
            $('#jam_selesai').text(response.data.time_end);
            $('#admin').text(response.data.user.name);
            $('#toga_hakim').text(response.data.toga_hakim ? 'Ya' : 'Tidak');
            $('#toga_jaksa').text(response.data.toga_jaksa ? 'Ya' : 'Tidak');
            $('#toga_penasihat_hukum').text(response.data.toga_penasihat_hukum ? 'Ya' : 'Tidak');
            $('#baju_tahanan').text(response.data.baju_tahanan ? 'Ya' : 'Tidak');
            $('#baju_petugas_kepolisian').text(response.data.baju_petugas_kepolisian ? 'Ya' : 'Tidak');
            $('#lainnya').text(response.data.lainnya ? response.data.lainnya : '-');

            $('#showBookingLabModal').modal('show');
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
