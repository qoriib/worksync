<nav class="navbar navbar-expand-lg bg-body-secondary">
    <div class="container g-5">
        <a class="navbar-brand" href="/">WorkSync</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-offcanvas">
            @auth
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.karyawan.view') }}">Data Karyawan</a>
                        </li>
                    @elseif (Auth::user()->role === 'user')
                        <li class="nav-item">
                            <a class="nav-link" href="#">Presensi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Pengajuan Cuti</a>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav hstack justify-content-between gap-3 ms-auto">
                    <li class="nav-item">
                        <span class="navbar-text">
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout.handle') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>