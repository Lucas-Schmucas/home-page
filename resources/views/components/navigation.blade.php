{{-- Glassmorphism Navigation --}}
<nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-gray-900/30 border-b border-gray-700/30">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo/Name --}}
            <a href="/" wire:navigate class="text-xl font-bold text-white hover:text-blue-400 transition-colors">
                Lucas
            </a>

            {{-- Navigation Links --}}
            <div class="flex items-center gap-8">
                <a href="{{ route('home') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Home</a>
                <a href="{{ route('about') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">About</a>
                <a href="{{ route('books') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Books</a>
                <a href="{{ route('projects') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">Projects</a>
                <a href="{{ route('mcp') }}" wire:navigate.hover class="text-gray-300 hover:text-white transition-colors font-medium">MCP</a>
                <a href="mailto:{{ config('information.contact.mail') }}" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/30 hover:bg-blue-500/20 transition-all font-medium">
                    Contact
                </a>
            </div>
        </div>
    </div>
</nav>
