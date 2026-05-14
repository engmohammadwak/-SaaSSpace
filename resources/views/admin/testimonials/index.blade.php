<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials – SaaSSpace Admin</title>
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
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .page-header h1 { font-size: 26px; font-weight: 700; }
        .btn-primary { background: linear-gradient(135deg, #65E4F3, #359DFC); color: #000; border: none; padding: 10px 22px; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; text-decoration: none; }
        .testimonials-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 16px; }
        .testimonial-card { background: #111; border: 1px solid #222; border-radius: 12px; padding: 20px; transition: border-color 0.2s; }
        .testimonial-card:hover { border-color: #333; }
        .t-header { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
        .t-avatar { width: 46px; height: 46px; border-radius: 50%; object-fit: cover; background: #1a1a1a; }
        .t-avatar-placeholder { width: 46px; height: 46px; border-radius: 50%; background: #1a1a2e; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
        .t-name { font-weight: 600; font-size: 15px; }
        .t-title { font-size: 12px; color: #777; margin-top: 2px; }
        .t-stars { color: #FFD700; font-size: 14px; margin-bottom: 10px; letter-spacing: 2px; }
        .t-content { font-size: 13px; color: #aaa; line-height: 1.6; }
        .t-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 16px; padding-top: 14px; border-top: 1px solid #1a1a1a; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-active { background: rgba(0,208,130,0.15); color: #00d082; }
        .badge-inactive { background: rgba(255,80,80,0.15); color: #ff5050; }
        .action-btns { display: flex; gap: 8px; }
        .btn-edit { background: #1a1a2e; color: #65E4F3; border: 1px solid #65E4F3; padding: 5px 12px; border-radius: 6px; font-size: 12px; text-decoration: none; transition: all 0.2s; }
        .btn-edit:hover { background: #65E4F3; color: #000; }
        .btn-delete { background: #1a0a0a; color: #ff5050; border: 1px solid #ff5050; padding: 5px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.2s; }
        .btn-delete:hover { background: #ff5050; color: #fff; }
        .alert-success { background: rgba(0,208,130,0.1); border: 1px solid #00d082; color: #00d082; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .empty-state { text-align: center; padding: 80px 20px; color: #555; }
    </style>
</head>
<body>
<div class="admin-layout">
    @include('admin.partials.sidebar')
    <div class="main-content">
        @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
        @endif
        <div class="page-header">
            <h1>💬 Testimonials</h1>
            <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ Add Testimonial</a>
        </div>
        @if($testimonials->isEmpty())
        <div class="empty-state"><p>No testimonials yet.</p><a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ Add First Testimonial</a></div>
        @else
        <div class="testimonials-grid">
            @foreach($testimonials as $t)
            <div class="testimonial-card">
                <div class="t-header">
                    @if($t->client_avatar)
                    <img src="{{ Storage::url($t->client_avatar) }}" alt="{{ $t->client_name }}" class="t-avatar">
                    @else
                    <div class="t-avatar-placeholder">👤</div>
                    @endif
                    <div>
                        <div class="t-name">{{ $t->client_name }}</div>
                        <div class="t-title">{{ $t->client_title }}</div>
                    </div>
                </div>
                <div class="t-stars">{{ str_repeat('★', $t->rating) }}{{ str_repeat('☆', 5 - $t->rating) }}</div>
                <div class="t-content">"{{ Str::limit($t->content, 120) }}"</div>
                <div class="t-footer">
                    <span class="badge {{ $t->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span>
                    <div class="action-btns">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">🗑</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
</body>
</html>
