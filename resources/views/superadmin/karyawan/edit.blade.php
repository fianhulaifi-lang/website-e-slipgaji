@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow">

    <div class="card-header">
        <a href="{{ route('karyawan') }}" class="btn btn-sm btn-success">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="card-body p-0">

        <form action="{{ route('karyawanUpdate', $karyawan->id) }}" method="POST">
            @csrf

            {{-- ERROR --}}
            @if($errors->any())
            <div class="alert alert-danger m-3">
                <i class="fas fa-times-circle mr-1"></i>
                <strong>Terdapat kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- TAB NAVIGATION --}}
            <ul class="nav nav-tabs px-3 pt-3" id="karyawanTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">
                        <i class="fas fa-id-card mr-1"></i> Data Utama
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">
                        <i class="fas fa-user mr-1"></i> Data Pribadi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">
                        <i class="fas fa-university mr-1"></i> Bank & Pendidikan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab">
                        <i class="fas fa-users mr-1"></i> Keluarga
                    </a>
                </li>
            </ul>

            <div class="tab-content p-4">

                {{-- ======================== TAB 1: DATA UTAMA ======================== --}}
                <div class="tab-pane fade show active" id="tab1" role="tabpanel">

                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-briefcase mr-1"></i> Informasi Kepegawaian
                    </h6>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input type="text" name="nik"
                                class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik', $karyawan->nik) }}">
                            @error('nik')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>No Absen</label>
                            <input type="text" name="no_absen" class="form-control"
                                value="{{ old('no_absen', $karyawan->no_absen) }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Golongan</label>
                            <select name="golongan" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($golonganOptions as $g)
                                    <option value="{{ $g }}" {{ old('golongan', $karyawan->golongan) == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $karyawan->nama) }}">
                            @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>Nama Panggilan</label>
                            <input type="text" name="nama_panggilan" class="form-control"
                                value="{{ old('nama_panggilan', $karyawan->nama_panggilan) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>Jabatan <span class="text-danger">*</span></label>
                            <select name="jabatan_id"
                                class="form-control @error('jabatan_id') is-invalid @enderror">
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $j)
                                    <option value="{{ $j->id }}"
                                        {{ old('jabatan_id', $karyawan->jabatan_id) == $j->id ? 'selected' : '' }}>
                                        {{ $j->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan_id')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>Divisi <span class="text-danger">*</span></label>
                            <select name="divisi_id"
                                class="form-control @error('divisi_id') is-invalid @enderror">
                                <option value="">Pilih Divisi</option>
                                @foreach ($divisi as $d)
                                    <option value="{{ $d->id }}"
                                        {{ old('divisi_id', $karyawan->divisi_id) == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('divisi_id')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Status Pegawai</label>
                            <select name="status_pegawai" class="form-control" id="status_pegawai">
                                <option value="">-- Pilih --</option>
                                @foreach($statusPegawaiOptions as $s)
                                    <option value="{{ $s }}"
                                        {{ old('status_pegawai', $karyawan->status_pegawai) == $s ? 'selected' : '' }}>
                                        {{ $s }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Status Aktif</label>
                            <select name="status_aktif" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($statusAktifOptions as $s)
                                    <option value="{{ $s }}"
                                        {{ old('status_aktif', $karyawan->status_aktif) == $s ? 'selected' : '' }}>
                                        {{ $s }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Masa Kerja (tahun)</label>
                            <input type="number" name="masa_kerja" class="form-control"
                                value="{{ old('masa_kerja', $karyawan->masa_kerja) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk" class="form-control"
                                value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk) }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Tanggal Pengangkatan</label>
                            <input type="date" name="tanggal_pengangkatan" class="form-control"
                                value="{{ old('tanggal_pengangkatan', $karyawan->tanggal_pengangkatan) }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Tanggal Pensiun</label>
                            <input type="date" id="tanggal_pensiun" name="tanggal_pensiun" class="form-control"
                                value="{{ old('tanggal_pensiun', $karyawan->tanggal_pensiun) }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Jatah Cuti (hari)</label>
                            <input type="number" name="jatah_cuti" class="form-control"
                                value="{{ old('jatah_cuti', $karyawan->jatah_cuti) }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Sisa Cuti (hari)</label>
                            <input type="number" name="sisa_cuti" class="form-control"
                                value="{{ old('sisa_cuti', $karyawan->sisa_cuti) }}">
                        </div>
                    </div>

                    <hr>
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-address-card mr-1"></i> Kontak & Identitas
                    </h6>

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $karyawan->email) }}">
                            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>No KTP <span class="text-danger">*</span></label>
                            <input type="text" name="no_ktp"
                                class="form-control @error('no_ktp') is-invalid @enderror"
                                value="{{ old('no_ktp', $karyawan->no_ktp) }}">
                            @error('no_ktp')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>No HP <span class="text-danger">*</span></label>
                            <input type="text" name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp', $karyawan->no_hp) }}">
                            @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 mb-3">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $karyawan->alamat) }}</textarea>
                            @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                    </div>

                </div>

                {{-- ======================== TAB 2: DATA PRIBADI ======================== --}}
                <div class="tab-pane fade" id="tab2" role="tabpanel">

                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-user mr-1"></i> Identitas Pribadi
                    </h6>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $karyawan->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Agama</label>
                            <select name="agama" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($agamaOptions as $a)
                                    <option value="{{ $a }}"
                                        {{ old('agama', $karyawan->pribadi->agama ?? '') == $a ? 'selected' : '' }}>
                                        {{ $a }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Suku</label>
                            <input type="text" name="suku" class="form-control"
                                value="{{ old('suku', $karyawan->pribadi->suku ?? '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir', $karyawan->pribadi->tempat_lahir ?? '') }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}">
                            @error('tanggal_lahir')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Status Nikah</label>
                            <select name="status_nikah" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($statusNikahOptions as $sn)
                                    <option value="{{ $sn }}"
                                        {{ old('status_nikah', $karyawan->pribadi->status_nikah ?? '') == $sn ? 'selected' : '' }}>
                                        {{ $sn }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>Hobby</label>
                            <input type="text" name="hobby" class="form-control"
                                value="{{ old('hobby', $karyawan->pribadi->hobby ?? '') }}">
                        </div>
                    </div>

                </div>

                {{-- ======================== TAB 3: BANK & PENDIDIKAN ======================== --}}
                <div class="tab-pane fade" id="tab3" role="tabpanel">

                    {{-- BANK --}}
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-university mr-1"></i> Informasi Bank
                    </h6>

                    <div id="bankContainer">
                        @forelse ($karyawan->bank as $idx => $b)
                        <div class="row align-items-end bank-row">
                            <div class="col-xl-1 mb-3 d-flex align-items-end">
                                <span class="badge badge-secondary mb-1">Bank {{ $idx + 1 }}</span>
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>Nama Bank</label>
                                <select name="bank[]" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach($bankOptions as $bank)
                                        <option value="{{ $bank }}"
                                            {{ old("bank.{$idx}", $b->bank) == $bank ? 'selected' : '' }}>
                                            {{ $bank }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label>No Rekening</label>
                                <input type="text" name="no_rekening[]" class="form-control"
                                    value="{{ old("no_rekening.{$idx}", $b->no_rekening) }}">
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>Atas Nama</label>
                                <input type="text" name="atas_nama[]" class="form-control"
                                    value="{{ old("atas_nama.{$idx}", $b->atas_nama) }}">
                            </div>
                            <div class="col-xl-1 mb-3 d-flex align-items-end">
                                @if($idx > 0)
                                <button type="button" class="btn btn-sm btn-danger hapusBank mb-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="row align-items-end bank-row">
                            <div class="col-xl-1 mb-3 d-flex align-items-end">
                                <span class="badge badge-secondary mb-1">Bank 1</span>
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>Nama Bank</label>
                                <select name="bank[]" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach($bankOptions as $bank)
                                        <option value="{{ $bank }}">{{ $bank }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-4 mb-3">
                                <label>No Rekening</label>
                                <input type="text" name="no_rekening[]" class="form-control">
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>Atas Nama</label>
                                <input type="text" name="atas_nama[]" class="form-control">
                            </div>
                            <div class="col-xl-1 mb-3"></div>
                        </div>
                        @endforelse
                    </div>

                    <button type="button" id="tambahBank" class="btn btn-sm btn-outline-primary mb-4">
                        <i class="fas fa-plus mr-1"></i> Tambah Bank
                    </button>

                    <hr>

                    {{-- PENDIDIKAN --}}
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-graduation-cap mr-1"></i> Riwayat Pendidikan
                    </h6>

                    @php $pend = $karyawan->pendidikan; @endphp

                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>SD</label>
                            <input type="text" name="pendidikan_sd" class="form-control"
                                value="{{ old('pendidikan_sd', $pend->sd ?? '') }}" placeholder="Nama sekolah & tahun">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>SLTP</label>
                            <input type="text" name="pendidikan_sltp" class="form-control"
                                value="{{ old('pendidikan_sltp', $pend->sltp ?? '') }}" placeholder="Nama sekolah & tahun">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>SLTA</label>
                            <input type="text" name="pendidikan_slta" class="form-control"
                                value="{{ old('pendidikan_slta', $pend->slta ?? '') }}" placeholder="Nama sekolah & tahun">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>Perguruan Tinggi (PT)</label>
                            <input type="text" name="pendidikan_pt" class="form-control"
                                value="{{ old('pendidikan_pt', $pend->pt ?? '') }}" placeholder="Nama kampus & tahun">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($pendidikanOptions as $p)
                                    <option value="{{ $p }}"
                                        {{ old('pendidikan_terakhir', $pend->pendidikan_terakhir ?? '') == $p ? 'selected' : '' }}>
                                        {{ $p }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control"
                                value="{{ old('jurusan', $pend->jurusan ?? '') }}">
                        </div>
                        <div class="col-xl-2 mb-3">
                            <label>Tahun Masuk</label>
                            <input type="text" name="tahun_masuk_kuliah" class="form-control"
                                value="{{ old('tahun_masuk_kuliah', $pend->tahun_masuk ?? '') }}" placeholder="2010">
                        </div>
                        <div class="col-xl-2 mb-3">
                            <label>Tahun Keluar</label>
                            <input type="text" name="tahun_keluar_kuliah" class="form-control"
                                value="{{ old('tahun_keluar_kuliah', $pend->tahun_keluar ?? '') }}" placeholder="2014">
                        </div>
                    </div>

                </div>

                {{-- ======================== TAB 4: KELUARGA ======================== --}}
                <div class="tab-pane fade" id="tab4" role="tabpanel">

                    @php $kel = $karyawan->keluarga; @endphp

                    {{-- ORANG TUA --}}
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-user-friends mr-1"></i> Orang Tua
                    </h6>
                    <div class="row">
                        <div class="col-xl-6 mb-3">
                            <label>Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control"
                                value="{{ old('nama_ayah', $kel->nama_ayah ?? '') }}">
                        </div>
                        <div class="col-xl-6 mb-3">
                            <label>Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control"
                                value="{{ old('nama_ibu', $kel->nama_ibu ?? '') }}">
                        </div>
                    </div>

                    <hr>

                    {{-- PASANGAN --}}
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-heart mr-1"></i> Suami / Istri
                    </h6>
                    <div class="row">
                        <div class="col-xl-4 mb-3">
                            <label>Nama Pasangan</label>
                            <input type="text" name="nama_pasangan" class="form-control"
                                value="{{ old('nama_pasangan', $kel->nama_pasangan ?? '') }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Tempat Lahir Pasangan</label>
                            <input type="text" name="tempat_lahir_pasangan" class="form-control"
                                value="{{ old('tempat_lahir_pasangan', $kel->tempat_lahir_pasangan ?? '') }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Tanggal Lahir Pasangan</label>
                            <input type="date" name="tanggal_lahir_pasangan" class="form-control"
                                value="{{ old('tanggal_lahir_pasangan', $kel->tanggal_lahir_pasangan ?? '') }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Pekerjaan Pasangan</label>
                            <input type="text" name="pekerjaan_pasangan" class="form-control"
                                value="{{ old('pekerjaan_pasangan', $kel->pekerjaan_pasangan ?? '') }}">
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Jenis Kelamin Pasangan</label>
                            <select name="jenis_kelamin_pasangan" class="form-control">
                                <option value="">-- Pilih --</option>
                                <option value="PRIA" {{ old('jenis_kelamin_pasangan', $kel->jenis_kelamin_pasangan ?? '') == 'PRIA' ? 'selected' : '' }}>PRIA</option>
                                <option value="WANITA" {{ old('jenis_kelamin_pasangan', $kel->jenis_kelamin_pasangan ?? '') == 'WANITA' ? 'selected' : '' }}>WANITA</option>
                            </select>
                        </div>
                        <div class="col-xl-4 mb-3">
                            <label>Pendidikan Pasangan</label>
                            <input type="text" name="pendidikan_pasangan" class="form-control"
                                value="{{ old('pendidikan_pasangan', $kel->pendidikan_pasangan ?? '') }}">
                        </div>
                    </div>

                    <hr>

                    {{-- ANAK --}}
                    <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                        <i class="fas fa-child mr-1"></i> Data Anak
                    </h6>

                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th width="5%">No</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pekerjaan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Pendidikan</th>
                                    <th width="5%">#</th>
                                </tr>
                            </thead>
                            <tbody id="anakBody">
                                @forelse ($karyawan->anak as $idx => $a)
                                <tr>
                                    <td class="text-center align-middle"><small class="text-muted">{{ $idx + 1 }}</small></td>
                                    <td><input type="text" name="nama_anak[]" class="form-control form-control-sm"
                                        value="{{ old("nama_anak.{$idx}", $a->nama) }}"></td>
                                    <td><input type="text" name="tempat_lahir_anak[]" class="form-control form-control-sm"
                                        value="{{ old("tempat_lahir_anak.{$idx}", $a->tempat_lahir) }}"></td>
                                    <td><input type="date" name="tanggal_lahir_anak[]" class="form-control form-control-sm"
                                        value="{{ old("tanggal_lahir_anak.{$idx}", $a->tanggal_lahir) }}"></td>
                                    <td><input type="text" name="pekerjaan_anak[]" class="form-control form-control-sm"
                                        value="{{ old("pekerjaan_anak.{$idx}", $a->pekerjaan) }}"></td>
                                    <td>
                                        <select name="jenis_kelamin_anak[]" class="form-control form-control-sm">
                                            <option value="">-</option>
                                            <option value="PRIA" {{ old("jenis_kelamin_anak.{$idx}", $a->jenis_kelamin) == 'PRIA' ? 'selected' : '' }}>PRIA</option>
                                            <option value="WANITA" {{ old("jenis_kelamin_anak.{$idx}", $a->jenis_kelamin) == 'WANITA' ? 'selected' : '' }}>WANITA</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="pendidikan_anak[]" class="form-control form-control-sm"
                                        value="{{ old("pendidikan_anak.{$idx}", $a->pendidikan) }}"></td>
                                    <td class="text-center align-middle">
                                        @if($idx > 0)
                                        <button type="button" class="btn btn-sm btn-danger hapusAnak">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center align-middle"><small class="text-muted">1</small></td>
                                    <td><input type="text" name="nama_anak[]" class="form-control form-control-sm"></td>
                                    <td><input type="text" name="tempat_lahir_anak[]" class="form-control form-control-sm"></td>
                                    <td><input type="date" name="tanggal_lahir_anak[]" class="form-control form-control-sm"></td>
                                    <td><input type="text" name="pekerjaan_anak[]" class="form-control form-control-sm"></td>
                                    <td>
                                        <select name="jenis_kelamin_anak[]" class="form-control form-control-sm">
                                            <option value="">-</option>
                                            <option value="PRIA">PRIA</option>
                                            <option value="WANITA">WANITA</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="pendidikan_anak[]" class="form-control form-control-sm"></td>
                                    <td></td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <button type="button" id="tambahAnak" class="btn btn-sm btn-outline-primary mb-3">
                        <i class="fas fa-plus mr-1"></i> Tambah Anak
                    </button>

                    <hr>

                    {{-- JAMINAN KESEHATAN --}}
                    <div class="row mt-2">
                        <div class="col-xl-6 mb-3">
                            <label>Jaminan Kesehatan</label>
                            <select name="jaminan_kesehatan" class="form-control">
                                <option value="">-- Pilih --</option>
                                @foreach($jaminanOptions as $jk)
                                    <option value="{{ $jk }}"
                                        {{ old('jaminan_kesehatan', $kel->jaminan_kesehatan ?? '') == $jk ? 'selected' : '' }}>
                                        {{ ucfirst($jk) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </div>{{-- end tab-content --}}

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit mr-2"></i>
                    Update
                </button>
                <a href="{{ route('karyawan') }}" class="btn btn-secondary btn-sm ml-2">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali
                </a>
            </div>

        </form>

    </div>

</div>

{{-- Otomatis buka tab yang ada error --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const invalidFields = document.querySelectorAll('.is-invalid');
    if (invalidFields.length > 0) {
        const tabPane = invalidFields[0].closest('.tab-pane');
        if (tabPane) {
            const tabLink = document.querySelector(`[href="#${tabPane.id}"]`);
            if (tabLink) tabLink.click();
        }
    }
});
</script>

{{-- Hitung otomatis tanggal pensiun (usia dari setting) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const usiaPensiun = {{ $usiaPensiun }}; {{-- dari Setting --}}
    const tglLahir    = document.getElementById('tanggal_lahir');
    const pensiun     = document.getElementById('tanggal_pensiun');
    const status      = document.getElementById('status_pegawai');

    function hitungPensiun() {
        if (!tglLahir.value || status.value !== 'TETAP') {
            pensiun.value = '';
            return;
        }
        let tgl = new Date(tglLahir.value);
        tgl.setFullYear(tgl.getFullYear() + usiaPensiun);
        pensiun.value = tgl.toISOString().split('T')[0];
    }

    tglLahir.addEventListener('change', hitungPensiun);
    status.addEventListener('change', hitungPensiun);
});
</script>

{{-- Tambah / Hapus Bank --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const bankOptions = @json($bankOptions);

    document.getElementById('tambahBank').addEventListener('click', function () {
        const container = document.getElementById('bankContainer');
        const index     = container.querySelectorAll('.bank-row').length + 1;
        const opts      = bankOptions.map(b => `<option value="${b}">${b}</option>`).join('');

        container.insertAdjacentHTML('beforeend', `
            <div class="row align-items-end bank-row">
                <div class="col-xl-1 mb-3 d-flex align-items-end">
                    <span class="badge badge-secondary mb-1">Bank ${index}</span>
                </div>
                <div class="col-xl-3 mb-3">
                    <label>Nama Bank</label>
                    <select name="bank[]" class="form-control">
                        <option value="">-- Pilih --</option>
                        ${opts}
                    </select>
                </div>
                <div class="col-xl-4 mb-3">
                    <label>No Rekening</label>
                    <input type="text" name="no_rekening[]" class="form-control">
                </div>
                <div class="col-xl-3 mb-3">
                    <label>Atas Nama</label>
                    <input type="text" name="atas_nama[]" class="form-control">
                </div>
                <div class="col-xl-1 mb-3 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-danger hapusBank mb-1">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.hapusBank')) {
            e.target.closest('.bank-row').remove();
            document.querySelectorAll('#bankContainer .bank-row').forEach((row, i) => {
                row.querySelector('.badge').textContent = 'Bank ' + (i + 1);
            });
        }
    });
});
</script>

{{-- Tambah / Hapus Anak --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tambahAnak').addEventListener('click', function () {
        const tbody = document.getElementById('anakBody');
        const index = tbody.querySelectorAll('tr').length + 1;

        tbody.insertAdjacentHTML('beforeend', `
            <tr>
                <td class="text-center align-middle"><small class="text-muted">${index}</small></td>
                <td><input type="text" name="nama_anak[]" class="form-control form-control-sm"></td>
                <td><input type="text" name="tempat_lahir_anak[]" class="form-control form-control-sm"></td>
                <td><input type="date" name="tanggal_lahir_anak[]" class="form-control form-control-sm"></td>
                <td><input type="text" name="pekerjaan_anak[]" class="form-control form-control-sm"></td>
                <td>
                    <select name="jenis_kelamin_anak[]" class="form-control form-control-sm">
                        <option value="">-</option>
                        <option value="PRIA">PRIA</option>
                        <option value="WANITA">WANITA</option>
                    </select>
                </td>
                <td><input type="text" name="pendidikan_anak[]" class="form-control form-control-sm"></td>
                <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-danger hapusAnak">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `);
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.hapusAnak')) {
            e.target.closest('tr').remove();
            document.querySelectorAll('#anakBody tr').forEach((row, i) => {
                row.querySelector('td:first-child small').textContent = i + 1;
            });
        }
    });
});
</script>

@endsection