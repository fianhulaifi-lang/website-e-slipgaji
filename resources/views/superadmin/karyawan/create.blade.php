@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus mr-2"></i>
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
        <form action="{{ route('karyawanStore') }}" method="POST">
            @csrf

            <div class="row">

                <div class="col-xl-6 mb-3">
                    <label>Nama :</label>
                    <input type="text" name="nama"
                        class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}">

                    @error('nama')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>Email :</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">

                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>NIK :</label>
                    <input type="text" name="nik"
                        class="form-control @error('nik') is-invalid @enderror"
                        value="{{ old('nik') }}">

                    @error('nik')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>No HP :</label>
                    <input type="text" name="no_hp"
                        class="form-control @error('no_hp') is-invalid @enderror"
                        value="{{ old('no_hp') }}">

                    @error('no_hp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- JABATAN -->
<div class="col-xl-6 mb-3">
    <label>Jabatan :</label>

    <select name="jabatan_id"
        class="form-control @error('jabatan_id') is-invalid @enderror">

        <option value="">Pilih Jabatan</option>

        @foreach ($jabatan as $j)
            <option value="{{ $j->id }}"
                {{ old('jabatan_id') == $j->id ? 'selected' : '' }}>
                {{ $j->nama_jabatan }}
            </option>
        @endforeach

    </select>

    @error('jabatan_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

                <!-- DIVISI -->
<div class="col-xl-6 mb-3">
    <label>Divisi :</label>

    <select name="divisi_id"
        class="form-control @error('divisi_id') is-invalid @enderror">

        <option value="">Pilih Divisi</option>

        @foreach ($divisi as $d)
            <option value="{{ $d->id }}"
                {{ old('divisi_id') == $d->id ? 'selected' : '' }}>
                {{ $d->nama_divisi }}
            </option>
        @endforeach

    </select>

    @error('divisi_id')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

                <div class="col-xl-12 mb-3">
                    <label>Alamat :</label>

                    <textarea name="alamat" rows="3"
                        class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>

                    @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>

            </div>

        </form>
    </div>

</div>

@endsection