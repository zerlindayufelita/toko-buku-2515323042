@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Penerbit</h1>

    <a href="{{ route('penerbit.index') }}"
        class="btn btn-secondary mb-3">
        Kembali
    </a>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('penerbit.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Penerbit</label>
            <input
                type="text"
                name="name"
                id="name"
                class="form-control"
                value="{{ old('name') }}"
                required
                maxlength="100">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Kota</label>
            <input
                type="text"
                name="city"
                id="city"
                class="form-control"
                value="{{ old('city') }}"
                required
                maxlength="100">
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
    </form>
</div>
@endsection