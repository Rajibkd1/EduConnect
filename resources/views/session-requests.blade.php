@extends('layouts.app')

@section('title', __('session_requests.title'))

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('session_requests.session_requests') }}</h1>
            <p class="text-gray-600 dark:text-gray-300">{{ __('session_requests.manage_requests') }}</p>
        </div>
        
        <div class="p-6">
            <!-- Request Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-yellow-100 dark:bg-yellow-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-600 dark:text-yellow-400">{{ __('session_requests.stats.pending') }}</p>
                            <p class="text-lg font-semibold text-yellow-900 dark:text-yellow-300">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-green-100 dark:bg-green-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ __('session_requests.stats.accepted') }}</p>
                            <p class="text-lg font-semibold text-green-900 dark:text-green-300">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-red-50 dark:bg-red-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-red-100 dark:bg-red-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-600 dark:text-red-400">{{ __('session_requests.stats.declined') }}</p>
                            <p class="text-lg font-semibold text-red-900 dark:text-red-300">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <div class="flex items-center">
                        <div class="bg-blue-100 dark:bg-blue-800 rounded-lg p-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                        </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">{{ __('session_requests.stats.total_requests') }}</p>
                            <p class="text-lg font-semibold text-blue-900 dark:text-blue-300">0</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Filter Tabs -->
            <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <button class="border-b-2 border-indigo-500 text-indigo-600 py-2 px-1 text-sm font-medium">
                        {{ __('session_requests.tabs.pending_requests') }}
                    </button>
                    <button class="border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 py-2 px-1 text-sm font-medium">
                        {{ __('session_requests.tabs.accepted') }}
                    </button>
                    <button class="border-b-2 border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600 py-2 px-1 text-sm font-medium">
                        {{ __('session_requests.tabs.all_requests') }}
                    </button>
                </nav>
            </div>
            
            <!-- Requests List -->
            <div class="space-y-4">
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">{{ __('session_requests.empty_state.title') }}</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-4">{{ __('session_requests.empty_state.description') }}</p>
                    <a href="{{ route('profile') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        {{ __('session_requests.empty_state.update_profile') }}
                    </a>
                </div>
                
                <!-- Sample Request Card (Hidden by default) -->
                <div class="hidden bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-6 hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 dark:bg-indigo-800 rounded-full p-3">
                                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ __('session_requests.request_card.mathematics_request') }}</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ __('session_requests.request_card.from_student', ['student' => 'Sarah Johnson']) }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('session_requests.request_card.requested_time', ['time' => '2 hours']) }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 text-sm rounded-full">{{ __('session_requests.request_card.pending_status') }}</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                                {{ __('session_requests.request_card.subject', ['subject' => 'Algebra']) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                </svg>
                                {{ __('session_requests.request_card.level', ['level' => 'High School']) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('session_requests.request_card.duration', ['duration' => '1 hour']) }}
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                                </svg>
                                {{ __('session_requests.request_card.preferred_date', ['date' => 'Jan 20, 2024']) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('session_requests.request_card.time', ['time' => '3:00 PM - 4:00 PM']) }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                {{ __('session_requests.request_card.rate', ['rate' => '$35/hour']) }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('session_requests.request_card.student_message') }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-gray-600 rounded-lg p-3">
                            "{{ __('session_requests.request_card.sample_message') }}"
                        </p>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                            {{ __('session_requests.request_card.view_profile') }}
                        </button>
                        <button class="px-4 py-2 text-red-700 dark:text-red-300 bg-red-100 dark:bg-red-900/30 rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-colors">
                            {{ __('session_requests.request_card.decline') }}
                        </button>
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            {{ __('session_requests.request_card.accept_request') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
