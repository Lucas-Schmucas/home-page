<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:200,300,400,500,600,700,800" rel="stylesheet" />
        <title>{{ $title ?? config('app.name') }}</title>
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-svh antialiased font-inter bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 text-gray-900 flex flex-col">
        <main class="flex-1 relative z-10">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="relative z-10 py-12 text-center border-t border-gray-700/50">
            <div class="max-w-6xl mx-auto px-6">
                <p class="text-gray-400">© {{ date('Y') }} Lucas. Built with Laravel & Livewire.</p>
            </div>
        </footer>

        @persist('particles')
            {{-- Particle Canvas Background --}}
            <canvas id="particleCanvas" class="fixed inset-0 w-full h-full pointer-events-none"></canvas>
        @endpersist
        <x-toaster-hub />
        @livewireScriptConfig

        {{-- Particle Animation Script --}}
        <script>
            document.addEventListener('livewire:navigated', function() {
                const canvas = document.getElementById('particleCanvas');
                if (!canvas) return;

                const ctx = canvas.getContext('2d');

                function resizeCanvas() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                }

                resizeCanvas();

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

                window.addEventListener('resize', resizeCanvas);
            }, { once: true }); // Only run once on initial page load
        </script>
    </body>

</html>
