@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <h3>Lamaran Pekerjaan</h3>
    </div>

    <div class="page-content">
        {{-- Notifikasi (status terbaru) --}}
        @if (auth()->user()->unreadNotifications->count() > 0)
            @foreach (auth()->user()->unreadNotifications as $notif)
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Notifikasi:</strong> {{ $notif->data['message'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"
                        onclick="markNotificationRead('{{ $notif->id }}')"></button>
                </div>
            @endforeach
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List Lamaran Anda</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 15%;">Lowongan</th>
                                    <th style="width: 10%;">Devisi</th>
                                    <th style="width: 20%;">Status Lamaran</th>
                                    <th style="width: 35%;">Keterangan</th>
                                    <th style="width: 20%;">Link Wawancara</th>
                                    <th class="text-center" style="width: 15%;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lamaran as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->loker->title }}</td>
                                        <td>{{ $item->loker->devisi->nama_devisi }}</td>
                                        <td>
                                            @if ($item->status_lamaran == 'seleksi')
                                                <span class="badge bg-primary">Proses Seleksi</span>
                                            @elseif ($item->status_lamaran == 'wawancara')
                                                <span class="badge bg-info text-dark">Tahap Wawancara</span>
                                            @elseif ($item->status_lamaran == 'diterima')
                                                <span class="badge bg-success">Diterima</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_lamaran == 'seleksi')
                                                Anda sedang dalam proses seleksi. Periksa kembali profil dan berkas Anda.
                                            @elseif ($item->status_lamaran == 'wawancara')
                                                Silakan periksa Email atau WhatsApp untuk undangan wawancara.
                                            @elseif ($item->status_lamaran == 'diterima')
                                                Selamat! Anda diterima.
                                            @else
                                                Mohon maaf, lamaran Anda tidak lolos.
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_lamaran == 'wawancara' && $item->link_wawancara)
                                                <a href="{{ $item->link_wawancara }}" target="_blank"
                                                    class="btn btn-sm btn-outline-info">
                                                    Join Wawancara
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/pelamar/detail-loker/{{ $item->loker_id }}"
                                                class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        @if ($lamaran->isEmpty())
                            <div class="text-center text-muted py-4">Belum ada lamaran yang dikirim.</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $('#table1').DataTable({
            responsive: true
        });

        // Tandai notifikasi sebagai dibaca
        function markNotificationRead(id) {
            fetch(`/notifikasi/baca/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
        }
    </script>
@endpush
