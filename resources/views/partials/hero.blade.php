<section class="hero-section" id="hero">
    <div class="hero-inner">
        <div class="hero-content">
            {{-- Badge --}}
            <a class="hero-badge" role="button">
                <span class="badge-dot"></span>
                <span>{{ $hero->badge_text ?? 'Available for New Projects' }}</span>
            </a>

            {{-- Animated Headline --}}
            <h1 class="hero-title">
                {{ $hero->main_title ?? 'We Craft High-Impact Designs for' }}
                <span class="hero-rotating" id="rotatingText"></span>
            </h1>

            {{-- Description --}}
            <p class="hero-description">{{ $hero->description }}</p>

            {{-- CTAs --}}
            <div class="hero-ctas">
                <a href="{{ $hero->primary_btn_url }}" class="flip-button" target="_blank" rel="noopener noreferrer">
                    <div class="text-container">
                        <span>{{ $hero->primary_btn_text }}</span>
                        <span>{{ $hero->primary_btn_text }}</span>
                    </div>
                </a>
                <a href="{{ $hero->secondary_btn_url }}" class="aae-flip-btn" target="_blank" rel="noopener noreferrer">
                    <div class="text-container">
                        <span>{{ $hero->secondary_btn_text }}</span>
                        <span>{{ $hero->secondary_btn_text }}</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Rotating text JS --}}
    @push('scripts')
    <script>
    (function() {
        const texts = @json($hero->rotating_texts ?? []);
        const el = document.getElementById('rotatingText');
        if (!el || !texts.length) return;
        let i = 0;
        el.textContent = texts[0];
        setInterval(() => {
            el.style.opacity = 0;
            setTimeout(() => {
                i = (i + 1) % texts.length;
                el.textContent = texts[i];
                el.style.opacity = 1;
            }, 300);
        }, 2000);
        el.style.transition = 'opacity 0.3s ease';
    })();
    </script>
    @endpush
</section>
