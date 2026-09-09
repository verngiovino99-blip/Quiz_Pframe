@extends('admin.layouts.app')

@section('title', 'Ubah Kategori')
@section('header_title', 'Ubah Data Kategori')

@section('header_actions')
    <a href="{{ route('kategori.daftar') }}" class="btn btn-outline" style="color: var(--text-secondary); border: 1px solid var(--card-border);">Batal</a>
@endsection

@section('content')
<form method="post" action="{{ route('kategori.update', $kategori->id) }}" style="max-width: 500px;">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama" value="{{ $kategori->nama }}" required>
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">Simpan Perubahan</button>
    </div>
</form>
@endsection