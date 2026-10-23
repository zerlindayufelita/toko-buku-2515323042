<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::latest()->paginate(10);

        return view('penerbit.index', compact('publishers'));
    }

    public function create()
    {
        return view('penerbit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:publishers,name',
            'city' => 'required|string|max:100',
        ]);

        Publisher::create($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function edit(Publisher $penerbit)
    {
        return view('penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, Publisher $penerbit)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('publishers', 'name')->ignore($penerbit->id),
            ],
            'city' => 'required|string|max:100',
        ]);

        $penerbit->update($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy(Publisher $penerbit)
    {
        $penerbit->delete();

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil dihapus.');
    }
}
