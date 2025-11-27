<x-layouts.page>
    {{-- Page Header --}}
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('books') }}"
               class="text-gray-400 hover:text-white transition-colors"
               wire:navigate>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-5xl md:text-6xl font-bold text-white">Edit Book</h1>
        </div>
        <p class="text-xl text-gray-300 leading-relaxed">
            Update book details.
        </p>
    </div>

    {{-- Form --}}
    <div class="max-w-3xl">
        <form wire:submit="save" class="space-y-6">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-2">
                    Title <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="title"
                       wire:model="title"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('title')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Author --}}
            <div>
                <label for="author" class="block text-sm font-medium text-gray-300 mb-2">
                    Author <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="author"
                       wire:model="author"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('author')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                    Book Cover Image
                </label>
                @if ($book->image && !$image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-400 mb-2">Current image:</p>
                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="w-48 h-auto rounded-lg border border-gray-700">
                    </div>
                @endif
                <input type="file"
                       id="image"
                       wire:model="image"
                       accept="image/*"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:cursor-pointer">
                @error('image')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
                @if ($image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-400 mb-2">New image:</p>
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-48 h-auto rounded-lg border border-gray-700">
                    </div>
                @endif
                <div wire:loading wire:target="image" class="mt-2 text-sm text-blue-400">
                    Uploading...
                </div>
            </div>

            {{-- Personal Summary --}}
            <div>
                <label for="personal_summary" class="block text-sm font-medium text-gray-300 mb-2">
                    Personal Summary <span class="text-red-400">*</span>
                </label>
                <textarea id="personal_summary"
                          wire:model="personal_summary"
                          rows="5"
                          class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('personal_summary')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL --}}
            <div>
                <label for="url" class="block text-sm font-medium text-gray-300 mb-2">
                    Amazon URL <span class="text-red-400">*</span>
                </label>
                <input type="url"
                       id="url"
                       wire:model="url"
                       placeholder="https://amazon.com/..."
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('url')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Dates --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="started_on" class="block text-sm font-medium text-gray-300 mb-2">
                        Started On
                    </label>
                    <input type="date"
                           id="started_on"
                           wire:model="started_on"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('started_on')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="finished_on" class="block text-sm font-medium text-gray-300 mb-2">
                        Finished On
                    </label>
                    <input type="date"
                           id="finished_on"
                           wire:model="finished_on"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('finished_on')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="save">Save Changes</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
                <a href="{{ route('books') }}"
                   wire:navigate
                   class="px-8 py-3 text-gray-300 hover:text-white transition-colors font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.page>
