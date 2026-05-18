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
       multiple
       class="form-control"
       accept=".pdf,.png,.jpg,.jpeg">
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
@if(session('popup_upload'))

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire({
    icon: '{{ count(session("gagal")) > 0 ? "warning" : "success" }}',
    title: 'Upload Selesai',
    html: `
        <b>Berhasil:</b> {{ session('berhasil') }} file <br><br>

        <b>Gagal:</b> {{ count(session('gagal')) }} file <br><br>

        @if(count(session('gagal')) > 0)
            <b>File Gagal:</b><br>
            {!! implode('<br>', session('gagal')) !!}
        @endif
    `,
    width: 600
});
</script>

@endif
@endsection