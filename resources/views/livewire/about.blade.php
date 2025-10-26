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
                    <div class="flex gap-6" wire:key="work-{{ $loop->index }}">
                        {{-- Company Logo --}}
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-{{ $work['logo_gradient_from'] }} to-{{ $work['logo_gradient_to'] }} flex items-center justify-center text-white font-bold text-2xl">
                                {{ $work['logo_letter'] }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="flex-1">
                            <div class="mb-2">
                                <h3 class="text-xl font-bold text-white">{{ $work['title'] }}</h3>
                                <p class="text-gray-400">{{ $work['company'] }} • {{ $work['period'] }}</p>
                            </div>
                            <p class="text-gray-300 leading-relaxed mb-3">
                                {{ $work['description'] }}
                            </p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($work['technologies'] as $tech)
                                    <span class="px-3 py-1 bg-{{ $tech['color'] }}-500/10 text-{{ $tech['color'] }}-400 rounded-lg text-sm border border-{{ $tech['color'] }}-500/30">
                                        {{ $tech['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Education Section --}}
        <section class="mb-20">
            <h2 class="text-3xl font-bold text-white mb-12">Education</h2>

            <div class="space-y-8">
                @foreach ($education as $edu)
                    <div class="flex gap-6" wire:key="edu-{{ $loop->index }}">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-{{ $edu['logo_gradient_from'] }} to-{{ $edu['logo_gradient_to'] }} flex items-center justify-center text-white font-bold text-2xl">
                                {{ $edu['logo_letter'] }}
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="mb-2">
                                <h3 class="text-xl font-bold text-white">{{ $edu['degree'] }}</h3>
                                <p class="text-gray-400">{{ $edu['institution'] }} • {{ $edu['period'] }}</p>
                            </div>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $edu['description'] }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
