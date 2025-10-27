<x-layouts.page>
    {{-- Page Header --}}
    <div class="mb-16">
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ route('about') }}"
               class="text-gray-400 hover:text-white transition-colors"
               wire:navigate>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-5xl md:text-6xl font-bold text-white">Add Work Experience</h1>
        </div>
        <p class="text-xl text-gray-300 leading-relaxed">
            Add a new work experience entry to your profile.
        </p>
    </div>

    {{-- Form --}}
    <div class="max-w-3xl">
        <form wire:submit="save" class="space-y-6">
            {{-- Job Title --}}
            <div>
                <label for="job_title" class="block text-sm font-medium text-gray-300 mb-2">
                    Job Title <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="job_title"
                       wire:model="job_title"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('job_title')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Company Name --}}
            <div>
                <label for="company_name" class="block text-sm font-medium text-gray-300 mb-2">
                    Company Name <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="company_name"
                       wire:model="company_name"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('company_name')
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

            {{-- Company Logo/Image --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300 mb-2">
                    Company Logo
                </label>
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
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-16 h-16 rounded-xl object-cover border border-gray-700">
                    </div>
                @endif
                <div wire:loading wire:target="image" class="mt-2 text-sm text-blue-400">
                    Uploading...
                </div>
            </div>

            {{-- Color --}}
            <div>
                <label for="color" class="block text-sm font-medium text-gray-300 mb-2">
                    Brand Color (e.g., blue, red, green)
                </label>
                <input type="text"
                       id="color"
                       wire:model="color"
                       placeholder="blue"
                       class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('color')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-400">This color will be used for the technology badges.</p>
            </div>

            {{-- Dates --}}
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-300 mb-2">
                        Start Date <span class="text-red-400">*</span>
                    </label>
                    <input type="date"
                           id="start_date"
                           wire:model="start_date"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('start_date')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-300 mb-2">
                        End Date <span class="text-sm text-gray-400">(leave empty if current)</span>
                    </label>
                    <input type="date"
                           id="end_date"
                           wire:model="end_date"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('end_date')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Technologies --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-3">
                    Technologies
                </label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @foreach ($availableTechnologies as $tech)
                        <label class="flex items-center gap-3 px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg cursor-pointer hover:border-blue-500/50 transition-colors"
                               :class="@js(in_array($tech->value, $technologies)) && 'border-blue-500 bg-blue-500/10'">
                            <input type="checkbox"
                                   wire:model="technologies"
                                   value="{{ $tech->value }}"
                                   class="w-4 h-4 text-blue-500 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <span class="text-sm text-gray-300">{{ $tech->value }}</span>
                        </label>
                    @endforeach
                </div>
                @error('technologies')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="save">Add Experience</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
                <a href="{{ route('about') }}"
                   wire:navigate
                   class="px-8 py-3 text-gray-300 hover:text-white transition-colors font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.page>
