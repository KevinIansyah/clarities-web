<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item @if (request()->routeIs('dashboard.index')) active @endif">
      <a class="nav-link" href="{{ route('dashboard.index') }}">
        <i class="fa-light fa-gauge menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    @role('admin')
      <li class="nav-item @if (request()->routeIs('dashboard.management-role.*')) active @endif">
        <a class="nav-link" href="{{ route('dashboard.management-role.index') }}">
          <i class="fa-light fa-gears menu-icon"></i>
          <span class="menu-title">Manajemen Role</span>
        </a>
      </li>

      <li class="nav-item @if (request()->routeIs('dashboard.user.*')) active @endif">
        <a class="nav-link" href="{{ route('dashboard.user.index') }}">
          <i class="fa-light fa-users menu-icon"></i>
          <span class="menu-title">Pengguna</span>
        </a>
      </li>
    @endrole

    @if (auth()->user()->can('lihat tujuan') ||
            auth()->user()->can('lihat visimisi') ||
            auth()->user()->can('lihat pengelola') ||
            auth()->user()->can('lihat fasilitas') ||
            auth()->user()->can('lihat strukturorganisasi') ||
            auth()->user()->can('lihat fasilitas') ||
            auth()->user()->can('lihat sop') ||
            auth()->user()->can('lihat kerjasama') ||
            auth()->user()->can('lihat pelatihan') ||
            auth()->user()->can('lihat kalenderakademik'))
      <li class="nav-item @if (request()->routeIs('dashboard.pages.*')) active @endif">
        <a class="nav-link" data-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="charts">
          <i class="fa-light fa-files menu-icon"></i>
          <span class="menu-title">Pages</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="pages">
          <ul class="nav flex-column sub-menu">
            @can('lihat tujuan')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.pages.tujuan.index') }}">Tujuan</a>
              </li>
            @endcan
            @can('lihat visimisi')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.pages.visi-misi.index') }}">Visi
                  Misi</a></li>
            @endcan
            @can('lihat strukturorganisasi')
              <li class="nav-item"> <a class="nav-link"
                  href="{{ route('dashboard.pages.struktur-organisasi.index') }}">Struktur Organisasi</a>
              </li>
            @endcan
            @can('lihat unitbagian')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.pages.unit-bagian.index') }}">Unit
                  Bagian</a>
              </li>
            @endcan
            @can('lihat pengelola')
              <li class="nav-item"> <a class="nav-link"
                  href="{{ route('dashboard.pages.pengelola.index') }}">Pengelola</a>
              </li>
            @endcan
            @can('lihat fasilitas')
              <li class="nav-item"> <a class="nav-link"
                  href="{{ route('dashboard.pages.fasilitas.index') }}">Fasilitas</a>
              </li>
            @endcan
            @can('lihat sop')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.pages.sop.index') }}">SOP</a>
              </li>
            @endcan
            @can('lihat kerjasama')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.pages.kerja-sama.index') }}">Kerja
                  Sama</a>
              </li>
            @endcan
            @can('lihat pelatihan')
              <li class="nav-item"> <a class="nav-link"
                  href="{{ route('dashboard.pages.pelatihan.index') }}">Pelatihan</a>
              </li>
            @endcan
            @can('lihat kalenderakademik')
              <li class="nav-item"> <a class="nav-link"
                  href="{{ route('dashboard.pages.kalender-akademik.index') }}">Kalender Akademik</a>
              </li>
            @endcan
          </ul>
        </div>
      </li>
    @endif

    @if (auth()->user()->can('lihat jadwalpraktikum') || auth()->user()->can('lihat modulpraktikum'))
      <li class="nav-item @if (request()->routeIs('dashboard.praktikum.*')) active @endif">
        <a class="nav-link" data-toggle="collapse" href="#praktikum" aria-expanded="false" aria-controls="charts">
          <i class="fa-light fa-chalkboard-user menu-icon"></i>
          <span class="menu-title">Praktikum</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="praktikum">
          <ul class="nav flex-column sub-menu">
            @can('lihat jadwalpraktikum')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.praktikum.jadwal.index') }}">Jadwal</a>
              </li>
            @endcan
            @can('lihat modulpraktikum')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.praktikum.modul.index') }}">Modul</a>
              </li>
            @endcan
          </ul>
        </div>
      </li>
    @endif

    @if (auth()->user()->can('lihat bookinglab') ||
            auth()->user()->can('lihat ruanganlab') ||
            auth()->user()->can('lihat kurikulumlab'))
      <li class="nav-item @if (request()->routeIs('dashboard.lab.*')) active @endif">
        <a class="nav-link" data-toggle="collapse" href="#lab" aria-expanded="false" aria-controls="charts">
          <i class="fa-light fa-flask menu-icon"></i>
          <span class="menu-title">Lab</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="lab">
          <ul class="nav flex-column sub-menu">
            @can('lihat kurikulumlab')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.lab.kurikulum.index') }}">Kurikulum</a>
              </li>
            @endcan
            @can('lihat bookinglab')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.lab.booking.index') }}">Booking</a>
              </li>
            @endcan
            @can('lihat ruanganlab')
              <li class="nav-item"> <a class="nav-link" href="{{ route('dashboard.lab.room.index') }}">Ruangan</a>
              </li>
            @endcan
          </ul>
        </div>
      </li>
    @endif

    @if (auth()->user()->can('lihat blog'))
      @can('lihat blog')
        <li class="nav-item @if (request()->routeIs('dashboard.blog.*')) active @endif">
          <a class="nav-link" href="{{ route('dashboard.blog.index') }}">
            <i class="fa-light fa-newspaper menu-icon"></i>
            <span class="menu-title">Blog</span>
          </a>
        </li>
      @endcan
    @endcan
</ul>
</nav>
