@extends('layouts.main')

@section('title', 'Tujuan - Clarities')
@section('meta-description', 'Jelajahi tujuan dari Clarities Laboratorium Hukum UPN Veteran Jatim, yang bertujuan untuk
  memberikan informasi, artikel, dan berita terbaru di bidang hukum.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-lg-8 mb-5 mb-lg-0 mx-auto">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tujuan</li>
          </ol>
        </nav>

        <h2 class="font-weight-bold mb-3 mb-lg-4 text-center">Tujuan Clarities</h2>

        @if ($tujuan->isEmpty())
          <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
        @else
          @foreach ($tujuan as $item)
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="bg-red-500 text-white rounded-circle d-flex align-items-center justify-content-center"
                style="min-width: 2rem; height: 2rem">{{ sprintf('%02d', $loop->iteration) }}</div>
              <p class="font-weight-normal mb-0">{{ $item->content }}</p>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
@endsection
