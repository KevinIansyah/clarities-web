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
                <h3 class="font-weight-bold">Tambah Data Jadwal Praktikum</h3>
                <h6 class="font-weight-normal mb-0">Tambahkan data Jadwal Praktikum Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.praktikum.jadwal.index') }}">Jadwal
                      Praktikum</a></li>
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
            <form action="{{ route('dashboard.praktikum.jadwal.store') }}" method="POST" class="form-sample"
              enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="instruktur">Instruktur</label>
                    <input type="text" class="form-control" id="instruktur" name="instruktur"
                      placeholder="Nama instruktur" required>
                  </div>
                </div>

                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="materi">Materi</label>
                    <input type="text" class="form-control" id="materi" name="materi"
                      placeholder="Materi praktikum" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="mata_kuliah">Mata Kuliah</label>
                    <input type="text" class="form-control" id="mata_kuliah" name="mata_kuliah"
                      placeholder="Nama mata kuliah." required>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="Kelas" required>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="number" class="form-control" id="semester" name="semester" placeholder="1 / 2 / 3 etc..." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="date_start">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="date_start" name="date_start"
                      placeholder="Tanggal mulai" required>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="date_end">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="date_end" name="date_end"
                      placeholder="Tanggal selesai" required>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="time_start">Jam Mulai</label>
                    <input type="time" class="form-control" id="time_start" name="time_start" required>
                  </div>
                </div>

                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="time_end">Jam Selesai</label>
                    <input type="time" class="form-control" id="time_end" name="time_end" required>
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
  <script type="module"></script>
@endpush
