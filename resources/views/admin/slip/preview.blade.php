@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow">
    <div class="card-body">
        
        {{-- Tombol Kembali --}}
    <a href="{{ route('slipCreate') }}" class="btn btn-secondary mb-3">
        ← Kembali ke Upload File
    </a>

        {{-- ================= FILTER ================= --}}
        <form method="GET" action="{{ route('slipPreview') }}" class="mb-3">

            <select name="divisi" class="form-control w-25 d-inline">
                <option value="">-- Semua Divisi --</option>

                @foreach($divisi as $d)
                    <option value="{{ $d->id }}">
                        {{ $d->nama_divisi }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary btn-sm">Filter</button>

            <a href="{{ route('slipPreview') }}" class="btn btn-secondary btn-sm">Reset</a>

        </form>

        <hr>

        {{-- ================= GROUP BY DIVISI ================= --}}
        @foreach(collect($dataSlip)->groupBy('divisi') as $divisi => $items)

        <div class="card mb-3">

          <div class="card-header bg-primary text-white d-flex justify-content-between">

    <span>{{ $divisi }}</span>

    <form action="{{ route('slipStoreDivisi') }}" method="POST">
        @csrf
        <input type="hidden" name="divisi" value="{{ $divisi }}">

        <button type="submit" class="btn btn-light btn-sm">
            Kirim Divisi
        </button>
    </form>

</div>

            <div class="card-body">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>File</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $item['nik'] }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            <td>{{ $item['date'] }}</td>
                            <td>{{ $item['file'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

        @endforeach

        <hr>
<form action="{{ route('slipStoreAll') }}" method="POST" class="mb-3">
    @csrf
    <button type="submit" class="btn btn-success">
        Kirim Semua Slip
    </button>
</form>
    
        </form>

    </div>
</div>

{{-- ================= JS ================= --}}
<script>
document.getElementById('karyawanSelect').addEventListener('change', function () {

    let email = this.options[this.selectedIndex].getAttribute('data-email');
    let nama = this.value;

    document.getElementById('nama').value = nama;
    document.getElementById('email').value = email;

});
</script>



@endsection