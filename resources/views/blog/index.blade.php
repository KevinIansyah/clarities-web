@extends('layouts.main')

@section('title', $blog->title . ' - Clarities')
@section('meta-description', $blog->overview)

@section('main')
  <div class="container" style="margin-top: 8rem; margin-bottom: 5rem;">
    <div class="row g-4 g-sm-7">
      <div class="col-lg-8">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-dots mb-1">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
          </ol>
        </nav>

        <h2 class="font-weight-bold">{{ $blog->title }}</h2>

        <div class="d-flex align-items-center flex-wrap mt-4 gap-3">
          <a href="#" class="badge text-bg-dark mb-0">Blog</a>
          <span class="text-secondary opacity-3">|</span>
          <p class="text-secondary mb-0">{{ $blog->created_at->diffForHumans() }}</p>
          <span class="text-secondary opacity-3">|</span>
          <p class="text-secondary mb-0">{{ $blog->view }} dilihat</p>
          <span class="text-secondary opacity-3">|</span>
          <p class="text-secondary mb-0">{{ $blog->read }} menit baca</p>
        </div>

        <a href="{{ asset('storage/filepond-image/' . $blog->image) }}" data-fancybox data-caption="{{ $blog->title }}">
          <img src="{{ asset('storage/filepond-image/' . $blog->image) }}" class="img-fluid rounded mt-5"
            alt="foto blog {{ $blog->title }}">
        </a>

        <div class="mt-5 blog-content">
          {!! $blog->content !!}
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card card-body bg-light border p-4 w-100 mt-2 mt-lg-0">
          <div class="d-flex align-items-center gap-3">
            <div class="avatar flex-shrink-0">
              @if ($blog->user->gender == 'laki-laki')
                <img class="avatar-img rounded-circle" src="{{ asset('images/man-2.jpg') }}" alt="avatar">
              @else
                <img class="avatar-img rounded-circle" src="{{ asset('images/woman-2.jpg') }}" alt="avatar">
              @endif
            </div>
            <div>
              <h6 class="mb-0 text-red-500">{{ $blog->user->name }}</h6>
              <small>Penulis</small>
            </div>
          </div>
        </div>

        <div class="align-items-center mt-5">
          <h6 class="mb-3">Postingan terbaru :</h6>

          <ul class="list-group list-group-flush">
            @foreach ($latestBlogs as $item)
              <li class="list-group-item ps-0"><a href="{{ route('blog.show', $item->slug) }}"
                  class="heading-color text-primary-hover fw-semibold">{{ $item->title }}</a></li>
            @endforeach
          </ul>
        </div>

        <div class="align-items-center mt-5">
          <h6 class="mb-3">Tag terkait :</h6>
          <ul class="list-inline mb-0">
            @php
              $tags = explode(',', $blog->tag);
            @endphp
            @foreach ($tags as $tag)
              <li class="list-inline-item mb-2"><a class="btn btn-light"
                  href="{{ route('blog.search', ['tag' => $tag]) }}">{{ $tag }}</a></li>
            @endforeach
          </ul>
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
