<section class="testimonials-section" id="testimonial">
    <div class="testimonials-inner">
        <h2 class="section-title">What Our <span class="highlight">Clients</span> Say</h2>
        <div class="testimonials-grid">
            @forelse($testimonials as $testimonial)
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= $testimonial->rating ? 'filled' : '' }}">★</span>
                    @endfor
                </div>
                <p class="testimonial-content">"{{ $testimonial->content }}"</p>
                <div class="testimonial-author">
                    @if($testimonial->client_avatar)
                    <img src="{{ Storage::url($testimonial->client_avatar) }}" alt="{{ $testimonial->client_name }}" class="author-avatar">
                    @endif
                    <div>
                        <strong>{{ $testimonial->client_name }}</strong>
                        <span>{{ $testimonial->client_title }}</span>
                    </div>
                </div>
            </div>
            @empty
            <p>No testimonials yet.</p>
            @endforelse
        </div>
    </div>
</section>
