@extends('admin.layouts.app')

@section('title', 'Tambah Informasi')
@section('header_title', 'Tambah Informasi Baru')

@section('header_actions')
    <a href="{{ route('informasi.daftar') }}" class="btn btn-outline" style="color: var(--text-secondary); border: 1px solid var(--card-border);">Batal</a>
@endsection

@section('content')
<form method="post" action="{{ url('simpan-informasi') }}" style="max-width: 800px;">
    @csrf
    
    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" required>
    </div>

    <div class="form-group">
        <label>Ringkasan</label>
        <textarea name="ringkasan" style="min-height: 80px;" required></textarea>
    </div>

    <div class="form-group">
        <label>Isi Konten</label>
        <textarea name="isi" style="min-height: 200px;" required></textarea>
    </div>

    <div class="form-group">
        <label>Sumber (Opsional)</label>
        <input type="text" name="sumber">
    </div>

    <div class="form-group">
        <label>Status</label>
        <div style="display: flex; gap: 20px; margin-top: 10px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="radio" name="status" value="draft" checked style="width: auto;"> Draft
            </label>
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="radio" name="status" value="published" style="width: auto;"> Published
            </label>
        </div>
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">Simpan Informasi</button>
    </div>
</form>
@endsection