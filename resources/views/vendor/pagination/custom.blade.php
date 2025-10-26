@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center">
        <div class="flex items-center gap-2 backdrop-blur-md bg-gray-900/30 border border-gray-700/30 rounded-lg p-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 text-gray-500 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   wire:navigate.hover
                   class="px-3 py-2 text-gray-300 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-4 py-2 bg-blue-500/20 text-blue-400 rounded-lg border border-blue-500/30 font-medium">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               wire:navigate.hover
                               class="px-4 py-2 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   wire:navigate.hover
                   class="px-3 py-2 text-gray-300 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="px-3 py-2 text-gray-500 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </div>
    </nav>
@endif
