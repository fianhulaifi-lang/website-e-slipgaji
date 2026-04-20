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

    <div class="card-body">
        <form action="{{ route('karyawanUpdate', $karyawan->id) }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-xl-6 mb-3">
                    <label>Nama :</label>
                    <input type="text" name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ $karyawan->nama }}">

                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>Email :</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ $karyawan->email }}">

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>No Kode :</label>
                    <input type="text" name="no_kode"
                        class="form-control @error('no_kode') is-invalid @enderror"
                        value="{{ $karyawan->no_kode }}">

                    @error('no_kode')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </button>
                </div>

            </div>

        </form>
    </div>

</div>

@endsection