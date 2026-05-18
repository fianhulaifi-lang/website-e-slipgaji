@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Import Data Karyawan</h1>

{{-- CARD DOWNLOAD TEMPLATE --}}
<div class="card shadow mb-4 border-left-primary">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h6 class="font-weight-bold text-primary mb-1">
                    <i class="fas fa-file-excel me-1"></i>
                    Download Template Import
                </h6>
            </div>
            <a href="{{ route('karyawanExport') }}" class="btn btn-primary">
                <i class="fas fa-download me-1"></i>
                Download Template
            </a>
        </div>
    </div>
</div>

{{-- CARD IMPORT --}}
<div class="card shadow">
    <div class="card-header">
        <h6 class="font-weight-bold text-success mb-0">
            <i class="fas fa-upload me-1"></i>
            Upload File Excel
        </h6>
    </div>
    <div class="card-body">

        {{-- ALERT INFO LANGKAH --}}
        <div class="alert alert-warning small mb-4">
            <strong><i class="fas fa-exclamation-triangle me-1"></i>Perhatian:</strong>
            <ol class="mb-0 mt-1 ps-3">
                <li>Download template Excel di atas terlebih dahulu</li>
                <li>Isi data karyawan mulai dari <strong>baris ke-2</strong> (baris header jangan diubah)</li>
                <li>Simpan file (nama file boleh <strong>data-karyawan.xlsx</strong> atau <strong>data-karyawan (1).xlsx</strong> dst)</li>
                <li>Upload file tersebut melalui form di bawah</li>
            </ol>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-1"></i>
                <strong>Import Gagal:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('karyawanImport') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Pilih File Excel</label>
                <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv">
                <div class="form-text text-muted">
                </div>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-upload me-1"></i>
                Import Excel
            </button>

            <a href="{{ route('karyawan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection