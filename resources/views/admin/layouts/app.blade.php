<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --sidebar-bg: rgba(15, 23, 42, 0.95);
            --content-bg: #1e293b;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --accent: #3b82f6;
            --accent-hover: #2563eb;
            --danger: #ef4444;
            --danger-hover: #dc2626;
            --success: #10b981;
            --card-border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: var(--bg-color);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            padding: 1rem 1.5rem;
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--card-border);
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .menu-toggle {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            backdrop-filter: blur(10px);
            border-right: 1px solid var(--card-border);
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 999;
            transition: transform 0.3s ease;
        }

        .brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 3rem;
            padding: 0 1rem;
        }
        
        .brand span {
            background: linear-gradient(to right, #60a5fa, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.8rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-item a:hover, .nav-item a.active {
            color: white;
            background: rgba(59, 130, 246, 0.15);
            border-left: 3px solid var(--accent);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem 3rem;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            min-height: 100vh;
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--card-border);
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Card/Form Styling */
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-out;
            overflow-x: auto;
        }

        /* Search & Filter Bar */
        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .search-input {
            flex: 1;
            min-width: 250px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--card-border);
        }

        th {
            background: rgba(255, 255, 255, 0.05);
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Form Inputs */
        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        input[type="text"], 
        select, 
        textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            background: rgba(15, 23, 42, 0.5);
            border: 1px solid var(--card-border);
            border-radius: 8px;
            color: white;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, 
        select:focus, 
        textarea:focus {
            outline: none;
            border-color: var(--accent);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary { background: var(--accent); color: white; }
        .btn-primary:hover { background: var(--accent-hover); }

        .btn-danger { background: rgba(239, 68, 68, 0.1); color: var(--danger); border: 1px solid rgba(239, 68, 68, 0.2); }
        .btn-danger:hover { background: var(--danger); color: white; }

        .btn-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }
        .btn-warning:hover { background: #f59e0b; color: white; }

        .btn-outline { background: transparent; color: var(--text-primary); border: 1px solid var(--card-border); }
        .btn-outline:hover { background: rgba(255,255,255,0.05); }

        .action-cell {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Pagination Styling */
        nav[aria-label="Pagination Navigation"] {
            margin-top: 2rem;
        }
        
        .pagination {
            display: flex;
            gap: 5px;
            list-style: none;
            justify-content: center;
            margin-top: 2rem;
            align-items: center;
        }
        .pagination li a, .pagination li span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 35px;
            height: 35px;
            padding: 0 10px;
            border-radius: 6px;
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid var(--card-border);
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.9rem;
        }
        .pagination li a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .pagination li.active span {
            background: var(--accent);
            color: white;
            border-color: var(--accent);
        }
        .pagination li.disabled span {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        .alert-success { background: rgba(16, 185, 129, 0.1); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.2); }
        .alert-error { background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.2); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .mobile-header { display: flex; }
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }
            .sidebar.active { transform: translateX(0); }
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1.5rem 1rem;
            }
            .filter-bar { flex-direction: column; }
            .search-input { width: 100%; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <a href="#" class="brand" style="margin: 0; padding: 0;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            <span>Admin Hub</span>
        </a>
        <button class="menu-toggle" id="menuToggle">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a href="#" class="brand" style="display: none;"> <!-- Hidden on mobile via CSS but we kept it in mobile-header -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            <span>Admin Hub</span>
        </a>
        <ul class="nav-menu" style="margin-top: 1rem;">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('informasi.daftar') }}" class="{{ request()->routeIs('informasi.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Informasi
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kategori.daftar') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    Kategori
                </a>
            </li>
            <li class="nav-item" style="margin-top: 2rem;">
                <a href="{{ route('public.index') }}" target="_blank" style="color: #60a5fa;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    Lihat Website
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1 class="page-title">@yield('header_title')</h1>
            <div class="header-actions">
                @yield('header_actions')
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

    <script>
        // Mobile Sidebar Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Add brand logo visibility based on window width
        window.addEventListener('resize', checkBrand);
        window.addEventListener('load', checkBrand);

        function checkBrand() {
            const brand = document.querySelector('.sidebar .brand');
            if (window.innerWidth > 768) {
                brand.style.display = 'flex';
            } else {
                brand.style.display = 'none';
            }
        }
    </script>
</body>
</html>
