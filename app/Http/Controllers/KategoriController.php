<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function tampil(Request $request)
    {
        $query = Kategori::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }
        
        $kategoris = $query->orderBy('id', 'desc')->paginate(10);
        return view('admin.daftarKategori', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.createKategori');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);
        
        try {
            $kategori = new Kategori;
            $kategori->nama = $request->get('nama');
            $kategori->save();
            return redirect('/daftar-kategori')->with('success', 'Data kategori berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect('/daftar-kategori')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function ubah(string $id)
    {
        // Ubah variabel menjadi $kategori (tunggal) agar cocok dengan blade
        $kategori = Kategori::findOrFail($id); 
        return view('admin.ubahKategori', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        try {
            // Gunakan $id dari parameter route, bukan dari request form
            $kategori = Kategori::findOrFail($id);
            $kategori->nama = $request->get('nama');
            $kategori->save();
            
            return redirect('/daftar-kategori')->with('success', 'Data kategori berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect('/daftar-kategori')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function hapus(string $id)
    {
        try {
            Kategori::findOrFail($id)->delete();
            return redirect('/daftar-kategori')->with('success', 'Data kategori berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/daftar-kategori')->with('error', 'Data gagal dihapus!');
        }
    }
}