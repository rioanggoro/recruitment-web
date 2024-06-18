@extends('layouts.master')


@section('content')
    <div class="page-heading">
        <h3>Profile Statistics</h3>
    </div>
    <div class="page-content">
        <div class="row mb-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Biodata</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <img src="{{ optional($user->biodata)->foto ? asset('storage/images/profile/' . $user->biodata->foto) : asset('assets/compiled/jpg/1.jpg') }}"
                                class="rounded-circle" alt="Profile Picture" style="width: 150px; height: 150px;">
                        </div>
                        <div class="text-center">
                            @if ($user->biodata != null)
                                @if ($user->biodata->cv != null)
                                    <a href="{{ asset('storage/images/profile/' . $user->biodata->foto) }}"
                                        class="btn btn-primary" download>
                                        Download Photo
                                    </a>
                                @else
                                    <button class="btn btn-primary" disabled>
                                        Download Photo
                                    </button>
                                @endif
                            @else
                                <button class="btn btn-primary" disabled>
                                    Download Photo
                                </button>
                            @endif
                        </div>
                        <hr>
                        <div>
                            <p><strong>Nama:</strong> {{ $user->name }}</p>
                            <p><strong>Jenis Kelamin:</strong>
                                {{ optional($user->biodata)->jenis_kelamin ?? '-' }}</p>
                            <p><strong>Tempat Tanggal Lahir:</strong>
                                {{ optional($user->biodata)->tempat_lahir ?? '-' }},
                                {{ optional($user->biodata)->tanggal_lahir ?? '-' }}</p>
                            <p><strong>Agama:</strong> {{ optional($user->biodata)->agama ?? '-' }}</p>
                            <p><strong>Alamat:</strong> {{ optional($user->biodata)->alamat ?? '-' }}</p>
                            <p><strong>Status Pernikahan:</strong> {{ optional($user->biodata)->status ?? '-' }}
                            </p>
                            <p><strong>Pendidikan Terakhir:</strong>
                                {{ optional($user->biodata)->pendidikan_terakhir ?? '-' }}</p>
                            <p><strong>Email:</strong> {{ optional($user->biodata)->email ?? '-' }}</p>
                            <p><strong>Nomor HP:</strong> {{ optional($user->biodata)->nomor_hp ?? '-' }}</p>
                            <p><strong>Nomor KTP (NIK):</strong> {{ optional($user->biodata)->nik ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Data Berkas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis Berkas</th>
                                        <th>Nama File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>CV</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->cv != null)
                                                    {{ $user->biodata->cv }}
                                                @else
                                                    Belum ada CV yang di upload
                                                @endif
                                            @else
                                                Belum ada CV yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->cv != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->cv) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Ijazah</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->ijazah != null)
                                                    {{ $user->biodata->ijazah }}
                                                @else
                                                    Belum ada Ijazah yang di upload
                                                @endif
                                            @else
                                                Belum ada Ijazah yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->ijazah != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->ijazah) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>KTP</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->ktp != null)
                                                    {{ $user->biodata->ktp }}
                                                @else
                                                    Belum ada KTP yang di upload
                                                @endif
                                            @else
                                                Belum ada KTP yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->ktp != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->ktp) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Surat Pengalaman Kerja</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->surat_pengalaman_kerja != null)
                                                    {{ $user->biodata->surat_pengalaman_kerja }}
                                                @else
                                                    Belum ada Surat Pengalaman Kerja yang di upload
                                                @endif
                                            @else
                                                Belum ada Surat Pengalaman Kerja yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->surat_pengalaman_kerja != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->surat_pengalaman_kerja) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Surat Keterangan Sehat</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->surat_keterangan_sehat != null)
                                                    {{ $user->biodata->surat_keterangan_sehat }}
                                                @else
                                                    Belum ada Surat Keterangan Sehat yang di upload
                                                @endif
                                            @else
                                                Belum ada Surat Keterangan Sehat yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->surat_keterangan_sehat != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->surat_keterangan_sehat) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>SKCK</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->skck != null)
                                                    {{ $user->biodata->skck }}
                                                @else
                                                    Belum ada SKCK yang di upload
                                                @endif
                                            @else
                                                Belum ada SKCK yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->skck != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->skck) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Transkrip Nilai</td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->transkrip_nilai != null)
                                                    {{ $user->biodata->transkrip_nilai }}
                                                @else
                                                    Belum ada Transkrip Nilai yang di upload
                                                @endif
                                            @else
                                                Belum ada Transkrip Nilai yang di upload
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->biodata != null)
                                                @if ($user->biodata->transkrip_nilai != null)
                                                    <a href="{{ asset('storage/images/berkas/' . $user->biodata->transkrip_nilai) }}"
                                                        class="btn btn-primary" download>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </a>
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                @endif
                                            @else
                                                <button class="btn btn-primary" disabled>
                                                    <i class="bi bi-cloud-download"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
