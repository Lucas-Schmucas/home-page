<div>
    <x-navigation />

    <div class="max-w-4xl mx-auto px-6 py-20 pt-32">
        {{-- Page Header --}}
        <div class="mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">About Me</h1>
            <p class="text-xl text-gray-300 leading-relaxed">
                I'm a full-stack developer with a passion for building elegant solutions to complex problems.
                Here's a bit about my journey.
            </p>
        </div>

        {{-- Work Experience Section --}}
        <section class="mb-20">
            <h2 class="text-3xl font-bold text-white mb-12">Work Experience</h2>

            <div class="space-y-12">
                @foreach ($workExperience as $work)
                    <div class="flex gap-6" wire:key="work-{{ $work->id }}">
                        {{-- Company Logo/Image --}}
                        <div class="flex-shrink-0">
                            @if ($work->image)
                                <img src="{{ $work->image }}" alt="{{ $work->company_name }}" class="w-16 h-16 rounded-xl object-cover">
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
                                    <span class="px-3 py-1 bg-{{ $work->color ?? 'blue' }}-500/10 text-{{ $work->color ?? 'blue' }}-400 rounded-lg text-sm border border-{{ $work->color ?? 'blue' }}-500/30">
                                        {{ $tech->value }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
      </div>
</div>
