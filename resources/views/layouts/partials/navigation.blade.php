@auth
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden backdrop-blur-sm"></div>

    <!-- Mobile sidebar -->
    <div id="mobile-sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 shadow-2xl transform -translate-x-full transition-all duration-300 ease-in-out lg:hidden">
        <!-- Animated background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500"></div>
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center justify-between h-16 px-6 border-b border-white/10 backdrop-blur-sm">
                <a href="{{ route('home') }}" class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    EduConnect
                </a>
                <button id="close-sidebar" class="text-white/70 hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile User Info -->
            <div class="p-4 border-b border-white/10">
                <div class="flex items-center">
                    @php
                        $user = auth()->user();
                        $profile = null;
                        if ($user->user_type === 'student') {
                            $profile = $user->student;
                        } elseif ($user->user_type === 'tutor') {
                            $profile = $user->tutor;
                        } elseif ($user->user_type === 'guardian') {
                            $profile = $user->guardian;
                        }
                    @endphp
                    
                    <div class="relative">
                        @if($profile && $profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture" 
                                 class="w-12 h-12 rounded-full object-cover border-2 border-white/20 shadow-lg">
                        @else
                            <div class="bg-gradient-to-br from-blue-400 to-purple-500 rounded-full p-3 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Online status indicator -->
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-slate-900 rounded-full animate-pulse"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-blue-300 border border-blue-400/20">
                                {{ ucfirst(auth()->user()->user_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Items -->
            <nav class="mt-6 px-3 space-y-2">
                @foreach (auth()->user()->getNavigationItems() as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs($item['route']) ? 'bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-white border border-blue-400/30 shadow-lg backdrop-blur-sm' : 'text-white/70 hover:text-white hover:bg-white/10 hover:backdrop-blur-sm hover:shadow-lg' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs($item['route']) ? 'bg-gradient-to-br from-blue-400 to-purple-500 shadow-lg' : 'bg-white/10 group-hover:bg-white/20' }} transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3">{{ $item['name'] }}</span>
                        @if(request()->routeIs($item['route']))
                            <div class="ml-auto w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                @endforeach

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="mt-8">
                    @csrf
                    <button type="submit"
                        class="group flex items-center w-full px-4 py-3 text-sm font-medium text-red-300 rounded-xl hover:text-red-200 hover:bg-red-500/10 hover:backdrop-blur-sm hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 group-hover:bg-red-500/20 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-64 lg:bg-gradient-to-br lg:from-slate-900 lg:via-purple-900 lg:to-slate-900 lg:shadow-2xl">
        <!-- Animated background pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500"></div>
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
        </div>
        
        <div class="relative z-10 h-full flex flex-col">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6 border-b border-white/10 backdrop-blur-sm">
                <a href="{{ route('home') }}" class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                    EduConnect
                </a>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-white/10">
                <div class="flex items-center">
                    @php
                        $user = auth()->user();
                        $profile = null;
                        if ($user->user_type === 'student') {
                            $profile = $user->student;
                        } elseif ($user->user_type === 'tutor') {
                            $profile = $user->tutor;
                        } elseif ($user->user_type === 'guardian') {
                            $profile = $user->guardian;
                        }
                    @endphp
                    
                    <div class="relative">
                        @if($profile && $profile->profile_image)
                            <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture" 
                                 class="w-12 h-12 rounded-full object-cover border-2 border-white/20 shadow-lg">
                        @else
                            <div class="bg-gradient-to-br from-blue-400 to-purple-500 rounded-full p-3 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Online status indicator -->
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-slate-900 rounded-full animate-pulse"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-blue-300 border border-blue-400/20">
                                {{ ucfirst(auth()->user()->user_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Navigation Items -->
            <nav class="mt-6 px-3 flex-1 space-y-2">
                @foreach (auth()->user()->getNavigationItems() as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs($item['route']) ? 'bg-gradient-to-r from-blue-500/20 to-purple-500/20 text-white border border-blue-400/30 shadow-lg backdrop-blur-sm' : 'text-white/70 hover:text-white hover:bg-white/10 hover:backdrop-blur-sm hover:shadow-lg' }}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg {{ request()->routeIs($item['route']) ? 'bg-gradient-to-br from-blue-400 to-purple-500 shadow-lg' : 'bg-white/10 group-hover:bg-white/20' }} transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3">{{ $item['name'] }}</span>
                        @if(request()->routeIs($item['route']))
                            <div class="ml-auto w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                        @endif
                    </a>
                @endforeach
            </nav>

            <!-- Logout Button -->
            <div class="p-3 border-t border-white/10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center w-full px-4 py-3 text-sm font-medium text-red-300 rounded-xl hover:text-red-200 hover:bg-red-500/10 hover:backdrop-blur-sm hover:shadow-lg transition-all duration-200">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/10 group-hover:bg-red-500/20 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </div>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile header -->
    <div class="lg:hidden bg-gradient-to-r from-slate-900 to-purple-900 shadow-lg border-b border-white/10">
        <div class="flex items-center justify-between h-16 px-4">
            <button id="open-sidebar" class="text-white/70 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                EduConnect
            </a>
            <div class="w-6"></div> <!-- Spacer for centering -->
        </div>
    </div>
@else
    <!-- Guest Navigation -->
    <nav class="bg-gradient-to-r from-slate-900 via-purple-900 to-slate-900 shadow-lg border-b border-white/10 relative">
        <!-- Animated background pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500"></div>
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                            EduConnect
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @if (request()->routeIs('home'))
                            <a href="#features"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Features</a>
                            <a href="#about"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">About</a>
                            <a href="#contact"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Contact</a>
                        @else
                            <a href="{{ route('home') }}#features"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Features</a>
                            <a href="{{ route('home') }}#about"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">About</a>
                            <a href="{{ route('home') }}#contact"
                                class="text-white/70 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Contact</a>
                        @endif
                    </div>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('signup.show') }}"
                        class="text-blue-300 hover:text-blue-200 px-3 py-2 text-sm font-medium transition-colors duration-200">Sign In</a>
                    <a href="{{ route('signup.show') }}"
                        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 shadow-lg hover:shadow-xl">
                        Get Started
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button"
                        class="mobile-menu-button text-white/70 hover:text-white focus:outline-none focus:text-white transition-colors duration-200"
                        aria-label="Toggle menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-slate-900/50 backdrop-blur-sm border-t border-white/10">
                @if (request()->routeIs('home'))
                    <a href="#features"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Features</a>
                    <a href="#about"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">About</a>
                    <a href="#contact"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Contact</a>
                @else
                    <a href="{{ route('home') }}#features"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Features</a>
                    <a href="{{ route('home') }}#about"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">About</a>
                    <a href="{{ route('home') }}#contact"
                        class="text-white/70 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Contact</a>
                @endif
                <div class="pt-4 pb-3 border-t border-white/10">
                    <div class="flex items-center px-3 space-x-3">
                        <a href="{{ route('signup.show') }}"
                            class="text-blue-300 hover:text-blue-200 text-base font-medium transition-colors duration-200">Sign In</a>
                        <a href="{{ route('signup.show') }}"
                            class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-base font-medium transition-all duration-200 shadow-lg">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endauth

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar functionality
    const openSidebar = document.getElementById('open-sidebar');
    const closeSidebar = document.getElementById('close-sidebar');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (openSidebar) {
        openSidebar.addEventListener('click', function() {
            mobileSidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
        });
    }

    if (closeSidebar) {
        closeSidebar.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            mobileSidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
    }

    // Mobile menu functionality for guest navigation
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>
