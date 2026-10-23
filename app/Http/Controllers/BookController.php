<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', [
            'daftarBuku' => Book::with('category')->get(),
        ]);
    }

    public function show($id)
    {
        $buku = Book::with('category')->findOrFail($id);

        return view('books.show', [
            'buku' => $buku,
        ]);
    }
}
