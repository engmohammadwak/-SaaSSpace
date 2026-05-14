<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client – SaaSSpace Admin</title>
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
        .main-content { margin-left: 260px; flex: 1; padding: 32px; max-width: 560px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; }
        .btn-back { color: #aaa; text-decoration: none; font-size: 14px; }
        .form-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 28px; }
        .form-group { display: flex; flex-direction: column; gap: 7px; margin-bottom: 18px; }
        label { font-size: 13px; color: #aaa; font-weight: 500; }
        input[type="text"], input[type="number"], input[type="file"] {
            background: #0a0a0a; border: 1px solid #2a2a2a; border-radius: 8px;
            padding: 11px 14px; color: #fff; font-size: 14px; width: 100%; transition: border-color 0.2s;
        }
        input:focus { outline: none; border-color: #65E4F3; }
        .toggle-row { display: flex; align-items: center; gap: 12px; }
        .toggle-row label { color: #fff; font-size: 14px; cursor: pointer; }
        input[type="checkbox"] { width: 18px; height: 18px; accent-color: #65E4F3; cursor: pointer; }
        .form-actions { display: flex; gap: 12px; margin-top: 8px; }
        .btn-save { background: linear-gradient(135deg, #65E4F3, #359DFC); color: #000; border: none; padding: 12px 32px; border-radius: 8px; font-weight: 600; font-size: 15px; cursor: pointer; }
        .btn-cancel { background: #1a1a1a; color: #aaa; border: 1px solid #333; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px; }
        .logo-preview { max-width: 160px; max-height: 60px; object-fit: contain; margin-top: 8px; display: none; background: #1a1a1a; padding: 8px; border-radius: 6px; }
    </style>
</head>
<body>
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="main-content">
        <div class="page-header">
            <h1>+ Add Client Logo</h1>
            <a href="{{ route('admin.clients.index') }}" class="btn-back">← Back</a>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Client / Company Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Google, Notion, Stripe" required>
                </div>
                <div class="form-group">
                    <label>Logo Image * (PNG/WebP/SVG — transparent background recommended)</label>
                    <input type="file" name="logo" accept="image/*" required onchange="previewLogo(this)">
                    <img id="logoPreview" class="logo-preview" alt="preview">
                </div>
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                </div>
                <div class="form-group">
                    <div class="toggle-row">
                        <input type="checkbox" name="is_active" id="is_active" checked>
                        <label for="is_active">Active (visible in swiper)</label>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-save">💾 Add Client</button>
                    <a href="{{ route('admin.clients.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewLogo(input) {
    const preview = document.getElementById('logoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
