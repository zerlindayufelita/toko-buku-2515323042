<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => ['judul' => 'Malice', 'penulis' => 'Keigo Higashino'],
        2 => ['judul' => 'The Long Walk', 'penulis' => 'Stephen King'],
        3 => ['judul' => 'Holy Mother', 'penulis' => 'Minato Kanae'],
    ];

    public function index()
    {
        return view('books.index', ['daftarBuku' => $this->daftarBuku]);
    }

    public function show($id)
    {
        $buku = $this->daftarBuku[$id] ?? null;
        return view('books.show', ['buku' => $buku, 'id' => $id]);
    }
}
