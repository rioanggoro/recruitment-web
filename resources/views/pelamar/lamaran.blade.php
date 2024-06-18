@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <h3>Lamaran Pekerjaan</h3>
    </div>

    <div class="page-content">
        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        List Lamaran Anda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 15%;">Lowongan</th>
                                    <th style="width: 10%;">Devisi</th>
                                    <th style="width: 20%;">Status Lamaran Anda</th>
                                    <th style="width: 35%;">Keterangan</th>
                                    <th class="text-center" style="width: 15%;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lamaran as $no => $item)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $item->loker->title }}</td>
                                        <td>{{ $item->loker->devisi->nama_devisi }}</td>
                                        <td>
                                            @if ($item->status_lamaran == 'seleksi')
                                                <span class="badge bg-light-primary">Proses Seleksi</span>
                                            @elseif ($item->status_lamaran == 'wawancara')
                                                <span class="badge bg-light-info">Tahap Wawancara</span>
                                            @elseif ($item->status_lamaran == 'diterima')
                                                <span class="badge bg-light-success">Lamaran Anda Diterima</span>
                                            @else
                                                <span class="badge bg-light-danger">Lamaran Anda Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_lamaran == 'seleksi')
                                                Anda sedang dalam proses seleksi, silahkan periksa kembali profile anda dan
                                                lengkapi berkas yang belum di upload karena dapat mempengaruhi proses
                                                seleksi
                                            @elseif ($item->status_lamaran == 'wawancara')
                                                Periksa secara berkala Email dan Whatsapp anda untuk menerima undangan
                                                wawancara
                                            @elseif ($item->status_lamaran == 'diterima')
                                                Selamat Anda Diterima
                                            @else
                                                Maaf lamaran anda kami tolak
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="/pelamar/detail-loker/{{ $item->loker_id }}"
                                                class="btn btn-sm btn-info">Lihat Detail Loker</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        let jquery_datatable = $("#table1").DataTable({
            responsive: true
        })
        let customized_datatable = $("#table2").DataTable({
            responsive: true,
            pagingType: 'simple',
            dom: "<'row'<'col-3'l><'col-9'f>>" +
                "<'row dt-row'<'col-sm-12'tr>>" +
                "<'row'<'col-4'i><'col-8'p>>",
            "language": {
                "info": "Page _PAGE_ of _PAGES_",
                "lengthMenu": "_MENU_ ",
                "search": "",
                "searchPlaceholder": "Search.."
            }
        })

        const setTableColor = () => {
            document.querySelectorAll('.dataTables_paginate .pagination').forEach(dt => {
                dt.classList.add('pagination-primary')
            })
        }
        setTableColor()
        jquery_datatable.on('draw', setTableColor)
    </script>
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
