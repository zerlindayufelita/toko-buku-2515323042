@extends('layouts.app')

@section('title', 'Edit Buku — BookStore')

@section('content')
<h1 class="mb-4">Edit Buku</h1>

<form action="{{ route('books.update', $buku->id) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Judul Buku</label>
        <input type="text" name="title" id="title"
            class="form-control"
            value="{{ old('title', $buku->title) }}" required>
        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="author_name" class="form-label">Nama Penulis</label>
        <input type="text" name="author_name" id="author_name"
            class="form-control"
            value="{{ old('author_name', $buku->author_name) }}" required>
        @error('author_name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" name="price" id="price"
            class="form-control" min="0" step="0.01"
            value="{{ old('price', $buku->price) }}" required>
        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="published_year" class="form-label">Tahun Terbit</label>
        <input
            type="number"
            name="published_year"
            id="published_year"
            class="form-control"
            min="1900"
            max="2100"
            value="{{ old('published_year', $buku->published_year) }}"
            @error('published_year')
            <div class="text-danger">{{ $message }}
    </div>
    @enderror
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                @selected(old('category_id', $buku->category_id) == $category->id)>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="publisher_id" class="form-label">Penerbit</label>
        <select name="publisher_id" id="publisher_id" class="form-select">
            <option value="">-- Pilih Penerbit (Opsional) --</option>
            @foreach ($publishers as $publisher)
            <option value="{{ $publisher->id }}"
                @selected(old('publisher_id', $buku->publisher_id) == $publisher->id)>
                {{ $publisher->name }}
            </option>
            @endforeach
        </select>
        @error('publisher_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Sampul Saat Ini</label><br>

        @if ($buku->cover && file_exists(public_path('images/' . $buku->cover)))
        <img src="{{ asset('images/' . $buku->cover) }}"
            alt="{{ $buku->title }}"
            style="max-height: 180px; object-fit: contain;">
        @else
        <p class="text-muted">Sampul belum tersedia.</p>
        @endif
    </div>

    <div class="mb-3">
        <label for="cover" class="form-label">Ganti Sampul (Opsional)</label>
        <input type="file" name="cover" id="cover"
            class="form-control" accept=".jpg,.jpeg,.png,.webp">
        <small class="text-muted">Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.</small>
        @error('cover') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection