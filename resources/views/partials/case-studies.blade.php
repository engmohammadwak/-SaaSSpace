<section class="casestudies-section" id="casestudies">
    <div class="casestudies-inner">
        <h2 class="section-title">Case <span class="highlight">Studies</span></h2>
        <div class="projects-grid">
            @forelse($projects as $project)
            <div class="project-card">
                <a href="{{ $project->url ?? '#' }}" target="_blank" rel="noopener noreferrer">
                    <div class="project-image">
                        <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" loading="lazy">
                    </div>
                    <div class="project-info">
                        <span class="project-category">{{ $project->category }}</span>
                        <h3>{{ $project->title }}</h3>
                        @if($project->description)
                        <p>{{ $project->description }}</p>
                        @endif
                    </div>
                </a>
            </div>
            @empty
            <p>No projects found.</p>
            @endforelse
        </div>
    </div>
</section>
