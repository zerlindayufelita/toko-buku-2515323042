@extends('layouts.app')

@section('title', 'Daftar Buku — BookStore')

@section('content')
<h1 class="mb-4">Daftar Buku</h1>

@php
$gambarBuku = [
1 => 'belajar-php.jpg',
2 => 'belajar-java.jpg',
3 => 'the-long-walk.jpg',
4 => 'holy-mother.jpg',
5 => 'kecerdasan-ai.jpg',
6 => 'teknologi-masa-depan.jpg',
];
@endphp

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($daftarBuku as $buku)
    <div class="col">
        <div class="card h-100 kartu-buku">

            <img
                src="{{ asset('images/' . ($gambarBuku[$buku->id] ?? 'default.jpg')) }}"
                class="card-img-top"
                alt="{{ $buku->title }}"
                style="height: 250px; object-fit: contain;">

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">
                    {{ $buku->title }}
                </h5>

                <p class="card-text text-muted mb-1">
                    {{ $buku->author_name }}
                </p>

                <p class="card-text">
                    Kategori: {{ $buku->category->name ?? '-' }}
                </p>

                <p class="card-text harga-buku">
                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                </p>

                <a href="{{ url('/books/'.$buku->id) }}"
                    class="btn btn-primary mt-auto">
                    Lihat Detail
                </a>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection