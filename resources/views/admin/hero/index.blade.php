<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Section – SaaSSpace Admin</title>
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
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 13px; color: #aaa; }
        input, textarea {
            background: #0a0a0a; border: 1px solid #333; border-radius: 8px;
            padding: 10px 14px; color: #fff; font-size: 14px; width: 100%;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus { outline: none; border-color: #65E4F3; }
        textarea { min-height: 100px; resize: vertical; }
        .help-text { font-size: 11px; color: #555; margin-top: 2px; }
        .btn-save {
            background: linear-gradient(135deg, #65E4F3, #359DFC);
            color: #000; border: none; padding: 12px 32px;
            border-radius: 8px; font-weight: 600; font-size: 15px;
            cursor: pointer; margin-top: 24px; width: 100%;
        }
        .btn-save:hover { opacity: 0.9; }
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
            <h1>🎯 Hero Section</h1>
        </div>

        <div class="form-card">
            <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Badge Text</label>
                        <input type="text" name="badge_text" value="{{ $hero->badge_text }}" required>
                    </div>
                    <div class="form-group full">
                        <label>Main Title</label>
                        <input type="text" name="main_title" value="{{ $hero->main_title }}" required>
                    </div>
                    <div class="form-group full">
                        <label>Rotating Texts (one per line)</label>
                        <textarea name="rotating_texts" rows="8">{{ implode("\n", $hero->rotating_texts ?? []) }}</textarea>
                        <span class="help-text">Each line = one rotating item (SaaS Products, AI Products...)</span>
                    </div>
                    <div class="form-group full">
                        <label>Description</label>
                        <textarea name="description">{{ $hero->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Primary Button Text</label>
                        <input type="text" name="primary_btn_text" value="{{ $hero->primary_btn_text }}" required>
                    </div>
                    <div class="form-group">
                        <label>Primary Button URL</label>
                        <input type="url" name="primary_btn_url" value="{{ $hero->primary_btn_url }}" required>
                    </div>
                    <div class="form-group">
                        <label>Secondary Button Text</label>
                        <input type="text" name="secondary_btn_text" value="{{ $hero->secondary_btn_text }}" required>
                    </div>
                    <div class="form-group">
                        <label>Secondary Button URL</label>
                        <input type="url" name="secondary_btn_url" value="{{ $hero->secondary_btn_url }}" required>
                    </div>
                </div>
                <button type="submit" class="btn-save">💾 Save Hero Section</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
