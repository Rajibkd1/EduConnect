@extends('layouts.app')

@section('title', __('sessions.title'))

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('sessions.my_sessions') }}</h1>
            <p class="text-gray-600 dark:text-gray-300">{{ __('sessions.manage_sessions') }}</p>
        </div>

        <div class="p-6">
            <!-- Session Tabs -->
            <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button class="border-b-2 border-indigo-500 text-indigo-600 py-2 px-1 text-sm font-medium">
                        {{ __('sessions.tabs.upcoming') }}
                    </button>
                    <button
                        class="border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 py-2 px-1 text-sm font-medium">
                        {{ __('sessions.tabs.completed') }}
                    </button>
                    <button
                        class="border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 py-2 px-1 text-sm font-medium">
                        {{ __('sessions.tabs.cancelled') }}
                    </button>
                </nav>
            </div>

            <!-- Session Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">{{ __('sessions.stats.upcoming') }}</p>
                            <p class="text-lg font-semibold text-blue-900 dark:text-blue-300">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ __('sessions.stats.completed') }}</p>
                            <p class="text-lg font-semibold text-green-900 dark:text-green-300">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 dark:bg-yellow-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-600 dark:text-yellow-400">{{ __('sessions.stats.pending') }}</p>
                            <p class="text-lg font-semibold text-yellow-900 dark:text-yellow-300">0</p>
                        </div>
                    </div>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-red-100 dark:bg-red-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-600 dark:text-red-400">{{ __('sessions.stats.cancelled') }}</p>
                            <p class="text-lg font-semibold text-red-900 dark:text-red-300">0</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sessions List -->
            <div class="space-y-4">
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('sessions.empty_state.title') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('sessions.empty_state.description') }}</p>
                    <a href="{{ route('search-tutor') }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        {{ __('sessions.empty_state.find_tutor') }}
                    </a>
                </div>

                <!-- Sample Session Card (Hidden by default) -->
                <div class="hidden bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 dark:bg-indigo-800 rounded-full p-3">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('sessions.session_card.mathematics_session') }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('sessions.session_card.with_tutor', ['tutor' => 'John Doe']) }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 text-sm rounded-full">{{ __('sessions.session_card.upcoming_status') }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z">
                                </path>
                            </svg>
                            Jan 15, 2024
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            2:00 PM - 3:00 PM
                        </div>
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                                </path>
                            </svg>
                            $35
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                            {{ __('sessions.session_card.reschedule') }}
                        </button>
                        <button class="px-4 py-2 text-red-700 dark:text-red-300 bg-red-100 dark:bg-red-900/30 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors">
                            {{ __('sessions.session_card.cancel') }}
                        </button>
                        <button
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            {{ __('sessions.session_card.join_session') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
