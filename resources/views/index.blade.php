@extends('layouts.main')

@section('title', 'Clarities - Laboratorium Hukum UPN Veteran Jatim')
@section('meta-description', 'Temukan artikel dan berita terbaru dari Clarities Laboratorium Hukum UPN Veteran Jatim.')

@section('main')
  <div id="carouselExampleInterval" class="carousel slide rounded" data-bs-ride="carousel" style="height: 100vh">
    <div class="carousel-indicators">
      @foreach ($banner_blogs as $key => $item)
        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{ $key }}"
          class="{{ $key == 0 ? 'active' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
      @endforeach
    </div>

    <div class="carousel-inner rounded h-100">
      @foreach ($banner_blogs as $key => $item)
        <div class="carousel-item {{ $key == 0 ? 'active' : '' }} rounded h-100"
          style="background-image: url('{{ asset('storage/filepond-image/' . $item->image) }}'); background-position: center; background-size: cover;">

          <div class="dark-overlay"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.7); z-index: 1;">
          </div>

          <div class="container d-flex gap-4 flex-column align-items-center justify-content-center mx-auto h-100"
            style="position: relative; z-index: 2; width: 80%;">
            <span class="badge text-bg-dark mb-0">Blog</span>

            <h1 class="h2 text-center font-weight-bold">
              <a href="{{ route('blog.show', $item->slug) }}" class="text-white">{{ $item->title }}</a>
            </h1>
            <div class="d-flex flex-column gap-2 flex-md-row">
              <div class="d-flex align-items-center gap-2">
                <i class="fa-light fa-user text-white"></i>
                <p class="text-white mb-0">{{ $item->user->name }}</p>
              </div>
              <span class="text-white d-none d-md-block mx-2">•</span>
              <div class="d-flex align-items-center gap-2">
                <i class="fa-light fa-calendar-days text-white"></i>
                <p class="text-white mb-0">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</p>
              </div>
              <span class="text-white d-none d-md-block mx-2">•</span>
              <div class="d-flex align-items-center gap-2">
                <i class="fa-light fa-timer text-white"></i>
                <p class="text-white mb-0">{{ $item->read }} menit baca</p>
              </div>
            </div>
            <form class="d-flex banner-search" role="search" method="GET" action="{{ route('blog.search') }}">
              <input class="form-control me-2" type="search" name="search" placeholder="Cari blog..."
                aria-label="Search">
            </form>
          </div>
        </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  @if ($pelatihan)
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header p-4 d-flex justify-content-between align-items-center gap-4">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi Pelatihan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-3">
            <a href="{{ route('informasi.pelatihan.detail', $pelatihan->slug) }}">
              <img src="{{ asset('storage/filepond-image/' . $pelatihan->image) }}" class="w-100 h-100 rounded"
                alt="gambar pelatihan">
            </a>

          </div>
        </div>
      </div>
    </div>
  @endif


  <div class="container" style="margin-top: 5rem; margin-bottom: 5rem">
    <div class="row g-5 mb-5">
      @foreach ($blogs as $item)
        <div class="col-md-6 col-lg-4">
          <a href="{{ route('blog.show', $item->slug) }}" class="d-flex flex-column gap-2 rounded text-decoration-none"
            style="cursor: pointer; position: relative;">
            <img src="{{ asset('storage/filepond-image/' . $item->image) }}"
              class="w-100 object-fit-cover object-position-center rounded" style="height: 12rem"
              alt="foto blog {{ $item->title }}">
            <div class="px-2 mt-2">

              <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge btn-inverse-secondary mb-2">
                  {{ $item->created_at->diffForHumans() }}</span>
                <span class="badge btn-inverse-secondary mb-2">
                  {{ $item->view }} dilihat</span>
                <span class="badge btn-inverse-secondary mb-2">
                  {{ $item->read }} menit baca</span>
              </div>

              <p class="blog-title font-weight-semibold text-black">{{ $item->title }}</p>
              <p class="blog-overview text-gray-600">{{ $item->overview }}</p>
              <div class="d-flex align-items-center justify-content-end">
                <div class="badge btn-inverse-danger d-flex align-items-center gap-2">
                  <p class="mb-0" style="font-size: 0.9rem">Read More</p>
                  <i class="fa-light fa-arrow-right"></i>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>

    <div class="row mt-7">
      <div class="col-12 mx-auto">
        <ul class="pagination d-flex justify-content-center mb-0 d-sm-none">
          @if ($blogs->onFirstPage())
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->previousPageUrl() }}">Prev</a>
            </li>
          @endif

          @if ($blogs->lastPage() == 1)
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
          @elseif ($blogs->lastPage() == 2)
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->url(2) }}">2</a>
            </li>
          @else
            @if ($blogs->currentPage() == 1)
              <li class="page-item active">
                <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a>
              </li>
            @elseif ($blogs->currentPage() == $blogs->lastPage())
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item active">
                <a class="page-link" href="#">{{ $blogs->currentPage() }}</a>
              </li>
            @else
              <li class="page-item active">
                <a class="page-link" href="#">{{ $blogs->currentPage() }}</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a>
              </li>
            @endif
          @endif

          @if ($blogs->hasMorePages())
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next</a>
            </li>
          @else
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
            </li>
          @endif
        </ul>
        <ul class="pagination pagination-lg d-flex justify-content-center mb-0 d-none d-sm-flex">
          @if ($blogs->onFirstPage())
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Prev</a>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->previousPageUrl() }}">Prev</a>
            </li>
          @endif

          @if ($blogs->lastPage() == 1)
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
          @elseif ($blogs->lastPage() == 2)
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->url(2) }}">2</a>
            </li>
          @else
            @if ($blogs->currentPage() == 1)
              <li class="page-item active">
                <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a>
              </li>
            @elseif ($blogs->currentPage() == $blogs->lastPage())
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item active">
                <a class="page-link" href="#">{{ $blogs->currentPage() }}</a>
              </li>
            @else
              <li class="page-item active">
                <a class="page-link" href="#">{{ $blogs->currentPage() }}</a>
              </li>
              <li class="page-item disabled"><span class="page-link">...</span></li>
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a>
              </li>
            @endif
          @endif

          @if ($blogs->hasMorePages())
            <li class="page-item">
              <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next</a>
            </li>
          @else
            <li class="page-item disabled">
              <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="{{ asset('js/utils/navbar-initiator.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      let exampleModalElement = document.getElementById('exampleModal');

      if (exampleModalElement) {
        let exampleModal = new bootstrap.Modal(exampleModalElement, {
          backdrop: 'static',
          keyboard: false
        });

        exampleModal.show();
      } else {
        console.log('Modal tidak ada karena $pelatihan adalah null.');
      }
    });
  </script>
@endpush
