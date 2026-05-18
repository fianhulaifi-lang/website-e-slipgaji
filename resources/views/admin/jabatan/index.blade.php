@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    {{ $title }}
</h1>

<button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addJabatan">
    <i class="fas fa-plus"></i> Tambah Jabatan
</button>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($jabatan as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->nama_jabatan }}</td>

                    <td>
                        <!-- EDIT -->
                        <button class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#edit{{ $j->id }}">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('jabatanDestroy', $j->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="edit{{ $j->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5>Edit Jabatan</h5>
                            </div>

                            <form action="{{ route('jabatanUpdate', $j->id) }}" method="POST">
                                @csrf

                                <div class="modal-body">
                                    <input type="text" name="nama_jabatan"
                                        class="form-control"
                                        value="{{ $j->nama_jabatan }}">
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="addJabatan">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Tambah Jabatan</h5>
            </div>

            <form action="{{ route('jabatanStore') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection