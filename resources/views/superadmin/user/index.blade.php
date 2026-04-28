@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-user mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <a href="{{ route('userCreate') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus mr-2"></i>
            Tambah Data
        </a>
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>
                            <i class="fas fa-cog"></i>
                        </th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($user as $item)

                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>

                        <td>{{ $item->email }}</td>

                        <td class="text-center">
                            @if ($item->role == 'admin')
                                <span class="badge badge-dark">
                                    {{ $item->role }}
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $item->role }}
                                </span>
                            @endif
                        </td>
                        <td class="text-center">

                            <a href="{{ route('userEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button class="btn btn-sm btn-danger"
                                data-toggle="modal"
                                data-target="#exampleModal{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>

                    @include('superadmin.user.modal')

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection