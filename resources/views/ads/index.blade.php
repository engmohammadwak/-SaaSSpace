@extends('layouts.app')

@section('title', __('app.ads_page_title'))

@section('content')

{{-- Hero Banner --}}
<section class="ads-hero">
    <div class="ads-hero-bg"></div>
    <div class="ads-hero-content">
        <p class="ads-hero-label">{{ __('app.ads_label') }}</p>
        <h1 class="ads-hero-title">{{ __('app.ads_title') }}</h1>
        <p class="ads-hero-sub">{{ __('app.ads_subtitle') }}</p>

        {{-- Search Bar --}}
        <form method="GET" action="{{ route('ads.index') }}" class="ads-search-form" id="adsSearchForm">
            <div class="ads-search-bar">
                <svg class="ads-search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input
                    type="text"
                    name="search"
                    class="ads-search-input"
                    value="{{ $search }}"
                    placeholder="{{ __('app.ads_search_placeholder') }}"
                    autocomplete="off"
                    id="adsSearchInput"
                >
                @if(!empty($search))
                <a href="{{ route('ads.index') }}" class="ads-search-clear" title="{{ __('app.clear_search') }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </a>
                @endif
                <button type="submit" class="ads-search-btn">{{ __('app.search') }}</button>
            </div>
        </form>
    </div>
</section>

<div class="ads-page-wrapper">

    @if($ads->count() > 0)

    {{-- Results count --}}
    <div class="ads-results-header">
        <p class="ads-results-count">
            @if(!empty($search))
                {!! __('app.ads_found_count', ['count' => '<span class="count-highlight">' . $ads->total() . '</span>', 'query' => '<span class="query-highlight">"' . e($search) . '"</span>']) !!}
            @else
                {!! __('app.ads_total_count', ['count' => '<span class="count-highlight">' . $ads->total() . '</span>']) !!}
            @endif
        </p>
    </div>

    {{-- Ads Grid --}}
    <div class="ads-grid">
        @foreach($ads as $ad)
        <div class="ad-card wow fadeInUp" data-wow-delay="{{ $loop->index * 0.07 }}s">
            @if(!empty($ad->image))
            <div class="ad-card-img">
                <img src="{{ Storage::url($ad->image) }}" alt="{{ $ad->title }}" loading="lazy">
                @if(!empty($ad->category))
                <span class="ad-card-badge">{{ $ad->category }}</span>
                @endif
            </div>
            @endif
            <div class="ad-card-body">
                <h3 class="ad-card-title">{{ $ad->title }}</h3>
                @if(!empty($ad->description))
                <p class="ad-card-desc">{{ Str::limit($ad->description, 90) }}</p>
                @endif
                <div class="ad-card-footer">
                    @if(!empty($ad->price))
                    <span class="ad-card-price">{{ number_format($ad->price) }} {{ __('app.currency') }}</span>
                    @endif
                    <a href="{{ route('ads.show', $ad->id) }}" class="ad-card-btn">
                        {{ __('app.view_ad') }}
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    @if($ads->hasPages())
    <div class="ads-pagination">
        {{ $ads->links('vendor.pagination.custom') }}
    </div>
    @endif

    @else

    {{-- ===== EMPTY STATE ===== --}}
    <div class="ads-empty wow fadeInUp">

        {{-- Animated illustration --}}
        <div class="ads-empty-illustration">
            <div class="empty-orb empty-orb-1"></div>
            <div class="empty-orb empty-orb-2"></div>
            <div class="empty-icon-wrap">
                <svg class="empty-main-icon" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="38" stroke="rgba(255,212,40,0.2)" stroke-width="2" stroke-dasharray="6 4"/>
                    <circle cx="36" cy="34" r="14" stroke="rgba(255,212,40,0.7)" stroke-width="3"/>
                    <path d="M46 44 L58 56" stroke="rgba(255,212,40,0.7)" stroke-width="3" stroke-linecap="round"/>
                    <path d="M30 34 L36 40 L44 30" stroke="rgba(255,212,40,0.4)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" opacity="0"/>
                    <line x1="26" y1="34" x2="30" y2="34" stroke="rgba(255,212,40,0.5)" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="40" y1="22" x2="40" y2="26" stroke="rgba(255,212,40,0.5)" stroke-width="2.5" stroke-linecap="round"/>
                    <line x1="26" y1="26" x2="29" y2="29" stroke="rgba(255,212,40,0.4)" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </div>
        </div>

        {{-- Message --}}
        <div class="ads-empty-message">
            <h2 class="ads-empty-title">{{ __('app.no_ads_found_title') }}</h2>
            <p class="ads-empty-desc">
                {!! __('app.no_ads_found_desc', ['query' => '<span class="query-highlight">"' . e($search) . '"</span>']) !!}
            </p>
        </div>

        {{-- Tips --}}
        <div class="ads-empty-tips">
            <div class="empty-tip">
                <div class="empty-tip-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/></svg></div>
                <span>{{ __('app.empty_tip_1') }}</span>
            </div>
            <div class="empty-tip">
                <div class="empty-tip-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
                <span>{{ __('app.empty_tip_2') }}</span>
            </div>
            <div class="empty-tip">
                <div class="empty-tip-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/><line x1="4" y1="22" x2="4" y2="15"/></svg></div>
                <span>{{ __('app.empty_tip_3') }}</span>
            </div>
        </div>

        {{-- CTA --}}
        <a href="{{ route('ads.index') }}" class="ads-empty-cta">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
            {{ __('app.browse_all_ads') }}
        </a>
    </div>

    {{-- ===== SUGGESTIONS ===== --}}
    @if($suggestions->count() > 0)
    <div class="ads-suggestions wow fadeInUp" data-wow-delay="0.2s">
        <div class="suggestions-header">
            <p class="suggestions-label">{{ __('app.suggestions_label') }}</p>
            <h3 class="suggestions-title">{{ __('app.suggestions_title') }}</h3>
        </div>

        <div class="suggestions-grid">
            @foreach($suggestions as $ad)
            <a href="{{ route('ads.show', $ad->id) }}" class="suggestion-card">
                @if(!empty($ad->image))
                <div class="suggestion-img">
                    <img src="{{ Storage::url($ad->image) }}" alt="{{ $ad->title }}" loading="lazy">
                </div>
                @else
                <div class="suggestion-img suggestion-img-placeholder">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15 16 10 5 21"/></svg>
                </div>
                @endif
                <div class="suggestion-body">
                    <p class="suggestion-category">{{ $ad->category ?? __('app.general') }}</p>
                    <h4 class="suggestion-title">{{ Str::limit($ad->title, 50) }}</h4>
                    @if(!empty($ad->price))
                    <span class="suggestion-price">{{ number_format($ad->price) }} {{ __('app.currency') }}</span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        <div class="suggestions-footer">
            <a href="{{ route('ads.index') }}" class="suggestions-all-btn">
                {{ __('app.see_all_ads') }}
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
    @endif

    @endif

