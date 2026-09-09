@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header_title', 'Dashboard Ringkas')

@push('styles')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .stat-info h3 {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-bottom: 0.2rem;
        font-weight: 500;
    }

    .stat-info p {
        font-size: 1.8rem;
        font-weight: 700;
        color: white;
    }

    /* Colors */
    .icon-blue { background: rgba(59, 130, 246, 0.1); color: #60a5fa; }
    .icon-purple { background: rgba(168, 85, 247, 0.1); color: #c084fc; }
    .icon-green { background: rgba(16, 185, 129, 0.1); color: #34d399; }
    .icon-orange { background: rgba(249, 115, 22, 0.1); color: #fb923c; }

    .recent-section {
        margin-top: 2rem;
    }

    .recent-section h2 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>
        <div class="stat-info">
            <h3>Total Informasi</h3>
            <p>{{ $totalInformasi }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-purple">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
        </div>
        <div class="stat-info">
            <h3>Total Kategori</h3>
            <p>{{ $totalKategori }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-green">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        </div>
        <div class="stat-info">
            <h3>Published</h3>
            <p>{{ $totalPublished }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-orange">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </div>
        <div class="stat-info">
            <h3>Draft</h3>
            <p>{{ $totalDraft }}</p>
        </div>
    </div>
</div>

<div class="recent-section">
    <h2>Aktivitas Terbaru</h2>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentInformasi as $info)
                    <tr>
                        <td style="font-weight: 500;">{{ Str::limit($info->judul, 40) }}</td>
                        <td><span style="background: rgba(59, 130, 246, 0.2); color: #60a5fa; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">{{ $info->kategori->nama }}</span></td>
                        <td>
                            @if($info->status == 'published')
                                <span style="color: #34d399;">Published</span>
                            @else
                                <span style="color: #fb923c;">Draft</span>
                            @endif
                        </td>
                        <td style="color: var(--text-secondary); font-size: 0.9rem;">
                            {{ $info->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 1rem;">Belum ada aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
