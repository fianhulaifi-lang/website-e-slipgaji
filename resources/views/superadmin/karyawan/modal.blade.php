<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                    Hapus {{ $title }}?
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body text-left">

                <div class="row mb-2">
                    <div class="col-5">Nama</div>
                    <div class="col-7">: {{ $item->nama }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5">Email</div>
                    <div class="col-7">: {{ $item->email }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5">NIK</div>
                    <div class="col-7">: {{ $item->nik ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5">No HP</div>
                    <div class="col-7">: {{ $item->no_hp }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5">Jabatan</div>
                    <div class="col-7">: {{ $item->jabatan->nama_jabatan ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-5">Divisi</div>
                    <div class="col-7">: {{ $item->divisi->nama_divisi ?? '-' }}</div>
                </div>

                <div class="row">
                    <div class="col-5">Alamat</div>
                    <div class="col-7">: {{ $item->alamat }}</div>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Tutup
                </button>

                <form action="{{ route('karyawanDestroy', $item->id) }}" method="post">
                    @csrf
                    @method('delete')

                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>