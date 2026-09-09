@extends('admin.layouts.app')

@section('title', 'Ubah Informasi')
@section('header_title', 'Ubah Data Informasi')

@section('header_actions')
    <a href="{{ route('informasi.daftar') }}" class="btn btn-outline" style="color: var(--text-secondary); border: 1px solid var(--card-border);">Batal</a>
@endsection

@section('content')
<form method="post" action="{{ route('informasi.update', $informasi->id) }}" style="max-width: 800px;">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label>Kategori</label>
        <select name="kategori_id" required>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ $informasi->kategori_id == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" value="{{ $informasi->judul }}" required>
    </div>

    <div class="form-group">
        <label>Ringkasan</label>
        <textarea name="ringkasan" style="min-height: 80px;" required>{{ $informasi->ringkasan }}</textarea>
    </div>

    <div class="form-group">
        <label>Isi Konten</label>
        <textarea name="isi" style="min-height: 200px;" required>{{ $informasi->isi }}</textarea>
    </div>

    <div class="form-group">
        <label>Sumber</label>
        <input type="text" name="sumber" value="{{ $informasi->sumber }}">
    </div>

    <div class="form-group">
        <label>Status</label>
        <div style="display: flex; gap: 20px; margin-top: 10px;">
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="radio" name="status" value="draft" {{ $informasi->status == 'draft' ? 'checked' : '' }} style="width: auto;"> Draft
            </label>
            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                <input type="radio" name="status" value="published" {{ $informasi->status == 'published' ? 'checked' : '' }} style="width: auto;"> Published
            </label>
        </div>
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">Simpan Perubahan</button>
    </div>
</form>
@endsection