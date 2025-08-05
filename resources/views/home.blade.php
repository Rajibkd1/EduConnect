@extends('layouts.app')

@section('title', __('home.hero.title') . ' - ' . __('navigation.educonnect'))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 hero-pattern">
        <!-- Floating Educational Icons -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Student Icon -->
            <div class="floating-icon absolute top-1/4 left-1/6 opacity-5 dark:opacity-10">
                <svg class="w-32 h-32 text-gray-400 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
            </div>
            <!-- Tutor Icon -->
            <div class="floating-icon absolute bottom-1/4 right-1/6 opacity-5 dark:opacity-10">
                <svg class="w-28 h-28 text-gray-400 dark:text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <!-- Book Icon -->
            <div class="floating-icon absolute top-1/3 right-1/4 opacity-5 dark:opacity-10">
                <svg class="w-24 h-24 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Main Hero Content -->
            <div class="mb-12">
                <div class="flex justify-center mb-8">
                    <div class="flex items-center space-x-4">
                        <!-- Student Icon -->
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <!-- Connection Line -->
                        <div class="connection-line w-8 h-0.5 bg-gray-300 dark:bg-gray-600"></div>
                        <!-- EduConnect Logo/Icon -->
                        <div class="w-20 h-20 bg-gray-900 dark:bg-white rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-white dark:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <!-- Connection Line -->
                        <div class="connection-line w-8 h-0.5 bg-gray-300 dark:bg-gray-600"></div>
                        <!-- Tutor Icon -->
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight">
                    {{ __('home.hero.title') }}
                </h1>
                <div class="w-24 h-1 bg-gray-800 dark:bg-white mx-auto mb-8 rounded-full"></div>
                <p class="text-xl sm:text-2xl lg:text-3xl text-gray-600 dark:text-gray-300 mb-12 max-w-4xl mx-auto font-light leading-relaxed">
                    {{ __('home.hero.subtitle') }}
                </p>
            </div>
            
            <!-- User Type Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 max-w-4xl mx-auto">
                <!-- Student Card -->
                <div class="user-type-card group bg-white dark:bg-gray-800 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-10 h-10 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.hero.for_students') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">{{ __('home.hero.student_description') }}</p>
                    <a href="{{ route('signup.show') }}" class="inline-flex items-center text-gray-900 dark:text-white font-medium hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                        {{ __('home.hero.join_as_student') }}
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Tutor Card -->
                <div class="user-type-card group bg-white dark:bg-gray-800 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-600 transition-colors">
                        <svg class="w-10 h-10 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.hero.for_tutors') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">{{ __('home.hero.tutor_description') }}</p>
                    <a href="{{ route('signup.show') }}" class="inline-flex items-center text-gray-900 dark:text-white font-medium hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                        {{ __('home.hero.join_as_tutor') }}
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('signup.show') }}" class="group bg-gray-900 dark:bg-white hover:bg-gray-800 dark:hover:bg-gray-100 text-white dark:text-gray-900 px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 elegant-shadow hover:shadow-2xl transform hover:-translate-y-1">
                    <span class="flex items-center">
                        {{ __('home.hero.start_learning') }}
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
                <a href="#features" class="group text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-10 py-5 rounded-2xl text-lg font-semibold border-2 border-gray-300 dark:border-gray-600 hover:border-gray-400 dark:hover:border-gray-400 transition-all duration-300 subtle-shadow hover:shadow-lg transform hover:-translate-y-1">
                    <span class="flex items-center">
                        {{ __('home.hero.learn_more') }}
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-6">{{ __('home.features.title') }}</h2>
                <div class="w-16 h-1 bg-gray-800 dark:bg-white mx-auto mb-6 rounded-full"></div>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto font-light leading-relaxed">
                    {{ __('home.features.subtitle') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.students.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.students.description') }}
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.tutors.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.tutors.description') }}
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.guardians.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.guardians.description') }}
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.security.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.security.description') }}
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.scheduling.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.scheduling.description') }}
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="feature-card group bg-white dark:bg-gray-700 rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ __('home.features.tracking.title') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        {{ __('home.features.tracking.description') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-8">{{ __('home.about.title') }}</h2>
                    <div class="w-16 h-1 bg-gray-800 dark:bg-white mb-8 rounded-full"></div>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 font-light leading-relaxed">
                        {{ __('home.about.description') }}
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-12 leading-relaxed">
                        {{ __('home.about.mission') }}
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">1000+</div>
                            <div class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.about.stats.students') }}</div>
                        </div>
                        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">500+</div>
                            <div class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.about.stats.tutors') }}</div>
                        </div>
                        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">50+</div>
                            <div class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.about.stats.subjects') }}</div>
                        </div>
                        <div class="text-center p-6 bg-white dark:bg-gray-800 rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 dark:text-white mb-2">98%</div>
                            <div class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.about.stats.satisfaction') }}</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl p-10 elegant-shadow border border-gray-100 dark:border-gray-700">
                        <h3 class="text-3xl font-semibold text-gray-900 dark:text-white mb-8">{{ __('home.about.how_it_works.title') }}</h3>
                        <div class="space-y-8">
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 dark:group-hover:bg-gray-100 transition-colors">1</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('home.about.how_it_works.step1.title') }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ __('home.about.how_it_works.step1.description') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 dark:group-hover:bg-gray-100 transition-colors">2</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('home.about.how_it_works.step2.title') }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ __('home.about.how_it_works.step2.description') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 dark:bg-white text-white dark:text-gray-900 rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 dark:group-hover:bg-gray-100 transition-colors">3</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('home.about.how_it_works.step3.title') }}</h4>
                                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ __('home.about.how_it_works.step3.description') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gray-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 100px 100px;"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">{{ __('home.cta.title') }}</h2>
            <div class="w-24 h-1 bg-white mx-auto mb-8 rounded-full"></div>
            <p class="text-xl sm:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto font-light leading-relaxed">
                {{ __('home.cta.subtitle') }}
            </p>
            <a href="{{ route('signup.show') }}" class="group inline-flex items-center bg-white text-gray-900 hover:bg-gray-100 px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 elegant-shadow hover:shadow-2xl transform hover:-translate-y-1">
                <span>{{ __('home.cta.get_started') }}</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-6">{{ __('home.contact.title') }}</h2>
                <div class="w-16 h-1 bg-gray-800 dark:bg-white mx-auto mb-6 rounded-full"></div>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto font-light leading-relaxed">
                    {{ __('home.contact.subtitle') }}
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-white dark:hover:bg-gray-600 subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('home.contact.email') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.contact.email_address') }}</p>
                </div>
                
                <div class="group text-center p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-white dark:hover:bg-gray-600 subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('home.contact.phone') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.contact.phone_number') }}</p>
                </div>
                
                <div class="group text-center p-8 bg-gray-50 dark:bg-gray-700 rounded-2xl hover:bg-white dark:hover:bg-gray-600 subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100 dark:border-gray-600">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-600 group-hover:bg-gray-200 dark:group-hover:bg-gray-500 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">{{ __('home.contact.address') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 font-medium">{{ __('home.contact.physical_address') }}</p>
                </div>
            </div>
        </div>
    </section>

@endsection
