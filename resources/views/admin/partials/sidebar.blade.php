<aside class="sidebar">
    <div class="sidebar-logo">
        <span>⚡ SaaSSpace Admin</span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">📊 Dashboard</a>

        <div class="nav-section">Content</div>
        <a href="{{ route('admin.hero.index') }}" class="{{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">🎯 Hero Section</a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">⚙️ Services</a>
        <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">📁 Case Studies</a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">💬 Testimonials</a>
        <a href="{{ route('admin.pricing.index') }}" class="{{ request()->routeIs('admin.pricing.*') ? 'active' : '' }}">💰 Pricing Plans</a>
        <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">🏢 Client Logos</a>

        <div class="nav-section">Config</div>
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">⚙️ Site Settings</a>

        <div class="nav-section">Account</div>
        <a href="{{ route('home') }}" target="_blank">🌐 View Website</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </nav>
</aside>
