@extends('layouts.main')

@section('title', 'SOP - Clarities')
@section('meta-description', 'Temukan Standar Operasional Prosedur (SOP) yang diterapkan di Clarities Laboratorium Hukum
  UPN Veteran Jatim untuk memastikan kegiatan berjalan sesuai dengan standar yang ditetapkan.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">SOP</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Standar Operasional Prosedur</h2>

        @if ($sop->isEmpty())
          <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
        @else
          <div class="row g-5 mb-5">
            @foreach ($sop as $item)
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
                        alt="cover prosedur operasi standar {{ $item->name }}">
                    @else
                      <img src="{{ asset('images/sop-default.jpg') }}"
                        class="img-scale object-fit-cover object-position-center w-100" style="height: 22rem"
                        alt="cover prosedur operasi standar {{ $item->name }}">
                    @endif
                  </div>
                  <div class="card-body text-center p-2 w-100"
                    style="position: absolute; bottom: 0; left: 0; background-color: rgba(239, 68, 68, 0.5); backdrop-filter: blur(10px);">
                    <p class="mb-0 text-white font-weight-bold">{{ $item->name }}</p>
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
