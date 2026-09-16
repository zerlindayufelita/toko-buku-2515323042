<h1>Data Buku</h1>

<ul>
    @foreach ($daftarBuku as $id => $buku)
    <li><a href="/books/{{ $id }}">{{ $buku['judul'] }}</a></li>
    @endforeach
</ul>