<x-layouts.page>
    {{-- Page Header --}}
    <div class="mb-16">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-5xl md:text-6xl font-bold text-white">My Bookshelf</h1>
            @auth
                <a href="{{ route('books.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Book</span>
                </a>
            @endauth
        </div>
        <p class="text-xl text-gray-300 leading-relaxed">
            Some of the books that have kept me company on my journey so far. <br>
        </p>
    </div>
    @if($booksByYear->isNotEmpty())
        @foreach($booksByYear as $year => $books)
            {{-- Year Separator --}}
            <div class="mb-8 mt-16 first:mt-0">
                <div class="flex items-center gap-4">
                    <h2 class="text-3xl font-bold text-white">{{ $year }}</h2>
                    <div class="flex-1 h-px bg-gray-700"></div>
                    <span class="text-gray-500 text-sm">{{ $books->count() }} {{ Str::plural('book', $books->count()) }}</span>
                </div>
            </div>

            {{-- Books Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 mb-12">
                @foreach ($books as $book)
                    <div class="aspect-[2/3] cursor-pointer [perspective:1000px]" x-data="{ flipped: false }" @click="flipped = !flipped" wire:key="book-{{ $book->id }}">
                        <div class="relative w-full h-full transition-transform duration-600 [transform-style:preserve-3d]" :class="flipped && '[transform:rotateY(180deg)]'">
                            {{-- Front of card (Book cover) --}}
                            <div class="absolute w-full h-full [backface-visibility:hidden]">
                                <div class="w-full h-full rounded-xl shadow-xl overflow-hidden border border-white/10 relative">
                                    <img src="{{ $book->image_url }}"
                                         alt="{{ $book->title }}"
                                         class="w-full h-full object-cover">
                                    @auth
                                        <div class="absolute top-2 right-2 flex gap-1" @click.stop>
                                            <a href="{{ route('books.edit', $book) }}"
                                               wire:navigate
                                               class="p-1.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            <button wire:click="delete({{ $book->id }})"
                                                    wire:confirm="Are you sure you want to delete this book?"
                                                    class="p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors shadow-lg">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    @endauth
                                </div>
                            </div>

                            {{-- Back of card (Review) --}}
                            <div class="absolute w-full h-full [backface-visibility:hidden] [transform:rotateY(180deg)]">
                                <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl shadow-xl p-4 border border-white/10 flex flex-col justify-between overflow-hidden">
                                    <div class="overflow-y-auto">
                                        <h3 class="text-lg font-bold text-white mb-2">{{ $book->title }}</h3>
                                        <p class="text-sm text-gray-400 mb-3">by {{ $book->author }}</p>
                                        <p class="text-gray-300 text-sm leading-relaxed mb-3">{{ $book->personal_summary }}</p>

                                        {{-- Reading dates --}}
                                        <div class="flex flex-col gap-1 text-xs text-gray-400">
                                            @if($book->started_on)
                                                <div class="flex items-center gap-1">
                                                    <span>Started:</span>
                                                    <span class="text-gray-300">{{ $book->started_on->format('M Y') }}</span>
                                                </div>
                                            @endif
                                            @if($book->finished_on)
                                                <div class="flex items-center gap-1">
                                                    <span>Finished:</span>
                                                    <span class="text-gray-300">{{ $book->finished_on->format('M Y') }}</span>
                                                </div>
                                            @else
                                                @if($book->started_on)
                                                    <span class="text-blue-400">Currently reading</span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="mt-3 shrink-0">
                                        <a href="{{ $book->url }}"
                                           target="_blank"
                                           class="inline-flex items-center gap-1 px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium"
                                           @click.stop>
                                            <span>Amazon</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        @endforeach
    @endif
</x-layouts.page>
