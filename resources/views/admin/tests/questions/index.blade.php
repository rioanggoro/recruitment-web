@extends('layouts.master')

@section('title', 'Kelola Soal Tes: ' . $test->name)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Kelola Soal Tes: {{ $test->name }}</h1>
        <p class="mb-4">Divisi: {{ $test->devisi ? $test->devisi->name : 'Umum' }}</p>

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

        {{-- Form untuk Menambah Pertanyaan Baru --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pertanyaan Baru</h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.tests.questions.store', $test->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="question_text">Teks Soal</label>
                        <textarea class="form-control" id="question_text" name="question_text" rows="3" required>{{ old('question_text') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_type">Tipe Soal</label>
                        <select class="form-control" id="question_type" name="question_type" onchange="toggleOptions()">
                            <option value="multiple_choice"
                                {{ old('question_type') == 'multiple_choice' ? 'selected' : '' }}>Pilihan Ganda</option>
                            <option value="essay" {{ old('question_type') == 'essay' ? 'selected' : '' }}>Esai</option>
                        </select>
                    </div>

                    {{-- Bagian untuk Opsi Pilihan Ganda (akan muncul/sembunyi dengan JS) --}}
                    <div id="options-container" style="{{ old('question_type') == 'essay' ? 'display: none;' : '' }}">
                        <label class="mt-3">Opsi Jawaban (Pilihan Ganda)</label>
                        <div id="options-list">
                            @if (old('options'))
                                @foreach (old('options') as $index => $oldOption)
                                    <div class="input-group mb-2">
                                        <input type="text" name="options[{{ $index }}][text]"
                                            class="form-control" placeholder="Teks Opsi" value="{{ $oldOption['text'] }}"
                                            required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <input type="checkbox" name="options[{{ $index }}][is_correct]"
                                                    value="1"
                                                    {{ isset($oldOption['is_correct']) && $oldOption['is_correct'] ? 'checked' : '' }}>
                                                <label class="ms-2 mb-0">Benar</label>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm ms-2 remove-option">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="options[0][text]" class="form-control"
                                        placeholder="Teks Opsi" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="options[0][is_correct]" value="1">
                                            <label class="ms-2 mb-0">Benar</label>
                                            <button type="button"
                                                class="btn btn-danger btn-sm ms-2 remove-option">X</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-2">
                                    <input type="text" name="options[1][text]" class="form-control"
                                        placeholder="Teks Opsi" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="options[1][is_correct]" value="1">
                                            <label class="ms-2 mb-0">Benar</label>
                                            <button type="button"
                                                class="btn btn-danger btn-sm ms-2 remove-option">X</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="add-option">Tambah Opsi</button>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Simpan Pertanyaan</button>
                    <a href="{{ route('admin.tests.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Tes</a>
                </form>
            </div>
        </div>

        {{-- Daftar Pertanyaan yang Sudah Ada --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pertanyaan</h6>
            </div>
            <div class="card-body">
                @forelse ($questions as $question)
                    <div class="mb-4 p-3 border rounded">
                        <h6>{{ $loop->iteration }}. {{ $question->question_text }}
                            ({{ ucfirst(str_replace('_', ' ', $question->question_type)) }})
                        </h6>
                        @if ($question->question_type === 'multiple_choice')
                            <ul>
                                @foreach ($question->options as $option)
                                    <li class="{{ $option->is_correct ? 'text-success font-weight-bold' : '' }}">
                                        {{ $option->option_text }}
                                        @if ($option->is_correct)
                                            <i class="fas fa-check-circle"></i>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted">Jawaban esai akan dinilai secara manual.</p>
                        @endif
                        <div class="mt-2">
                            <a href="{{ route('admin.tests.questions.edit', $question->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.tests.questions.destroy', $question->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Belum ada pertanyaan untuk tes ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const questionTypeSelect = document.getElementById('question_type');
                const optionsContainer = document.getElementById('options-container');
                const optionsList = document.getElementById('options-list');
                const addOptionButton = document.getElementById('add-option');
                let optionIndex =
                    {{ old('options') ? count(old('options')) : 2 }}; // Start index after initial options

                function toggleOptions() {
                    if (questionTypeSelect.value === 'multiple_choice') {
                        optionsContainer.style.display = 'block';
                    } else {
                        optionsContainer.style.display = 'none';
                    }
                }

                addOptionButton.addEventListener('click', function() {
                    const newOptionHtml = `
                <div class="input-group mb-2">
                    <input type="text" name="options[${optionIndex}][text]" class="form-control" placeholder="Teks Opsi" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <input type="checkbox" name="options[${optionIndex}][is_correct]" value="1">
                            <label class="ms-2 mb-0">Benar</label>
                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-option">X</button>
                        </div>
                    </div>
                </div>
            `;
                    optionsList.insertAdjacentHTML('beforeend', newOptionHtml);
                    optionIndex++;
                });

                // Handle remove option
                optionsList.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-option')) {
                        event.target.closest('.input-group').remove();
                    }
                });

                // Initial toggle on page load
                toggleOptions();
            });
        </script>
    @endpush
@endsection
