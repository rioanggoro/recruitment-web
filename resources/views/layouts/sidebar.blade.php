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
            <li class="sidebar-item">
                @php
                    $notifCount = auth()->user()->unreadNotifications->count();
                @endphp

                <a href="/admin/notifikasi" class='sidebar-link relative flex items-center gap-2'>
                    <i class="bi bi-bell"></i>
                    <span>Notifikasi</span>

                    @if ($notifCount > 0)
                        <span class="absolute top-1.5 right-3 w-2.5 h-2.5 bg-red-600 rounded-full animate-ping"></span>
                        <span class="absolute top-1.5 right-3 w-2.5 h-2.5 bg-red-600 rounded-full"></span>
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
            <li class="sidebar-item">
                <a href="/pelamar/profile" class='sidebar-link'>
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
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
