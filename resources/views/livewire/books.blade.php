<div>
    <x-navigation />

    <div class="max-w-6xl mx-auto px-6 py-20 pt-32">
        {{-- Page Header --}}
        <div class="mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">My Bookshelf</h1>
            <p class="text-xl text-gray-300 leading-relaxed">
                Some of the books that have kept me company on my journey so far. <br>
            </p>
        </div>
        @if($books)
        {{-- Books Grid --}}
        <div class="grid md:grid-cols-2 gap-12 mb-20">
            @foreach ($books as $book)
                <div class="h-[500px] cursor-pointer [perspective:1000px]" x-data="{ flipped: false }" @click="flipped = !flipped" wire:key="book-{{ $book->id }}">
                    <div class="relative w-full h-full transition-transform duration-600 [transform-style:preserve-3d]" :class="flipped && '[transform:rotateY(180deg)]'">
                        {{-- Front of card (Book cover) --}}
                        <div class="absolute w-full h-full [backface-visibility:hidden]">
                            <div class="w-full h-full rounded-2xl shadow-2xl overflow-hidden border border-white/10">
                                <img src="{{ $book->image_url }}"
                                     alt="{{ $book->title }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </div>

                        {{-- Back of card (Review) --}}
                        <div class="absolute w-full h-full [backface-visibility:hidden] [transform:rotateY(180deg)]">
                            <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl shadow-2xl p-8 border border-white/10 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-4">My Thoughts</h3>
                                    <p class="text-gray-300 leading-relaxed mb-4">{{ $book->personal_summary }}</p>

                                    {{-- Reading dates --}}
                                    <div class="flex flex-col gap-2 text-sm text-gray-400">
                                        @if($book->started_on)
                                            <div class="flex items-center gap-2">
                                                <span>Started on:</span>
                                                <span class="text-gray-300">{{ $book->started_on->format('M j, Y') }}</span>
                                            </div>
                                        @endif
                                        @if($book->finished_on)
                                            <div class="flex items-center gap-2">
                                                <span>Finished on:</span>
                                                <span class="text-gray-300">{{ $book->finished_on->format('M j, Y') }}</span>
                                            </div>
                                        @else
                                            @if($book->started_on)
                                                <div class="flex items-center gap-2">
                                                    <span class="text-blue-400">Currently reading</span>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ $book->url }}"
                                       target="_blank"
                                       class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium"
                                       @click.stop>
                                        <span>View on Amazon</span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-12">
            {{ $books->links('vendor.pagination.custom') }}
        </div>
        @endif
    </div>
</div>
