@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <h3>Manage Loker Perusahaan</h3>
    </div>

    <div class="page-content">
        <section class="section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <input type="text" id="searchLoker" class="form-control w-25" placeholder="Cari Loker...">
                <div class="d-flex ms-auto">
                    <label for="filterStatus" class="form-label me-2 mt-2">Filter Berdasarkan Status Perekrutan Saat Ini</label>
                    <select id="filterStatus" class="form-select w-auto me-2">
                        <option value="all">Semua</option>
                        <option value="Open">Dibuka</option>
                        <option value="Close">Ditutup</option>
                    </select>
                </div>
            </div>

            <div class="row" id="lokerList">
                @foreach ($loker as $item)
                    <div class="col-md-4 mb-4 loker-card" data-status="{{ $item->status }}"
                        data-title="{{ $item->title }}">
                        <div class="card">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('assets/Images/Job offers-bro.svg') }}" class="card-img-top img-fluid"
                                    style="width: 70%;" alt="Loker Image">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $item->title }}
                                </h5>
                                @if ($item->status == 'Open')
                                    <span class="badge bg-success">Open</span>
                                @elseif ($item->status == 'Close')
                                    <span class="badge bg-secondary">Closed</span>
                                @endif
                                <p class="card-text">{{ $item->description }}</p>
                                <div class="d-flex justify-content-end">
                                    <a href="/pelamar/detail-loker/{{ $item->id }}" class="btn btn-primary ms-2">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
        $(document).ready(function() {
            // Filter Status
            $('#filterStatus').on('change', function() {
                var status = $(this).val();
                filterLoker(status, $('#searchLoker').val());
            });

            // Search Loker
            $('#searchLoker').on('keyup', function() {
                var keyword = $(this).val().toLowerCase();
                filterLoker($('#filterStatus').val(), keyword);
            });

            function filterLoker(status, keyword) {
                $('.loker-card').each(function() {
                    var title = $(this).data('title').toLowerCase();
                    var lokerStatus = $(this).data('status');

                    if ((status == 'all' || lokerStatus == status) && title.includes(keyword)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>
@endpush
