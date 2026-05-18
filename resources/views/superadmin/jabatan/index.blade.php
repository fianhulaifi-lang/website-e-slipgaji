@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user-tie mr-2"></i>
    {{ $title }}
</h1>

<button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addJabatan">
    <i class="fas fa-plus"></i> Tambah Jabatan
</button>

<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Jabatan</th>
                   <th>
                            <i class="fas fa-cog"></i>
                        </th>
                </tr>
            </thead>

            <tbody>
                @foreach($jabatan as $j)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $j->nama_jabatan }}</td>

                    <td class="text-center align-middle">

                        <!-- EDIT -->
                     <button class="btn btn-warning btn-sm"
                    data-toggle="modal"
                    data-target="#edit{{ $j->id }}">
                    <i class="fas fa-edit"></i> Edit
                     </button>

                        <!-- DELETE -->
                        <button class="btn btn-danger btn-sm"
                            data-toggle="modal"
                            data-target="#delete{{ $j->id }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>

                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="edit{{ $j->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Jabatan</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('jabatanUpdate', $j->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">
                                    <input type="text"
                                        name="nama_jabatan"
                                        class="form-control"
                                        value="{{ $j->nama_jabatan }}"
                                        required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- MODAL DELETE -->
<div class="modal fade" id="delete{{ $j->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Data</h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                Yakin mau hapus jabatan <b>{{ $j->nama_jabatan }}</b> ?
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Batal
                </button>

                <form action="{{ route('jabatanDestroy', $j->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="addJabatan" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('jabatanStore') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="text"
                        name="nama_jabatan"
                        class="form-control"
                        placeholder="Nama Jabatan"
                        required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection