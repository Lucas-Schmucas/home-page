<x-layouts.page>
    {{-- Page Header --}}
    <div class="mb-16">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">About Me</h1>
        <p class="text-xl text-gray-300 leading-relaxed">
            I'm a full-stack developer with a passion for building elegant solutions to complex problems. <br>
            Here's a bit about my journey.
        </p>
    </div>

    {{-- Work Experience Section --}}
        <section class="mb-20">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-3xl font-bold text-white">Work Experience</h2>
                @auth
                    <a href="{{ route('work-experience.create') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Add Experience</span>
                    </a>
                @endauth
            </div>

            <div class="space-y-12">
                @foreach ($workExperience as $work)
                    <div class="flex gap-6" wire:key="work-{{ $work->id }}">
                        {{-- Company Logo/Image --}}
                        <div class="flex-shrink-0">
                            @if ($work->image_url)
                                <img src="{{ $work->image_url }}" alt="{{ $work->company_name }}" class="w-16 h-16 rounded-xl object-cover">
                            @else
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-{{ $work->color ?? 'blue' }}-500 to-{{ $work->color ?? 'blue' }}-700 flex items-center justify-center text-white font-bold text-2xl">
                                    {{ substr($work->company_name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <div class="mb-2">
                                <h3 class="text-xl font-bold text-white">{{ $work->job_title }}</h3>
                                <p class="text-gray-400">
                                    {{ $work->company_name }} •
                                    {{ $work->start_date->format('M Y') }} - {{ $work->end_date ? $work->end_date->format('M Y') : 'Present' }}
                                </p>
                            </div>
                            <p class="text-gray-300 leading-relaxed mb-3">
                                {{ $work->description }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($work->technologies as $tech)
                                    <span class="px-3 py-1 rounded-lg text-sm font-medium border"
                                          style="background-color: {{ $tech->color() }}20; color: {{ $tech->color() }}; border-color: {{ $tech->color() }}50;">
                                        {{ $tech->value }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
</x-layouts.page>
