@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-history mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>File</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($data as $item)
                    <tr>

                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->file }}</td>

                        <td class="text-center">
                            @if($item->status == 'terkirim')
                                <span class="badge badge-success">
                                    Berhasil
                                </span>
                            @else
                                <span class="badge badge-danger">
                                    Gagal
                                </span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection