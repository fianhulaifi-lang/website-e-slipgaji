@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-users mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <a href="{{ route('karyawanCreate') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Data
        </a>
        <a href="{{ route('karyawanExport') }}" class="btn btn-success btn-sm">
    <i class="fas fa-file-excel"></i> Export Excel
</a>
    </div>

    <div class="card-body">
<form method="GET" class="mb-3">

    <select name="divisi" class="form-control w-25 d-inline select2">
        <option value="">-- Semua Divisi --</option>

        @foreach ($divisi as $d)
            <option value="{{ $d->id }}"
                {{ request('divisi') == $d->id ? 'selected' : '' }}>
                {{ $d->nama_divisi }}
            </option>
        @endforeach

    </select>

    <button class="btn btn-primary btn-sm">Filter</button>

    <a href="{{ route('karyawan') }}" class="btn btn-secondary btn-sm">Reset</a>

</form>
        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nik</th>
                        <th>Divisi</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($karyawan as $item)
                    <tr>

                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">{{ $item->nik }}</td>
                       <td class="text-center">{{ $item->divisi->nama_divisi ?? '-' }}</td>

                        <td class="text-center">

                            <a href="{{ route('karyawanEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button class="btn btn-sm btn-danger"
                                data-toggle="modal"
                                data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                            @include('superadmin.karyawan.modal')

                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> 