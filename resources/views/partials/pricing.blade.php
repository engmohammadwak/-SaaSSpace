<section class="pricing-section" id="pricing">
    <div class="pricing-inner">
        <h2 class="section-title">Simple <span class="highlight">Pricing</span></h2>
        <div class="pricing-grid">
            @forelse($pricingPlans as $plan)
            <div class="pricing-card {{ $plan->is_featured ? 'featured' : '' }}">
                @if($plan->is_featured)
                <span class="featured-badge">Most Popular</span>
                @endif
                <div class="plan-header">
                    <h3>{{ $plan->name }}</h3>
                    <div class="plan-price">
                        <span class="amount">${{ number_format($plan->price, 0) }}</span>
                        <span class="period">/{{ $plan->billing_period }}</span>
                    </div>
                </div>
                <ul class="plan-features">
                    @foreach($plan->features as $feature)
                    <li>✓ {{ $feature }}</li>
                    @endforeach
                </ul>
                <a href="{{ $plan->btn_url }}" class="flip-button" target="_blank">
                    <div class="text-container">
                        <span>{{ $plan->btn_text }}</span>
                        <span>{{ $plan->btn_text }}</span>
                    </div>
                </a>
            </div>
            @empty
            <p>No pricing plans yet.</p>
            @endforelse
        </div>
    </div>
</section>
