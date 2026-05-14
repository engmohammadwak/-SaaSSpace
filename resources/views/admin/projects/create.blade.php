<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project – SaaSSpace Admin</title>
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
        .btn-back { color: #aaa; text-decoration: none; font-size: 14px; }
        .btn-back:hover { color: #fff; }
        .form-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 28px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        .form-group { display: flex; flex-direction: column; gap: 7px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 13px; color: #aaa; font-weight: 500; }
        input[type="text"], input[type="url"], input[type="number"], input[type="file"], textarea {
            background: #0a0a0a; border: 1px solid #2a2a2a; border-radius: 8px;
            padding: 11px 14px; color: #fff; font-size: 14px; width: 100%; transition: border-color 0.2s;
        }
        input:focus, textarea:focus { outline: none; border-color: #65E4F3; }
        textarea { min-height: 100px; resize: vertical; }
        .toggle-row { display: flex; align-items: center; gap: 12px; }
        .toggle-row label { color: #fff; font-size: 14px; cursor: pointer; }
        input[type="checkbox"] { width: 18px; height: 18px; accent-color: #65E4F3; cursor: pointer; }
        .error { color: #ff5050; font-size: 12px; }
        .form-actions { display: flex; gap: 12px; margin-top: 24px; }
        .btn-save { background: linear-gradient(135deg, #65E4F3, #359DFC); color: #000; border: none; padding: 12px 32px; border-radius: 8px; font-weight: 600; font-size: 15px; cursor: pointer; }
        .btn-cancel { background: #1a1a1a; color: #aaa; border: 1px solid #333; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px; }
        .img-preview { max-width: 100%; max-height: 200px; border-radius: 8px; margin-top: 8px; display: none; object-fit: cover; }
    </style>
</head>
<body>
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="main-content">
        <div class="page-header">
            <h1>+ Add Project</h1>
            <a href="{{ route('admin.projects.index') }}" class="btn-back">← Back</a>
        </div>
        <div class="form-card">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Project Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. SaaS Dashboard UI" required>
                        @error('title') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Category *</label>
                        <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. UI/UX Design, Branding" required>
                        @error('category') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description" placeholder="Short description of the project...">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label>Cover Image * (PNG/WebP/JPG)</label>
                        <input type="file" name="image" accept="image/*" required onchange="previewImg(this)">
                        <img id="imgPreview" class="img-preview" alt="preview">
                        @error('image') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Project URL (Behance / live link)</label>
                        <input type="url" name="url" value="{{ old('url') }}" placeholder="https://behance.net/...">
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
                    <button type="submit" class="btn-save">💾 Save Project</button>
                    <a href="{{ route('admin.projects.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function previewImg(input) {
    const preview = document.getElementById('imgPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
