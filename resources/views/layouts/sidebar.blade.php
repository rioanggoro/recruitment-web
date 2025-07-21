<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        @if (Auth::user()->role == 'admin')
            <li class="sidebar-item">
                <a href="/admin/dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/admin/manage-devisi" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Manage Devisi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/admin/manage-loker" class='sidebar-link'>
                    <i class="bi bi-journal-check"></i>
                    <span>Manage Loker</span>
                </a>
            </li>
            {{-- 💡 TAMBAHKAN INI UNTUK ADMIN: Manage Tes --}}
            <li class="sidebar-item">
                <a href="{{ route('admin.tests.index') }}" class='sidebar-link'>
                    <i class="bi bi-file-earmark-text"></i> {{-- Icon yang relevan --}}
                    <span>Manage Tes</span>
                </a>
            </li>
            {{-- AKHIR TAMBAHAN ADMIN --}}
            <li class="sidebar-item">
                @php
                    $notifCount = auth()->user()->unreadNotifications->count();
                @endphp

                <a href="/admin/notifikasi" class='sidebar-link relative flex items-center justify-between'>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-bell"></i>
                        <span>Notifikasi</span>
                    </div>

                    @if ($notifCount > 0)
                        <span
                            class="absolute top-0 right-0 -mt-1 -mr-2 text-danger text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $notifCount }}
                        </span>
                    @endif
                </a>

            </li>
            <li class="sidebar-item">
                <a href="/admin/logout" class='sidebar-link'>
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        @else
            <li class="sidebar-item">
                <a href="/pelamar/dashboard" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/pelamar/loker" class='sidebar-link'>
                    <i class="bi bi-pc-display-horizontal"></i>
                    <span>Lowongan Pekerjaan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/pelamar/lamaran" class='sidebar-link'>
                    <i class="bi bi-file-earmark-medical-fill"></i>
                    <span>Lamaran Anda</span>
                </a>
            </li>
            {{-- 💡 TAMBAHKAN INI UNTUK PELAMAR: Tes Online --}}
            <li class="sidebar-item">
                <a href="{{ route('pelamar.test.selection') }}" class='sidebar-link'>
                    <i class="bi bi-pencil-square"></i> {{-- Icon yang relevan --}}
                    <span>Tes Online</span>
                </a>
            </li>
            {{-- AKHIR TAMBAHAN PELAMAR --}}
            <li class="sidebar-item">
                <a href="/pelamar/profile" class='sidebar-link'>
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/pelamar/notifikasi" class='sidebar-link position-relative'>
                    <i class="bi bi-bell"></i>
                    <span>Notifikasi</span>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    @endif
                </a>
            </li>
            <li class="sidebar-item">
                <a href="/pelamar/logout" class='sidebar-link'>
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        @endif
    </ul>
</div>