</div>

<style>
/* ===== PAGE WRAPPER ===== */
.ads-page-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    padding: 48px 24px 80px;
}

/* ===== HERO ===== */
.ads-hero {
    position: relative;
    background: linear-gradient(135deg, #0a1628 0%, #0D3334 40%, #1a5c5e 70%, #0a2a1a 100%);
    padding: 100px 24px 70px;
    text-align: center;
    overflow: hidden;
}
.ads-hero-bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 70% 50%, rgba(255,212,40,0.07) 0%, transparent 60%),
                radial-gradient(ellipse at 20% 80%, rgba(26,92,94,0.5) 0%, transparent 50%);
    pointer-events: none;
}
.ads-hero-content { position: relative; z-index: 1; max-width: 680px; margin: 0 auto; }
.ads-hero-label {
    display: inline-block;
    color: #ffd428; font-size: 0.8rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    margin-bottom: 12px;
}
.ads-hero-title {
    color: #fff; font-size: clamp(1.8rem, 4vw, 3rem);
    font-weight: 900; margin-bottom: 12px; line-height: 1.15;
}
.ads-hero-sub {
    color: rgba(255,255,255,0.6); font-size: 1rem;
    margin-bottom: 32px;
}

/* ===== SEARCH FORM ===== */
.ads-search-form { width: 100%; }
.ads-search-bar {
    display: flex; align-items: center;
    max-width: 600px; margin: 0 auto;
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,212,40,0.3);
    border-radius: 50px;
    padding: 6px 6px 6px 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
    transition: border-color 0.3s, box-shadow 0.3s;
}
.ads-search-bar:focus-within {
    border-color: rgba(255,212,40,0.7);
    box-shadow: 0 8px 32px rgba(255,212,40,0.15);
}
.ads-search-icon { color: rgba(255,212,40,0.7); flex-shrink: 0; }
.ads-search-input {
    flex: 1; background: transparent; border: none; outline: none;
    color: #fff; font-size: 1rem; padding: 8px 12px;
    caret-color: #ffd428;
}
.ads-search-input::placeholder { color: rgba(255,255,255,0.35); }
.ads-search-clear {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.4); transition: color 0.2s;
    text-decoration: none;
}
.ads-search-clear:hover { color: #ffd428; }
.ads-search-btn {
    padding: 10px 28px; border-radius: 50px;
    background: #ffd428; color: #0D3334;
    font-weight: 800; font-size: 0.9rem;
    border: none; cursor: pointer;
    transition: all 0.25s;
    white-space: nowrap;
    box-shadow: 0 4px 16px rgba(255,212,40,0.3);
}
.ads-search-btn:hover { background: #fff; transform: scale(1.04); }

/* ===== RESULTS HEADER ===== */
.ads-results-header { margin-bottom: 28px; }
.ads-results-count { color: rgba(255,255,255,0.6); font-size: 0.95rem; }
.count-highlight { color: #ffd428; font-weight: 700; font-size: 1.1rem; }
.query-highlight { color: #ffd428; font-weight: 600; }

/* ===== ADS GRID ===== */
.ads-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(min(300px, 100%), 1fr));
    gap: 24px;
    margin-bottom: 48px;
}
.ad-card {
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.ad-card:hover {
    border-color: rgba(255,212,40,0.4);
    box-shadow: 0 20px 50px rgba(255,212,40,0.1);
    transform: translateY(-4px);
}
.ad-card-img { position: relative; aspect-ratio: 16/10; overflow: hidden; }
.ad-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.ad-card:hover .ad-card-img img { transform: scale(1.05); }
.ad-card-badge {
    position: absolute; top: 12px; right: 12px;
    background: rgba(255,212,40,0.9); color: #0D3334;
    font-size: 0.75rem; font-weight: 700;
    padding: 4px 12px; border-radius: 50px;
}
.ad-card-body { padding: 20px; }
.ad-card-title { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: 8px; line-height: 1.4; }
.ad-card-desc { color: rgba(255,255,255,0.55); font-size: 0.875rem; line-height: 1.6; margin-bottom: 16px; }
.ad-card-footer { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
.ad-card-price { color: #ffd428; font-weight: 800; font-size: 1rem; }
.ad-card-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: 50px;
    background: rgba(255,212,40,0.12);
    border: 1px solid rgba(255,212,40,0.3);
    color: #ffd428; font-size: 0.8rem; font-weight: 700;
    text-decoration: none; transition: all 0.25s; white-space: nowrap;
    margin-inline-start: auto;
}
.ad-card-btn:hover { background: #ffd428; color: #0D3334; }

/* ===== PAGINATION ===== */
.ads-pagination { display: flex; justify-content: center; margin-top: 40px; }

/* ===== EMPTY STATE ===== */
.ads-empty {
    text-align: center;
    padding: 60px 20px 40px;
}
.ads-empty-illustration {
    position: relative;
    width: 140px; height: 140px;
    margin: 0 auto 32px;
    display: flex; align-items: center; justify-content: center;
}
.empty-orb {
    position: absolute; border-radius: 50%;
    animation: pulse-glow 3s ease-in-out infinite;
}
.empty-orb-1 {
    width: 140px; height: 140px;
    background: radial-gradient(circle, rgba(255,212,40,0.08) 0%, transparent 70%);
    animation-delay: 0s;
}
.empty-orb-2 {
    width: 100px; height: 100px;
    background: radial-gradient(circle, rgba(13,51,52,0.6) 0%, transparent 70%);
    animation-delay: 1s;
}
.empty-icon-wrap {
    position: relative; z-index: 1;
    width: 80px; height: 80px;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,212,40,0.25);
    border-radius: 50%;
    animation: float3d 4s ease-in-out infinite;
}
.empty-main-icon { width: 56px; height: 56px; }
.ads-empty-message { margin-bottom: 28px; }
.ads-empty-title {
    color: #fff; font-size: clamp(1.3rem, 3vw, 1.8rem);
    font-weight: 900; margin-bottom: 12px;
}
.ads-empty-desc {
    color: rgba(255,255,255,0.55);
    font-size: 0.95rem; line-height: 1.7;
    max-width: 480px; margin: 0 auto;
}

/* Tips row */
.ads-empty-tips {
    display: flex; flex-wrap: wrap; justify-content: center;
    gap: 12px; margin-bottom: 32px;
}
.empty-tip {
    display: flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50px;
    padding: 8px 16px;
    color: rgba(255,255,255,0.6); font-size: 0.82rem;
}
.empty-tip-icon {
    width: 28px; height: 28px; border-radius: 50%;
    background: rgba(255,212,40,0.1);
    border: 1px solid rgba(255,212,40,0.25);
    color: #ffd428;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.ads-empty-cta {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 36px; border-radius: 50px;
    background: #ffd428; color: #0D3334;
    font-weight: 800; font-size: 0.95rem;
    text-decoration: none; transition: all 0.3s;
    box-shadow: 0 8px 25px rgba(255,212,40,0.35);
}
.ads-empty-cta:hover { background: #fff; transform: translateY(-3px) scale(1.05); }

/* ===== SUGGESTIONS ===== */
.ads-suggestions { margin-top: 72px; }
.suggestions-header { text-align: center; margin-bottom: 36px; }
.suggestions-label {
    color: #ffd428; font-size: 0.8rem; font-weight: 700;
    letter-spacing: 3px; text-transform: uppercase;
    margin-bottom: 8px;
}
.suggestions-title {
    color: #fff; font-size: clamp(1.3rem, 3vw, 1.8rem);
    font-weight: 900;
    position: relative; display: inline-block;
}
.suggestions-title::after {
    content: ''; position: absolute;
    bottom: -8px; right: 0;
    width: 60%; height: 3px;
    background: linear-gradient(90deg, #ffd428, transparent);
    border-radius: 2px;
}
.suggestions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(min(260px, 100%), 1fr));
    gap: 20px;
    margin-bottom: 36px;
}
.suggestion-card {
    display: flex; flex-direction: column;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 16px; overflow: hidden;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
}
.suggestion-card:hover {
    border-color: rgba(255,212,40,0.35);
    box-shadow: 0 12px 36px rgba(255,212,40,0.1);
    transform: translateY(-4px);
}
.suggestion-img { aspect-ratio: 16/10; overflow: hidden; }
.suggestion-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
.suggestion-card:hover .suggestion-img img { transform: scale(1.05); }
.suggestion-img-placeholder {
    background: rgba(13,51,52,0.5);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.2);
}
.suggestion-body { padding: 16px; }
.suggestion-category {
    color: #ffd428; font-size: 0.75rem; font-weight: 700;
    letter-spacing: 1.5px; text-transform: uppercase;
    margin-bottom: 6px;
}
.suggestion-title {
    color: rgba(255,255,255,0.85); font-size: 0.9rem;
    font-weight: 600; line-height: 1.4; margin-bottom: 8px;
}
.suggestion-price { color: rgba(255,255,255,0.5); font-size: 0.82rem; }
.suggestions-footer { text-align: center; }
.suggestions-all-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 32px; border-radius: 50px;
    background: rgba(255,212,40,0.1);
    border: 1px solid rgba(255,212,40,0.3);
    color: #ffd428; font-weight: 700; font-size: 0.9rem;
    text-decoration: none; transition: all 0.25s;
}
.suggestions-all-btn:hover { background: #ffd428; color: #0D3334; }

/* ===== KEYFRAMES ===== */
@keyframes float3d {
    0%   { transform: translateY(0) rotateY(-5deg) rotateX(3deg); }
    50%  { transform: translateY(-10px) rotateY(5deg) rotateX(-3deg); }
    100% { transform: translateY(0) rotateY(-5deg) rotateX(3deg); }
}
@keyframes pulse-glow {
    0%,100% { transform: scale(1); opacity: 0.7; }
    50%      { transform: scale(1.15); opacity: 1; }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .ads-hero { padding: 80px 16px 50px; }
    .ads-page-wrapper { padding: 32px 16px 60px; }
    .ads-empty-tips { flex-direction: column; align-items: center; }
    .suggestions-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 480px) {
    .suggestions-grid { grid-template-columns: 1fr; }
    .ads-search-btn { padding: 10px 18px; font-size: 0.8rem; }
}
</style>

@endsection
