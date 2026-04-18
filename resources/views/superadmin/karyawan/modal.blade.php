<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                    Hapus {{ $title }}?
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-left">

                <div class="row mb-2">
                    <div class="col-6">
                        Nama
                    </div>
                    <div class="col-6">
                        : {{ $item->nama }}
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">
                        Email
                    </div>
                    <div class="col-6">
                        : {{ $item->email }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        No Kode
                    </div>
                    <div class="col-6">
                        : {{ $item->no_kode }}
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
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