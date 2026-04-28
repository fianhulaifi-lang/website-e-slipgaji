@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow">
    <div class="card-body">

        <form action="{{ route('slipUpload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Email Pengirim</label>
                <input type="text"
                       class="form-control"
                       value="{{ Auth::user()->email }}"
                       readonly>
            </div>

            <div class="form-group">
                <label>Upload Slip</label>
                <input type="file"
                       name="file_slip[]"
                       class="form-control"
                       multiple
                       required>
            </div>

            {{-- tombol simpan --}}
            <button type="submit"
                    name="aksi"
                    value="simpan"
                    class="btn btn-warning">
                Simpan
            </button>

            {{-- tombol preview --}}
            <a href="{{ route('slipPreview') }}"
               class="btn btn-primary">
                Preview
            </a>

        </form>

    </div>
</div>

@endsection