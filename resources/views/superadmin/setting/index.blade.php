@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-cog mr-2"></i> {{ $title }}
</h1>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
@endif

<form action="{{ route('settingUpdate') }}" method="POST">
    @csrf

    @foreach ($settings as $grup => $items)
    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-primary">
            <i class="fas fa-sliders-h mr-1"></i> {{ $grup }}
        </div>
        <div class="card-body">
            @foreach ($items as $s)
            <div class="form-group row">
                <label class="col-xl-3 col-form-label font-weight-bold">
                    {{ $s->label }}
                </label>
                <div class="col-xl-5">
                    <input type="text" name="settings[{{ $s->key }}]"
                        class="form-control"
                        value="{{ old("settings.{$s->key}", $s->value) }}">
                </div>
                <div class="col-xl-4 d-flex align-items-center">
                    <small class="text-muted">{{ $s->keterangan }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach

    
<div class="mb-4">

     <button type="submit" class="btn btn-primary">
        <i class="fas fa-save mr-1"></i> Simpan Semua Pengaturan
    </button>

    <a href="{{ url()->previous() }}" class="btn btn-secondary ml-2">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>

</div>

</form>

@endsection