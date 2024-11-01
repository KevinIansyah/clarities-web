@extends('layouts.main')

@section('title', 'Kerja Sama - Clarities')
@section('meta-description', 'Jelajahi berbagai kerja sama yang dilakukan oleh Clarities Laboratorium Hukum UPN Veteran
  Jatim dengan institusi lain untuk pengembangan akademik dan penelitian.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kerja Sama</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Kerja Sama</h2>

        @if ($kerjaSama->isEmpty())
          <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
        @else
          <div class="row g-5">
            @foreach ($kerjaSama as $item)
              <div class="col-6 col-md-3 col-lg-2 card-custom">
                <a href="{{ $item->link }}" target="_blank" class="card" style="position: relative">
                  <img src="{{ asset('storage/filepond-image/' . $item->image) }}"
                    class="img-scale-custom object-fit-cover object-position-center w-100"
                    alt="logo lembaga {{ $item->name }}">
                  <div
                    class="card-body-custom text-center p-2 w-100 rounded d-flex align-items-center justify-content-center">
                    <p class="mb-0 text-white font-weight-bold">{{ $item->name . ' (' . $item->type . ')' }}</p>
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
