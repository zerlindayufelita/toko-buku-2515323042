@extends('layouts.app')

@section('title', 'Daftar Buku — BookStore')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Buku</h1>

    <a href="{{ route('books.create') }}" class="btn btn-success">
        + Tambah Buku
    </a>
</div>

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($daftarBuku as $buku)
    <div class="col">
        <div class="card h-100 kartu-buku">

            {{-- Gambar Sampul --}}
            @if ($buku->cover && file_exists(public_path('images/' . $buku->cover)))
            <img
                src="{{ asset('images/' . $buku->cover) }}"
                class="card-img-top"
                alt="{{ $buku->title }}"
                style="height: 250px; object-fit: contain;">
            @else
            <div class="d-flex align-items-center justify-content-center bg-light"
                style="height: 250px;">
                <span class="text-muted">Sampul belum tersedia</span>
            </div>
            @endif

            {{-- Informasi Buku --}}
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $buku->title }}</h5>

                <p class="card-text text-muted mb-1">
                    {{ $buku->author_name }}
                </p>

                <p class="card-text mb-1">
                    Kategori: {{ $buku->category->name ?? '-' }}
                </p>

                <p class="card-text mb-1">
                    Penerbit: {{ $buku->publisher->name ?? '-' }}
                </p>

                <p class="card-text harga-buku">
                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                </p>

                {{-- Tombol Aksi --}}
                <div class="mt-auto">
                    <a href="{{ route('books.show', $buku->id) }}"
                        class="btn btn-primary w-100 mb-2">
                        Lihat Detail
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('books.edit', $buku->id) }}"
                            class="btn btn-warning w-50">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $buku->id) }}"
                            method="POST" class="w-50"
                            onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger w-100">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection