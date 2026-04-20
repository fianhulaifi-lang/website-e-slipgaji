@extends('layouts.app')

@section('content')

<h1>{{ $title }}</h1>

<form action="{{ route('slipPreview') }}" method="POST" enctype="multipart/form-data">
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
        <input type="file" name="file_slip" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">
        Lanjut Preview
    </button>

</form>

@endsection