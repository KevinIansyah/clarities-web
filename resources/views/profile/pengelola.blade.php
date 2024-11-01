@extends('layouts.main')

@section('title', 'Pengelola - Clarities')
@section('meta-description', 'Kenali tim pengelola Clarities Laboratorium Hukum UPN Veteran Jatim yang berkomitmen dalam meningkatkan kualitas penelitian dan pendidikan di bidang hukum.')

@section('main')
  <div class="w-100" style="margin-top: 5rem;">
    <div class="card bg-parallax"
      style="background:url({{ asset('images/bg/04.jpg') }}) no-repeat; background-size:cover; background-position:center;">
      <div class="dark-overlay"
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
      </div>
      <div class="card-img-overlay d-flex align-items-center justify-content-center text-center z-index-2">
        <h1 class="text-white text-center font-weight-bold">We're Clarities</h1>
      </div>
    </div>
  </div>

  <div class="container" style="margin-top: 5rem; margin-bottom: 5rem;">
    @if ($pengelola->isEmpty())
      <p class="mb-0 text-gray-500 fst-italic text-center">Belum ada data untuk ditampilkan!</p>
    @else
      <div class="row g-4 g-sm-6">
        @foreach ($pengelola as $item)
          <div class="col-sm-6 col-xl-3">
            <div class="card card-img-scale bg-transparent overflow-hidden" style="position: relative">
              <div class="m-3" style="position:absolute; top: 0; right: 0; z-index: 2;">
                <ul class="list-inline mb-0 mb-2 mb-sm-0">
                  @if ($item->facebook)
                    <li class="list-inline-item">
                      <a class="btn-icon btn-sm rounded mb-2 text-decoration-none bg-facebook" target="_blank"
                        href="{{ $item->facebook }}"><i class="fab fa-fw fa-facebook-f"></i></a>
                    </li>
                  @endif

                  @if ($item->instagram)
                    <li class="list-inline-item">
                      <a class="btn-icon btn-sm rounded mb-2 text-decoration-none bg-instagram-gradient" target="_blank"
                        href="{{ $item->instagram }}"><i class="fab fa-fw fa-instagram"></i></a>
                    </li>
                  @endif

                  @if ($item->twitter)
                    <li class="list-inline-item">
                      <a class="btn-icon btn-sm rounded mb-2 text-decoration-none bg-twitter" target="_blank"
                        href="{{ $item->twitter }}"><i class="fab fa-fw fa-twitter"></i></a>
                    </li>
                  @endif

                  @if ($item->linkedin)
                    <li class="list-inline-item">
                      <a class="btn-icon btn-sm rounded mb-2 text-decoration-none bg-linkedin" target="_blank"
                        href="{{ $item->linkedin }}"><i class="fab fa-fw fa-linkedin-in"></i></a>
                    </li>
                  @endif
                </ul>
                </ul>
              </div>
              <div class="card-img-scale-wrapper rounded-3">
                <a href="{{ asset('storage/filepond-image/' . $item->image) }}" data-fancybox="gallery"
                  data-caption="{{ $item->name . ' ( ' . $item->position . ' ) ' }}">
                  <img src="{{ asset('storage/filepond-image/' . $item->image) }}"
                    class="img-scale object-fit-cover object-position-center" alt="foto pengelola {{ $item->name }}">
                </a>
              </div>
              <div class="card-body text-center p-2 bg-red-500 w-100"
                style="position: absolute; bottom: 0; left: 0; background-color: transparent; backdrop-filter: blur(10px);">
                <p class="mb-0 text-white font-weight-bold">{{ $item->name }}</p>
                <p class="mb-0 text-white">{{ $item->position }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
@endsection

@push('scripts')
  <script>
    Fancybox.bind('[data-fancybox="gallery"]', {});
  </script>
@endpush
