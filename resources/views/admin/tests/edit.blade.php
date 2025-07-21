@extends('layouts.master')

@section('title', 'Edit Tes')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Tes: {{ $test->name }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Edit Tes</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tests.update', $test->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- 💡 Penting untuk method PUT --}}

                    <div class="form-group">
                        <label for="name">Nama Tes</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $test->name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $test->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="devisi_id">Divisi Terkait (Opsional)</label>
                        <select class="form-control" id="devisi_id" name="devisi_id">
                            <option value="">Pilih Divisi</option>
                            @foreach ($devisis as $devisi)
                                <option value="{{ $devisi->id }}"
                                    {{ old('devisi_id', $test->devisi_id) == $devisi->id ? 'selected' : '' }}>
                                    {{ $devisi->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duration_minutes">Durasi Tes (Menit)</label>
                        <input type="number" class="form-control" id="duration_minutes" name="duration_minutes"
                            value="{{ old('duration_minutes', $test->duration_minutes) }}" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="min_score_to_pass">Skor Minimal Lulus</label>
                        <input type="number" class="form-control" id="min_score_to_pass" name="min_score_to_pass"
                            value="{{ old('min_score_to_pass', $test->min_score_to_pass ?? 0) }}" required min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Tes</button>
                    <a href="{{ route('admin.tests.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
