@extends('layouts.app')

@section('title', 'Detail Buku — BookStore')

@section('content')
<div class="card">
    <div class="card-body">
        <h1>{{ $buku->title }}</h1>

        <p>Penulis: {{ $buku->author_name }}</p>

        <p>Kategori: {{ $buku->category->name ?? '-' }}</p>

        <p>Harga: Rp{{ number_format($buku->price, 0, ',', '.') }}</p>

        <a href="{{ url('/books') }}" class="btn btn-secondary">
            Kembali ke Daftar Buku
        </a>
    </div>
</div>
@endsection