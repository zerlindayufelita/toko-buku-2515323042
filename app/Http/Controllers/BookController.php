<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'daftarBuku' => Book::with(['category', 'publisher'])->get(),
        ]);
    }

    public function create()
    {
        return view('books.create', [
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        unset($data['cover']);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $namaFile = Str::uuid() . '.' . $file->extension();

            $file->move(public_path('images'), $namaFile);
            $data['cover'] = $namaFile;
        }

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'publisher']);

        return view('books.show', [
            'buku' => $book,
        ]);
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'buku' => $book,
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'publisher_id' => ['nullable', 'exists:publishers,id'],
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'published_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
        ]);

        unset($data['cover']);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $namaFile = Str::uuid() . '.' . $file->extension();

            $file->move(public_path('images'), $namaFile);

            if ($book->cover && File::exists(public_path('images/' . $book->cover))) {
                File::delete(public_path('images/' . $book->cover));
            }

            $data['cover'] = $namaFile;
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
