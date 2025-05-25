@extends('layouts.master')

@section('title', 'Notifikasi Saya')

@section('content')
    <div class="container py-4">
        <h4 class="mb-3">Notifikasi Anda</h4>

        @if (auth()->user()->unreadNotifications->count())
            <form action="{{ route('pelamar.notifications.markRead') }}" method="POST" class="mb-3">
                @csrf
                <button class="btn btn-sm btn-primary">Tandai Semua Dibaca</button>
            </form>
        @endif

        <ul class="list-group">
            @forelse (auth()->user()->notifications as $notif)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-bold">{{ $notif->data['message'] ?? 'Notifikasi Kosong' }}</div>
                        <small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        @if ($notif->read_at === null)
                            <span class="badge bg-warning text-dark me-2">Baru</span>
                        @endif
                        <a href="{{ $notif->data['link'] ?? '#' }}" class="btn btn-sm btn-light">Lihat</a>
                        <form method="POST" action="{{ route('pelamar.notifications.destroy', $notif->id) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger btn-delete-notification">
                                Hapus
                            </button>
                        </form>

                    </div>
                </li>
            @empty
                <li class="list-group-item text-muted text-center">Tidak ada notifikasi.</li>
            @endforelse
        </ul>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete-notification').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Hapus Notifikasi?',
                    text: "Notifikasi ini akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
