@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

<div class="card shadow">
    <div class="card-body">

       <a href="{{ route('slipCreate') }}" class="btn btn-secondary mb-3">
    ← Kembali ke Upload File
</a>

<div class="mb-3">
    <div class="position-relative" style="width: 260px;" id="comboWrap">
        <input type="text" id="searchDivisi" class="form-control" placeholder="Cari atau ketik divisi..." autocomplete="off">
        <div id="comboDropdown" class="list-group shadow" style="display:none; position:absolute; z-index:999; width:100%; max-height:200px; overflow-y:auto;"></div>
    </div>
</div>
        {{-- ================= GROUP BY DIVISI ================= --}}
        @foreach(collect($dataSlip)->groupBy('divisi') as $divisi => $items)

        <div class="card mb-3 divisi-card">

            <div class="card-header bg-primary text-white d-flex justify-content-between divisi-toggle"
                 style="cursor:pointer;"
                 data-divisi="{{ strtolower($divisi) }}">

                <span>
                 <i class="fas fa-chevron-down toggle-icon"></i>
                 {{ $divisi }}
                </span>

                <div class="d-flex gap-2" onclick="event.stopPropagation()">

                    {{-- Kirim via Email --}}
                    <form action="{{ route('slipStoreDivisi') }}" method="POST">
                        @csrf
                        <input type="hidden" name="divisi" value="{{ $divisi }}">
                        <input type="hidden" name="via" value="email">
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="fas fa-envelope mr-1">Email</i> 
                        </button>
                    </form>

                    {{-- Kirim via WhatsApp (belum tersedia) --}}
                    <button type="button" class="btn btn-success btn-sm"
                        onclick="alert('Fitur kirim via WhatsApp belum tersedia.')">
                        <i class="fab fa-whatsapp mr-1"> Wa</i> 
                    </button>

                </div>

            </div>

            {{-- ✅ Semua data langsung tampil tanpa pagination --}}
            <div class="card-body divisi-content" style="display:none;">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
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

        <div>

    {{-- Kirim Semua via Email --}}
    <form action="{{ route('slipStoreAll') }}" method="POST" class="mb-2">
        @csrf
        <input type="hidden" name="via" value="email">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-envelope mr-1"></i> Kirim Semua via Email
        </button>
    </form>

    {{-- Kirim Semua via WhatsApp (belum tersedia) --}}
    <button type="button" class="btn btn-success"
        onclick="alert('Fitur kirim via WhatsApp belum tersedia.')">
        <i class="fab fa-whatsapp mr-1"></i> Kirim Semua via WhatsApp
    </button>

</div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const input    = document.getElementById('searchDivisi');
    const dropdown = document.getElementById('comboDropdown');
    const cards    = document.querySelectorAll('.divisi-card');

    const divisiList = Array.from(cards).map(card =>
        card.querySelector('.divisi-toggle').dataset.divisi
    );

    function highlight(text, kw) {
        if (!kw) return text;
        const re = new RegExp('(' + kw.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + ')', 'gi');
        return text.replace(re, '<strong>$1</strong>');
    }

    function renderDropdown(kw) {
        const filtered = divisiList.filter(d => d.includes(kw.toLowerCase()));
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

    function filterCards(kw) {
        cards.forEach(card => {
            const divisiText = card.querySelector('.divisi-toggle').dataset.divisi;
            card.style.display = divisiText.includes(kw.toLowerCase()) ? '' : 'none';
        });
    }

    input.addEventListener('input', function () {
        const kw = this.value.trim();
        renderDropdown(kw);
        filterCards(kw);
    });

    input.addEventListener('focus', function () {
        if (this.value.trim()) renderDropdown(this.value.trim());
    });

    dropdown.addEventListener('click', function (e) {
        const btn = e.target.closest('[data-val]');
        if (!btn) return;
        input.value = btn.dataset.val;
        filterCards(btn.dataset.val);
        dropdown.style.display = 'none';
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('#comboWrap')) dropdown.style.display = 'none';
    });

});

// ================= TOGGLE ACCORDION =================
document.querySelectorAll('.divisi-toggle').forEach(function(header) {
    header.addEventListener('click', function(e) {
        if (e.target.closest('form') || e.target.closest('button')) return;

        let content = this.nextElementSibling;
        let icon    = this.querySelector('.toggle-icon');

        if (content.style.display === 'none' || content.style.display === '') {
            content.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            content.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    });
});
</script>

@endsection