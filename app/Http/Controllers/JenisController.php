<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Tampilkan halaman utama jenis produk (Daftar Data)
     */
    public function index()
    {
        $jenis = Jenis::all();
        return view('jenis.index', compact('jenis'));
    }

    /**
     * Tampilkan form untuk menambah jenis baru
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Simpan data jenis baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis
        ]);

        return redirect()->route('Jenis.index')->with('success', 'Jenis produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan data jenis tertentu (opsional)
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Tampilkan form edit untuk jenis tertentu
     */
    public function edit(string $id)
    {
        $jenis = Jenis::findOrFail($id);
        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Perbarui data jenis di database
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenis = Jenis::findOrFail($id);
        $jenis->update([
            'nama_jenis' => $request->nama_jenis
        ]);

        return redirect()->route('Jenis.index')->with('success', 'Jenis produk berhasil diperbarui!');
    }

    /**
     * Hapus data jenis dari database
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::findOrFail($id);
        $jenis->delete();

        return redirect()->route('Jenis.index')->with('success', 'Jenis produk berhasil dihapus!');
    }
}
