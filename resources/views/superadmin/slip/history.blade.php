@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-history mr-2"></i>
    {{ $title }}
</h1>

<div class="card shadow mb-4">
    <div class="card-body">

        {{-- ================= FILTER ================= --}}
        <form method="GET" action="{{ route('slipHistory') }}" class="mb-3" id="filterForm">
            <div class="row align-items-end">

                {{-- Cari Divisi --}}
                <div class="col-md-3 mb-2">
                    <div class="position-relative" id="comboWrap">
                        <input type="text"
                               id="searchDivisi"
                               class="form-control"
                               placeholder="Cari Divisi..."
                               autocomplete="off">
                        <div id="comboDropdown"
                             class="list-group shadow"
                             style="display:none; position:absolute; z-index:999; width:100%; max-height:200px; overflow-y:auto;">
                        </div>
                    </div>
                </div>

                {{-- Satu input bulan untuk filter, export, dan hapus --}}
                <div class="col-md-3 mb-2">
                    <input type="month"
                           name="tanggal"
                           id="inputTanggal"
                           value="{{ request('tanggal', date('Y-m')) }}"
                           class="form-control">
                </div>

                {{-- Export --}}
                <div class="col-md-2 mb-2">
                    <a href="{{ route('slipHistoryExport', ['tanggal' => request('tanggal', date('Y-m'))]) }}"
                       class="btn btn-success btn-block">
                        <i class="fas fa-file-excel mr-1"></i> Export
                    </a>
                </div>

                {{-- Hapus --}}
                <div class="col-md-2 mb-2">
                    <button type="button" id="btnHapus" class="btn btn-danger btn-block">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </div>

            </div>
        </form>

        {{-- Form hapus (hidden, disubmit via JS) --}}
        <form action="{{ route('slipHistoryDestroyBulk') }}" method="POST" id="formHapus">
            @csrf
            @method('DELETE')
            <input type="hidden" name="tanggal" id="tanggalHapus" value="{{ request('tanggal', date('Y-m')) }}">
        </form>

        {{-- ================= TABEL ================= --}}
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
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
                    @forelse ($data as $item)
                    <tr class="data-row">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center divisi-name">{{ $item->divisi->nama_divisi ?? '-' }}</td>
                        <td>{{ $item->file }}</td>
                        <td class="text-center">
                            @if($item->status == 'terkirim')
                                <span class="badge badge-success">Berhasil</span>
                            @else
                                <span class="badge badge-danger">Gagal</span>
                            @endif
                        </td>
                        <td class="text-center">
                            {{ $item->created_at->format('d-m-Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ================= NOTIFIKASI =================
    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", confirmButtonText: 'OK' });
    @endif

    @if(session('info'))
        Swal.fire({ icon: 'info', title: 'Info', text: "{{ session('info') }}", confirmButtonText: 'OK' });
    @endif

    // ================= AUTO SUBMIT FILTER BULAN =================
    const inputTanggal = document.getElementById('inputTanggal');

    inputTanggal.addEventListener('change', function () {
        document.getElementById('tanggalHapus').value = this.value;
        document.getElementById('filterForm').submit();
    });

    // ================= HAPUS DATA BULAN =================
    document.getElementById('btnHapus').addEventListener('click', function () {
        const bulan = inputTanggal.value;
        if (!bulan) return;

        const date  = new Date(bulan + '-01');
        const label = date.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });

        Swal.fire({
            title: 'Yakin?',
            html: `Semua data riwayat bulan <b>${label}</b> akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('tanggalHapus').value = bulan;
                document.getElementById('formHapus').submit();
            }
        });
    });

    // ================= COMBOBOX DIVISI =================
    const input    = document.getElementById('searchDivisi');
    const dropdown = document.getElementById('comboDropdown');
    const rows     = document.querySelectorAll('.data-row');

    const divisiSet = new Set();
    rows.forEach(row => {
        const nama = row.querySelector('.divisi-name').innerText.trim();
        if (nama && nama !== '-') divisiSet.add(nama);
    });
    const divisiList = Array.from(divisiSet).sort();

    function highlight(text, kw) {
        if (!kw) return text;
        const re = new RegExp('(' + kw.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
        return text.replace(re, '<strong>$1</strong>');
    }

    function renderDropdown(kw) {
        const filtered = divisiList.filter(d => d.toLowerCase().includes(kw.toLowerCase()));
        if (!kw || filtered.length === 0) { dropdown.style.display = 'none'; return; }
        dropdown.innerHTML = filtered.map(d =>
            `<button type="button" class="list-group-item list-group-item-action" data-val="${d}">
                ${highlight(d, kw)}
            </button>`
        ).join('');
        dropdown.style.display = 'block';
    }

    function filterRows(kw) {
        rows.forEach(row => {
            const divisi = row.querySelector('.divisi-name').innerText.toLowerCase();
            row.style.display = divisi.includes(kw.toLowerCase()) ? '' : 'none';
        });
    }

    input.addEventListener('input', function () {
        const kw = this.value.trim();
        renderDropdown(kw);
        filterRows(kw);
    });

    input.addEventListener('focus', function () {
        if (this.value.trim()) renderDropdown(this.value.trim());
    });

    dropdown.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-val]');
        if (!btn) return;
        input.value = btn.dataset.val;
        filterRows(btn.dataset.val);
        dropdown.style.display = 'none';
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#comboWrap')) dropdown.style.display = 'none';
    });

});
</script>

@endsection