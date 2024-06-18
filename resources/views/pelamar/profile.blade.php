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
                                <img src="{{ optional(Auth::user()->biodata)->foto ? asset('storage/images/profile/' . Auth::user()->biodata->foto) : asset('assets/compiled/jpg/1.jpg') }}"
                                    class="rounded-circle" alt="Profile Picture" style="width: 150px; height: 150px;">
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateAvatarModal">Update Foto</button>
                            </div>
                            <hr>
                            <div>
                                <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Jenis Kelamin:</strong>
                                    {{ optional(Auth::user()->biodata)->jenis_kelamin ?? '-' }}</p>
                                <p><strong>Tempat Tanggal Lahir:</strong>
                                    {{ optional(Auth::user()->biodata)->tempat_lahir ?? '-' }},
                                    {{ optional(Auth::user()->biodata)->tanggal_lahir ?? '-' }}</p>
                                <p><strong>Agama:</strong> {{ optional(Auth::user()->biodata)->agama ?? '-' }}</p>
                                <p><strong>Alamat:</strong> {{ optional(Auth::user()->biodata)->alamat ?? '-' }}</p>
                                <p><strong>Status Pernikahan:</strong> {{ optional(Auth::user()->biodata)->status ?? '-' }}
                                </p>
                                <p><strong>Pendidikan Terakhir:</strong>
                                    {{ optional(Auth::user()->biodata)->pendidikan_terakhir ?? '-' }}</p>
                                <p><strong>Email:</strong> {{ optional(Auth::user()->biodata)->email ?? '-' }}</p>
                                <p><strong>Nomor HP:</strong> {{ optional(Auth::user()->biodata)->nomor_hp ?? '-' }}</p>
                                <p><strong>Nomor KTP (NIK):</strong> {{ optional(Auth::user()->biodata)->nik ?? '-' }}</p>
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateBiodataModal">Update Biodata</button>
                            </div>
                        </div>

                        <!-- Modal Update Foto -->
                        <div class="modal fade" id="updateAvatarModal" tabindex="-1"
                            aria-labelledby="updateAvatarModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateAvatarModalLabel">Update Foto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/update-avatar" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Pilih Foto</label>
                                                <input type="file" class="form-control" id="avatar" name="avatar"
                                                    accept="image/*" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Update Biodata -->
                        <div class="modal fade" id="updateBiodataModal" tabindex="-1"
                            aria-labelledby="updateBiodataModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateBiodataModalLabel">Update Biodata</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/update-biodata" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ Auth::user()->name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                    <option value="">Pilih</option>
                                                    <option value="Pria"
                                                        {{ optional(Auth::user()->biodata)->jenis_kelamin == 'Pria' ? 'selected' : '' }}>
                                                        Pria</option>
                                                    <option value="Wanita"
                                                        {{ optional(Auth::user()->biodata)->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>
                                                        Wanita</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                    name="tempat_lahir"
                                                    value="{{ optional(Auth::user()->biodata)->tempat_lahir }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="tanggal_lahir"
                                                    name="tanggal_lahir"
                                                    value="{{ optional(Auth::user()->biodata)->tanggal_lahir }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="agama" class="form-label">Agama</label>
                                                <select class="form-select" id="agama" name="agama">
                                                    <option value="">Pilih</option>
                                                    <option value="Islam"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Islam' ? 'selected' : '' }}>
                                                        Islam</option>
                                                    <option value="Kristen Protestan"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Kristen Protestan' ? 'selected' : '' }}>
                                                        Kristen Protestan</option>
                                                    <option value="Katolik"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Katolik' ? 'selected' : '' }}>
                                                        Katolik</option>
                                                    <option value="Hindu"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Hindu' ? 'selected' : '' }}>
                                                        Hindu</option>
                                                    <option value="Buddha"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Buddha' ? 'selected' : '' }}>
                                                        Buddha</option>
                                                    <option value="Konghucu"
                                                        {{ optional(Auth::user()->biodata)->agama == 'Konghucu' ? 'selected' : '' }}>
                                                        Konghucu</option>
                                                    <option value="lainnya"
                                                        {{ optional(Auth::user()->biodata)->agama == 'lainnya' ? 'selected' : '' }}>
                                                        Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat">{{ optional(Auth::user()->biodata)->alamat }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status Pernikahan</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option value="">Pilih</option>
                                                    <option value="Menikah"
                                                        {{ optional(Auth::user()->biodata)->status == 'Menikah' ? 'selected' : '' }}>
                                                        Menikah</option>
                                                    <option value="Belum Menikah"
                                                        {{ optional(Auth::user()->biodata)->status == 'Belum Menikah' ? 'selected' : '' }}>
                                                        Belum Menikah</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="pendidikan_terakhir" class="form-label">Pendidikan
                                                    Terakhir</label>
                                                <select class="form-select" id="pendidikan_terakhir"
                                                    name="pendidikan_terakhir">
                                                    <option value="">Pilih</option>
                                                    <option value="SD (Sekolah Dasar)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'SD (Sekolah Dasar)' ? 'selected' : '' }}>
                                                        SD (Sekolah Dasar)</option>
                                                    <option value="SMP (Sekolah Menengah Pertama)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'SMP (Sekolah Menengah Pertama)' ? 'selected' : '' }}>
                                                        SMP (Sekolah Menengah Pertama)</option>
                                                    <option
                                                        value="SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)' ? 'selected' : '' }}>
                                                        SMA (Sekolah Menengah Atas) / SMK (Sekolah Menengah Kejuruan)
                                                    </option>
                                                    <option value="D1 (Diploma 1)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'D1 (Diploma 1)' ? 'selected' : '' }}>
                                                        D1 (Diploma 1)</option>
                                                    <option value="D2 (Diploma 2)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'D2 (Diploma 2)' ? 'selected' : '' }}>
                                                        D2 (Diploma 2)</option>
                                                    <option value="D3 (Diploma 3)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'D3 (Diploma 3)' ? 'selected' : '' }}>
                                                        D3 (Diploma 3)</option>
                                                    <option value="D4 (Diploma 4)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'D4 (Diploma 4)' ? 'selected' : '' }}>
                                                        D4 (Diploma 4)</option>
                                                    <option value="Sarjana (S1)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'Sarjana (S1)' ? 'selected' : '' }}>
                                                        Sarjana (S1)</option>
                                                    <option value="Magister (S2)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'Magister (S2)' ? 'selected' : '' }}>
                                                        Magister (S2)</option>
                                                    <option value="Doktor (S3)"
                                                        {{ optional(Auth::user()->biodata)->pendidikan_terakhir == 'Doktor (S3)' ? 'selected' : '' }}>
                                                        Doktor (S3)</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ optional(Auth::user()->biodata)->email }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_hp" class="form-label">Nomor HP</label>
                                                <input type="text" class="form-control" id="nomor_hp"
                                                    name="nomor_hp"
                                                    value="{{ optional(Auth::user()->biodata)->nomor_hp }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">Nomor KTP (NIK)</label>
                                                <input type="text" class="form-control" id="nik"
                                                    name="nik"
                                                    value="{{ optional(Auth::user()->biodata)->nik }}">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
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
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->cv != null)
                                                        {{ Auth::user()->biodata->cv }}
                                                    @else
                                                        Belum ada CV yang di upload
                                                    @endif
                                                @else
                                                    Belum ada CV yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->cv != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->cv) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalCV">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalCV">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalCV">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalCV" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalCV">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalCV" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalCV" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-cv" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="cv" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalCV" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-cv" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Ijazah</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->ijazah != null)
                                                        {{ Auth::user()->biodata->ijazah }}
                                                    @else
                                                        Belum ada Ijazah yang di upload
                                                    @endif
                                                @else
                                                    Belum ada Ijazah yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->ijazah != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->ijazah) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalIjazah">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalIjazah">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalIjazah">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalIjazah" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalIjazah">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalIjazah" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalIjazah" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-ijazah" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="ijazah" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalIjazah" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-ijazah" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>KTP</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->ktp != null)
                                                        {{ Auth::user()->biodata->ktp }}
                                                    @else
                                                        Belum ada KTP yang di upload
                                                    @endif
                                                @else
                                                    Belum ada KTP yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->ktp != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->ktp) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalKTP">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalKTP">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalKTP">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalKTP" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalKTP">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalKTP" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalKTP" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-ktp" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="ktp" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalKTP" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-ktp" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Surat Pengalaman Kerja</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->surat_pengalaman_kerja != null)
                                                        {{ Auth::user()->biodata->surat_pengalaman_kerja }}
                                                    @else
                                                        Belum ada Surat Pengalaman Kerja yang di upload
                                                    @endif
                                                @else
                                                    Belum ada Surat Pengalaman Kerja yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->surat_pengalaman_kerja != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->surat_pengalaman_kerja) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSuratPengalamanKerja">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSuratPengalamanKerja">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSuratPengalamanKerja">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSuratPengalamanKerja" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalSuratPengalamanKerja">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalSuratPengalamanKerja" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalSuratPengalamanKerja" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-surat-pengalaman-kerja" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="surat_pengalaman_kerja" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalSuratPengalamanKerja" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-surat-pengalaman-kerja" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Surat Keterangan Sehat</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->surat_keterangan_sehat != null)
                                                        {{ Auth::user()->biodata->surat_keterangan_sehat }}
                                                    @else
                                                        Belum ada Surat Keterangan Sehat yang di upload
                                                    @endif
                                                @else
                                                    Belum ada Surat Keterangan Sehat yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->surat_keterangan_sehat != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->surat_keterangan_sehat) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSuratKeteranganSehat">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSuratKeteranganSehat">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSuratKeteranganSehat">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSuratKeteranganSehat" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalSuratKeteranganSehat">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalSuratKeteranganSehat" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalSuratKeteranganSehat" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-surat-keterangan-sehat" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="surat_keterangan_sehat" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalSuratKeteranganSehat" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-surat-keterangan-sehat" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>SKCK</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->skck != null)
                                                        {{ Auth::user()->biodata->skck }}
                                                    @else
                                                        Belum ada SKCK yang di upload
                                                    @endif
                                                @else
                                                    Belum ada SKCK yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->skck != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->skck) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSKCK">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSKCK">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalSKCK">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalSKCK" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalSKCK">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalSKCK" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalSKCK" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-skck" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="skck" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalSKCK" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-skck" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Transkrip Nilai</td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->transkrip_nilai != null)
                                                        {{ Auth::user()->biodata->transkrip_nilai }}
                                                    @else
                                                        Belum ada Transkrip Nilai yang di upload
                                                    @endif
                                                @else
                                                    Belum ada Transkrip Nilai yang di upload
                                                @endif
                                            </td>
                                            <td>
                                                @if (Auth::user()->biodata != null)
                                                    @if (Auth::user()->biodata->transkrip_nilai != null)
                                                        <a href="{{ asset('storage/images/berkas/' . Auth::user()->biodata->transkrip_nilai) }}"
                                                            class="btn btn-primary" download>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </a>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalTranskripNilai">
                                                            <i class="bi bi-pencil"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalTranskripNilai">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-primary" disabled>
                                                            <i class="bi bi-cloud-download"></i>
                                                        </button>
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#uploadFileModalTranskripNilai">
                                                            <i class="bi bi-cloud-upload"></i>
                                                        </button>
                                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#deleteFileModalTranskripNilai" disabled>
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-primary" disabled>
                                                        <i class="bi bi-cloud-download"></i>
                                                    </button>
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#uploadFileModalTranskripNilai">
                                                        <i class="bi bi-cloud-upload"></i>
                                                    </button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteFileModalTranskripNilai" disabled>
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                @endif

                                                <div class="modal fade" id="uploadFileModalTranskripNilai" tabindex="-1"
                                                    aria-labelledby="uploadFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadFileModalLabel">Unggah
                                                                    File</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/upload-transkrip-nilai" method="POST"
                                                                    enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label for="uploadFile" class="form-label">Pilih
                                                                            File</label>
                                                                        <input type="file" class="form-control"
                                                                            id="uploadFile" name="transkrip_nilai" required>
                                                                    </div>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Unggah</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="deleteFileModalTranskripNilai" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteFileModalLabel">Hapus File</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus file ini?</p>
                                                                <form action="/delete-transkrip-nilai" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
