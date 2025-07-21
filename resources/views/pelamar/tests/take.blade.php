@extends('layouts.pelamar')

@section('title', 'Mulai Tes: ' . $test->name)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tes: {{ $test->name }}</h1>
        <p class="text-muted">Durasi: {{ $test->duration_minutes }} menit</p>

        {{-- 💡 OPSIONAL: Tambahkan timer menggunakan JavaScript --}}
        <div id="countdown" class="alert alert-info" style="font-size: 1.2rem;">Sisa Waktu: --:--</div>

        <form action="{{ route('pelamar.test.submit', $test->id) }}" method="POST">
            @csrf

            @foreach ($questions as $key => $question)
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Soal No. {{ $key + 1 }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">{{ $question->question_text }}</p>

                        @if ($question->question_type === 'multiple_choice')
                            <div class="form-group">
                                @foreach ($question->options as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="questions[{{ $question->id }}]"
                                            id="question_{{ $question->id }}_option_{{ $option->id }}"
                                            value="{{ $option->id }}" required>
                                        <label class="form-check-label"
                                            for="question_{{ $question->id }}_option_{{ $option->id }}">
                                            {{ $option->option_text }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('questions.' . $question->id)
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        @elseif ($question->question_type === 'essay')
                            <div class="form-group">
                                <textarea class="form-control" name="questions[{{ $question->id }}]" rows="5"
                                    placeholder="Tulis jawaban Anda di sini..." required></textarea>
                                @error('questions.' . $question->id)
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success btn-lg btn-block mt-4">Kirim Jawaban</button>
        </form>
    </div>

    @push('scripts')
        {{-- 💡 SCRIPT JAVASCRIPT UNTUK TIMER (OPSIONAL) --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const durationMinutes = {{ $test->duration_minutes }};
                const startedAt = new Date(
                    "{{ $userTest->started_at->toIso8601String() }}"); // Ambil waktu mulai dari PHP
                const endTime = new Date(startedAt.getTime() + durationMinutes * 60 * 1000);
                const countdownElement = document.getElementById('countdown');
                const form = document.querySelector('form');

                function updateCountdown() {
                    const now = new Date();
                    const timeLeft = endTime.getTime() - now.getTime();

                    if (timeLeft <= 0) {
                        countdownElement.innerHTML = 'Waktu Habis!';
                        countdownElement.classList.remove('alert-info');
                        countdownElement.classList.add('alert-danger');
                        // Otomatis submit form jika waktu habis
                        form.submit();
                        clearInterval(timerInterval);
                    } else {
                        const minutes = Math.floor(timeLeft / (1000 * 60));
                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                        countdownElement.innerHTML =
                            `Sisa Waktu: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                    }
                }

                const timerInterval = setInterval(updateCountdown, 1000);
                updateCountdown(); // Panggil pertama kali untuk menghindari jeda 1 detik
            });
        </script>
    @endpush
@endsection
