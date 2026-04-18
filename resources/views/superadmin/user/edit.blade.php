@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-edit mr-2"></i>
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
        <form action="{{ route('userUpdate', $user->id) }}" method="post">
            @csrf

            <div class="row">

            <div class="col-xl-6 mb-3">
                <label>Nama :</label>
                <input type="text" name="nama"
               class="form-control @error('nama') is-invalid @enderror"
               value="{{ $user->nama }}">
                    
                @error('nama')
                <small class="text-danger">{{ $message }}</small>
               @enderror
              </div>

                <div class="col-xl-6 mb-3">
                    <label>Email :</label>
                    <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{  $user->email }}">

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
                    class="form-control @error('password') is-invalid @enderror">
                </div>

                <div class="col-xl-6 mb-3">
                    <label>Role :</label>
                    <select name="role"
                    class="form-control @error('role') is-invalid @enderror">

                        <option disabled>Pilih Role</option>
                        <option value="Superadmin"{{ $user->role == 'Superadmin' ?
                        'selected' : "" }}>Superadmin</option>
                        <option value="Admin" {{ $user->role == 'Admin' ?
                        'selected' : "" }}>Admin</option>

                    </select>

                    @error('role')
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