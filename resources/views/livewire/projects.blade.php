<div>
    <x-navigation />

    <div class="max-w-6xl mx-auto px-6 py-20 pt-32">
        {{-- Page Header --}}
        <div class="mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Projects</h1>
            <p class="text-xl text-gray-300 leading-relaxed">
                A collection of projects I've been working on, from side projects to open-source contributions.
            </p>
        </div>

        @if($projects->isEmpty())
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="text-gray-400 text-lg">
                    <p class="mb-4">No projects yet.</p>
                    <p class="text-sm">Check back soon for updates!</p>
                </div>
            </div>
        @else
            {{-- Projects Grid --}}
            <div class="grid md:grid-cols-2 gap-8">
                @foreach ($projects as $project)
                    <div class="bg-gradient-to-br from-gray-800/50 to-gray-900/50 rounded-2xl p-8 border border-white/10 hover:border-white/20 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10" wire:key="project-{{ $project->id }}">
                        {{-- Project Header --}}
                        <div class="mb-6">
                            <div class="flex items-start justify-between mb-3">
                                <h2 class="text-2xl font-bold text-white">{{ $project->name }}</h2>
                            </div>

                            <p class="text-gray-300 leading-relaxed">
                                {{ $project->description }}
                            </p>
                        </div>

                        {{-- Technologies --}}
                        @if($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-6">
                                @foreach ($project->technologies as $tech)
                                    <span class="px-3 py-1 text-xs font-medium bg-gray-700/50 text-gray-300 rounded-lg border border-gray-600/50">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Project Links --}}
                        <div class="flex items-center gap-4 pt-4 border-t border-gray-700/50">
                            @if($project->url)
                                <a href="{{ $project->url }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 transition-colors font-medium group">
                                    <span>View Project</span>
                                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </a>
                            @endif

                            @if($project->github_url)
                                <a href="{{ $project->github_url }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                    <span>GitHub</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
