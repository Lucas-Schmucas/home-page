<div class="relative min-h-screen overflow-hidden">
    {{-- Particle Canvas Background --}}
    <canvas id="particleCanvas" class="fixed inset-0 w-full h-full pointer-events-none"></canvas>

    {{-- Glassmorphism Navigation --}}
    <nav class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-gray-900/30 border-b border-gray-700/30">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                {{-- Logo/Name --}}
                <a href="/" class="text-xl font-bold text-white hover:text-blue-400 transition-colors">
                    Lucas
                </a>

                {{-- Navigation Links --}}
                <div class="flex items-center gap-8">
                    <a href="#projects" class="text-gray-300 hover:text-white transition-colors font-medium">Projects</a>
                    <a href="#technologies" class="text-gray-300 hover:text-white transition-colors font-medium">Technologies</a>
                    <a href="mailto:hello@example.com" class="px-4 py-2 bg-blue-500/10 text-blue-400 rounded-lg border border-blue-500/30 hover:bg-blue-500/20 transition-all font-medium">
                        Contact
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <div class="relative z-10 max-w-5xl mx-auto px-6 py-20 pt-32">
        {{-- Hero Section --}}
        <section class="min-h-screen flex flex-col justify-center">
            <div class="space-y-8">
                {{-- Profile Image --}}
                <div class="flex justify-center mb-12">
                    <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center text-white text-5xl font-bold shadow-2xl">
                        L
                    </div>
                </div>

                {{-- Main Heading --}}
                <div class="text-center space-y-6">
                    <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight">
                        Hey, I'm Lucas
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                        Full-Stack Developer & Designer
                    </p>
                    <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                        I build beautiful web applications and turn ideas into reality. Currently focusing on modern web technologies and creating delightful user experiences.
                    </p>
                </div>

                {{-- Social Links --}}
                <div class="flex justify-center gap-6 pt-8">
                    <a href="https://github.com" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="https://linkedin.com" target="_blank" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    <a href="mailto:hello@example.com" class="text-gray-400 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        {{-- Latest Projects Section --}}
        <section id="projects" class="py-20">
            <h2 class="text-4xl font-bold text-white mb-12 text-center">Latest Projects</h2>
            <div class="grid md:grid-cols-2 gap-8">
                {{-- Project Card 1 --}}
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-semibold text-white">Project Alpha</h3>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-4">A modern web application built with Laravel and Livewire. Features real-time updates and a beautiful UI.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Laravel</span>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Livewire</span>
                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-sm">Tailwind</span>
                    </div>
                </div>

                {{-- Project Card 2 --}}
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-semibold text-white">Dashboard Pro</h3>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-4">An analytics dashboard with interactive charts and real-time data visualization.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">React</span>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">TypeScript</span>
                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-sm">Chart.js</span>
                    </div>
                </div>

                {{-- Project Card 3 --}}
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-semibold text-white">E-Commerce Platform</h3>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-4">Full-featured online store with payment processing, inventory management, and order tracking.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Laravel</span>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Stripe</span>
                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-sm">Vue.js</span>
                    </div>
                </div>

                {{-- Project Card 4 --}}
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 hover:bg-gray-800/70 transition-all duration-300 border border-gray-700/50">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-semibold text-white">API Gateway</h3>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <p class="text-gray-400 mb-4">Scalable API gateway with rate limiting, authentication, and request routing capabilities.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-blue-500/20 text-blue-300 rounded-full text-sm">Node.js</span>
                        <span class="px-3 py-1 bg-purple-500/20 text-purple-300 rounded-full text-sm">Redis</span>
                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 rounded-full text-sm">Docker</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Technologies Section --}}
        <section id="technologies" class="py-20">
            <h2 class="text-4xl font-bold text-white mb-12 text-center">Technologies I Work With</h2>
            <div class="max-w-3xl mx-auto">
                <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-8 border border-gray-700/50">
                    <div class="flex flex-wrap gap-3 justify-center">
                        <span class="px-5 py-2.5 bg-red-500/10 text-red-400 rounded-lg font-medium border border-red-500/30 hover:bg-red-500/20 transition-all">Laravel</span>
                        <span class="px-5 py-2.5 bg-pink-500/10 text-pink-400 rounded-lg font-medium border border-pink-500/30 hover:bg-pink-500/20 transition-all">Livewire</span>
                        <span class="px-5 py-2.5 bg-cyan-500/10 text-cyan-400 rounded-lg font-medium border border-cyan-500/30 hover:bg-cyan-500/20 transition-all">React</span>
                        <span class="px-5 py-2.5 bg-emerald-500/10 text-emerald-400 rounded-lg font-medium border border-emerald-500/30 hover:bg-emerald-500/20 transition-all">Vue.js</span>
                        <span class="px-5 py-2.5 bg-blue-500/10 text-blue-400 rounded-lg font-medium border border-blue-500/30 hover:bg-blue-500/20 transition-all">TypeScript</span>
                        <span class="px-5 py-2.5 bg-sky-500/10 text-sky-400 rounded-lg font-medium border border-sky-500/30 hover:bg-sky-500/20 transition-all">Tailwind CSS</span>
                        <span class="px-5 py-2.5 bg-green-500/10 text-green-400 rounded-lg font-medium border border-green-500/30 hover:bg-green-500/20 transition-all">Node.js</span>
                        <span class="px-5 py-2.5 bg-indigo-500/10 text-indigo-400 rounded-lg font-medium border border-indigo-500/30 hover:bg-indigo-500/20 transition-all">PostgreSQL</span>
                        <span class="px-5 py-2.5 bg-red-600/10 text-red-500 rounded-lg font-medium border border-red-600/30 hover:bg-red-600/20 transition-all">Redis</span>
                        <span class="px-5 py-2.5 bg-blue-600/10 text-blue-500 rounded-lg font-medium border border-blue-600/30 hover:bg-blue-600/20 transition-all">Docker</span>
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="py-12 text-center">
            <p class="text-gray-400">� {{ date('Y') }} Lucas. Built with Laravel & Livewire.</p>
        </footer>
    </div>
</div>

@script
<script>
    const canvas = document.getElementById('particleCanvas');
    const ctx = canvas.getContext('2d');

    canvas.width = window.innerWidth;
    canvas.height = document.documentElement.scrollHeight;

    const particles = [];
    const particleCount = 150;

    class Particle {
        constructor() {
            this.x = Math.random() * canvas.width;
            this.y = Math.random() * canvas.height;
            this.size = Math.random() * 2 + 1;
            this.speedX = Math.random() * 0.5 - 0.25;
            this.speedY = Math.random() * 0.5 - 0.25;
            this.opacity = Math.random() * 0.5 + 0.2;
        }

        update() {
            this.x += this.speedX;
            this.y += this.speedY;

            if (this.x > canvas.width) this.x = 0;
            if (this.x < 0) this.x = canvas.width;
            if (this.y > canvas.height) this.y = 0;
            if (this.y < 0) this.y = canvas.height;
        }

        draw() {
            ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fill();
        }
    }

    for (let i = 0; i < particleCount; i++) {
        particles.push(new Particle());
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        particles.forEach(particle => {
            particle.update();
            particle.draw();
        });

        requestAnimationFrame(animate);
    }

    animate();

    window.addEventListener('resize', () => {
        canvas.width = window.innerWidth;
        canvas.height = document.documentElement.scrollHeight;
    });

    // Update canvas height on scroll
    let scrollTimeout;
    window.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            canvas.height = document.documentElement.scrollHeight;
        }, 100);
    });
</script>
@endscript
