@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon purple mb-2">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Users</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalUsers }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon blue mb-2">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Job Listings</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalJobs }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon green mb-2">
                                            <i class="iconly-boldFolder"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Divisions</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalDivisions }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                        <div class="stats-icon red mb-2">
                                            <i class="iconly-boldDocument"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Total Applications</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalApplications }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 💡 TAMBAHKAN BAGIAN INI UNTUK HASIL TES & REKOMENDASI DIVISI --}}
            <div class="col-12">
                @php
                    $user = Auth::user();
                    // Load relasi userTests dan recommendedDevisi untuk user saat ini
                    $user->load(['userTests', 'recommendedDevisi']);
                    $userTest = $user->userTests->whereNotNull('completed_at')->first(); // Ambil tes yang sudah diselesaikan
                @endphp

                @if ($userTest && $userTest->completed_at) {{-- Cek apakah user sudah menyelesaikan tes --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Hasil Tes & Rekomendasi Divisi</h6>
                        </div>
                        <div class="card-body">
                            <p>Skor Tes Anda: <strong>{{ $userTest->score ?? 'N/A' }}</strong></p>
                            <p>Status Kelulusan:
                                @if ($userTest->passed !== null)
                                    @if ($userTest->passed)
                                        <span class="badge bg-success">Lulus</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Lulus</span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary">Belum Dinilai</span>
                                @endif
                            </p>

                            @if ($user->recommendedDevisi)
                                {{-- Periksa jika recommendedDevisi ada --}}
                                <p>Berdasarkan skor tes Anda, kami merekomendasikan Anda untuk bergabung dengan divisi:</p>
                                <h4 class="text-primary">{{ $user->recommendedDevisi->nama_devisi }}</h4>
                            @else
                                <p>Berdasarkan skor tes Anda, belum ada divisi yang secara spesifik direkomendasikan saat
                                    ini. Anda dapat melihat lowongan pekerjaan yang tersedia.</p>
                            @endif
                            <hr>
                            <a href="{{ route('pelamar.loker') }}" class="btn btn-info">Lihat Lowongan Pekerjaan</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        Anda belum menyelesaikan tes. Silakan selesaikan tes untuk mendapatkan rekomendasi divisi.
                        <a href="{{ route('pelamar.test.selection') }}" class="alert-link">Mulai Tes Sekarang</a>
                    </div>
                @endif
            </div>
            {{-- AKHIR BAGIAN REKOMENDASI --}}

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Job Listings</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Job Title</th>
                                        <th>Division</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $index => $job)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ $job->devisi->nama_devisi }}</td>
                                            <td>{{ $job->status }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
