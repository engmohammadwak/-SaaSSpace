<section class="clients-section" id="clients">
    <div class="clients-inner">
        <h2 class="section-title">Trusted by <span class="highlight">50+</span> SaaS Startups</h2>
        <div class="clients-swiper swiper" id="clientsSwiper">
            <div class="swiper-wrapper">
                @forelse($clients as $client)
                <div class="swiper-slide">
                    <figure>
                        <img
                            src="{{ Storage::url($client->logo) }}"
                            alt="{{ $client->name }}"
                            loading="lazy"
                        >
                    </figure>
                </div>
                @empty
                <p style="text-align:center; color:#888;">No clients yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Swiper !== 'undefined') {
        new Swiper('#clientsSwiper', {
            slidesPerView: 7,
            loop: true,
            autoplay: { delay: 0, disableOnInteraction: false },
            speed: 5000,
            breakpoints: {
                320:  { slidesPerView: 3 },
                768:  { slidesPerView: 5 },
                1024: { slidesPerView: 7 },
            }
        });
    }
});
</script>
@endpush
