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
                    <label for="filterStatus" class="form-label me-2">Filter Berdasarkan Status Perekrutan Saat Ini</label>
                    <select id="filterStatus" class="form-select w-auto me-2">
                        <option value="all">Semua</option>
                        <option value="Open">Dibuka</option>
                        <option value="Close">Ditutup</option>
                    </select>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLokerModal">Add Loker</button>
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
                                    <a href="/admin/detail-loker/{{ $item->id }}" class="btn btn-primary ms-2">Detail</a>
                                    <button class="btn btn-warning ms-2" data-bs-toggle="modal"
                                        data-bs-target="#editLokerModal{{ $item->id }}">Edit</button>
                                    <button class="btn btn-danger ms-2" data-bs-toggle="modal"
                                        data-bs-target="#deleteLokerModal{{ $item->id }}">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Loker Modal -->
                    <div class="modal fade" id="editLokerModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="editLokerModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLokerModalLabel{{ $item->id }}">Edit Loker</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/edit-loker/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ $item->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description">{{ $item->deskripsi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="devisi" class="form-label">Devisi</label>
                                            <select class="form-select" id="status" name="devisi_id" required>
                                                <option selected disabled>- Silahkan Pilih Devisi -</option>
                                                @foreach ($devisi as $dev)
                                                    <option value="{{ $dev->id }}"
                                                        {{ $item->devisi_id == $dev->id ? 'selected' : '' }}>
                                                        {{ $dev->nama_devisi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status Perekrutan</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="Open" {{ $item->status == 'Open' ? 'selected' : '' }}>
                                                    Dibuka</option>
                                                <option value="Close" {{ $item->status == 'Close' ? 'selected' : '' }}>
                                                    Ditutup</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Loker Modal -->
                    <div class="modal fade" id="deleteLokerModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="deleteLokerModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteLokerModalLabel{{ $item->id }}">Delete Loker</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this loker?</p>
                                    <form action="/delete-loker/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Add Loker Modal -->
    <div class="modal fade" id="addLokerModal" tabindex="-1" aria-labelledby="addLokerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLokerModalLabel">Add Loker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/add-loker" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="devisi" class="form-label">Devisi</label>
                            <select class="form-select" id="status" name="devisi_id" required>
                                <option selected disabled>- Silahkan Pilih Devisi -</option>
                                @foreach ($devisi as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_devisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });

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
    <script src="https://cdn.tiny.cloud/1/5gorw5nx4zw5j4viyd3rjucdwe1xqqwublsayv3cd879rzso/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            skin: 'oxide-dark',
            content_css: 'dark'
        });
    </script>
@endpush
