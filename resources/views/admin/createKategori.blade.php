@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')
@section('header_title', 'Tambah Kategori Baru')

@section('header_actions')
    <a href="{{ route('kategori.daftar') }}" class="btn btn-outline" style="color: var(--text-secondary); border: 1px solid var(--card-border);">Batal</a>
@endsection

@section('content')
<form method="post" action="{{ url('simpan-kategori') }}" style="max-width: 500px;">
    @csrf
    
    <div class="form-group">
        <label>Nama Kategori</label>
        <input type="text" name="nama" required placeholder="Contoh: Teknologi">
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem;">Simpan Kategori</button>
    </div>
</form>
@endsection