<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            @if (auth()->user()->isUser())
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard-user.*') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('dashboard-user.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('home.*') ? 'active' : '' }}"
                    href="{{ route('home.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Absen
                </a>
                <a class="nav-link {{ request()->routeIs('assignment-user.*') ? 'active' : '' }}"
                    href="{{ route('assignment-user.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Assignment
                </a>
                <a class="nav-link {{ request()->routeIs('information-user.*') ? 'active' : '' }}"
                    href="{{ route('information-user.index') }}">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Information
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
