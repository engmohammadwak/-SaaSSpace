<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service – SaaSSpace Admin</title>
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
        .main-content { margin-left: 260px; flex: 1; padding: 32px; max-width: 860px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; }
        .btn-back { color: #aaa; text-decoration: none; font-size: 14px; display: flex; align-items: center; gap: 6px; }
        .btn-back:hover { color: #fff; }
        .form-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 28px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 13px; color: #aaa; font-weight: 500; }
        input[type="text"], input[type="number"], input[type="file"], textarea, select {
            background: #0a0a0a; border: 1px solid #2a2a2a; border-radius: 8px;
            padding: 11px 14px; color: #fff; font-size: 14px; width: 100%;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus, select:focus { outline: none; border-color: #65E4F3; }
        textarea { min-height: 110px; resize: vertical; }
        .toggle-row { display: flex; align-items: center; gap: 12px; }
        .toggle-row label { color: #fff; font-size: 14px; cursor: pointer; }
        input[type="checkbox"] { width: 18px; height: 18px; accent-color: #65E4F3; cursor: pointer; }
        .error { color: #ff5050; font-size: 12px; margin-top: 2px; }
        .form-actions { display: flex; gap: 12px; margin-top: 24px; }
        .btn-save {
            background: linear-gradient(135deg, #65E4F3, #359DFC);
            color: #000; border: none; padding: 12px 32px;
            border-radius: 8px; font-weight: 600; font-size: 15px; cursor: pointer;
        }
        .btn-save:hover { opacity: 0.88; }
        .btn-cancel { background: #1a1a1a; color: #aaa; border: 1px solid #333; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px; }
        .btn-cancel:hover { color: #fff; }
        .preview-img { width: 60px; height: 60px; border-radius: 8px; object-fit: contain; background: #1a1a1a; padding: 4px; margin-top: 6px; display: none; }
    </style>
</head>
<body>
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="main-content">
        <div class="page-header">
            <h1>+ Add Service</h1>
            <a href="{{ route('admin.services.index') }}" class="btn-back">← Back to Services</a>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Service Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. UI/UX Design" required>
                        @error('title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group full">
                        <label>Description *</label>
                        <textarea name="description" placeholder="Describe this service...">{{ old('description') }}</textarea>
                        @error('description') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Icon Image (PNG/WebP/SVG)</label>
                        <input type="file" name="icon" accept="image/*" onchange="previewIcon(this)">
                        <img id="iconPreview" class="preview-img" alt="preview">
                        @error('icon') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                    <div class="form-group">
                        <div class="toggle-row">
                            <input type="checkbox" name="is_active" id="is_active" checked>
                            <label for="is_active">Active (visible on website)</label>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-save">💾 Save Service</button>
                    <a href="{{ route('admin.services.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewIcon(input) {
    const preview = document.getElementById('iconPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
