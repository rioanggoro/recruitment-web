@extends('layouts.pelamar') {{-- 💡 Sesuaikan dengan layout pelamarmu --}}

@section('title', 'Pilih Tes Divisi')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Pilih Tes Divisi</h1>

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
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        <div class="row">
            @forelse ($tests as $test)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $test->name }}</h6>
                        </div>
                        <div class="card-body">
                            <p>{{ $test->description }}</p>
                            <p><strong>Divisi:</strong> {{ $test->devisi ? $test->devisi->name : 'Umum' }}</p>
                            <p><strong>Durasi:</strong> {{ $test->duration_minutes }} menit</p>
                            <p><strong>Skor Lulus Minimal:</strong> {{ $test->min_score_to_pass }}</p>

                            @php
                                $hasTakenTest = in_array($test->id, $userTakenTests);
                            @endphp

                            @if ($hasTakenTest)
                                <button class="btn btn-secondary" disabled>Sudah Mengerjakan</button>
                                <p class="text-success mt-2">Anda telah menyelesaikan tes ini.</p>
                            @else
                                <a href="{{ route('pelamar.test.start', $test->id) }}" class="btn btn-primary">
                                    Mulai Tes
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Belum ada tes yang tersedia saat ini.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
