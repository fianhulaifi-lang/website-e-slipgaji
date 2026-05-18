@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-shield-alt mr-2"></i> Role Management
    </h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                Pengaturan Akses untuk Role:
                <span class="badge badge-warning text-dark">Admin</span>
            </h6>
            <small class="text-muted">
                <i class="fas fa-info-circle"></i>
                Superadmin selalu memiliki akses penuh
            </small>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Fitur</th>
                        <th width="150" class="text-center">View</th>
                        <th width="150" class="text-center">Edit</th>
                        <th width="150" class="text-center">Hapus</th>
                        <th width="150" class="text-center">Akses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Http\Controllers\RolePermissionController::$features as $key => $feature)
                        @php $actions = $feature['actions']; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <i class="fas fa-layer-group text-muted mr-2"></i>
                                {{ $feature['label'] }}
                            </td>

                            {{-- VIEW --}}
                            <td class="text-center">
                                @if(in_array('view', $actions))
                                    @php
                                        $permKey  = $key . '.view';
                                        $perm     = $permissions->get($permKey);
                                        $isActive = $perm ? (bool) $perm->is_active : true;
                                    @endphp
                                    <button class="btn btn-sm btn-toggle btn-{{ $isActive ? 'success' : 'secondary' }}"
                                            data-permission="{{ $permKey }}">
                                        <i class="fas fa-{{ $isActive ? 'check' : 'times' }}"></i>
                                        {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- EDIT --}}
                            <td class="text-center">
                                @if(in_array('edit', $actions))
                                    @php
                                        $permKey  = $key . '.edit';
                                        $perm     = $permissions->get($permKey);
                                        $isActive = $perm ? (bool) $perm->is_active : true;
                                    @endphp
                                    <button class="btn btn-sm btn-toggle btn-{{ $isActive ? 'success' : 'secondary' }}"
                                            data-permission="{{ $permKey }}">
                                        <i class="fas fa-{{ $isActive ? 'check' : 'times' }}"></i>
                                        {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- HAPUS --}}
                            <td class="text-center">
                                @if(in_array('hapus', $actions))
                                    @php
                                        $permKey  = $key . '.hapus';
                                        $perm     = $permissions->get($permKey);
                                        $isActive = $perm ? (bool) $perm->is_active : true;
                                    @endphp
                                    <button class="btn btn-sm btn-toggle btn-{{ $isActive ? 'success' : 'secondary' }}"
                                            data-permission="{{ $permKey }}">
                                        <i class="fas fa-{{ $isActive ? 'check' : 'times' }}"></i>
                                        {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- AKSES (khusus setting) --}}
                            <td class="text-center">
                                @if(in_array('akses', $actions))
                                    @php
                                        $permKey  = $key . '.akses';
                                        $perm     = $permissions->get($permKey);
                                        $isActive = $perm ? (bool) $perm->is_active : true;
                                    @endphp
                                    <button class="btn btn-sm btn-toggle btn-{{ $isActive ? 'success' : 'secondary' }}"
                                            data-permission="{{ $permKey }}">
                                        <i class="fas fa-{{ $isActive ? 'check' : 'times' }}"></i>
                                        {{ $isActive ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const permission = this.dataset.permission;
        const currentBtn = this;

        currentBtn.disabled = true;
        currentBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch("{{ route('role.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ permission: permission })
        })
        .then(res => res.json())
        .then(data => {
            const active = data.is_active;
            currentBtn.classList.remove('btn-success', 'btn-secondary');
            currentBtn.classList.add(active ? 'btn-success' : 'btn-secondary');
            currentBtn.innerHTML = `<i class="fas fa-${active ? 'check' : 'times'}"></i> ${active ? 'Aktif' : 'Nonaktif'}`;
        })
        .catch(err => {
            alert('Gagal mengubah akses. Silakan coba lagi.');
            console.error(err);
        })
        .finally(() => {
            currentBtn.disabled = false;
        });
    });
});
</script>
@endpush