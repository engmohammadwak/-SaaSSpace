<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard – SaaSSpace</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0a0a0a; color: #fff; }
        .admin-layout { display: flex; min-height: 100vh; }
        /* Sidebar */
        .sidebar {
            width: 260px; background: #111; border-right: 1px solid #222;
            padding: 24px 0; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto;
        }
        .sidebar-logo { padding: 0 24px 24px; border-bottom: 1px solid #222; margin-bottom: 16px; }
        .sidebar-logo img { height: 36px; width: auto; }
        .sidebar-logo span { color: #fff; font-size: 18px; font-weight: 600; }
        .sidebar-nav a {
            display: flex; align-items: center; gap: 10px; padding: 12px 24px;
            color: #aaa; text-decoration: none; font-size: 14px; transition: all 0.2s;
        }
        .sidebar-nav a:hover, .sidebar-nav a.active { color: #65E4F3; background: rgba(101,228,243,0.05); }
        .sidebar-nav .nav-section { padding: 16px 24px 6px; color: #555; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        /* Main */
        .main-content { margin-left: 260px; flex: 1; padding: 32px; }
        .page-header { margin-bottom: 32px; }
        .page-header h1 { font-size: 28px; font-weight: 700; }
        .page-header p { color: #aaa; margin-top: 4px; }
        /* Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; margin-bottom: 32px; }
        .stat-card {
            background: #111; border: 1px solid #222; border-radius: 12px;
            padding: 20px; text-align: center; transition: border-color 0.2s;
        }
        .stat-card:hover { border-color: #65E4F3; }
        .stat-number { font-size: 36px; font-weight: 700; color: #65E4F3; }
        .stat-label { color: #aaa; font-size: 13px; margin-top: 4px; }
        /* Quick links */
        .quick-links { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
        .quick-link {
            background: #111; border: 1px solid #222; border-radius: 12px;
            padding: 20px; text-decoration: none; color: #fff; transition: all 0.2s;
            display: flex; align-items: center; gap: 12px;
        }
        .quick-link:hover { border-color: #65E4F3; transform: translateY(-2px); }
        .quick-link-icon { font-size: 24px; }
        .quick-link-title { font-weight: 600; font-size: 15px; }
        .quick-link-desc { color: #aaa; font-size: 12px; margin-top: 2px; }
        /* Alert */
        .alert-success { background: rgba(0,208,130,0.1); border: 1px solid #00d082; color: #00d082; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="main-content">
        @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="page-header">
            <h1>Dashboard</h1>
            <p>Welcome back! Here's an overview of your website content.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['services'] }}</div>
                <div class="stat-label">Services</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['projects'] }}</div>
                <div class="stat-label">Case Studies</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['testimonials'] }}</div>
                <div class="stat-label">Testimonials</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['pricing'] }}</div>
                <div class="stat-label">Pricing Plans</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['clients'] }}</div>
                <div class="stat-label">Client Logos</div>
            </div>
        </div>

        <div class="quick-links">
            <a href="{{ route('admin.hero.index') }}" class="quick-link">
                <span class="quick-link-icon">🎯</span>
                <div><div class="quick-link-title">Hero Section</div><div class="quick-link-desc">Edit headline & buttons</div></div>
            </a>
            <a href="{{ route('admin.services.index') }}" class="quick-link">
                <span class="quick-link-icon">⚙️</span>
                <div><div class="quick-link-title">Services</div><div class="quick-link-desc">Manage service cards</div></div>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="quick-link">
                <span class="quick-link-icon">📁</span>
                <div><div class="quick-link-title">Case Studies</div><div class="quick-link-desc">Add/edit projects</div></div>
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="quick-link">
                <span class="quick-link-icon">💬</span>
                <div><div class="quick-link-title">Testimonials</div><div class="quick-link-desc">Client reviews</div></div>
            </a>
            <a href="{{ route('admin.pricing.index') }}" class="quick-link">
                <span class="quick-link-icon">💰</span>
                <div><div class="quick-link-title">Pricing Plans</div><div class="quick-link-desc">Manage plans & prices</div></div>
            </a>
            <a href="{{ route('admin.clients.index') }}" class="quick-link">
                <span class="quick-link-icon">🏢</span>
                <div><div class="quick-link-title">Client Logos</div><div class="quick-link-desc">Swiper logos</div></div>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="quick-link">
                <span class="quick-link-icon">⚙️</span>
                <div><div class="quick-link-title">Site Settings</div><div class="quick-link-desc">Logo, links, social</div></div>
            </a>
            <a href="{{ route('home') }}" class="quick-link" target="_blank">
                <span class="quick-link-icon">🌐</span>
                <div><div class="quick-link-title">View Website</div><div class="quick-link-desc">Open frontend</div></div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
