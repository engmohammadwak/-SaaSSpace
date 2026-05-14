<section class="about-section" id="about">
    <div class="about-inner">
        @php
            $videoPath = $settings['about_video'] ?? null;
        @endphp
        @if($videoPath)
            <video
                class="about-video"
                src="{{ Storage::url($videoPath) }}"
                autoplay loop muted playsinline
                controlslist="nodownload">
            </video>
        @else
            <video
                class="about-video"
                src="/wp-content/uploads/2025/12/Showreel.mp4"
                autoplay loop muted playsinline
                controlslist="nodownload">
            </video>
        @endif
    </div>
</section>
