@extends('layouts.main')

@section('title', 'Kurikulum Lab - Clarities')
@section('meta-description',
  'Pelajari kurikulum terbaru di Clarities Laboratorium Hukum UPN Veteran Jatim yang
  dirancang untuk meningkatkan pemahaman dan keterampilan di bidang hukum.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1 d-flex justify-content-center align-items-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kurikulum Lab</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Kurikulum Lab</h2>


        <div class="p-3 p-md-4 shadow">
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table id="kurikulum-table" class="display expandable-table text-start" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Materi</th>
                      <th>Mata Kuliah</th>
                      <th>Semester</th>
                      <th>Tahun Akademik</th>
                      <th>File</th>
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
    $('#kurikulum-table').on('draw.dt', function() {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    })

    $('#kurikulum-table').DataTable({
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
        url: "/praktikum/kurikulum-lab/data",
        type: 'GET',
      },
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          className: 'text-center',
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
          data: 'semester',
          name: 'semester'
        },
        {
          data: 'tahun_akademik',
          name: 'tahun_akademik'
        },
        {
          data: 'file',
          name: 'file'
        },
      ]
    });
  </script>
@endpush
