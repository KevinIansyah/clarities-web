<nav class="fixed-top navbar navbar-expand-lg @if (!request()->is('/')) scrolled @endif" data-bs-theme="dark">
  <div class="container py-2">
    <a href="/" class="navbar-brand d-flex align-items-center gap-2 text-decoration-none">
      <img style="width: 100%; height: 2rem;" src="{{ asset('images/logo.png') }}" alt="logo lab hukum clarities">
      <h5 class="text-white mb-0">CLARITIES</h5>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav w-100 flex justify-content-end">
        <li class="nav-item mx-0 mx-lg-2">
          <a class="nav-link font-weight-medium" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item mx-0 mx-lg-2 dropdown">
          <a class="nav-link font-weight-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Profil
          </a>
          <ul class="dropdown-menu @if (!request()->is('/')) scrolled @endif">
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.tujuan') }}">Tujuan</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.visi-misi') }}">Visi & Misi</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.struktur-organisasi') }}">Struktur Organisasi</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.unit-bagian') }}">Unit Bagian</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.pengelola') }}">Pengelola</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('profil.fasilitas') }}">Fasilitas</a></li>
          </ul>
        </li>
        <li class="nav-item mx-0 mx-lg-2 dropdown">
          <a class="nav-link font-weight-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Praktikum
          </a>
          <ul class="dropdown-menu @if (!request()->is('/')) scrolled @endif">
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('praktikum.modul-praktikum.index') }}">Modul</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('praktikum.jadwal-praktikum.index') }}">Jadwal</a>
            </li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('praktikum.kurikulum-lab.index') }}">Kurikulum
                Lab</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('praktikum.peminjaman-ruang-lab.index') }}">Peminjaman Ruang Lab</a></li>
          </ul>
        </li>
        <li class="nav-item mx-0 mx-lg-2 dropdown">
          <a class="nav-link font-weight-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Klinik Jurnal
          </a>
          <ul class="dropdown-menu @if (!request()->is('/')) scrolled @endif">
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="https://vsj.upnjatim.ac.id/index.php/vsj/index" target="_blank">Veteran SOC Jurnal</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="https://vjj.upnjatim.ac.id/index.php/vjj/index" target="_blank">Veteran Justice Jurnal</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="https://ligahukum.upnjatim.ac.id/index.php/ligahukum" target="_blank">Liga Hukum</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="https://prohutek.upnjatim.ac.id/index.php/prohutek/about/contact" target="_blank">Prohutek</a>
            </li>
          </ul>
        </li>
        <li class="nav-item mx-0 mx-lg-2">
          <a class="nav-link font-weight-medium" href="https://bkmbhfh.upnjatim.ac.id" target="_blank">Konsultasi &
            Bantuan Hukum</a>
        </li>
        <li class="nav-item mx-0 mx-lg-2">
          <a class="nav-link font-weight-medium" href="https://jdihn.go.id" target="_blank">JDIHN</a>
        </li>
        <li class="nav-item mx-0 mx-lg-2 dropdown">
          <a class="nav-link font-weight-medium dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Informasi
          </a>
          <ul class="dropdown-menu @if (!request()->is('/')) scrolled @endif">
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('informasi.sop') }}">SOP</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('informasi.kerja-sama') }}">Kerja
                Sama</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('informasi.pelatihan') }}">Pelatihan</a></li>
            <li><a class="dropdown-item @if (!request()->is('/')) scrolled @endif"
                href="{{ route('informasi.kalender-akademik') }}">Kalender
                Akademik</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
