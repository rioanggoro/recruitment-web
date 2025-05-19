@extends('layouts.master')

@section('title', 'Notifikasi Masuk')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Notifikasi Lamaran Masuk</h1>

        @if (auth()->user()->unreadNotifications->count() > 0)
            <form method="POST" action="{{ route('notifications.markRead') }}" class="mb-4">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">
                    Tandai semua sebagai dibaca
                </button>
            </form>
        @endif

        <div class="table-responsive bg-dark p-3 rounded shadow">
            <table class="table table-dark table-bordered table-striped table-hover text-sm align-middle mb-0">
                <thead class="table-secondary text-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pelamar</th>
                        <th>Waktu</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->notifications as $i => $notif)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $notif->data['pelamar_name'] ?? 'Tidak diketahui' }}</td>
                            <td>{{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}</td>
                            <td class="text-center">
                                @if (is_null($notif->read_at))
                                    <span class="badge bg-warning text-dark">Baru</span>
                                @else
                                    <span class="badge bg-success">Dibaca</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/manage-loker" class="btn btn-sm btn-light border me-1">
                                    Lihat
                                </a>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteNotifModal{{ $notif->id }}">
                                    Hapus
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteNotifModal{{ $notif->id }}" tabindex="-1"
                                    aria-labelledby="deleteNotifModalLabel{{ $notif->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title" id="deleteNotifModalLabel{{ $notif->id }}">
                                                    Konfirmasi Hapus Notifikasi
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus notifikasi ini?
                                            </div>
                                            <div class="modal-footer border-0">
                                                <form action="{{ route('notifications.destroy', $notif->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada notifikasi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
