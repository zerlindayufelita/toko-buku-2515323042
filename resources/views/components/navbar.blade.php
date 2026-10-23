<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/books') }}">
            BookStore
        </a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/books') }}">
                    Buku
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    Kategori
                </a>
            </li>
        </ul>
    </div>
</nav>