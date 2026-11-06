@extends('layouts.app')

@section('title', 'Detail Buku — BookStore')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row g-4">

            <div class="col-md-4">
                @if ($buku->cover && file_exists(public_path('images/' . $buku->cover)))
                <img
                    src="{{ asset('images/' . $buku->cover) }}"
                    alt="{{ $buku->title }}"
                    class="img-fluid rounded"
                    style="max-height: 400px; width: 100%; object-fit: contain;">
                @else
                <div class="d-flex align-items-center justify-content-center bg-light rounded"
                    style="height: 300px;">
                    <span class="text-muted">Sampul belum tersedia</span>
                </div>
                @endif
            </div>

            <div class="col-md-8">
                <h1 class="mb-3">{{ $buku->title }}</h1>

                <p>Penulis: {{ $buku->author_name }}</p>

                <p>
                    Tahun Terbit: {{ $buku->published_year ?? '-' }}
                </p>

                <p>Kategori: {{ $buku->category->name ?? '-' }}</p>

                <p>Penerbit: {{ $buku->publisher->name ?? '-' }}</p>

                <p>
                    Harga:
                    <strong>Rp{{ number_format($buku->price, 0, ',', '.') }}</strong>
                </p>

                <a href="{{ url('/books') }}" class="btn btn-secondary">
                    Kembali ke Daftar Buku
                </a>
            </div>

        </div>
    </div>
</div>

<hr class="my-4">

<h3 class="mb-3">Buku Lain dalam Kategori yang Sama</h3>

<div class="row">
    @forelse ($bukuLain as $item)
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            @if ($item->cover)
            <img src="{{ asset('images/' . $item->cover) }}"
                class="card-img-top"
                alt="{{ $item->title }}">
            @endif

            <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">Penulis: {{ $item->author_name }}</p>
                <a href="{{ route('books.show', $item->id) }}"
                    class="btn btn-primary">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
    @empty
    <p>Belum ada buku lain dalam kategori ini.</p>
    @endforelse
</div>
@endsection