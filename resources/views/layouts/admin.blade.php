{{-- resources/views/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Admin Dashboard</title> {{-- Untuk judul halaman dinamis --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Atau link ke CSS lokal kamu --}}
    {{-- <link href="{{ asset('css/admin_app.css') }}" rel="stylesheet"> --}}

    @stack('styles') {{-- Untuk CSS spesifik halaman --}}
</head>

<body>
    <div id="wrapper">

        {{-- 💡 Contoh Navbar Admin --}}
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAdmin"
                    aria-controls="navbarNavAdmin" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAdmin">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.tests.index') }}">Manage Tes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage-devisi') }}">Manage Devisi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.manage-loker') }}">Manage Loker</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.notifikasi') }}">Notifikasi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="content">
            <div class="container-fluid">
                {{-- Konten spesifik halaman akan di-inject di sini --}}
                @yield('content')
            </div>
        </div>

        {{-- 💡 Contoh Footer Admin --}}
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Admin Panel 2024</span>
                </div>
            </div>
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Atau link ke JS lokal kamu --}}
    {{-- <script src="{{ asset('js/admin_app.js') }}"></script> --}}

    @stack('scripts') {{-- Untuk JavaScript spesifik halaman --}}
</body>

</html>
