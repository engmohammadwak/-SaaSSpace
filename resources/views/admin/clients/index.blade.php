<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Logos – SaaSSpace Admin</title>
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
        .clients-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 14px; }
        .client-card {
            background: #111; border: 1px solid #222; border-radius: 12px;
            padding: 20px 16px; text-align: center; transition: border-color 0.2s;
        }
        .client-card:hover { border-color: #333; }
        .client-logo { max-width: 120px; max-height: 56px; object-fit: contain; margin: 0 auto 12px; display: block; filter: brightness(0.8); }
        .client-name { font-size: 12px; color: #777; margin-bottom: 10px; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 600; margin-bottom: 10px; }
        .badge-active { background: rgba(0,208,130,0.15); color: #00d082; }
        .badge-inactive { background: rgba(255,80,80,0.15); color: #ff5050; }
        .action-btns { display: flex; gap: 6px; justify-content: center; }
        .btn-edit { background: #1a1a2e; color: #65E4F3; border: 1px solid #65E4F3; padding: 4px 10px; border-radius: 6px; font-size: 11px; text-decoration: none; transition: all 0.2s; }
        .btn-edit:hover { background: #65E4F3; color: #000; }
        .btn-delete { background: #1a0a0a; color: #ff5050; border: 1px solid #ff5050; padding: 4px 10px; border-radius: 6px; font-size: 11px; cursor: pointer; transition: all 0.2s; }
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
            <h1>🏢 Client Logos</h1>
            <a href="{{ route('admin.clients.create') }}" class="btn-primary">+ Add Client</a>
        </div>
        @if($clients->isEmpty())
        <div class="empty-state"><p>No client logos yet.</p><a href="{{ route('admin.clients.create') }}" class="btn-primary">+ Add First Client</a></div>
        @else
        <div class="clients-grid">
            @foreach($clients as $client)
            <div class="client-card">
                <img src="{{ Storage::url($client->logo) }}" alt="{{ $client->name }}" class="client-logo">
                <div class="client-name">{{ $client->name }}</div>
                <div><span class="badge {{ $client->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $client->is_active ? 'Active' : 'Hidden' }}</span></div>
                <div class="action-btns">
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn-edit">✏️</a>
                    <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Delete?')" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete">🗑</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
</body>
</html>
