<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services – SaaSSpace Admin</title>
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
        .btn-primary {
            background: linear-gradient(135deg, #65E4F3, #359DFC);
            color: #000; border: none; padding: 10px 22px;
            border-radius: 8px; font-weight: 600; font-size: 14px;
            cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-primary:hover { opacity: 0.88; }
        .table-card { background: #111; border: 1px solid #222; border-radius: 12px; overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #161616; }
        th { padding: 14px 18px; text-align: left; font-size: 12px; color: #555; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 1px solid #222; }
        td { padding: 14px 18px; border-bottom: 1px solid #1a1a1a; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #131313; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-active { background: rgba(0,208,130,0.15); color: #00d082; }
        .badge-inactive { background: rgba(255,80,80,0.15); color: #ff5050; }
        .service-icon { width: 40px; height: 40px; border-radius: 8px; object-fit: contain; background: #1a1a1a; padding: 4px; }
        .action-btns { display: flex; gap: 8px; }
        .btn-edit { background: #1a1a2e; color: #65E4F3; border: 1px solid #65E4F3; padding: 6px 14px; border-radius: 6px; font-size: 12px; text-decoration: none; transition: all 0.2s; }
        .btn-edit:hover { background: #65E4F3; color: #000; }
        .btn-delete { background: #1a0a0a; color: #ff5050; border: 1px solid #ff5050; padding: 6px 14px; border-radius: 6px; font-size: 12px; cursor: pointer; transition: all 0.2s; }
        .btn-delete:hover { background: #ff5050; color: #fff; }
        .alert-success { background: rgba(0,208,130,0.1); border: 1px solid #00d082; color: #00d082; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .empty-state { text-align: center; padding: 60px 20px; color: #555; }
        .empty-state p { font-size: 16px; margin-bottom: 16px; }
        .sort-order { background: #1a1a1a; color: #aaa; border-radius: 4px; padding: 2px 8px; font-size: 12px; }
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
            <h1>⚙️ Services</h1>
            <a href="{{ route('admin.services.create') }}" class="btn-primary">+ Add Service</a>
        </div>

        <div class="table-card">
            @if($services->isEmpty())
            <div class="empty-state">
                <p>No services yet.</p>
                <a href="{{ route('admin.services.create') }}" class="btn-primary">+ Add First Service</a>
            </div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td style="color:#555;">{{ $loop->iteration }}</td>
                        <td>
                            @if($service->icon)
                            <img src="{{ Storage::url($service->icon) }}" alt="icon" class="service-icon">
                            @else
                            <span style="color:#333; font-size:20px;">⚙️</span>
                            @endif
                        </td>
                        <td style="font-weight:600;">{{ $service->title }}</td>
                        <td style="color:#aaa; max-width:300px;">
                            {{ Str::limit($service->description, 80) }}
                        </td>
                        <td><span class="sort-order">{{ $service->sort_order }}</span></td>
                        <td>
                            <span class="badge {{ $service->is_active ? 'badge-active' : 'badge-inactive' }}">
                                {{ $service->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-edit">✏️ Edit</a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="return confirm('Delete this service?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑 Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
</body>
</html>
