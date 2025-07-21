{{-- resources/views/admin/tests/questions/edit.blade.php --}}

@extends('layouts.admin') {{-- 💡 Pastikan ini sesuai dengan layout adminmu --}}

@section('title', 'Edit Soal Tes: ' . $question->question_text)

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Soal: {{ $question->question_text }}</h1>
        <p class="mb-4">Untuk Tes: {{ $question->test->name }}</p>

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

        {{-- Form untuk Edit Pertanyaan --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Pertanyaan</h6>
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
                <form action="{{ route('admin.tests.questions.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- 💡 PENTING: Untuk method UPDATE --}}

                    <div class="form-group">
                        <label for="question_text">Teks Soal</label>
                        <textarea class="form-control" id="question_text" name="question_text" rows="3" required>{{ old('question_text', $question->question_text) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="question_type">Tipe Soal</label>
                        <select class="form-control" id="question_type" name="question_type" onchange="toggleOptions()">
                            <option value="multiple_choice"
                                {{ old('question_type', $question->question_type) == 'multiple_choice' ? 'selected' : '' }}>
                                Pilihan Ganda</option>
                            <option value="essay"
                                {{ old('question_type', $question->question_type) == 'essay' ? 'selected' : '' }}>Esai
                            </option>
                        </select>
                    </div>

                    {{-- Bagian untuk Opsi Pilihan Ganda (akan muncul/sembunyi dengan JS) --}}
                    <div id="options-container"
                        style="{{ old('question_type', $question->question_type) == 'essay' ? 'display: none;' : '' }}">
                        <label class="mt-3">Opsi Jawaban (Pilihan Ganda)</label>
                        <div id="options-list">
                            @php $optionIndex = 0; @endphp
                            @forelse (old('options', $question->options) as $option)
                                <div class="input-group mb-2">
                                    <input type="text" name="options[{{ $optionIndex }}][text]" class="form-control"
                                        placeholder="Teks Opsi" value="{{ $option->option_text ?? $option['text'] }}"
                                        required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="options[{{ $optionIndex }}][is_correct]"
                                                value="1"
                                                {{ $option->is_correct ?? ($option['is_correct'] ?? false) ? 'checked' : '' }}>
                                            <label class="ms-2 mb-0">Benar</label>
                                            <button type="button"
                                                class="btn btn-danger btn-sm ms-2 remove-option">X</button>
                                        </div>
                                    </div>
                                </div>
                                @php $optionIndex++; @endphp
                            @empty
                                {{-- Jika tidak ada opsi atau baru --}}
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
                                @php $optionIndex = 2; @endphp
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="add-option">Tambah Opsi</button>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Pertanyaan</button>
                    <a href="{{ route('admin.tests.questions.index', $question->test_id) }}"
                        class="btn btn-secondary mt-3">Batal</a>
                </form>
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
                let optionIndex = {{ $optionIndex ?? 0 }}; // Start index based on existing options or default

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

                optionsList.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-option')) {
                        event.target.closest('.input-group').remove();
                    }
                });

                toggleOptions();
            });
        </script>
    @endpush
@endsection
