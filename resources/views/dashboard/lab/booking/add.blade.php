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
                <h3 class="font-weight-bold">Tambah Data Booking Lab</h3>
                <h6 class="font-weight-normal mb-0">Tambahkan data Booking Lab Anda di sini!</h6>
              </div>

              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('dashboard.lab.booking.index') }}">Booking Lab</a></li>
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
            <form action="{{ route('dashboard.lab.booking.store') }}" method="POST" class="form-sample"
              enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="name">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama mahasiswa"
                      required>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="npm">NPM</label>
                    <input type="text" class="form-control" id="npm" name="npm" placeholder="210xxxxxxxxx"
                      required>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan"
                      placeholder="2021 / 2022 / ...." required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="event">Acara</label>
                    <input type="text" class="form-control" id="event" name="event"
                      placeholder="Acara / Kepentingan" required>
                  </div>
                </div>

                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="participant">Peserta</label>
                    <input type="text" class="form-control" id="participant" name="participant"
                      placeholder="Jumlah peserta" required>
                  </div>
                </div>


                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="room_lab_id">Ruangan Lab</label>
                    <select class="form-control" id="room_lab_id" name="room_lab_id" required>
                      <option selected disabled>Pilih ruangan lab</option>
                      @foreach ($roomLabs as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
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

              <div class="row">
                <div class="col-12">
                  <div class="form-group mb-0">
                    <label>Fasilitas</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 col-lg-3">
                  <div class="form-check form-check-primary form-group">
                    <label id="toga_hakim" class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="toga_hakim" name="toga_hakim" />
                      Toga Hakim
                    </label>
                  </div>
                </div>

                <div class="col-md-4 col-lg-3">
                  <div class="form-check form-check-primary form-group">
                    <label id="toga_jaksa" class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="toga_jaksa" name="toga_jaksa" />
                      Toga Jaksa
                    </label>
                  </div>
                </div>

                <div class="col-md-4 col-lg-3">
                  <div class="form-check form-check-primary form-group">
                    <label id="toga_penasihat_hukum" class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="toga_penasihat_hukum"
                        name="toga_penasihat_hukum" />
                      Toga Penasihat Hukum
                    </label>
                  </div>
                </div>

                <div class="col-md-4 col-lg-3">
                  <div class="form-check form-check-primary form-group">
                    <label id="baju_tahanan" class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="baju_tahanan" name="baju_tahanan" />
                      Baju Tahanan
                    </label>
                  </div>
                </div>

                <div class="col-md-4 col-lg-3">
                  <div class="form-check form-check-primary form-group">
                    <label id="baju_petugas_kepolisian" class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="baju_petugas_kepolisian"
                        name="baju_petugas_kepolisian" />
                      Baju Petugas Kepolisian
                    </label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="lainnya">Lainnya</label>
                    <textarea class="form-control" id="lainnya" name="lainnya" placeholder="Lainnya" rows="5"></textarea>
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
