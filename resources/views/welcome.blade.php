<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/auth.css') }}">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12" style="overflow-y: auto;">
                <div id="auth-left" class="d-flex flex-column justify-content-center h-100">
                    <div class="auth-logo mb-4">
                        <a href="index.html"><img
                                src="{{ asset('assets/Images/3cee983f1407f2ab18b788e45732bf40.webp') }}"
                                style="width: 200px; height: auto;" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Silahkan Login Menggunakan Akun Anda</p>

                    <form id="loginForm" action="/login" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('username') is-invalid @enderror"
                                name="username" placeholder="Username" value="{{ old('username') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                name="password" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-gray-600" for="remember">
                                Ingat Saya
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Belum memiliki akun?? <a href="/registrasi" class="font-bold">Daftar
                                Disini</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block"
                style="position: fixed; right: 0; top: 50%; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0);">
                <div id="auth-right">
                    <!-- Tambahkan gambar ilustratif di sini -->
                    <img src="{{ asset('assets/Images/Job hunt-cuate.svg') }}" class="mt-5"
                        style="width: 100%; height: auto;" alt="Ilustratif">
                </div>
            </div>
        </div>

    </div>

    <script>
        // Menangkap pesan sukses dan error dari controller
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showCloseButton: true,
                showConfirmButton: false,
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showCloseButton: true,
                showConfirmButton: false,
            });
        @endif
    </script>
</body>

</html>
