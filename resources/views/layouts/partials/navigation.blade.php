<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">EduConnect</a>
                </div>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    @if(request()->routeIs('home'))
                        <a href="#features" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Features</a>
                        <a href="#about" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                        <a href="#contact" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                    @else
                        <a href="{{ route('home') }}#features" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Features</a>
                        <a href="{{ route('home') }}#about" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                        <a href="{{ route('home') }}#contact" class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                    @endif
                </div>
            </div>
            
            <!-- Auth Buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 px-3 py-2 text-sm font-medium transition-colors">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Logout</button>
                    </form>
                @else
                    <a href="{{ route('signup.show') }}" class="text-indigo-600 hover:text-indigo-800 px-3 py-2 text-sm font-medium transition-colors">Sign In</a>
                    <a href="{{ route('signup.show') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Get Started</a>
                @endauth
            </div>
            
            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" class="mobile-menu-button text-gray-600 hover:text-indigo-600 focus:outline-none focus:text-indigo-600" aria-label="Toggle menu">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile menu -->
    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
            @if(request()->routeIs('home'))
                <a href="#features" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                <a href="#about" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">About</a>
                <a href="#contact" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Contact</a>
            @else
                <a href="{{ route('home') }}#features" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                <a href="{{ route('home') }}#about" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">About</a>
                <a href="{{ route('home') }}#contact" class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Contact</a>
            @endif
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-3 space-x-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-800 text-base font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-base font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('signup.show') }}" class="text-indigo-600 hover:text-indigo-800 text-base font-medium">Sign In</a>
                        <a href="{{ route('signup.show') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-base font-medium">Get Started</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
