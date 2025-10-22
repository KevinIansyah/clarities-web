<!DOCTYPE html>
<html lang="id">

<head>
  <title>@yield('title', 'Clarities - Laboratorium Hukum UPN "Veteran" Jawa Timur')</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="author" content="Clarities">
  <meta name="description" content="@yield('meta-description', 'Clarities merupakan Laboratorium Hukum Fakultas Hukum, UPN Veteran Jawa Timur.')">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="Clarities, Laboratorium Hukum, UPN Veteran Jatim, Fakultas Hukum, Lab Hukum UPN, Fakultas Hukum UPN Veteran Jatim, Lab Hukum UPN Veteran Jatim, pendidikan hukum, penelitian hukum, layanan hukum, konsultasi hukum, program studi hukum, pengembangan kapasitas hukum, kegiatan ilmiah, seminar hukum, workshop hukum, penelitian hukum Indonesia, pengabdian masyarakat, hukum positif, laboratorium penelitian, pemecahan masalah hukum, kegiatan mahasiswa, pengajaran hukum, kurikulum fakultas hukum, sistem peradilan, advokasi hukum, etika hukum, penelitian hukum publik, laboratorium penelitian hukum, proyek hukum, kolaborasi akademis, Jatim, Jawa Timur, UPN Jawa Timur, Fakultas Hukum Jawa Timur">

  <meta property="og:title" content="@yield('og-title', 'Clarities - Laboratorium Hukum UPN Veteran Jatim')">
  <meta property="og:description" content="@yield('og-description', 'Laboratorium Hukum Fakultas Hukum UPN Veteran Jawa Timur.')">
  <meta property="og:image" content="{{ asset('images/tab-logo.png') }}">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">

  <link rel="shortcut icon" href="{{ asset('images/tab-logo.png') }}">

  <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">

  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

  @include('partials.navbar')
  <main>
    @yield('main')
  </main>
  @include('partials.footer')

  <div class="back-top"><i class="fa-regular fa-arrow-up"></i></div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if (session('success'))
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        timerProgressBar: true,
        showConfirmButton: false
      });
    </script>
  @endif
  @if (session('error'))
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        timer: 5000,
        timerProgressBar: true,
        showConfirmButton: false
      });
    </script>
  @endif

  <script src="{{ asset('vendors/jarallax/jarallax.min.js') }}"></script>
  <script src="{{ asset('js/functions.js') }}"></script>

  @stack('scripts')

</body>

</html>