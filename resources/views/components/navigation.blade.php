{{-- Glassmorphism Navigation --}}
<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-gray-900/30 border-b border-gray-700/30">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo/Name --}}
            <a href="/" wire:navigate class="text-xl font-bold text-white hover:text-blue-400 transition-colors">
                Lucas-Schmucas
            </a>

            {{-- Mobile Menu Button --}}
            <button @click="open = !open" class="lg:hidden text-gray-300 hover:text-white transition-colors p-2">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Desktop Navigation Links --}}
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Home</a>
                <a href="{{ route('books') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Books</a>
                <a href="{{ route('projects') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Projects</a>
                <span class="relative inline-flex items-center gap-2 text-gray-500 cursor-not-allowed font-medium">
                    MCP
                    <span class="px-2 py-0.5 text-xs font-semibold bg-yellow-500/20 text-yellow-400 rounded border border-yellow-500/30">
                        Coming Soon
                    </span>
                </span>
                <a href="mailto:{{ config('information.contact.mail') }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/30 hover:bg-blue-500/20 transition-all font-medium">
                    Contact
                </a>
                @auth
                    <livewire:auth.logout />
                @endauth
            </div>
        </div>

        {{-- Mobile Navigation Menu --}}
        <div x-show="open" x-collapse x-cloak class="lg:hidden mt-4 pb-4 border-t border-gray-700/30 pt-4">
            <div class="flex flex-col gap-4">
                <a href="{{ route('home') }}" wire:navigate.hover @click="open = false" class="text-gray-300 hover:text-white transition-colors font-medium">Home</a>
                <a href="{{ route('books') }}" wire:navigate.hover @click="open = false" class="text-gray-300 hover:text-white transition-colors font-medium">Books</a>
                <a href="{{ route('projects') }}" wire:navigate.hover @click="open = false" class="text-gray-300 hover:text-white transition-colors font-medium">Projects</a>
                <span class="inline-flex items-center gap-2 text-gray-500 cursor-not-allowed font-medium">
                    MCP
                    <span class="px-2 py-0.5 text-xs font-semibold bg-yellow-500/20 text-yellow-400 rounded border border-yellow-500/30">
                        Coming Soon
                    </span>
                </span>
                <a href="mailto:{{ config('information.contact.mail') }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/30 hover:bg-blue-500/20 transition-all font-medium text-center">
                    Contact
                </a>
                @auth
                    <livewire:auth.logout />
                @endauth
            </div>
        </div>
    </div>
</nav>
