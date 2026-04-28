<!-- Modal -->
<div class="modal fade"
     id="exampleModal{{ $item->id }}"
     tabindex="-1"
     aria-labelledby="exampleModalLabel{{ $item->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title"
                    id="exampleModalLabel{{ $item->id }}">
                    Hapus {{ $title }}?
                </h5>

                <button type="button"
                        class="close text-white"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <div class="row mb-2">
                    <div class="col-6">Nama</div>
                    <div class="col-6">: {{ $item->nama }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Email</div>
                    <div class="col-6">: {{ $item->email }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-6">Role</div>
                    <div class="col-6">: {{ $item->role }}</div>
                </div>

                <div class="row">
                    <div class="col-6">Divisi</div>
                    <div class="col-6">:

                        @if($item->role == 'Superadmin')
                            Semua Divisi
                        @elseif($item->divisi)
                            {{ $item->divisi->nama_divisi }}
                        @else
                            -
                        @endif

                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary btn-sm"
                        data-dismiss="modal">
                    Tutup
                </button>

                <form action="{{ route('userDestroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>