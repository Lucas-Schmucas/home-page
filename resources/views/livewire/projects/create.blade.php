<x-layouts.page>
    {{-- Page Header --}}
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('projects') }}"
               class="text-gray-400 hover:text-white transition-colors"
               wire:navigate>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-5xl md:text-6xl font-bold text-white">Add Project</h1>
        </div>
        <p class="text-xl text-gray-300 leading-relaxed">
            Add a new project to your portfolio.
        </p>
    </div>

    {{-- Form --}}
    <div class="max-w-3xl">
        <form wire:submit="save" class="space-y-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                    Project Name <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="name"
                       wire:model="name"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('name')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                    Description <span class="text-red-400">*</span>
                </label>
                <textarea id="description"
                          wire:model="description"
                          rows="5"
                          class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Project URL --}}
            <div>
                <label for="url" class="block text-sm font-medium text-gray-300 mb-2">
                    Project URL
                </label>
                <input type="url"
                       id="url"
                       wire:model="url"
                       placeholder="https://example.com"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('url')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- GitHub URL --}}
            <div>
                <label for="github_url" class="block text-sm font-medium text-gray-300 mb-2">
                    GitHub URL
                </label>
                <input type="url"
                       id="github_url"
                       wire:model="github_url"
                       placeholder="https://github.com/username/repo"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('github_url')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Technologies --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Technologies
                </label>
                <div class="space-y-3">
                    @foreach ($technologies as $index => $technology)
                        <div class="flex gap-2" wire:key="tech-{{ $index }}">
                            <input type="text"
                                   wire:model="technologies.{{ $index }}"
                                   placeholder="e.g., Laravel, Vue.js, Tailwind CSS"
                                   class="flex-1 px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if (count($technologies) > 1)
                                <button type="button"
                                        wire:click="removeTechnology({{ $index }})"
                                        class="px-4 py-3 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500/20 transition-colors border border-red-500/30">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button type="button"
                        wire:click="addTechnology"
                        class="mt-3 inline-flex items-center gap-2 px-4 py-2 text-sm text-blue-400 hover:text-blue-300 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Add Technology</span>
                </button>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="save">Add Project</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
                <a href="{{ route('projects') }}"
                   wire:navigate
                   class="px-8 py-3 text-gray-300 hover:text-white transition-colors font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.page>
