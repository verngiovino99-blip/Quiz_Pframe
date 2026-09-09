@extends('admin.layouts.app')

@section('title', 'Daftar Informasi')
@section('header_title', 'Kelola Informasi')

@section('header_actions')
    <a href="{{ url('tambah-informasi') }}" class="btn btn-primary">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        Tambah Informasi
    </a>
@endsection

@section('content')
<div class="glass-card">
    <div class="filter-bar">
        <form method="GET" action="{{ route('informasi.daftar') }}" style="display: flex; gap: 10px; width: 100%; flex-wrap: wrap;">
            <input type="text" name="search" class="search-input" placeholder="Cari judul atau ringkasan..." value="{{ request('search') }}">
            <select name="status" style="width: auto;">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search') || request('status'))
                <a href="{{ route('informasi.daftar') }}" class="btn btn-outline">Reset</a>
            @endif
        </form>
    </div>

    <div style="overflow-x: auto;">
        <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Ringkasan</th>
                <th>Status</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($informasis as $informasi)
                <tr>
                    <td><span style="background: rgba(59, 130, 246, 0.2); color: #60a5fa; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">{{ $informasi->kategori->nama }}</span></td>
                    <td style="font-weight: 500;">{{ Str::limit($informasi->judul, 40) }}</td>
                    <td style="color: var(--text-secondary);">{{ Str::limit($informasi->ringkasan, 50) }}</td>
                    <td>
                        @if($informasi->status == 'published')
                            <span style="color: #34d399;">Published</span>
                        @else
                            <span style="color: #94a3b8;">Draft</span>
                        @endif
                    </td>
                    <td class="action-cell">
                        <a href="{{ route('informasi.ubah', $informasi) }}" class="btn btn-warning" title="Ubah">Ubah</a>
                        <form action="{{ route('informasi.hapus', $informasi) }}" method="POST" style="display:inline;">
                            @method('DELETE')
                            @csrf 
                            <input type="hidden" name="id" value="{{$informasi->id}}">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--text-secondary); padding: 2rem;">Belum ada data informasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div style="margin-top: 1.5rem;">
        {{ $informasis->links('pagination::bootstrap-4') }}
    </div>
</div>
</div>
@endsection