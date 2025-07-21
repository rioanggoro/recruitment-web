@extends('layouts.admin')

@section('title', 'Tambah Tes Baru')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Tambah Tes Baru</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Form Tes Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Tes</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="devisi_id">Divisi Terkait (Opsional)</label>
                        <select class="form-control" id="devisi_id" name="devisi_id">
                            <option value="">Pilih Divisi</option>
                            @foreach ($devisis as $devisi)
                                <option value="{{ $devisi->id }}" {{ old('devisi_id') == $devisi->id ? 'selected' : '' }}>
                                    {{ $devisi->name }} {{-- 💡 Pastikan model Devisi punya atribut 'name' --}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="duration_minutes">Durasi Tes (Menit)</label>
                        <input type="number" class="form-control" id="duration_minutes" name="duration_minutes"
                            value="{{ old('duration_minutes', 30) }}" required min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Tes</button>
                    <a href="{{ route('admin.tests.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
