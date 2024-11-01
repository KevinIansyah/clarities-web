<!DOCTYPE html>
<html lang="id">

<head>
  <title>Dashboard | Login</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="author" content="Clarities">
  <meta name="description"
    content="Clarities merupakan Laboratorium Hukum yang dimiliki oleh
          Fakultas Hukum, UPN Veteran Jawa Timur.">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/dashboard/login.css') }}">
</head>
</head>

<body>
  <div class="container login-container d-flex gap-5 flex-column justify-content-center align-items-center">
    <div class="d-flex justify-content-center w-100">
      <div class="login-box d-flex flex-column align-items-center shadow p-4 rounded">
        <img src="{{ asset('images/dashboard/profil.png') }}" class="mb-3 login-image rounded-circle"
          alt="gambar login">
        <h4 class="text-center title-h4 mb-2">Hii, Selamat Datang Kembali</h4>
        <p class="text-center decription-p mb-4">Masukkan Email dan Password Anda Untuk Masuk ke Dalam Aplikasi</p>
        <form action="/login" method="post" class="w-100">
          @csrf
          <div class="mb-3">
            @if (session()->has('loginError'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <input type="text" class="form-control w-100 @error('email') is-invalid @enderror" id="id"
              name="email" placeholder="Email anda" value="{{ old('email') }}" autofocus required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <input type="password" class="form-control w-100" id="password" name="password" placeholder="Password anda"
              required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
