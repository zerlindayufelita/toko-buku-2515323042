@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Penerbit</h1>

    <a href="{{ route('penerbit.create') }}"
        class="btn btn-primary mb-3">
        Tambah Penerbit
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Penerbit</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($publishers as $publisher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $publisher->name }}</td>
                <td>{{ $publisher->city }}</td>
                <td>
                    <a href="{{ route('penerbit.edit', $publisher) }}"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('penerbit.destroy', $publisher) }}"
                        method="POST"
                        style="display:inline"
                        onsubmit="return confirm('Yakin ingin menghapus penerbit ini?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="btn btn-danger btn-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada data penerbit.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $publishers->links() }}
</div>
@endsection