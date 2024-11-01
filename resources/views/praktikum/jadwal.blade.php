@extends('layouts.main')

@section('title', 'Jadwal Praktikum - Clarities')
@section('meta-description', 'Lihat jadwal praktikum terbaru di Clarities Laboratorium Hukum UPN Veteran Jatim dan
  persiapkan diri Anda untuk pengalaman belajar yang optimal.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1 d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal Praktikum</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Jadwal Praktikum</h2>


        <div class="p-3 p-md-4 shadow">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="jadwal-table" class="display expandable-table text-start" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Instruktur</th>
                      <th>Materi</th>
                      <th>Mata Kuliah</th>
                      <th>Kelas</th>
                      <th>Tanggal</th>
                      <th>Jam</th>
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
@endsection

@push('scripts')
  <script>
    $('#jadwal-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    })

    $('#jadwal-table').DataTable({
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
        url: "/praktikum/jadwal-praktikum/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
        },
        {
          data: 'instruktur',
          name: 'instruktur'
        },
        {
          data: 'materi',
          name: 'materi'
        },
        {
          data: 'mata_kuliah',
          name: 'mata_kuliah'
        },
        {
          data: 'kelas',
          name: 'kelas'
        },
        {
          data: 'date',
          name: 'date'
        },
        {
          data: 'time',
          name: 'time'
        },
      ]
    });
  </script>
@endpush
