@extends('publics.layouts.app')

@section('title', 'Knowledge Hub - Beranda')

@push('styles')
<style>
    .header-section {
        text-align: center;
        margin-bottom: 4rem;
        animation: fadeInDown 0.8s ease-out;
    }

    .search-container {
        max-width: 600px;
        margin: 2rem auto 0;
        position: relative;
    }

    .search-container input {
        width: 100%;
        padding: 1rem 1.5rem;
        border-radius: 50px;
        background: rgba(30, 41, 59, 0.5);
        border: 1px solid var(--card-border);
        color: white;
        font-size: 1rem;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .search-container input:focus {
        outline: none;
        border-color: var(--accent);
        background: rgba(30, 41, 59, 0.8);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .article-card {
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: fadeInUp 0.6s ease-out backwards;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255,255,255,0.2);
    }

    .card-category {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: rgba(59, 130, 246, 0.1);
        color: #60a5fa;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .card-summary {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid var(--card-border);
    }

    .date {
        font-size: 0.8rem;
        color: var(--text-secondary);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .read-more {
        color: #60a5fa;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: color 0.2s ease;
    }

    .read-more:hover {
        color: white;
    }
    
    .read-more svg {
        transition: transform 0.2s ease;
    }

    .read-more:hover svg {
        transform: translateX(3px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        grid-column: 1 / -1;
    }

    .empty-state svg {
        width: 64px;
        height: 64px;
        color: var(--text-secondary);
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div class="header-section">
    <h1 class="page-title">Jelajahi Pengetahuan</h1>
    <p class="page-subtitle">Temukan artikel dan informasi terbaru yang relevan untuk Anda.</p>
</div>

<div class="grid-container">
    @forelse ($informasis as $index => $info)
        <div class="glass-card article-card" style="animation-delay: {{ $index * 0.1 }}s">
            <div>
                <span class="card-category">{{ $info->kategori->nama }}</span>
                <h3 class="card-title">{{ $info->judul }}</h3>
                <p class="card-summary">{{ Str::limit($info->ringkasan ?? strip_tags($info->isi), 120) }}</p>
            </div>
            <div class="card-footer">
                <span class="date">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ $info->created_at ? $info->created_at->format('d M Y') : 'Baru' }}
                </span>
                <a href="{{ route('public.show', $info->id) }}" class="read-more">
                    Baca <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>
    @empty
        <div class="glass-card empty-state">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <h3 class="card-title">Belum ada informasi</h3>
            <p class="card-summary">Silakan kembali lagi nanti untuk melihat pembaruan informasi.</p>
        </div>
    @endforelse
</div>
@endsection