@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-plus mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow">

    <div class="card-header">
        <a href="{{ route('user') }}" class="btn btn-sm btn-success">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <div class="card-body">
        <form action="{{ route('userStore') }}" method="post">
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
                    <label>Password :</label>
                    <input type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror">

                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-xl-6 mb-3">
                    <label>Password Konfirmasi :</label>
                    <input type="password" name="password_confirmation"
                    class="form-control">
                </div>
<div class="col-xl-6 mb-3">
    <label>Role :</label>

    <select name="role" id="role"
    class="form-control @error('role') is-invalid @enderror">

        <option value="">Pilih Role</option>

        <option value="superadmin"
        {{ old('role') == 'superadmin' ? 'selected' : '' }}>
            Superadmin
        </option>

        <option value="admin"
        {{ old('role') == 'admin' ? 'selected' : '' }}>
            Admin
        </option>

    </select>

    @error('role')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="col-xl-6 mb-3" id="divisiBox">
    <label>Divisi :</label>

    <select name="divisi_id"
    class="form-control @error('divisi_id') is-invalid @enderror">

        <option value="">Pilih Divisi</option>

        @foreach($divisi as $item)
            <option value="{{ $item->id }}"
            {{ old('divisi_id') == $item->id ? 'selected' : '' }}>
                {{ $item->nama_divisi }}
            </option>
        @endforeach

    </select>

    @error('divisi_id')
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

<script>
document.getElementById('role').addEventListener('change', function () {

    let divisi = document.getElementById('divisiBox');

    if (this.value == 'superadmin') {
        divisi.style.display = 'none';
    } else {
        divisi.style.display = 'block';
    }

});

window.onload = function () {
    document.getElementById('role').dispatchEvent(new Event('change'));
}
</script>

@endsection