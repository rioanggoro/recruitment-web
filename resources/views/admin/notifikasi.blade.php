@extends('layouts.master')

@section('title', 'Notifikasi Masuk')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-semibold text-white mb-6">Notifikasi Lamaran Masuk</h1>

        @if (auth()->user()->unreadNotifications->count() > 0)
            <form method="POST" action="{{ route('notifications.markRead') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                    Tandai semua sebagai dibaca
                </button>
            </form>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-900 text-white text-sm rounded-lg overflow-hidden shadow">
                <thead class="bg-gray-700 text-gray-300 text-left">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Nama Pelamar</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(auth()->user()->notifications as $i => $notif)
                        <tr class="border-t border-gray-700 hover:bg-gray-800">
                            <td class="px-4 py-3">{{ $i + 1 }}</td>
                            <td class="px-4 py-3">
                                {{ $notif->data['name'] ?? 'Tidak diketahui' }}
                            </td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($notif->created_at)->diffForHumans() }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if (is_null($notif->read_at))
                                    <span class="bg-yellow-400 text-black text-xs px-2 py-0.5 rounded-full">Baru</span>
                                @else
                                    <span class="bg-green-600 text-white text-xs px-2 py-0.5 rounded-full">Dibaca</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="/admin/manage-loker"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-4">
                                Tidak ada notifikasi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
