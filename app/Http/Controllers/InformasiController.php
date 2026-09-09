<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function halamanUtama(Request $request)
    {
        $query = Informasi::with('kategori')->where('status', 'published');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('ringkasan', 'like', '%' . $search . '%');
            });
        }
        
        $informasis = $query->orderBy('created_at', 'desc')->paginate(6);
        return view('publics.index', compact('informasis'));
    }

    public function halamanDetail($id)
    {
        $informasi = Informasi::with('kategori')->findOrFail($id);
        return view('publics.show', compact('informasi'));
    }

    public function tampil(Request $request)
    {
        $query = Informasi::with('kategori');
        
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('ringkasan', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('status') && in_array($request->status, ['draft', 'published'])) {
            $query->where('status', $request->status);
        }

        $informasis = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.daftar', compact('informasis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.create', compact('kategoris'));
    }

    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'judul'       => 'required|string|max:255',
            'ringkasan'   => 'required|string',
            'isi'         => 'required',
            'sumber'      => 'required|string|max:255',
            'status'      => 'required|in:draft,published'
        ]);
        
        try {
            // Menggunakan Eloquent Create
            Informasi::create($validated);
            return redirect('/daftar-informasi')->with('success', 'Berhasil! Data informasi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('/daftar-informasi')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function ubah(string $id)
    {
        $informasi = Informasi::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.ubah', compact('informasi', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kategori_id' => 'required',
            'judul'       => 'required|string|max:255',
            'ringkasan'   => 'required|string',
            'isi'         => 'required',
            'sumber'      => 'required|string|max:255',
            'status'      => 'required|in:draft,published'
        ]);
        
        try {
            // Menggunakan Eloquent Update
            $informasi = Informasi::findOrFail($id);
            $informasi->update($validated);
            return redirect('/daftar-informasi')->with('success', 'Berhasil! Data informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect('/daftar-informasi')->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function hapus(string $id)
    {
        try {
            // Menggunakan Eloquent Delete
            Informasi::findOrFail($id)->delete();
            return redirect('/daftar-informasi')->with('success', 'Data informasi berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/daftar-informasi')->with('error', 'Data gagal dihapus!');
        }
    }
}