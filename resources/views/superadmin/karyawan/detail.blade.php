@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user mr-2"></i>
    Detail Karyawan
</h1>

<div class="card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <a href="{{ route('karyawan') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="card-body p-0">

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
                        <label class="text-muted small">NIK</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->nik ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">No Absen</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->no_absen ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Golongan</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->golongan ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Nama Lengkap</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->nama ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Nama Panggilan</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->nama_panggilan ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Jabatan</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->jabatan->nama_jabatan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Divisi</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->divisi->nama_divisi ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Status Pegawai</label>
                        <p class="mb-0">
                            @if($karyawan->status_pegawai)
                                <span class="badge badge-info">{{ $karyawan->status_pegawai }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Status Aktif</label>
                        <p class="mb-0">
                            @if($karyawan->status_aktif == 'AKTIF')
                                <span class="badge badge-success">AKTIF</span>
                            @elseif($karyawan->status_aktif == 'NON AKTIF')
                                <span class="badge badge-danger">NON AKTIF</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Masa Kerja</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->masa_kerja ? $karyawan->masa_kerja . ' tahun' : '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tanggal Masuk</label>
                        <p class="font-weight-bold mb-0">
                            {{ $karyawan->tanggal_masuk ? \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tanggal Pengangkatan</label>
                        <p class="font-weight-bold mb-0">
                            {{ $karyawan->tanggal_pengangkatan ? \Carbon\Carbon::parse($karyawan->tanggal_pengangkatan)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tanggal Pensiun</label>
                        <p class="font-weight-bold mb-0">
                            {{ $karyawan->tanggal_pensiun ? \Carbon\Carbon::parse($karyawan->tanggal_pensiun)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Jatah Cuti</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->jatah_cuti ? $karyawan->jatah_cuti . ' hari' : '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Sisa Cuti</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->sisa_cuti ? $karyawan->sisa_cuti . ' hari' : '-' }}</p>
                    </div>
                </div>

                <hr>
                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-address-card mr-1"></i> Kontak & Identitas
                </h6>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Email</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->email ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">No KTP</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->no_ktp ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">No HP</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->no_hp ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Telp 1</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->telp_1 ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Telp 2</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->telp_2 ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <label class="text-muted small">Alamat</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->alamat ?? '-' }}</p>
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
                        <label class="text-muted small">Jenis Kelamin</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Agama</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->pribadi->agama ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Suku</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->pribadi->suku ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tempat Lahir</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->pribadi->tempat_lahir ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tanggal Lahir</label>
                        <p class="font-weight-bold mb-0">
                            {{ $karyawan->tanggal_lahir ? \Carbon\Carbon::parse($karyawan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Status Nikah</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->pribadi->status_nikah ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Hobby</label>
                        <p class="font-weight-bold mb-0">{{ $karyawan->pribadi->hobby ?? '-' }}</p>
                    </div>
                </div>

            </div>

            {{-- ======================== TAB 3: BANK & PENDIDIKAN ======================== --}}
            <div class="tab-pane fade" id="tab3" role="tabpanel">

                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-university mr-1"></i> Informasi Bank
                </h6>

                @forelse ($karyawan->bank as $idx => $b)
                <div class="row mb-2">
                    <div class="col-xl-1">
                        <span class="badge badge-secondary">Bank {{ $idx + 1 }}</span>
                    </div>
                    <div class="col-xl-3">
                        <label class="text-muted small">Nama Bank</label>
                        <p class="font-weight-bold mb-0">{{ $b->bank ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4">
                        <label class="text-muted small">No Rekening</label>
                        <p class="font-weight-bold mb-0">{{ $b->no_rekening ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4">
                        <label class="text-muted small">Atas Nama</label>
                        <p class="font-weight-bold mb-0">{{ $b->atas_nama ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <p class="text-muted">Belum ada data bank.</p>
                @endforelse

                <hr>
                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-graduation-cap mr-1"></i> Riwayat Pendidikan
                </h6>

                @php $pend = $karyawan->pendidikan; @endphp

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">SD</label>
                        <p class="font-weight-bold mb-0">{{ $pend->sd ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">SLTP</label>
                        <p class="font-weight-bold mb-0">{{ $pend->sltp ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">SLTA</label>
                        <p class="font-weight-bold mb-0">{{ $pend->slta ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Perguruan Tinggi (PT)</label>
                        <p class="font-weight-bold mb-0">{{ $pend->pt ?? '-' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Pendidikan Terakhir</label>
                        <p class="font-weight-bold mb-0">{{ $pend->pendidikan_terakhir ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Jurusan</label>
                        <p class="font-weight-bold mb-0">{{ $pend->jurusan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-2 mb-3">
                        <label class="text-muted small">Tahun Masuk</label>
                        <p class="font-weight-bold mb-0">{{ $pend->tahun_masuk ?? '-' }}</p>
                    </div>
                    <div class="col-xl-2 mb-3">
                        <label class="text-muted small">Tahun Keluar</label>
                        <p class="font-weight-bold mb-0">{{ $pend->tahun_keluar ?? '-' }}</p>
                    </div>
                </div>

            </div>

            {{-- ======================== TAB 4: KELUARGA ======================== --}}
            <div class="tab-pane fade" id="tab4" role="tabpanel">

                @php $kel = $karyawan->keluarga; @endphp

                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-user-friends mr-1"></i> Orang Tua
                </h6>

                <div class="row">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Nama Ayah</label>
                        <p class="font-weight-bold mb-0">{{ $kel->nama_ayah ?? '-' }}</p>
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Nama Ibu</label>
                        <p class="font-weight-bold mb-0">{{ $kel->nama_ibu ?? '-' }}</p>
                    </div>
                </div>

                <hr>
                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-heart mr-1"></i> Suami / Istri
                </h6>

                <div class="row">
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Nama Pasangan</label>
                        <p class="font-weight-bold mb-0">{{ $kel->nama_pasangan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tempat Lahir Pasangan</label>
                        <p class="font-weight-bold mb-0">{{ $kel->tempat_lahir_pasangan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Tanggal Lahir Pasangan</label>
                        <p class="font-weight-bold mb-0">
                            {{ $kel->tanggal_lahir_pasangan ? \Carbon\Carbon::parse($kel->tanggal_lahir_pasangan)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Pekerjaan Pasangan</label>
                        <p class="font-weight-bold mb-0">{{ $kel->pekerjaan_pasangan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Jenis Kelamin Pasangan</label>
                        <p class="font-weight-bold mb-0">{{ $kel->jenis_kelamin_pasangan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-4 mb-3">
                        <label class="text-muted small">Pendidikan Pasangan</label>
                        <p class="font-weight-bold mb-0">{{ $kel->pendidikan_pasangan ?? '-' }}</p>
                    </div>
                </div>

                <hr>
                <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">
                    <i class="fas fa-child mr-1"></i> Data Anak
                </h6>

                @forelse ($karyawan->anak as $idx => $a)
                <div class="row mb-2 border-bottom pb-2">
                    <div class="col-xl-1">
                        <span class="badge badge-secondary">Anak {{ $idx + 1 }}</span>
                    </div>
                    <div class="col-xl-2">
                        <label class="text-muted small">Nama</label>
                        <p class="font-weight-bold mb-0">{{ $a->nama ?? '-' }}</p>
                    </div>
                    <div class="col-xl-2">
                        <label class="text-muted small">Tempat Lahir</label>
                        <p class="font-weight-bold mb-0">{{ $a->tempat_lahir ?? '-' }}</p>
                    </div>
                    <div class="col-xl-2">
                        <label class="text-muted small">Tanggal Lahir</label>
                        <p class="font-weight-bold mb-0">
                            {{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-xl-2">
                        <label class="text-muted small">Pekerjaan</label>
                        <p class="font-weight-bold mb-0">{{ $a->pekerjaan ?? '-' }}</p>
                    </div>
                    <div class="col-xl-1">
                        <label class="text-muted small">JK</label>
                        <p class="font-weight-bold mb-0">{{ $a->jenis_kelamin ?? '-' }}</p>
                    </div>
                    <div class="col-xl-2">
                        <label class="text-muted small">Pendidikan</label>
                        <p class="font-weight-bold mb-0">{{ $a->pendidikan ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <p class="text-muted">Belum ada data anak.</p>
                @endforelse

                <hr>
                <div class="row mt-2">
                    <div class="col-xl-6 mb-3">
                        <label class="text-muted small">Jaminan Kesehatan</label>
                        <p class="mb-0">
                            @if(($kel->jaminan_kesehatan ?? '') == 'tercover')
                                <span class="badge badge-success">Tercover</span>
                            @elseif(($kel->jaminan_kesehatan ?? '') == 'tidak tercover')
                                <span class="badge badge-danger">Tidak Tercover</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </p>
                    </div>
                </div>

            </div>

        </div>{{-- end tab-content --}}

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('karyawan') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

    </div>

</div>

@endsection