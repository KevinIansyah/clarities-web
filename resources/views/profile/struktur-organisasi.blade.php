@extends('layouts.main')

@section('title', 'Struktur Organisasi - Clarities')
@section('meta-description', 'Lihat struktur organisasi Clarities Laboratorium Hukum UPN Veteran Jatim, yang
  mencerminkan komitmen kami dalam mengembangkan penelitian dan pendidikan hukum yang berkualitas.')

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row">
      <div class="col-xl-12">
        <nav class="d-flex justify-content-center w-100" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
          </ol>
        </nav>

        <h2 class="mb-5 font-weight-bold text-center">Struktur Organisasi Clarities</h2>

        <div class="oraganization-img w-100 d-flex justify-content-center">
          @if (is_null($strukturOrganisasi))
            <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
          @else
            <a href="{{ asset('storage/filepond-image/' . $strukturOrganisasi->image) }}" data-fancybox
              data-caption="Struktur Organisasi">
              <img src="{{ asset('storage/filepond-image/' . $strukturOrganisasi->image) }}"
                alt="gambar struktur organisasi">
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    Fancybox.bind('[data-fancybox]', {});
  </script>
@endpush
