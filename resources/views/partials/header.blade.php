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
                <div class="text-container"><span>About</span><span>About</span></div>
            </a>
            <a href="/#services" class="menu_flip_btn">
                <div class="text-container"><span>Services</span><span>Services</span></div>
            </a>
            <a href="/#casestudies" class="menu_flip_btn">
                <div class="text-container"><span>Case Studies</span><span>Case Studies</span></div>
            </a>
            <a href="/#testimonial" class="menu_flip_btn">
                <div class="text-container"><span>Testimonials</span><span>Testimonials</span></div>
            </a>
            <a href="/#pricing" class="menu_flip_btn">
                <div class="text-container"><span>Pricing</span><span>Pricing</span></div>
            </a>
        </nav>

        {{-- CTA Button --}}
        <div class="header-cta">
            <a href="{{ $settings['calendly_url'] ?? '#' }}" class="flip-button" target="_blank" rel="noopener noreferrer">
                <div class="text-container">
                    <span>Contact us</span>
                    <span>Contact us</span>
                </div>
            </a>
        </div>
    </div>
</header>

<style>
.home-heading {
    position: fixed !important;
    top: 16px;
    left: 50%;
    transform: translateX(-50%) translateY(0%);
    width: 1600px;
    transition: transform 0.3s cubic-bezier(0.4,0,0.2,1), background-color 0.3s ease, backdrop-filter 0.3s ease, border-radius 0.3s ease;
    background: transparent;
    border-radius: 0;
    z-index: 9999;
    padding: 12px 24px;
}
.header-visible {
    transform: translateX(-50%) translateY(0);
    background: rgba(0,0,0,0.05);
    backdrop-filter: blur(8.5px);
    border-radius: 20px;
}
.header-hidden { transform: translateX(-50%) translateY(-100%); }
.e-con-inner { display: flex; align-items: center; justify-content: space-between; width: 100%; }
.header-logo img { height: 40px; width: auto; }
.header-nav { display: flex; gap: 32px; align-items: center; }
@media (max-width: 1600px) { .home-heading { width: calc(100% - 100px); } }
@media (max-width: 1024px) { .home-heading { width: calc(100% - 60px); top: 8px; border-radius: 16px; } }
@media (max-width: 768px) { .home-heading { width: calc(100% - 30px); top: 4px; border-radius: 12px; } }
.hidden-mobile, .hidden-tablet { display: flex; }
@media (max-width: 1150px) { .hidden-tablet { display: none !important; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.home-heading');
    if (!header) return;
    let lastScrollTop = 0;
    const topThreshold = 5;
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop <= topThreshold) {
            header.classList.remove('header-visible', 'header-hidden');
        } else if (scrollTop > lastScrollTop && scrollTop > 150) {
            header.classList.remove('header-visible');
            header.classList.add('header-hidden');
        } else if (scrollTop < lastScrollTop) {
            header.classList.remove('header-hidden');
            header.classList.add('header-visible');
        }
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }, { passive: true });
});
</script>
