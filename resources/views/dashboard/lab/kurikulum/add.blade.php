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
                <h3 class="font-weight-bold">Tambah Data Kurikulum Lab</h3>
                <h6 class="font-weight-normal mb-0">Tambahkan data Kurikulum Lab Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.lab.kurikulum.index') }}">Kurikulum Lab</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('dashboard.lab.kurikulum.store') }}" method="POST" class="form-sample"
              enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="materi">Materi</label>
                    <input type="text" class="form-control" id="materi" name="materi"
                      placeholder="Materi praktikum" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="mata_kuliah">Mata Kuliah</label>
                    <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah"
                      placeholder="Nama mata kuliah." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="number" class="form-control" id="semester" name="semester"
                      placeholder="1 / 2 / 3 etc..." required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="tahun_akademik">Tahun Akademik</label>
                    <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik"
                      placeholder="Tahun akademik, contoh: 2024/2025 etc..." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="file_pdf">File PDF</label>
                    <input type="file" class="filepond file_pdf" name="file">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="Link Drive">
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    FilePond.create(
      document.querySelector('.file_pdf'), {
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
  </script>
@endpush
