<header class="home-heading animated-fast" data-header>
    <div class="e-con-inner">

        {{-- Logo --}}
        <div class="header-logo">
            <a href="{{ route('home') }}">
                @if(!empty($settings['logo'] ?? null))
                    <img src="{{ Storage::url($settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'SaaSSpace' }}" width="860" height="192">
                @else
                    <img src="https://saasspace.co/wp-content/uploads/2025/10/Frame-1321315704.webp" alt="SaaSSpace" width="860" height="192">
                @endif
            </a>
        </div>

        {{-- Desktop Nav --}}
        <nav class="header-nav hidden-mobile hidden-tablet">
            <a href="/#about" class="menu_flip_btn">
                <div class="text-container"><span>{{ __('app.nav_about') }}</span><span>{{ __('app.nav_about') }}</span></div>
            </a>
            <a href="/#services" class="menu_flip_btn">
                <div class="text-container"><span>{{ __('app.nav_services') }}</span><span>{{ __('app.nav_services') }}</span></div>
            </a>
            <a href="/#casestudies" class="menu_flip_btn">
                <div class="text-container"><span>{{ __('app.nav_case_studies') }}</span><span>{{ __('app.nav_case_studies') }}</span></div>
            </a>
            <a href="/#testimonial" class="menu_flip_btn">
                <div class="text-container"><span>{{ __('app.nav_testimonials') }}</span><span>{{ __('app.nav_testimonials') }}</span></div>
            </a>
            <a href="/#pricing" class="menu_flip_btn">
                <div class="text-container"><span>{{ __('app.nav_pricing') }}</span><span>{{ __('app.nav_pricing') }}</span></div>
            </a>
        </nav>

        {{-- Right Side Actions --}}
        <div class="header-actions">

            {{-- Search --}}
            <div class="header-search" id="headerSearch">
                <button class="search-icon-btn" id="searchToggle" aria-label="Search">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <div class="search-expand" id="searchExpand">
                    <input type="text" class="search-input" placeholder="{{ __('app.search_placeholder') }}" id="searchInput" autocomplete="off">
                    <button class="search-close" id="searchClose" aria-label="Close search">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <path d="M18 6 6 18M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Language Switcher --}}
            <div class="lang-switcher" id="langSwitcher">
                <button class="lang-btn" id="langToggle" aria-label="Switch language">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                    </svg>
                    <span>{{ app()->getLocale() === 'ar' ? 'EN' : 'عربي' }}</span>
                    <svg class="lang-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                </button>
                <div class="lang-dropdown" id="langDropdown">
                    <a href="{{ route('lang.switch', 'ar') }}" class="lang-option {{ app()->getLocale() === 'ar' ? 'active' : '' }}">
                        <span class="lang-flag">🇸🇦</span> العربية
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" class="lang-option {{ app()->getLocale() === 'en' ? 'active' : '' }}">
                        <span class="lang-flag">🇺🇸</span> English
                    </a>
                </div>
            </div>

            {{-- Auth Buttons --}}
            @auth
                <div class="auth-user-menu" id="authUserMenu">
                    <button class="user-avatar-btn" id="userMenuToggle" aria-label="User menu">
                        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                        <span class="user-name hidden-tablet">{{ Auth::user()->name }}</span>
                        <svg class="lang-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="user-dropdown" id="userDropdown">
                        @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="user-option">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            {{ __('app.dashboard') }}
                        </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="user-option">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            {{ __('app.profile') }}
                        </a>
                        <div class="user-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="user-option user-option-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                {{ __('auth.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="auth-buttons hidden-tablet">
                    <a href="{{ route('login') }}" class="btn-auth-ghost">{{ __('auth.login') }}</a>
                    <a href="{{ route('register') }}" class="btn-auth-gold">{{ __('auth.register') }}</a>
                </div>
            @endauth

            {{-- Mobile Hamburger --}}
            <button class="hamburger" id="mobileMenuBtn" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>

{{-- Mobile Drawer --}}
<div class="mobile-overlay" id="mobileOverlay"></div>
<div class="mobile-drawer" id="mobileDrawer">
    <div class="mobile-drawer-header">
        <a href="{{ route('home') }}">
            <img src="https://saasspace.co/wp-content/uploads/2025/10/Frame-1321315704.webp" alt="SaaSSpace" height="36">
        </a>
        <button class="mobile-drawer-close" id="mobileDrawerClose" aria-label="Close menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- Mobile Search --}}
    <div class="mobile-search">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" placeholder="{{ __('app.search_placeholder') }}" autocomplete="off">
    </div>

    <nav class="mobile-nav">
        <a href="/#about">{{ __('app.nav_about') }}</a>
        <a href="/#services">{{ __('app.nav_services') }}</a>
        <a href="/#casestudies">{{ __('app.nav_case_studies') }}</a>
        <a href="/#testimonial">{{ __('app.nav_testimonials') }}</a>
        <a href="/#pricing">{{ __('app.nav_pricing') }}</a>
    </nav>

    <div class="mobile-lang">
        <a href="{{ route('lang.switch', 'ar') }}" class="mobile-lang-btn {{ app()->getLocale() === 'ar' ? 'active' : '' }}">🇸🇦 العربية</a>
        <a href="{{ route('lang.switch', 'en') }}" class="mobile-lang-btn {{ app()->getLocale() === 'en' ? 'active' : '' }}">🇺🇸 English</a>
    </div>

    @guest
    <div class="mobile-auth">
        <a href="{{ route('login') }}" class="mobile-btn-ghost">{{ __('auth.login') }}</a>
        <a href="{{ route('register') }}" class="mobile-btn-gold">{{ __('auth.register') }}</a>
    </div>
    @endguest
</div>

<style>
/* ===== BASE ===== */
.home-heading {
    position: fixed !important;
    top: 16px;
    left: 50%;
    transform: translateX(-50%) translateY(0%);
    width: 1600px;
    transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), background 0.3s ease, backdrop-filter 0.3s ease, border-radius 0.3s ease;
    background: transparent;
    border-radius: 0;
    z-index: 9999;
    padding: 10px 24px;
}
.header-visible {
    transform: translateX(-50%) translateY(0);
    background: rgba(10,22,40,0.75);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}
.header-hidden { transform: translateX(-50%) translateY(-130%); }
.e-con-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 16px; }
.header-logo img { height: 38px; width: auto; }
@media (max-width: 1600px) { .home-heading { width: calc(100% - 80px); } }
@media (max-width: 1024px) { .home-heading { width: calc(100% - 40px); top: 8px; } }
@media (max-width: 768px)  { .home-heading { width: calc(100% - 24px); top: 6px; padding: 8px 16px; } }
.hidden-tablet { display: flex !important; }
@media (max-width: 1150px) { .hidden-tablet { display: none !important; } }
.hidden-mobile  { display: flex; }
@media (max-width: 768px)  { .hidden-mobile  { display: none !important; } }

/* ===== NAV LINKS ===== */
.header-nav { display: flex; gap: 28px; align-items: center; }
.menu_flip_btn {
    position: relative; overflow: hidden; display: inline-block;
    color: rgba(255,255,255,0.8); font-size: 0.9rem; font-weight: 500;
    text-decoration: none; cursor: pointer; transition: color 0.3s;
}
.menu_flip_btn:hover { color: #ffd428; }
.menu_flip_btn .text-container { display: flex; flex-direction: column; height: 1.2em; overflow: hidden; }
.menu_flip_btn .text-container span { transition: transform 0.35s cubic-bezier(0.4,0,0.2,1); display: block; }
.menu_flip_btn:hover .text-container span { transform: translateY(-100%); }

/* ===== RIGHT SIDE ACTIONS ===== */
.header-actions { display: flex; align-items: center; gap: 10px; }

/* ===== SEARCH ===== */
.header-search { position: relative; display: flex; align-items: center; }
.search-icon-btn {
    width: 38px; height: 38px; border-radius: 50%;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.75);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.25s; flex-shrink: 0;
}
.search-icon-btn:hover { background: rgba(255,212,40,0.15); border-color: rgba(255,212,40,0.4); color: #ffd428; }
.search-expand {
    position: absolute; right: 0; top: 50%; transform: translateY(-50%);
    display: flex; align-items: center;
    background: rgba(10,22,40,0.85);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,212,40,0.35);
    border-radius: 50px;
    overflow: hidden;
    width: 0; opacity: 0; pointer-events: none;
    transition: width 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.3s ease;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}
.search-expand.open { width: 280px; opacity: 1; pointer-events: all; }
.search-input {
    flex: 1; background: transparent; border: none; outline: none;
    color: #fff; font-size: 0.875rem; padding: 10px 16px;
    caret-color: #ffd428;
}
.search-input::placeholder { color: rgba(255,255,255,0.4); }
.search-close {
    width: 36px; height: 36px; border-radius: 50%;
    background: transparent; border: none;
    color: rgba(255,255,255,0.5); cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    margin-right: 4px; transition: color 0.2s;
    flex-shrink: 0;
}
.search-close:hover { color: #ffd428; }

/* ===== LANGUAGE SWITCHER ===== */
.lang-switcher { position: relative; }
.lang-btn {
    display: flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 50px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.8); font-size: 0.82rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s; white-space: nowrap;
}
.lang-btn:hover { background: rgba(255,212,40,0.12); border-color: rgba(255,212,40,0.35); color: #ffd428; }
.lang-chevron { transition: transform 0.25s; }
.lang-switcher.open .lang-chevron { transform: rotate(180deg); }
.lang-dropdown {
    position: absolute; top: calc(100% + 10px);
    right: 0; min-width: 160px;
    background: rgba(10,22,40,0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 14px;
    padding: 6px;
    box-shadow: 0 16px 40px rgba(0,0,0,0.4);
    opacity: 0; transform: translateY(-8px) scale(0.97);
    pointer-events: none;
    transition: opacity 0.25s ease, transform 0.25s ease;
}
.lang-switcher.open .lang-dropdown { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
.lang-option {
    display: flex; align-items: center; gap: 10px;
    padding: 9px 14px; border-radius: 10px;
    color: rgba(255,255,255,0.75); font-size: 0.875rem; font-weight: 500;
    text-decoration: none; transition: all 0.2s; cursor: pointer;
}
.lang-option:hover { background: rgba(255,212,40,0.12); color: #ffd428; }
.lang-option.active { background: rgba(255,212,40,0.18); color: #ffd428; font-weight: 700; }
.lang-flag { font-size: 1.1rem; }

/* ===== AUTH BUTTONS ===== */
.auth-buttons { display: flex; align-items: center; gap: 8px; }
.btn-auth-ghost {
    padding: 8px 18px; border-radius: 50px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.22);
    color: rgba(255,255,255,0.85); font-size: 0.85rem; font-weight: 600;
    text-decoration: none; transition: all 0.25s; white-space: nowrap;
}
.btn-auth-ghost:hover { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.4); color: #fff; }
.btn-auth-gold {
    padding: 8px 20px; border-radius: 50px;
    background: #ffd428; color: #0D3334;
    border: none; font-size: 0.85rem; font-weight: 800;
    text-decoration: none; transition: all 0.25s; white-space: nowrap;
    box-shadow: 0 4px 16px rgba(255,212,40,0.35);
}
.btn-auth-gold:hover { background: #fff; transform: translateY(-2px) scale(1.04); box-shadow: 0 8px 24px rgba(255,212,40,0.4); }

/* ===== AUTH USER MENU ===== */
.auth-user-menu { position: relative; }
.user-avatar-btn {
    display: flex; align-items: center; gap: 8px;
    padding: 6px 14px 6px 6px; border-radius: 50px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.85); font-size: 0.85rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s;
}
.user-avatar-btn:hover { background: rgba(255,212,40,0.12); border-color: rgba(255,212,40,0.35); }
.user-avatar {
    width: 30px; height: 30px; border-radius: 50%;
    background: linear-gradient(135deg, #ffd428, #ff8c00);
    color: #0D3334; font-size: 0.8rem; font-weight: 900;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.user-name { font-size: 0.85rem; color: rgba(255,255,255,0.85); max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.user-dropdown {
    position: absolute; top: calc(100% + 10px);
    right: 0; min-width: 200px;
    background: rgba(10,22,40,0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 14px; padding: 6px;
    box-shadow: 0 16px 40px rgba(0,0,0,0.4);
    opacity: 0; transform: translateY(-8px) scale(0.97);
    pointer-events: none;
    transition: opacity 0.25s ease, transform 0.25s ease;
}
.auth-user-menu.open .user-dropdown { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
.user-option {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px; border-radius: 10px;
    color: rgba(255,255,255,0.75); font-size: 0.875rem; font-weight: 500;
    text-decoration: none; background: none; border: none; width: 100%;
    text-align: start; cursor: pointer; transition: all 0.2s;
}
.user-option:hover { background: rgba(255,212,40,0.12); color: #ffd428; }
.user-option-danger:hover { background: rgba(220,38,38,0.12); color: #ef4444; }
.user-divider { height: 1px; background: rgba(255,255,255,0.08); margin: 4px 0; }

/* ===== HAMBURGER ===== */
.hamburger {
    display: none; flex-direction: column; gap: 5px;
    width: 38px; height: 38px; padding: 8px;
    border-radius: 10px; cursor: pointer;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    transition: all 0.25s;
}
.hamburger span {
    display: block; width: 100%; height: 2px;
    background: rgba(255,255,255,0.85); border-radius: 2px;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
.hamburger:hover { background: rgba(255,212,40,0.12); border-color: rgba(255,212,40,0.35); }
@media (max-width: 1150px) { .hamburger { display: flex; } }

/* ===== MOBILE DRAWER ===== */
.mobile-overlay {
    position: fixed; inset: 0; z-index: 10000;
    background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);
    opacity: 0; pointer-events: none;
    transition: opacity 0.3s ease;
}
.mobile-overlay.open { opacity: 1; pointer-events: all; }
.mobile-drawer {
    position: fixed; top: 0; right: 0; bottom: 0;
    width: min(360px, 90vw); z-index: 10001;
    background: linear-gradient(160deg, #0a1628 0%, #0D3334 100%);
    border-left: 1px solid rgba(255,255,255,0.1);
    padding: 0; display: flex; flex-direction: column;
    transform: translateX(100%);
    transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
    overflow-y: auto;
}
.mobile-drawer.open { transform: translateX(0); }
.mobile-drawer-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.08);
}
.mobile-drawer-close {
    width: 36px; height: 36px; border-radius: 10px;
    background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
    color: rgba(255,255,255,0.75); cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
}
.mobile-drawer-close:hover { background: rgba(255,212,40,0.15); color: #ffd428; }
.mobile-search {
    display: flex; align-items: center; gap: 10px;
    margin: 16px 20px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 50px; padding: 10px 18px;
    transition: border-color 0.2s;
}
.mobile-search:focus-within { border-color: rgba(255,212,40,0.4); }
.mobile-search svg { color: rgba(255,255,255,0.4); flex-shrink: 0; }
.mobile-search input {
    flex: 1; background: transparent; border: none; outline: none;
    color: #fff; font-size: 0.9rem; caret-color: #ffd428;
}
.mobile-search input::placeholder { color: rgba(255,255,255,0.35); }
.mobile-nav { display: flex; flex-direction: column; padding: 8px 12px; gap: 2px; }
.mobile-nav a {
    padding: 13px 16px; border-radius: 12px;
    color: rgba(255,255,255,0.75); font-size: 0.95rem; font-weight: 500;
    text-decoration: none; transition: all 0.2s;
    display: flex; align-items: center;
}
.mobile-nav a:hover { background: rgba(255,212,40,0.1); color: #ffd428; padding-right: 22px; }
.mobile-lang {
    display: flex; gap: 8px; padding: 16px 20px;
    border-top: 1px solid rgba(255,255,255,0.08);
}
.mobile-lang-btn {
    flex: 1; padding: 10px; border-radius: 12px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.12);
    color: rgba(255,255,255,0.7); font-size: 0.85rem; font-weight: 600;
    text-decoration: none; text-align: center; transition: all 0.2s;
}
.mobile-lang-btn:hover,
.mobile-lang-btn.active { background: rgba(255,212,40,0.15); border-color: rgba(255,212,40,0.35); color: #ffd428; }
.mobile-auth {
    display: flex; flex-direction: column; gap: 10px;
    padding: 16px 20px 24px;
}
.mobile-btn-ghost {
    padding: 12px; border-radius: 50px; text-align: center;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.22);
    color: rgba(255,255,255,0.85); font-size: 0.9rem; font-weight: 600;
    text-decoration: none; transition: all 0.25s;
}
.mobile-btn-ghost:hover { background: rgba(255,255,255,0.12); }
.mobile-btn-gold {
    padding: 12px; border-radius: 50px; text-align: center;
    background: #ffd428; color: #0D3334;
    font-size: 0.9rem; font-weight: 800;
    text-decoration: none; transition: all 0.25s;
    box-shadow: 0 4px 16px rgba(255,212,40,0.35);
}
.mobile-btn-gold:hover { background: #fff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Scroll behaviour ── */
    const header = document.querySelector('.home-heading');
    let lastScrollTop = 0;
    window.addEventListener('scroll', () => {
        const st = window.pageYOffset || document.documentElement.scrollTop;
        if (st <= 5) {
            header.classList.remove('header-visible', 'header-hidden');
        } else if (st > lastScrollTop && st > 150) {
            header.classList.remove('header-visible');
            header.classList.add('header-hidden');
        } else if (st < lastScrollTop) {
            header.classList.remove('header-hidden');
            header.classList.add('header-visible');
        }
        lastScrollTop = st <= 0 ? 0 : st;
    }, { passive: true });

    /* ── Search toggle ── */
    const searchToggle  = document.getElementById('searchToggle');
    const searchExpand  = document.getElementById('searchExpand');
    const searchClose   = document.getElementById('searchClose');
    const searchInput   = document.getElementById('searchInput');
    searchToggle.addEventListener('click', () => {
        searchExpand.classList.toggle('open');
        if (searchExpand.classList.contains('open')) searchInput.focus();
    });
    searchClose.addEventListener('click', () => {
        searchExpand.classList.remove('open');
        searchInput.value = '';
    });
    document.addEventListener('click', e => {
        if (!document.getElementById('headerSearch').contains(e.target))
            searchExpand.classList.remove('open');
    });

    /* ── Language dropdown ── */
    const langSwitcher = document.getElementById('langSwitcher');
    document.getElementById('langToggle').addEventListener('click', e => {
        e.stopPropagation();
        langSwitcher.classList.toggle('open');
        if (userMenuEl) userMenuEl.classList.remove('open');
    });

    /* ── User menu dropdown ── */
    const userMenuEl = document.getElementById('authUserMenu');
    const userMenuToggle = document.getElementById('userMenuToggle');
    if (userMenuToggle) {
        userMenuToggle.addEventListener('click', e => {
            e.stopPropagation();
            userMenuEl.classList.toggle('open');
            langSwitcher.classList.remove('open');
        });
    }

    /* Close all dropdowns on outside click */
    document.addEventListener('click', () => {
        langSwitcher.classList.remove('open');
        if (userMenuEl) userMenuEl.classList.remove('open');
    });

    /* ── Mobile drawer ── */
    const drawer  = document.getElementById('mobileDrawer');
    const overlay = document.getElementById('mobileOverlay');
    const burgerBtn = document.getElementById('mobileMenuBtn');
    const closeBtn  = document.getElementById('mobileDrawerClose');

    function openDrawer()  { drawer.classList.add('open'); overlay.classList.add('open'); burgerBtn.classList.add('open'); document.body.style.overflow = 'hidden'; }
    function closeDrawer() { drawer.classList.remove('open'); overlay.classList.remove('open'); burgerBtn.classList.remove('open'); document.body.style.overflow = ''; }

    burgerBtn.addEventListener('click', openDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);
});
</script>
