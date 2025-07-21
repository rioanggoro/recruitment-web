@extends('layouts.admin')
@section('title', 'Manajemen Tes')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Tes</h1>
            <a href="{{ route('admin.tests.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Tes Baru
            </a>
        </div>

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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Tes</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Tes</th>
                                <th>Deskripsi</th>
                                <th>Divisi Terkait</th>
                                <th>Durasi (Menit)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tests as $test)
                                <tr>
                                    <td>{{ $test->name }}</td>
                                    <td>{{ $test->description }}</td>
                                    <td>{{ $test->devisi ? $test->devisi->name : 'Tidak Terkait' }}</td>
                                    {{-- 💡 Pastikan model Devisi punya atribut 'name' --}}
                                    <td>{{ $test->duration_minutes }}</td>
                                    <td>
                                        <a href="{{ route('admin.tests.questions.index', $test->id) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-question-circle"></i> Kelola Soal
                                        </a>
                                        <a href="{{ route('admin.tests.edit', $test->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tes ini? Semua soal terkait juga akan terhapus.')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada tes yang dibuat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
