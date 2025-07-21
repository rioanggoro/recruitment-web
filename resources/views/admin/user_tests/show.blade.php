@extends('layouts.master')

@section('title', 'Detail Hasil Tes')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Detail Hasil Tes</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Tes dan Pelamar</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Pelamar:</strong> {{ $userTest->user->name ?? 'N/A' }}</p>
                        <p><strong>Username:</strong> {{ $userTest->user->username ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Nama Tes:</strong> {{ $userTest->test->name ?? 'N/A' }}</p>
                        <p><strong>Durasi Tes:</strong> {{ $userTest->test->duration_minutes ?? '-' }} Menit</p>
                        <p><strong>Skor Minimal Lulus:</strong> {{ $userTest->test->min_score_to_pass ?? '-' }}</p>
                    </div>
                </div>
                <hr>
                <p><strong>Skor Pelamar:</strong> <span
                        class="h5 {{ $userTest->passed ?? false ? 'text-success' : 'text-danger' }}">{{ $userTest->score ?? 'Belum Dinilai' }}</span>
                </p>
                <p><strong>Status Kelulusan:</strong>
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
                <p><strong>Waktu Mulai:</strong>
                    {{ $userTest->started_at ? $userTest->started_at->format('d M Y H:i:s') : '-' }}</p>
                <p><strong>Waktu Selesai:</strong>
                    {{ $userTest->completed_at ? $userTest->completed_at->format('d M Y H:i:s') : '-' }}</p>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Jawaban</h6>
            </div>
            <div class="card-body">
                @forelse ($userTest->userAnswers as $index => $userAnswer)
                    <div
                        class="mb-4 p-3 border rounded {{ $userAnswer->is_correct === true ? 'border-success' : ($userAnswer->is_correct === false ? 'border-danger' : '') }}">
                        <h6>{{ $index + 1 }}. {{ $userAnswer->question->question_text }}</h6>
                        <p class="text-muted">Tipe Soal:
                            {{ ucfirst(str_replace('_', ' ', $userAnswer->question->question_type)) }}</p>

                        @if ($userAnswer->question->question_type === 'multiple_choice')
                            <p><strong>Jawaban Pelamar:</strong> {{ $userAnswer->answer_text }}
                                @if ($userAnswer->is_correct === true)
                                    <span class="text-success ms-2">✅ Benar</span>
                                @elseif ($userAnswer->is_correct === false)
                                    <span class="text-danger ms-2">🚫 Salah</span>
                                @endif
                            </p>
                            <p><strong>Opsi Jawaban:</strong></p>
                            <ul>
                                @foreach ($userAnswer->question->options as $option)
                                    <li
                                        class="{{ $option->is_correct ? 'text-success font-weight-bold' : '' }} {{ $option->option_text == $userAnswer->answer_text && !$option->is_correct ? 'text-danger' : '' }}">
                                        {{ $option->option_text }}
                                        @if ($option->is_correct)
                                            <i class="fas fa-check-circle"></i>
                                        @endif
                                        @if ($option->option_text == $userAnswer->answer_text && !$option->is_correct)
                                            <i class="fas fa-times-circle"></i>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @elseif ($userAnswer->question->question_type === 'essay')
                            <p><strong>Jawaban Pelamar:</strong></p>
                            <div class="p-2 border rounded bg-light">
                                {{ $userAnswer->answer_text ?? 'Tidak ada jawaban' }}
                            </div>
                            <p class="mt-2 text-muted">Soal esai perlu dinilai secara manual.</p>
                            {{-- 💡 Opsional: Tambahkan form untuk penilaian manual esai di sini --}}
                            {{-- Misalnya:
                        <form action="{{ route('admin.user_answers.score_essay', $userAnswer->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="essay_score_{{ $userAnswer->id }}">Skor Esai (0-100)</label>
                                <input type="number" class="form-control" id="essay_score_{{ $userAnswer->id }}" name="score" min="0" max="100" value="{{ $userAnswer->score ?? '' }}">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Simpan Skor Esai</button>
                        </form>
                        --}}
                        @endif
                    </div>
                @empty
                    <p class="text-center">Pelamar ini belum menjawab pertanyaan apapun.</p>
                @endforelse
            </div>
        </div>

        <a href="{{ route('admin.user_tests.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Hasil Tes</a>
    </div>
@endsection
