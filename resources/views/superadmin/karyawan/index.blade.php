@extends('layouts.app')

@section('content')

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
        <a href="{{ route('karyawanExportData') }}" id="btnExport" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('karyawanImportForm') }}" class="btn btn-info btn-sm">
            <i class="fas fa-file-import"></i> Import Excel
        </a>
    </div>

    {{-- Search Combobox --}}
    <div class="px-3 pt-3 pb-2">
        <div class="position-relative d-inline-block" style="width: 260px;" id="comboWrap">
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

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIK</th>
                        <th>Divisi</th>
                        <th><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                    @php $no = 1; @endphp

                    @foreach ($karyawan as $item)
                    <tr class="data-row" data-divisi="{{ strtolower($item->divisi->nama_divisi ?? '-') }}">
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="text-center">{{ $item->nik }}</td>
                        <td class="text-center divisi-name">{{ $item->divisi->nama_divisi ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('karyawanDetail', $item->id) }}" class="btn btn-sm btn-info">
                                 <i class="fas fa-eye"></i>
                            </a>
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input    = document.getElementById('searchDivisi');
    const dropdown = document.getElementById('comboDropdown');
    const dataRows = document.querySelectorAll('.data-row');

    const divisiList = @json($divisi->pluck('nama_divisi')->sort()->values());

    function highlight(text, kw) {
        if (!kw) return text;
        const re = new RegExp('(' + kw.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
        return text.replace(re, '<strong>$1</strong>');
    }

    function renderDropdown(kw) {
        const filtered = divisiList.filter(d => d.toLowerCase().includes(kw.toLowerCase()));
        if (!kw || filtered.length === 0) {
            dropdown.style.display = 'none';
            return;
        }
        dropdown.innerHTML = filtered.map(d =>
            `<button type="button" class="list-group-item list-group-item-action" data-val="${d}">
                ${highlight(d, kw)}
            </button>`
        ).join('');
        dropdown.style.display = 'block';
    }

    function filterRows(kw) {
        const keyword = kw.toLowerCase();
        dataRows.forEach(function (row) {
            const divisi = row.dataset.divisi;
            row.style.display = (!keyword || divisi.includes(keyword)) ? '' : 'none';
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

    // ✅ FIX — arahkan ke karyawanExportData bukan karyawanExport
    document.getElementById('btnExport').addEventListener('click', function (e) {
        e.preventDefault();
        const divisi = input.value;
        window.location.href = "{{ route('karyawanExportData') }}" + (divisi ? '?divisi=' + encodeURIComponent(divisi) : '');
    });

});
</script>

@endsection