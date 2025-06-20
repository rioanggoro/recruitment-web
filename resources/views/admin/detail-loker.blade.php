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

            <!-- Table List Pelamar -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">List Pelamar</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pelamar</th>
                                        <th>Gender</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamaran_seleksi as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->biodata->jenis_kelamin }}</td>
                                            <td>{{ $item->user->biodata->pendidikan_terakhir }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-pelamar/{{ $item->user->id }}"
                                                    class="btn btn-primary btn-sm me-2">Detail Profile</a>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editStatusModalSeleksi{{ $item->id }}">Edit
                                                    Status</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editStatusModalSeleksi{{ $item->id }}"
                                            tabindex="-1" aria-labelledby="editStatusModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editStatusModalLabel{{ $item->id }}">Ubah Status
                                                            Lamaran
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/update-status-lamaran/{{ $item->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="statusLamaran{{ $item->id }}"
                                                                    class="form-label">Status Lamaran</label>
                                                                <select class="form-select status-select"
                                                                    name="status_lamaran" data-id="{{ $item->id }}"
                                                                    required>
                                                                    <option value="" disabled selected>Pilih Status
                                                                    </option>
                                                                    <option value="ditolak">Tolak</option>
                                                                    <option value="wawancara">Masukkan Ke Tahap Wawancara
                                                                    </option>
                                                                    <option value="diterima">Terima Lamaran</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3 link-wawancara-field d-none"
                                                                id="linkWawancaraField{{ $item->id }}">
                                                                <label for="link_wawancara{{ $item->id }}"
                                                                    class="form-label">Link Wawancara (Google Meet, Zoom,
                                                                    dll)</label>
                                                                <input type="url" class="form-control"
                                                                    name="link_wawancara"
                                                                    id="link_wawancara{{ $item->id }}"
                                                                    placeholder="https://meet.google.com/xxxx-xxxx-xxx">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table List Pelamar Wawancara -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">List Pelamar Tahap Wawancara</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pelamar</th>
                                        <th>Gender</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Link Wawancara</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamaran_wawancara as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->biodata->jenis_kelamin }}</td>
                                            <td>{{ $item->user->biodata->pendidikan_terakhir }}</td>
                                            <td>{{ $item->link_wawancara }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-pelamar/{{ $item->user->id }}"
                                                    class="btn btn-primary btn-sm me-2">Detail Profile</a>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editStatusModalWawancara{{ $item->id }}">Edit
                                                    Status</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editStatusModalWawancara{{ $item->id }}"
                                            tabindex="-1" aria-labelledby="editStatusModalLabel{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="editStatusModalLabel{{ $item->id }}">Ubah Status
                                                            Lamaran
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="/update-status-lamaran/{{ $item->id }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="statusLamaran{{ $item->id }}"
                                                                    class="form-label">Status Lamaran</label>
                                                                <select class="form-select"
                                                                    id="statusLamaran{{ $item->id }}"
                                                                    name="status_lamaran" required>
                                                                    <option value="" disabled selected>Pilih Status
                                                                    </option>
                                                                    <option value="ditolak">Tolak</option>
                                                                    <option value="diterima">Terima Lamaran</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table List Pelamar Diterima -->
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">List Pelamar Diterima</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pelamar</th>
                                        <th>Gender</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamaran_diterima as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->biodata->jenis_kelamin }}</td>
                                            <td>{{ $item->user->biodata->pendidikan_terakhir }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-pelamar/{{ $item->user->id }}"
                                                    class="btn btn-primary btn-sm me-2">Detail Profile</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">List Pelamar Ditolak</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Pelamar</th>
                                        <th>Gender</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lamaran_ditolak as $item)
                                        <tr>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->biodata->jenis_kelamin }}</td>
                                            <td>{{ $item->user->biodata->pendidikan_terakhir }}</td>
                                            <td class="text-center">
                                                <a href="/admin/detail-pelamar/{{ $item->user->id }}"
                                                    class="btn btn-primary btn-sm me-2">Detail Profile</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- Tooltip Bootstrap --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Semua select status
            document.querySelectorAll('.status-select').forEach(select => {
                select.addEventListener('change', function() {
                    const selectedStatus = this.value;
                    const lamaranId = this.getAttribute('data-id');
                    const linkField = document.getElementById('linkWawancaraField' + lamaranId);

                    if (selectedStatus === 'wawancara') {
                        linkField.classList.remove('d-none');
                    } else {
                        linkField.classList.add('d-none');
                    }
                });
            });
        });
    </script>


    {{-- SweetAlert2 untuk flash message --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @elseif (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('error') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endpush
