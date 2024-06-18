@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <h3>Detail Loker</h3>
    </div>

    <div class="page-content">
        <div class="row">
            <!-- Card Detail Loker -->
            <!-- Bagian Kiri: Gambar -->
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/Images/Job offers-bro.svg') }}" class="card-img-top img-fluid"
                                style="width: 70%;" alt="Loker Image">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if ($loker->status == 'Close')
                            <center><span class="badge bg-danger">Pendaftaran Ditutup</span></center>
                        @else
                            <center><span class="badge bg-success">Pendaftaran Dibuka</span></center>
                        @endif
                        <div class="mt-4">
                            <span>Status Lamaran Anda: </span>
                            @if ($loker->lamaran()->where('user_id', Auth::id())->exists())
                                <span class="badge bg-info">Anda telah melamar</span>
                            @else
                                <span class="badge bg-secondary">Anda belum melamar di loker ini</span>
                            @endif
                        </div>
                        @if (!$loker->lamaran()->where('user_id', Auth::id())->exists() && $loker->status == 'Open')
                            <center><button class="btn btn-primary mt-5" data-bs-toggle="modal"
                                    data-bs-target="#confirmApplyModal">Lamar Pekerjaan Ini</button></center>
                        @endif
                    </div>
                </div>

            </div>


            <!-- Bagian Kanan: Detail Loker -->
            <div class="col-md-9 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Detail Loker</h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $loker->title }}</h5>
                        <p><strong>Divisi:</strong> {{ $loker->devisi->nama_devisi }}</p>
                        <p>{!! $loker->deskripsi !!}</p>
                    </div>
                </div>
            </div>

            <!-- Modal Konfirmasi Lamar Pekerjaan -->
            <div class="modal fade" id="confirmApplyModal" tabindex="-1" aria-labelledby="confirmApplyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/lamar-pekerjaan/{{ $loker->id }}" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmApplyModalLabel">Konfirmasi Lamar Pekerjaan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda yakin ingin melamar untuk posisi ini?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Lamar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
                showCloseButton: true,
                showConfirmButton: false,
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showCloseButton: true,
                showConfirmButton: false,
            });
        @endif
    </script>
@endpush
