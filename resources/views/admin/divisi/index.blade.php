@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    {{ $title }}
</h1>

<!-- BUTTON TAMBAH -->
<button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addDivisi">
    <i class="fas fa-plus"></i> Tambah Divisi
</button>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- TABLE -->
<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Divisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($divisi as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_divisi }}</td>

                    <td>
                        <!-- EDIT -->
                        <button class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#edit{{ $d->id }}">
                            Edit
                        </button>

                        <!-- DELETE -->
                        <form action="{{ route('divisiDestroy', $d->id) }}" method="POST" style="display:inline;">
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
                <div class="modal fade" id="edit{{ $d->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5>Edit Divisi</h5>
                            </div>

                            <form action="{{ route('divisiUpdate', $d->id) }}" method="POST">
                                @csrf

                                <div class="modal-body">
                                    <input type="text" name="nama_divisi"
                                        class="form-control"
                                        value="{{ $d->nama_divisi }}">
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
<div class="modal fade" id="addDivisi">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Tambah Divisi</h5>
            </div>

            <form action="{{ route('divisiStore') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="text" name="nama_divisi" class="form-control" placeholder="Nama Divisi">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection