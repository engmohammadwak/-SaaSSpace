<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Settings – SaaSSpace Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #0a0a0a; color: #fff; }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #111; border-right: 1px solid #222; padding: 24px 0; position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto; }
        .sidebar-logo { padding: 0 24px 24px; border-bottom: 1px solid #222; margin-bottom: 16px; }
        .sidebar-logo span { color: #fff; font-size: 18px; font-weight: 600; }
        .sidebar-nav a { display: flex; align-items: center; gap: 10px; padding: 12px 24px; color: #aaa; text-decoration: none; font-size: 14px; transition: all 0.2s; }
        .sidebar-nav a:hover, .sidebar-nav a.active { color: #65E4F3; background: rgba(101,228,243,0.05); }
        .sidebar-nav .nav-section { padding: 16px 24px 6px; color: #555; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; }
        .main-content { margin-left: 260px; flex: 1; padding: 32px; }
        .page-header { margin-bottom: 32px; }
        .page-header h1 { font-size: 28px; font-weight: 700; }
        .form-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 28px; }
        .form-section-title { font-size: 16px; font-weight: 600; color: #65E4F3; margin: 24px 0 16px; border-bottom: 1px solid #222; padding-bottom: 8px; }
        .form-section-title:first-child { margin-top: 0; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 13px; color: #aaa; }
        input, textarea, select {
            background: #0a0a0a; border: 1px solid #333; border-radius: 8px;
            padding: 10px 14px; color: #fff; font-size: 14px; width: 100%;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus { outline: none; border-color: #65E4F3; }
        textarea { min-height: 80px; resize: vertical; }
        .btn-save {
            background: linear-gradient(135deg, #65E4F3, #359DFC);
            color: #000; border: none; padding: 12px 32px;
            border-radius: 8px; font-weight: 600; font-size: 15px;
            cursor: pointer; margin-top: 24px; width: 100%;
        }
        .btn-save:hover { opacity: 0.9; }
        .alert-success { background: rgba(0,208,130,0.1); border: 1px solid #00d082; color: #00d082; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .current-file { font-size: 12px; color: #65E4F3; margin-top: 4px; }
        @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }
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
            <h1>⚙️ Site Settings</h1>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-section-title">General</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Site Name</label>
                        <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'SaaSSpace' }}" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="email" name="site_email" value="{{ $settings['site_email'] ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label>Logo (PNG/WebP)</label>
                        <input type="file" name="logo" accept="image/*">
                        @if(!empty($settings['logo']))
                        <span class="current-file">Current: {{ basename($settings['logo']) }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Favicon (PNG)</label>
                        <input type="file" name="favicon" accept="image/*">
                    </div>
                </div>

                <div class="form-section-title">About Section</div>
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Showreel Video (MP4)</label>
                        <input type="file" name="about_video" accept="video/*">
                        @if(!empty($settings['about_video']))
                        <span class="current-file">Current: {{ basename($settings['about_video']) }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-section-title">CTA Links</div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Calendly URL</label>
                        <input type="url" name="calendly_url" value="{{ $settings['calendly_url'] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label>Behance URL</label>
                        <input type="url" name="behance_url" value="{{ $settings['behance_url'] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label>Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label>Dribbble URL</label>
                        <input type="url" name="dribbble_url" value="{{ $settings['dribbble_url'] ?? '' }}">
                    </div>
                </div>

                <div class="form-section-title">Footer</div>
                <div class="form-group full">
                    <label>Footer Copyright Text</label>
                    <textarea name="footer_text">{{ $settings['footer_text'] ?? '' }}</textarea>
                </div>

                <button type="submit" class="btn-save">💾 Save All Settings</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
