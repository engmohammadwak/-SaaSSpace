<section class="services-section" id="services">
    <div class="services-inner">
        <h2 class="section-title">Our <span class="highlight">Services</span></h2>
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card">
                @if($service->icon)
                <div class="service-icon">
                    <img src="{{ Storage::url($service->icon) }}" alt="{{ $service->title }}">
                </div>
                @endif
                <h3>{{ $service->title }}</h3>
                <p>{{ $service->description }}</p>
            </div>
            @empty
            <p>No services found.</p>
            @endforelse
        </div>
    </div>
</section>
