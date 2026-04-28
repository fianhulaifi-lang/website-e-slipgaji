@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-history mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">

    <div class="card-body">

        {{-- ================= FILTER DIVISI ================= --}}
        <form method="GET" action="{{ route('slipHistory') }}" class="mb-3">

<div class="row">

    <div class="col-md-3">
        <select name="divisi" class="form-control">
            <option value="">-- Semua Divisi --</option>

            @foreach($divisi as $d)
                <option value="{{ $d->id }}"
                    {{ request('divisi') == $d->id ? 'selected' : '' }}>
                    {{ $d->nama_divisi }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <input type="date"
               name="tanggal"
               value="{{ request('tanggal') }}"
               class="form-control">
    </div>

    <div class="col-md-4">

        <button class="btn btn-primary">
            Filter
        </button>

        <a href="{{ route('slipHistory') }}"
           class="btn btn-secondary">
            Reset
        </a>

        <a href="{{ route('slipHistoryExport') }}"
           class="btn btn-success">
              <i class="fas fa-file-excel"></i> Export Excel
        </a>

    </div>

</div>
</form>

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                         <th>Divisi</th>
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
                        <td class="text-center">{{ $item->divisi->nama_divisi ?? '-' }}</td>
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