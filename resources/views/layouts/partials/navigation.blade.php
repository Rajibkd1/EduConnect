@auth
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"></div>

    <!-- Mobile sidebar -->
    <div id="mobile-sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-800 shadow-2xl transform -translate-x-full transition-all duration-300 ease-in-out lg:hidden">
        
        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-16 px-6 border-b border-slate-700">
                <a href="{{ route('home') }}" class="text-xl font-bold text-white">
                    EduConnect
                </a>
                <button id="close-sidebar" class="text-slate-400 hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Mobile User Info -->
            <div class="p-4 border-b border-slate-700">
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
                                 class="w-10 h-10 rounded-full object-cover border-2 border-slate-600">
                        @else
                            <div class="bg-slate-600 rounded-full p-2">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Online status indicator -->
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 border-2 border-slate-800 rounded-full"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-700 text-slate-300">
                                {{ ucfirst(auth()->user()->user_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Language Toggle -->
            <div class="px-6 py-4 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-300">{{ __('ui.language') }}</span>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="px-2 py-1 text-xs rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            EN
                        </a>
                        <a href="{{ route('language.switch', 'bn') }}" 
                           class="px-2 py-1 text-xs rounded {{ app()->getLocale() == 'bn' ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            বাং
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Items -->
            <nav class="mt-4 px-3 flex-1 space-y-1">
                @foreach (auth()->user()->getNavigationItems() as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs($item['route']) ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                        <div class="flex items-center justify-center w-6 h-6 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                                </path>
                            </svg>
                        </div>
                        <span>{{ $item['name'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout Button -->
            <div class="p-3 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center w-full px-3 py-2 text-sm font-medium text-red-400 rounded-lg hover:text-red-300 hover:bg-slate-700 transition-colors duration-200">
                        <div class="flex items-center justify-center w-6 h-6 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </div>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-64 lg:bg-gradient-to-b lg:from-slate-800 lg:to-slate-900 lg:shadow-2xl">
        
        <div class="h-full flex flex-col">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6 border-b border-slate-700/50 bg-slate-800/50 backdrop-blur-sm">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <a href="{{ route('home') }}" class="text-xl font-bold text-white">
                        {{ __('navigation.educonnect') }}
                    </a>
                </div>
            </div>

            <!-- Language Toggle -->
            <div class="px-6 py-4 border-b border-slate-700">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-300">{{ __('ui.language') }}</span>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="px-2 py-1 text-xs rounded {{ app()->getLocale() == 'en' ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            EN
                        </a>
                        <a href="{{ route('language.switch', 'bn') }}" 
                           class="px-2 py-1 text-xs rounded {{ app()->getLocale() == 'bn' ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            বাং
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Info -->
            <div class="p-4 border-b border-slate-700">
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
                                 class="w-10 h-10 rounded-full object-cover border-2 border-slate-600">
                        @else
                            <div class="bg-slate-600 rounded-full p-2">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Online status indicator -->
                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 border-2 border-slate-800 rounded-full"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                        <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-700 text-slate-300">
                                {{ ucfirst(auth()->user()->user_type) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desktop Navigation Items -->
            <nav class="mt-4 px-3 flex-1 space-y-1">
                @foreach (auth()->user()->getNavigationItems() as $item)
                    <a href="{{ route($item['route']) }}"
                        class="group flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs($item['route']) ? 'bg-slate-700 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-700' }}">
                        <div class="flex items-center justify-center w-6 h-6 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                                </path>
                            </svg>
                        </div>
                        <span>{{ $item['name'] }}</span>
                    </a>
                @endforeach
            </nav>

            <!-- Logout Button -->
            <div class="p-3 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="group flex items-center w-full px-3 py-2 text-sm font-medium text-red-400 rounded-lg hover:text-red-300 hover:bg-slate-700 transition-colors duration-200">
                        <div class="flex items-center justify-center w-6 h-6 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </div>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Mobile header -->
    <div class="lg:hidden bg-slate-800 shadow-sm border-b border-slate-700">
        <div class="flex items-center justify-between h-16 px-4">
            <button id="open-sidebar" class="text-slate-400 hover:text-white transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">
                EduConnect
            </a>
            <div class="w-6"></div> <!-- Spacer for centering -->
        </div>
    </div>
@else
    <!-- Guest Navigation -->
    <nav class="bg-slate-800 shadow-lg border-b border-slate-700">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                            EduConnect
                        </a>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @if (request()->routeIs('home'))
                            <a href="#features"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Features</a>
                            <a href="#about"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">About</a>
                            <a href="#contact"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Contact</a>
                        @else
                            <a href="{{ route('home') }}#features"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Features</a>
                            <a href="{{ route('home') }}#about"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">About</a>
                            <a href="{{ route('home') }}#contact"
                                class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Contact</a>
                        @endif
                    </div>
                </div>

                <!-- Language Toggle and Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <!-- Language Toggle -->
                    <div class="flex items-center space-x-2 bg-slate-700 rounded-lg p-1">
                        <a href="{{ route('language.switch', 'en') }}" 
                           class="px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'en' ? 'bg-slate-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            EN
                        </a>
                        <a href="{{ route('language.switch', 'bn') }}" 
                           class="px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ app()->getLocale() === 'bn' ? 'bg-slate-600 text-white' : 'text-slate-300 hover:text-white' }}">
                            বাং
                        </a>
                    </div>
                    
                    <a href="{{ route('signup.show') }}"
                        class="text-slate-300 hover:text-white px-3 py-2 text-sm font-medium transition-colors duration-200">Sign In</a>
                    <a href="{{ route('signup.show') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                        Get Started
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button"
                        class="mobile-menu-button text-slate-300 hover:text-white focus:outline-none focus:text-white transition-colors duration-200"
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
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-slate-700 border-t border-slate-600">
                @if (request()->routeIs('home'))
                    <a href="#features"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Features</a>
                    <a href="#about"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">About</a>
                    <a href="#contact"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Contact</a>
                @else
                    <a href="{{ route('home') }}#features"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Features</a>
                    <a href="{{ route('home') }}#about"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">About</a>
                    <a href="{{ route('home') }}#contact"
                        class="text-slate-300 hover:text-white block px-3 py-2 text-base font-medium transition-colors duration-200">Contact</a>
                @endif
                <div class="pt-4 pb-3 border-t border-slate-600">
                    <div class="flex items-center px-3 space-x-3">
                        <a href="{{ route('signup.show') }}"
                            class="text-slate-300 hover:text-white text-base font-medium transition-colors duration-200">Sign In</a>
                        <a href="{{ route('signup.show') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-base font-medium transition-colors duration-200">
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
