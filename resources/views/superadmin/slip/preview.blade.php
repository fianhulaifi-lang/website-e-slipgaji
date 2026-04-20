@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow">
    <div class="card-body">

        <form action="{{ route('slipStore') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pilih Karyawan</label>

                <select name="karyawan" class="form-control" id="karyawanSelect" required>
                    <option value="">-- Pilih Karyawan --</option>

                    @foreach($karyawan as $item)
                    <option 
                        value="{{ $item->nama }}"
                        data-email="{{ $item->email }}">
                        {{ $item->nama }}
                    </option>
                    @endforeach
                </select>
            </div>

           <input type="hidden" name="nama" id="nama">

<div class="form-group">
    <label>Email Tujuan</label>
    <input type="text"
           name="email_tujuan"
           id="email"
           class="form-control"
           readonly>
</div>
            <div class="form-group">
                <label>Preview Slip</label><br>

                <iframe src="{{ asset('storage/' . $file) }}"
                        width="100%"
                        height="500px">
                </iframe>
            </div>

            <button type="submit" class="btn btn-success">
                Kirim Slip
            </button>

        </form>

    </div>
</div>

<script>
document.getElementById('karyawanSelect').addEventListener('change', function () {
    let nama = this.value;
    let email = this.options[this.selectedIndex].getAttribute('data-email');

    document.getElementById('nama').value = nama;
    document.getElementById('email').value = email;
});
</script>

@endsection