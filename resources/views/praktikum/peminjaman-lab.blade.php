@extends('layouts.main')

@section('title', 'Peminjaman Ruang Lab - Clarities')
@section('meta-description',
  'Informasi mengenai prosedur peminjaman ruang lab di Clarities Laboratorium Hukum UPN
  Veteran Jatim untuk kegiatan praktikum dan penelitian.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1 d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Peminjaman Ruang Lab</li>
            <li class="breadcrumb-item d-flex justify-content-center align-items-center"><button type="button"
                class="btn btn-danger" onclick="information()">Pinjam</button></li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Jadwal Peminjaman Ruang Lab</h2>

        <div class="p-3 p-md-4 shadow">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="booking-table" class="display expandable-table" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Mahasiswa</th>
                      <th>Tanggal</th>
                      <th>Jam Mulai</th>
                      <th>Jam Selesai</th>
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

  <div class="modal fade" id="showBookingLabModal" tabindex="-1" aria-labelledby="showBookingLabModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <form action="" method="POST" class="modal-content">
        @csrf
        @method('PUT')
        <div class="modal-header align-items-center py-2">
          <h6 class="modal-title" id="showBookingLabModalLabel">Detail Peminjaman Ruang Lab</h6>
          <button type="button" class="btn p-2" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti-close mx-1 my-2"></i>
          </button>
        </div>
        <div class="modal-body">
          <ul>
            <li>
              <p style="font-size: 0.9rem">Nama Mahasiswa : <strong id="nama_mahasiswa"></strong>
              </p>
            </li>
            <li>
              <p style="font-size: 0.9rem">NPM : <strong id="npm"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Angkatan : <strong id="angkatan"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Acara : <strong id="acara"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Peserta : <strong id="peserta"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Ruangan : <strong id="ruangan"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Tanggal : <strong id="tanggal"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Jam Mulai : <strong id="jam_mulai"></strong></p>
            </li>
            <li>
              <p style="font-size: 0.9rem">Jam Selesai : <strong id="jam_selesai"></strong></p>
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
    $('#booking-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    })

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
        url: "/praktikum/peminjaman-ruang-lab/data",
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
          data: 'time_end',
          name: 'time_end'
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
        url: "/praktikum/peminjaman-ruang-lab/detail/" + id,
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

    function information() {
      const formulirUrl = "{{ asset('pdf/formulir.pdf') }}";
      const sopUrl = "{{ asset('pdf/sop.pdf') }}";

      Swal.fire({
        title: 'Informasi',
        text: 'Silahkan menghubungi Admin untuk melakukan peminjaman ruang lab!',
        icon: 'info',
        html: `
                Silahkan unduh 
                <a href="${formulirUrl}" target="_blank">Formulir</a> peminjaman!
                Sebelum meminjam anda bisa membaca <a href="${sopUrl}" target="_blank">SOP</a> dahulu!
            `,
      });
    };
  </script>
@endpush
