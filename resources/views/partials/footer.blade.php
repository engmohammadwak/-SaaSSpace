<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-logo">
            @if(!empty($settings['logo'] ?? null))
                <img src="{{ Storage::url($settings['logo']) }}" alt="{{ $settings['site_name'] ?? 'SaaSSpace' }}" height="40">
            @else
                <img src="https://saasspace.co/wp-content/uploads/2025/10/Frame-1321315704.webp" alt="SaaSSpace" height="40">
            @endif
        </div>

        <div class="footer-links">
            <a href="/#about">About</a>
            <a href="/#services">Services</a>
            <a href="/#casestudies">Case Studies</a>
            <a href="/#testimonial">Testimonials</a>
            <a href="/#pricing">Pricing</a>
        </div>

        <div class="footer-social">
            @if(!empty($settings['behance_url']))
            <a href="{{ $settings['behance_url'] }}" target="_blank" rel="noopener">Behance</a>
            @endif
            @if(!empty($settings['instagram_url']))
            <a href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener">Instagram</a>
            @endif
            @if(!empty($settings['dribbble_url']))
            <a href="{{ $settings['dribbble_url'] }}" target="_blank" rel="noopener">Dribbble</a>
            @endif
        </div>

        <p class="footer-copy">{{ $settings['footer_text'] ?? '© 2025 SaaSSpace. All rights reserved.' }}</p>
    </div>
</footer>
