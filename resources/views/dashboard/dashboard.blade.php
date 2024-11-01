@extends('dashboard.layouts.main')

@section('main')
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Welcome {{ auth()->user()->name }}</h3>
            <h6 class="font-weight-normal mb-0">Selamat datang di Aplikasi <span class="text-primary">Clarities!</span></h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg p-3 d-flex justify-content-start align-items-start" style="background-image: url('{{ asset($weatherBackground) }}'); background-size: cover; background-position: center;">
          <div class="d-flex rounded px-2" style="backdrop-filter: blur(6px)">
            <div class="d-flex flex-column align-items-center">
              <p class="text-white">{{ $weatherData['name'] . ", " . $weatherData['sys']['country'] }}</p>
              {!! $weatherIcon !!}
              <h2 class="mb-0 text-white mt-2">{{ $tempInCelsius }}°C</h2>
              <p class="text-white mb-0 mt-1 text-capitalize">{{ $weatherData['weather'][0]['description'] }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Total Peminjaman Lab</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fs-30 mb-0">{{ $totalPeminjamanLab }}</p>
                  <i class="fs-30 fa-thin fa-building-memo"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Total Pengguna</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fs-30 mb-0">{{ $totalPengguna }}</p>
                  <i class="fs-30 fa-light fa-users"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Total Blog</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fs-30 mb-0">{{ $totalBlog }}</p>
                  <i class="fs-30 fa-light fa-newspaper"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Total Pelihat Blog</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fs-30 mb-0">{{ $totalBlogViews }}</p>
                  <i class="fs-30 fa-light fa-eye"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection