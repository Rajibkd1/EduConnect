@extends('layouts.app')

@section('title', __('create_sessions.title'))

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">{{ __('create_sessions.page_title') }}</h1>
            <p class="text-gray-600">{{ __('create_sessions.page_description') }}</p>
        </div>
        
        <div class="p-6">
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-indigo-50 rounded-lg p-6 text-center">
                    <div class="bg-indigo-100 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('create_sessions.quick_actions.create_new.title') }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ __('create_sessions.quick_actions.create_new.description') }}</p>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        {{ __('create_sessions.quick_actions.create_new.button') }}
                    </button>
                </div>
                
                <div class="bg-green-50 rounded-lg p-6 text-center">
                    <div class="bg-green-100 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('create_sessions.quick_actions.set_availability.title') }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ __('create_sessions.quick_actions.set_availability.description') }}</p>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        {{ __('create_sessions.quick_actions.set_availability.button') }}
                    </button>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-6 text-center">
                    <div class="bg-purple-100 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('create_sessions.quick_actions.bulk_sessions.title') }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ __('create_sessions.quick_actions.bulk_sessions.description') }}</p>
                    <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        {{ __('create_sessions.quick_actions.bulk_sessions.button') }}
                    </button>
                </div>
            </div>
            
            <!-- Create Session Form -->
            <div class="max-w-2xl">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">{{ __('create_sessions.form.title') }}</h2>
                    
                    <form class="space-y-6">
                        <!-- Session Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.subject') }}</label>
                                <select id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('create_sessions.form.select_subject') }}</option>
                                    <option value="mathematics">Mathematics</option>
                                    <option value="physics">Physics</option>
                                    <option value="chemistry">Chemistry</option>
                                    <option value="biology">Biology</option>
                                    <option value="english">English</option>
                                    <option value="history">History</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.level') }}</label>
                                <select id="level" name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">{{ __('create_sessions.form.select_level') }}</option>
                                    <option value="elementary">{{ __('create_sessions.levels.elementary') }}</option>
                                    <option value="middle">{{ __('create_sessions.levels.middle') }}</option>
                                    <option value="high">{{ __('create_sessions.levels.high') }}</option>
                                    <option value="college">{{ __('create_sessions.levels.college') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Date and Time -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.date') }}</label>
                                <input type="date" id="date" name="date" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.start_time') }}</label>
                                <input type="time" id="start_time" name="start_time" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.duration') }}</label>
                                <select id="duration" name="duration" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="30">{{ __('create_sessions.durations.30') }}</option>
                                    <option value="60" selected>{{ __('create_sessions.durations.60') }}</option>
                                    <option value="90">{{ __('create_sessions.durations.90') }}</option>
                                    <option value="120">{{ __('create_sessions.durations.120') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Pricing and Capacity -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.price_per_hour') }}</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="{{ __('create_sessions.form.price_placeholder') }}">
                            </div>
                            
                            <div>
                                <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.max_students') }}</label>
                                <select id="max_students" name="max_students" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="1" selected>{{ __('create_sessions.max_students_options.1') }}</option>
                                    <option value="2">{{ __('create_sessions.max_students_options.2') }}</option>
                                    <option value="3">{{ __('create_sessions.max_students_options.3') }}</option>
                                    <option value="4">{{ __('create_sessions.max_students_options.4') }}</option>
                                    <option value="5">{{ __('create_sessions.max_students_options.5') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Session Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">{{ __('create_sessions.form.session_type') }}</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="session_type" value="online" class="text-indigo-600 focus:ring-indigo-500" checked>
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-900">{{ __('create_sessions.form.online_session') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ __('create_sessions.form.online_description') }}</p>
                                    </div>
                                </label>
                                
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="session_type" value="in_person" class="text-indigo-600 focus:ring-indigo-500">
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-900">{{ __('create_sessions.form.in_person') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ __('create_sessions.form.in_person_description') }}</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.session_description') }}</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="{{ __('create_sessions.form.description_placeholder') }}"></textarea>
                        </div>
                        
                        <!-- Prerequisites -->
                        <div>
                            <label for="prerequisites" class="block text-sm font-medium text-gray-700 mb-2">{{ __('create_sessions.form.prerequisites') }}</label>
                            <input type="text" id="prerequisites" name="prerequisites" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="{{ __('create_sessions.form.prerequisites_placeholder') }}">
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                                {{ __('create_sessions.form.save_draft') }}
                            </button>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                {{ __('create_sessions.form.create_session') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Recent Sessions -->
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">{{ __('create_sessions.recent_sessions.title') }}</h2>
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                    </svg>
                    <p class="text-gray-500">{{ __('create_sessions.recent_sessions.no_sessions') }}</p>
                    <p class="text-sm text-gray-400 mt-2">{{ __('create_sessions.recent_sessions.sessions_appear_here') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
