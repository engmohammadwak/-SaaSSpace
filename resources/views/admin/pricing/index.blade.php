<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans – SaaSSpace Admin</title>
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
        .plans-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 18px; }
        .plan-card {
            background: #111; border: 1px solid #222; border-radius: 14px; padding: 24px;
            position: relative; transition: border-color 0.2s;
        }
        .plan-card.featured { border-color: #65E4F3; }
        .plan-card:hover { border-color: #333; }
        .featured-tag { position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #65E4F3, #359DFC); color: #000; font-size: 11px; font-weight: 700; padding: 3px 14px; border-radius: 20px; white-space: nowrap; }
        .plan-name { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
        .plan-price { font-size: 32px; font-weight: 800; color: #65E4F3; }
        .plan-price span { font-size: 14px; color: #555; font-weight: 400; }
        .plan-features { margin: 16px 0; list-style: none; }
        .plan-features li { font-size: 13px; color: #aaa; padding: 5px 0; border-bottom: 1px solid #1a1a1a; }
        .plan-features li:last-child { border-bottom: none; }
        .plan-footer { display: flex; justify-content: space-between; align-items: center; margin-top: 16px; }
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
            <h1>💰 Pricing Plans</h1>
            <a href="{{ route('admin.pricing.create') }}" class="btn-primary">+ Add Plan</a>
        </div>
        @if($plans->isEmpty())
        <div class="empty-state"><p>No plans yet.</p><a href="{{ route('admin.pricing.create') }}" class="btn-primary">+ Add First Plan</a></div>
        @else
        <div class="plans-grid">
            @foreach($plans as $plan)
            <div class="plan-card {{ $plan->is_featured ? 'featured' : '' }}">
                @if($plan->is_featured)
                <div class="featured-tag">⭐ Most Popular</div>
                @endif
                <div class="plan-name">{{ $plan->name }}</div>
                <div class="plan-price">${{ number_format($plan->price, 0) }}<span>/{{ $plan->billing_period }}</span></div>
                <ul class="plan-features">
                    @foreach(array_slice($plan->features, 0, 4) as $feature)
                    <li>✓ {{ $feature }}</li>
                    @endforeach
                    @if(count($plan->features) > 4)
                    <li style="color:#555;">+ {{ count($plan->features) - 4 }} more...</li>
                    @endif
                </ul>
                <div class="plan-footer">
                    <span class="badge {{ $plan->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $plan->is_active ? 'Active' : 'Hidden' }}</span>
                    <div class="action-btns">
                        <a href="{{ route('admin.pricing.edit', $plan) }}" class="btn-edit">✏️ Edit</a>
                        <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST" onsubmit="return confirm('Delete this plan?')">
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
