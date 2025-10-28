<div>
    <x-navigation/>

    <div class="max-w-6xl mx-auto px-6 py-20 pt-32">
        {{-- Hero Section --}}
        <section class="min-h-[80vh] flex items-center">
            <div class="grid md:grid-cols-2 gap-12 md:gap-16 items-center w-full">
                {{-- Left Column - Image --}}
                <div class="flex justify-center md:justify-start">
                    <div class="relative">
                        <div
                            class="w-72 h-72 md:w-96 md:h-96 rounded-2xl bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center text-white text-8xl font-bold shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-300">
                            L
                        </div>
                    </div>
                </div>

                {{-- Right Column - Content --}}
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight">
                        I'm Lucas, and this is what I'm working on right now
                    </h1>

                    <div class="space-y-4 text-gray-300 text-lg leading-relaxed">
                        <p class="text-sm text-gray-500">Last updated: {{ date('F j, Y') }}</p>
                        <p>
                            I’m a full-stack developer specializing in Laravel, PHP, and modern web applications. I
                            build, maintain, and optimize robust systems with clean code, efficient queries, and
                            thoughtful architecture.
                        </p>
                        <p>
                            Currently, I’m working at <a class="underline underline-offset-3 hover:decoration-red-600" target="_blank" href="https://www.clipmyhorse.tv/">ClipMyHorse.TV</a> on data-driven platforms and exploring how to make backend
                            performance and frontend experience work seamlessly together.
                        </p>
                        <p>
                            When I’m not coding, I enjoy <a class="underline underline-offset-3 hover:decoration-green-500" href="{{route('books')}}">diving into tech books</a>, solving bouldering problems,
                            playing tabletop games with friends, or spending time with my kids.
                        </p>
                    </div>

                    {{-- Social Links --}}
                    <div class="flex gap-4 pt-6">
                        <a href="https://github.com" target="_blank"
                           class="text-gray-400 hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        <a href="mailto:hello@example.com"
                           class="text-gray-400 hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
