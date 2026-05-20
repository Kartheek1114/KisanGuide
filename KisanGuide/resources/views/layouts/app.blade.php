<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KisanGuide - Modern Agricultural Advisor & Portal</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .glass-card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card-hover:hover {
            transform: translateY(-4px);
            border-color: rgba(16, 185, 129, 0.35);
            box-shadow: 0 12px 30px -10px rgba(16, 185, 129, 0.15);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen selection:bg-emerald-500 selection:text-slate-900 overflow-x-hidden">
    <!-- Background Gradients -->
    <div class="fixed top-0 left-0 w-full h-full pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-[150px]"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 bg-teal-500/10 rounded-full blur-[150px]"></div>
        <div class="absolute -bottom-40 left-1/3 w-96 h-96 bg-green-500/5 rounded-full blur-[150px]"></div>
    </div>

    <!-- Header Navigation -->
    <header class="sticky top-0 z-40 w-full bg-slate-950/80 backdrop-blur-md border-b border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ auth()->check() ? route('crops') : '/' }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center shadow-lg shadow-emerald-900/30 group-hover:scale-105 transition-transform duration-300">
                        <!-- Leaf Icon -->
                        <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent group-hover:brightness-110 transition-all">KisanGuide</h1>
                        <p class="text-xs text-emerald-500/80 font-medium tracking-wide">AGRICULTURE PORTAL</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            @auth
                <nav class="hidden md:flex space-x-8 text-sm font-medium text-slate-450">
                    <a href="{{ route('crops') }}" class="nav-link {{ request()->routeIs('crops') ? 'active' : '' }}">Crop Directory</a>
                    <a href="{{ route('calculator') }}" class="nav-link {{ request()->routeIs('calculator') ? 'active' : '' }}">NPK Calculator</a>
                    <a href="{{ route('weather') }}" class="nav-link {{ request()->routeIs('weather') ? 'active' : '' }}">Weather & Mandi</a>
                    <a href="{{ route('expert-help') }}" class="nav-link {{ request()->routeIs('expert-help') ? 'active' : '' }}">Expert Help</a>
                </nav>
                <div class="hidden md:flex items-center space-x-6">
                    <span class="text-xs font-semibold text-slate-300">Farmer: <span class="text-emerald-400 font-bold uppercase tracking-wider">{{ auth()->user()->name }}</span></span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-premium-outline px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <nav class="hidden md:flex space-x-8 text-sm font-medium text-slate-450">
                    <a href="/#features" class="nav-link">Portal Features</a>
                    <a href="/#about" class="nav-link">About</a>
                </nav>
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="btn-premium-outline px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="btn-premium-gradient px-4 py-2 text-xs font-bold uppercase tracking-wider rounded-lg">
                        Sign Up
                    </a>
                </div>
            @endauth

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn" class="p-2 rounded-lg bg-slate-900 border border-slate-800 text-slate-400 hover:text-white transition-colors focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="hamburger-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="close-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-900 bg-slate-950/95 backdrop-blur-md px-4 py-4 space-y-3">
            @auth
                <a href="{{ route('crops') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">Crop Directory</a>
                <a href="{{ route('calculator') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">NPK Calculator</a>
                <a href="{{ route('weather') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">Weather & Mandi</a>
                <a href="{{ route('expert-help') }}" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">Expert Help</a>
                <div class="pt-3 border-t border-slate-900 flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-300">Farmer: <span class="text-emerald-400 font-bold uppercase">{{ auth()->user()->name }}</span></span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn-premium-outline px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-lg">
                            Log Out
                        </button>
                    </form>
                </div>
            @else
                <a href="/#features" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">Portal Features</a>
                <a href="/#about" class="block px-3 py-2 rounded-lg text-sm font-semibold text-slate-300 hover:bg-slate-900 hover:text-emerald-400 transition-all">About</a>
                <div class="pt-3 border-t border-slate-900 flex space-x-2">
                    <a href="{{ route('login') }}" class="w-1/2 text-center btn-premium-outline px-3 py-2 text-xs font-bold uppercase tracking-wider rounded-lg">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="w-1/2 text-center btn-premium-gradient px-3 py-2 text-xs font-bold uppercase tracking-wider rounded-lg">
                        Sign Up
                    </a>
                </div>
            @endauth
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-900 bg-slate-950 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-xs text-slate-500 space-y-2">
            <p>© 2026 KisanGuide Agricultural Systems. Designed to support sustainable farming.</p>
            <p>Built with Laravel 12, SQLite, Tailwind CSS, and Vite.</p>
        </div>
    </footer>

    <!-- Mobile Menu script toggle -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const hamburger = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            hamburger.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html>
