@auth
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 bg-black bg-opacity-50 hidden lg:hidden"></div>

    <!-- Mobile sidebar -->
    <div id="mobile-sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden">
        <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">EduConnect</a>
            <button id="close-sidebar" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Mobile User Info -->
        <div class="p-4 border-b border-gray-200">
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
                
                @if($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-indigo-200">
                @else
                    <div class="bg-indigo-100 rounded-full p-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endif
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->user_type) }}</p>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Items -->
        <nav class="mt-6 px-3">
            @foreach (auth()->user()->getNavigationItems() as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center px-3 py-3 mb-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs($item['route']) ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                        </path>
                    </svg>
                    {{ $item['name'] }}
                </a>
            @endforeach

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-3 py-3 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Desktop Sidebar -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-64 lg:bg-white lg:shadow-lg">
        <!-- Logo -->
        <div class="flex items-center h-16 px-6 border-b border-gray-200">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">EduConnect</a>
        </div>

        <!-- User Info -->
        <div class="p-4 border-b border-gray-200">
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
                
                @if($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-indigo-200">
                @else
                    <div class="bg-indigo-100 rounded-full p-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endif
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ ucfirst(auth()->user()->user_type) }}</p>
                </div>
            </div>
        </div>

        <!-- Desktop Navigation Items -->
        <nav class="mt-6 px-3 flex-1">
            @foreach (auth()->user()->getNavigationItems() as $item)
                <a href="{{ route($item['route']) }}"
                    class="flex items-center px-3 py-3 mb-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs($item['route']) ? 'bg-indigo-100 text-indigo-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}">
                        </path>
                    </svg>
                    {{ $item['name'] }}
                </a>
            @endforeach

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit"
                    class="flex items-center w-full px-3 py-3 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </form>
        </nav>
    </div>

    <!-- Mobile header -->
    <div class="lg:hidden bg-white shadow-sm border-b border-gray-200">
        <div class="flex items-center justify-between h-16 px-4">
            <button id="open-sidebar" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">EduConnect</a>
            <div class="w-6"></div> <!-- Spacer for centering -->
        </div>
    </div>
@else
    <!-- Guest Navigation -->
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
                        @if (request()->routeIs('home'))
                            <a href="#features"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Features</a>
                            <a href="#about"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                            <a href="#contact"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                        @else
                            <a href="{{ route('home') }}#features"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Features</a>
                            <a href="{{ route('home') }}#about"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">About</a>
                            <a href="{{ route('home') }}#contact"
                                class="text-gray-600 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition-colors">Contact</a>
                        @endif
                    </div>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('signup.show') }}"
                        class="text-indigo-600 hover:text-indigo-800 px-3 py-2 text-sm font-medium transition-colors">Sign
                        In</a>
                    <a href="{{ route('signup.show') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Get
                        Started</a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button"
                        class="mobile-menu-button text-gray-600 hover:text-indigo-600 focus:outline-none focus:text-indigo-600"
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
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                @if (request()->routeIs('home'))
                    <a href="#features"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                    <a href="#about"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">About</a>
                    <a href="#contact"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Contact</a>
                @else
                    <a href="{{ route('home') }}#features"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                    <a href="{{ route('home') }}#about"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">About</a>
                    <a href="{{ route('home') }}#contact"
                        class="text-gray-600 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Contact</a>
                @endif
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-3 space-x-3">
                        <a href="{{ route('signup.show') }}"
                            class="text-indigo-600 hover:text-indigo-800 text-base font-medium">Sign In</a>
                        <a href="{{ route('signup.show') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-base font-medium">Get
                            Started</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endauth
