@extends('layouts.master')

@section('title', 'Hasil Tes Pelamar')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Hasil Tes Pelamar</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Hasil Tes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pelamar</th>
                                <th>Nama Tes</th>
                                <th>Skor</th>
                                <th>Status Kelulusan</th>
                                <th>Waktu Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userTests as $userTest)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $userTest->user->name ?? 'N/A' }}</td>
                                    <td>{{ $userTest->test->name ?? 'N/A' }}</td>
                                    <td>{{ $userTest->score ?? '-' }}</td>
                                    <td>
                                        @php
                                            $score = $userTest->score;
                                            $isPassed = $userTest->passed;
                                            if ($score !== null && $score < 50) {
                                                $isPassed = false;
                                            }
                                        @endphp
                                        @if ($isPassed !== null)
                                            @if ($isPassed)
                                                <span class="badge bg-success">Lulus</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Lulus</span>
                                            @endif
                                        @else
                                            <span class="badge bg-secondary">Belum Dinilai</span>
                                        @endif
                                    </td>
                                    <td>{{ $userTest->completed_at ? $userTest->completed_at->format('d M Y H:i') : 'Belum Selesai' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.user_tests.show', $userTest->id) }}"
                                            class="btn btn-info btn-sm">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pelamar yang menyelesaikan tes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
