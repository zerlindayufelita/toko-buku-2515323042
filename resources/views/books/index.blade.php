@extends('layouts.app')

@section('title', 'Daftar Buku — BookStore')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Daftar Buku</h1>

    <a href="{{ route('books.create') }}" class="btn btn-success">
        + Tambah Buku
    </a>
</div>

<form action="{{ route('books.index') }}" method="GET" class="mb-4">

    <div class="row g-2">
        <div class="col-md-5">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Cari judul buku atau nama penulis..."
                value="{{ $search ?? '' }}">
        </div>

        <div class="col-md-4">
            <select name="category_id" class="form-select">
                <option value="">-- Semua Kategori --</option>

                @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(($selectedCategory ?? '' )==$category->id)
                    >
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="publisher_id" class="form-select">
                <option value="">Semua Penerbit</option>

                @foreach ($publishers as $publisher)
                <option value="{{ $publisher->id }}"
                    {{ request('publisher_id') == $publisher->id ? 'selected' : '' }}>
                    {{ $publisher->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">
                Cari / Filter
            </button>

            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                Reset
            </a>
        </div>
    </div>

</form>

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

                <p class="card-text mb-1">
                    Jumlah Stok: {{ $buku->stock }}
                </p>

                @if ($buku->stock > 0)
                <span class="badge bg-success mb-2">Tersedia</span>
                @else
                <span class="badge bg-danger mb-2">Stok Habis</span>
                @endif

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
    <div class="d-flex justify-content-center mt-4">
        {{ $daftarBuku->links() }}
    </div>
</div>
@endsection