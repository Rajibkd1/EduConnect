@extends('layouts.app')

@section('title', __('pages.dashboard.title') . ' - ' . __('navigation.educonnect'))

@section('content')
    <!-- Main Content Area with Clean Background -->
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="p-4 sm:p-6">
            <!-- Welcome Header -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ __('pages.dashboard.welcome', ['name' => auth()->user()->name]) }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base">
                    {{ __('ui.dashboard_overview', ['type' => ucfirst(auth()->user()->user_type)]) }}</p>
            </div>

            <!-- Enhanced User Info Card - Mobile Responsive -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl p-4 sm:p-6 lg:p-8 shadow-lg border border-gray-200 dark:border-gray-700 mb-6 sm:mb-8 relative overflow-hidden">
                <!-- Subtle background pattern -->
                <div
                    class="absolute top-0 right-0 w-20 h-20 sm:w-32 sm:h-32 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-full -translate-y-10 translate-x-10 sm:-translate-y-16 sm:translate-x-16 opacity-50">
                </div>

                <div class="relative z-10">
                    <!-- Mobile Layout (Stack vertically) -->
                    <div class="flex flex-col space-y-4 sm:hidden">
                        <div class="flex items-center space-x-4">
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
                                @if ($profile && $profile->profile_image)
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture"
                                        class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full p-4 shadow-lg">
                                        <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Enhanced online status indicator -->
                                <div
                                    class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-3 border-white rounded-full shadow-lg">
                                    <div class="w-full h-full bg-green-400 rounded-full animate-ping opacity-75"></div>
                                </div>
                            </div>

                            <div class="flex-1">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-1">
                                    {{ auth()->user()->name }}</h2>
                                <div class="flex items-center mb-1">
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-700">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        {{ ucfirst(auth()->user()->user_type) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-xs flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v4m0-4H4m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    {{ __('dashboard.member_since', ['date' => auth()->user()->created_at->format('M j, Y')]) }}
                                </p>
                            </div>
                        </div>

                        <!-- Time card for mobile -->
                        <div class="flex justify-center">
                            <div
                                class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg p-3 border border-blue-200 shadow-sm">
                                @php
                                    $dhakaTime = now()->setTimezone('Asia/Dhaka');
                                @endphp
                                <div class="text-xl font-bold text-gray-900 mb-1 text-center">
                                    {{ $dhakaTime->format('h:i A') }}</div>
                                <div class="text-gray-600 text-sm text-center">{{ $dhakaTime->format('M j, Y') }}</div>
                                <div class="text-xs text-blue-600 mt-1 text-center">{{ __('dashboard.dhaka_bangladesh') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Desktop Layout (Side by side) -->
                    <div class="hidden sm:flex items-center justify-between">
                        <div class="flex items-center space-x-4 lg:space-x-6">
                            <div class="relative">
                                @if ($profile && $profile->profile_image)
                                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture"
                                        class="w-16 h-16 lg:w-20 lg:h-20 rounded-full object-cover border-4 border-white shadow-lg">
                                @else
                                    <div
                                        class="bg-gradient-to-br from-gray-100 to-gray-200 rounded-full p-4 lg:p-5 shadow-lg">
                                        <svg class="w-8 h-8 lg:w-10 lg:h-10 text-gray-600" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Enhanced online status indicator -->
                                <div
                                    class="absolute -bottom-1 -right-1 w-5 h-5 lg:w-6 lg:h-6 bg-green-500 border-4 border-white rounded-full shadow-lg">
                                    <div class="w-full h-full bg-green-400 rounded-full animate-ping opacity-75"></div>
                                </div>
                            </div>

                            <div>
                                <h2 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-1 lg:mb-2">
                                    {{ auth()->user()->name }}</h2>
                                <div class="flex items-center space-x-3 mb-1 lg:mb-2">
                                    <span
                                        class="inline-flex items-center px-2 lg:px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-700">
                                        <svg class="w-4 h-4 mr-1 lg:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        {{ ucfirst(auth()->user()->user_type) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v4m0-4H4m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    {{ __('dashboard.member_since', ['date' => auth()->user()->created_at->format('F j, Y')]) }}
                                </p>
                            </div>
                        </div>

                        <div class="text-right">
                            <div
                                class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-xl p-3 lg:p-4 border border-blue-200 shadow-sm">
                                @php
                                    $dhakaTime = now()->setTimezone('Asia/Dhaka');
                                @endphp
                                <div class="text-xl lg:text-2xl font-bold text-gray-900 mb-1">
                                    {{ $dhakaTime->format('h:i A') }}</div>
                                <div class="text-gray-600 text-sm">{{ $dhakaTime->format('M j, Y') }}</div>
                                <div class="text-xs text-blue-600 mt-1">{{ __('dashboard.dhaka_bangladesh') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @if (auth()->user()->isTutor())
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.upcoming_sessions') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-blue-600 dark:bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-green-100 dark:bg-green-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.completed_sessions') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-green-600 dark:bg-green-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 dark:bg-indigo-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                    </path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.total_earnings') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">$0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-indigo-600 dark:bg-indigo-500 h-2 rounded-full" style="width: 0%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-blue-100 dark:bg-blue-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.upcoming_sessions') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-blue-600 dark:bg-blue-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-green-100 dark:bg-green-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.completed_sessions') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-green-600 dark:bg-green-500 h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-center">
                            <div class="bg-orange-100 dark:bg-orange-900 rounded-lg p-3">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-1">
                                    {{ __('dashboard.stats.available_tutors') }}</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">0</p>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                                    <div class="bg-orange-600 dark:bg-orange-500 h-2 rounded-full" style="width: 0%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('dashboard.activity.title') }}</h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('dashboard.activity.live_updates') }}</span>
                    </div>
                </div>

                <div class="text-center py-12">
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-full p-6 w-20 h-20 mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('dashboard.activity.no_activity') }}</h4>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">{{ __('dashboard.activity.activity_description') }}</p>

                    @if (auth()->user()->user_type === 'student')
                        <a href="{{ route('search-tutor') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            {{ __('dashboard.activity.find_tutor') }}
                        </a>
                    @else
                        <a href="{{ route('profile.show') }}"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('dashboard.activity.complete_profile') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
