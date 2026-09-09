<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInformasi = Informasi::count();
        $totalKategori = Kategori::count();
        $totalPublished = Informasi::where('status', 'published')->count();
        $totalDraft = Informasi::where('status', 'draft')->count();

        // Get latest information for recent activity
        $recentInformasi = Informasi::with('kategori')
                                   ->orderBy('created_at', 'desc')
                                   ->limit(5)
                                   ->get();

        return view('admin.dashboard', compact(
            'totalInformasi', 
            'totalKategori', 
            'totalPublished', 
            'totalDraft',
            'recentInformasi'
        ));
    }
}
