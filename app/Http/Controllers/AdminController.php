<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403); // Akses ditolak
        }
        $produk = Produk::with('kategori')->get();
        $kategori = Kategori::all();
        return view('admin.product', compact('produk', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Produk::class);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()->route('produk');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {

        $this->authorize('update', $produk);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk');
    }

    public function indexKategori()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403); // Akses ditolak
        }
        $kategori = Kategori::all();
        return view('admin.kategori', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeKategori(Request $request)
    {
        $this->authorize('create', Kategori::class);

        $validated = $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        Kategori::create($validated);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateKategori(Request $request, Kategori $kategori)
    {
        $this->authorize('update', $kategori);

        $validated = $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori')->with('success', 'kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyKategori(Kategori $kategori)
    {
        $this->authorize('delete', $kategori);

        $kategori->delete();

        return redirect()->route('kategori');
    }
}
