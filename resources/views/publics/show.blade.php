@extends('publics.layouts.app')

@section('title', $informasi->judul . ' - Knowledge Hub')

@push('styles')
<style>
    .article-container {
        max-width: 800px;
        margin: 0 auto;
        animation: fadeIn 0.8s ease-out;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        text-decoration: none;
        margin-bottom: 2rem;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .back-link:hover {
        color: white;
    }

    .back-link svg {
        transition: transform 0.2s ease;
    }

    .back-link:hover svg {
        transform: translateX(-3px);
    }

    .article-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--card-border);
        padding-bottom: 2rem;
    }

    .article-title {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: white;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .meta-item.category {
        color: #60a5fa;
        background: rgba(59, 130, 246, 0.1);
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    .article-content {
        color: #e2e8f0;
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content a {
        color: #60a5fa;
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: border-color 0.2s ease;
    }

    .article-content a:hover {
        border-color: #60a5fa;
    }

    .source-box {
        margin-top: 3rem;
        padding: 1.5rem;
        background: rgba(255,255,255,0.03);
        border-radius: 12px;
        border-left: 4px solid var(--accent);
    }

    .source-label {
        font-weight: 600;
        color: white;
        margin-bottom: 0.5rem;
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
        .article-title { font-size: 2rem; }
    }
</style>
@endpush

@section('content')
<div class="article-container">
    <a href="{{ route('public.index') }}" class="back-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali ke Daftar Informasi
    </a>

    <div class="glass-card">
        <div class="article-header">
            <h1 class="article-title">{{ $informasi->judul }}</h1>
            
            <div class="article-meta">
                <div class="meta-item category">
                    {{ $informasi->kategori->nama }}
                </div>
                <div class="meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    {{ $informasi->created_at ? $informasi->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                </div>
            </div>
        </div>
        
        <div class="article-content">
            {!! nl2br(e($informasi->isi)) !!}
        </div>
        
        @if($informasi->sumber)
        <div class="source-box">
            <span class="source-label">Sumber Referensi:</span>
            {{ $informasi->sumber }}
        </div>
        @endif
    </div>
</div>
@endsection