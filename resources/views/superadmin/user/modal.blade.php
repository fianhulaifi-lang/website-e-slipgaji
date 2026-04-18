
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus {{ $title }}?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-content">

        <div class="modal-body text-left">

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
            Role
        </div>
        <div class="col-6">
            : {{ $item->role }}
        </div>
    </div>

</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            Tutup
        </button>
        <form action="{{ route('userDestroy', $item->id) }}" method="post">
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