@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-sitemap mr-2"></i>
    {{ $title }}
</h1>

<!-- BUTTON TAMBAH -->
<button class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#addDivisi">
    <i class="fas fa-plus"></i> Tambah Divisi
</button>

<!-- TABLE -->
<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Divisi</th>
                    <th>
                            <i class="fas fa-cog"></i>
                        </th>
                </tr>
            </thead>

            <tbody>
                @foreach($divisi as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_divisi }}</td>

                   <td class="text-center align-middle">

                        <!-- EDIT -->
                        <button class="btn btn-warning btn-sm"
                            data-toggle="modal"
                            data-target="#edit{{ $d->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <!-- DELETE -->
                        <button class="btn btn-danger btn-sm"
                            data-toggle="modal"
                            data-target="#delete{{ $d->id }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>

                    </td>
                </tr>

                <!-- MODAL EDIT -->
                <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Divisi</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <form action="{{ route('divisiUpdate', $d->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-body">
                                    <input type="text"
                                        name="nama_divisi"
                                        class="form-control"
                                        value="{{ $d->nama_divisi }}"
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

                <!-- MODAL DELETE -->
                <div class="modal fade" id="delete{{ $d->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Hapus Data</h5>
                                <button type="button" class="close text-white" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                Yakin mau hapus divisi <b>{{ $d->nama_divisi }}</b> ?
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                    Batal
                                </button>

                                <form action="{{ route('divisiDestroy', $d->id) }}" method="POST">
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
<div class="modal fade" id="addDivisi" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Divisi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action="{{ route('divisiStore') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <input type="text"
                        name="nama_divisi"
                        class="form-control"
                        placeholder="Nama Divisi"
                        required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary btn-sm">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection