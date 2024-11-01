@extends('layouts.main')

@section('title', 'Kalender Akademik - Clarities')
@section('meta-description', 'Lihat kalender akademik terbaru dari UPN Veteran Jatim untuk
  mendapatkan informasi penting mengenai kegiatan akademik dan jadwal semester.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kalender Akademik</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Kalender Akademik</h2>

        @if ($kalenderAkademik->isEmpty())
          <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
        @else
          <div class="row g-5 mb-5">
            @foreach ($kalenderAkademik as $item)
              <div class="col-sm-6 col-xl-3">
                @php
                  if ($item->file) {
                      $file = '/storage/filepond-file/' . $item->file;
                  } elseif ($item->link) {
                      $file = $item->link;
                  } else {
                      $file = '#';
                  }
                @endphp
                <a href="{{ $file }}" target="_blank" class="card card-img-scale bg-transparent overflow-hidden"
                  style="position: relative">
                  <div class="card-img-scale-wrapper rounded-3">
                    @if ($item->image)
                      <img src="{{ asset('storage/filepond-image/' . $item->image) }}"
                        class="img-scale object-fit-cover object-position-center w-100" style="height: 22rem"
                        alt="cover kalender tahun akademik {{ $item->tahun_akademik }}">
                    @else
                      <img src="{{ asset('images/kalender-default.jpg') }}"
                        class="img-scale object-fit-cover object-position-center w-100" style="height: 22rem"
                        alt="cover kalender tahun akademik {{ $item->tahun_akademik }}">
                    @endif
                  </div>
                  <div class="card-body text-center p-2 w-100"
                    style="position: absolute; bottom: 0; left: 0; background-color: rgba(29, 78, 216, 0.3); backdrop-filter: blur(10px);">
                    <p class="mb-0 text-white font-weight-bold">Kalender Akademik Th.</p>
                    <p class="mb-0 text-white font-weight-bold">{{ $item->tahun_akademik }}</p>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
