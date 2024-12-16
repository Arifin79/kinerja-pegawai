<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isAdmin() or auth()->user()->isOperator())
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                    {{-- href="{{ route('dashboard.index') }}"> --}}
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('information.*') ? 'active' : '' }}" href="{{ route('information.index') }}">
                    {{-- href="{{ route('information.index') }}"> --}}
                    <span data-feather="bell" class="align-text-bottom"></span>
                    Informasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('assignment.*') ? 'active' : '' }}" href="{{ route('assignment.index') }}">
                    {{-- href="{{ route('assignment.index') }}"> --}}
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    Tugas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('task.*') ? 'active' : '' }}" href="{{ route('task.index') }}">
                    {{-- href="{{ route('task.index') }}"> --}}
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    File Project
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}"
                    href="{{ route('positions.index') }}">
                    <span data-feather="tag" class="align-text-bottom"></span>
                    Jabatan / Posisi
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" href="{{ route('employees.index') }}">
                    {{-- href="{{ route('employees.index') }}"> --}}
                    <span data-feather="users" class="align-text-bottom"></span>
                    Karyawaan
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('holidays.*') ? 'active' : '' }}"
                    href="{{ route('holidays.index') }}">
                    <span data-feather="calendar" class="align-text-bottom"></span>
                    Hari Libur
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('location.index.*') ? 'active' : '' }}" href="{{ route('location.index') }}">
                    {{-- href="{{ route('location.index') }}"> --}}
                    <span data-feather="map-pin" class="align-text-bottom"></span>
                    Location
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('attendances.*') ? 'active' : '' }}" href="{{ route('attendances.index') }}">
                    {{-- href="{{ route('attendances.index') }}"> --}}
                    <span data-feather="clipboard" class="align-text-bottom"></span>
                    Absensi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('presences.*') ? 'active' : '' }}" href="{{ route('presences.index') }}">
                    {{-- href="{{ route('presences.index') }}"> --}}
                    <span data-feather="check-square" class="align-text-bottom"></span>
                    Data Kehadiran
                </a>
            </li>
            @endif
        </ul>
        

        <form action="{{ route('auth.logout') }}" method="post"
            onsubmit="return confirm('Apakah anda yakin ingin keluar?')">
            @method('DELETE')
            @csrf
            <button class="w-full mt-4 d-block bg-transparent border-0 fw-bold text-danger px-3">Keluar</button>
        </form>
    </div>
</nav>
