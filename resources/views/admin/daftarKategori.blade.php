@extends('admin.layouts.app')

@section('title', 'Daftar Kategori')
@section('header_title', 'Kelola Kategori')

@section('header_actions')
    <a href="{{ url('tambah-kategori') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Kategori
    </a>
@endsection

@section('content')
<div class="glass-card">
    <div class="filter-bar">
        <form method="GET" action="{{ route('kategori.daftar') }}" style="display: flex; gap: 10px; width: 100%; max-width: 600px;">
            <input type="text" name="search" class="search-input" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('kategori.daftar') }}" class="btn btn-outline">Reset</a>
            @endif
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table>
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
                <tr>
                    <td style="font-weight: 500; font-size: 1.1rem;">{{ $kategori->nama }}</td>
                    <td class="action-cell">
                        <a href="{{ route('kategori.ubah', $kategori) }}" class="btn btn-warning">Ubah</a>
                        <form action="{{ route('kategori.hapus', $kategori) }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf 
                            <input type="hidden" name="id" value="{{$kategori->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $kategoris->links('pagination::bootstrap-4') }}
    </div>
</div>
</div>
@endsection