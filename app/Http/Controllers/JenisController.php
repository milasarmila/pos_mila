<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisController extends Controller
{
    /**
     * Tampilkan daftar jenis
     */
    public function index()
    {
        $jenis = Jenis::all();

        return view('jenis.index', compact('jenis'));
    }

    /**
     * Form tambah jenis
     */
    public function create()
    {
        return view('jenis.create');
    }

    /**
     * Simpan jenis baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $data = [
            'nama_jenis' => $request->nama_jenis,
        ];

        // Jika user memilih foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('jenis', 'public');
        }

        Jenis::create($data);

        return redirect()
            ->route('Jenis.index')
            ->with('success', 'Jenis produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail jenis
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Form edit
     */
    public function edit(string $id)
    {
        $jenis = Jenis::findOrFail($id);

        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Update jenis
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_jenis.required' => 'Nama jenis wajib diisi.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        $jenis = Jenis::findOrFail($id);

        $data = [
            'nama_jenis' => $request->nama_jenis,
        ];

        // Kalau upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($jenis->foto && Storage::disk('public')->exists($jenis->foto)) {
                Storage::disk('public')->delete($jenis->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('jenis', 'public');
        }

        $jenis->update($data);

        return redirect()
            ->route('Jenis.index')
            ->with('success', 'Jenis produk berhasil diperbarui!');
    }

    /**
     * Hapus jenis
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::findOrFail($id);

        // Hapus foto dari storage
        if ($jenis->foto && Storage::disk('public')->exists($jenis->foto)) {
            Storage::disk('public')->delete($jenis->foto);
        }

        $jenis->delete();

        return redirect()
            ->route('Jenis.index')
            ->with('success', 'Jenis produk berhasil dihapus!');
    }
}
