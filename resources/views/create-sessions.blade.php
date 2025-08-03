@extends('layouts.app')

@section('title', 'Create Sessions - EduConnect')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Create Sessions</h1>
            <p class="text-gray-600">Set up your availability and create tutoring sessions</p>
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
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Create New Session</h3>
                    <p class="text-gray-600 text-sm mb-4">Schedule a one-time tutoring session</p>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Create Session
                    </button>
                </div>
                
                <div class="bg-green-50 rounded-lg p-6 text-center">
                    <div class="bg-green-100 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Set Availability</h3>
                    <p class="text-gray-600 text-sm mb-4">Define your weekly availability</p>
                    <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Set Schedule
                    </button>
                </div>
                
                <div class="bg-purple-50 rounded-lg p-6 text-center">
                    <div class="bg-purple-100 rounded-full p-4 w-16 h-16 mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Bulk Sessions</h3>
                    <p class="text-gray-600 text-sm mb-4">Create multiple sessions at once</p>
                    <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Bulk Create
                    </button>
                </div>
            </div>
            
            <!-- Create Session Form -->
            <div class="max-w-2xl">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-6">Create New Session</h2>
                    
                    <form class="space-y-6">
                        <!-- Session Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <select id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Subject</option>
                                    <option value="mathematics">Mathematics</option>
                                    <option value="physics">Physics</option>
                                    <option value="chemistry">Chemistry</option>
                                    <option value="biology">Biology</option>
                                    <option value="english">English</option>
                                    <option value="history">History</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                                <select id="level" name="level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select Level</option>
                                    <option value="elementary">Elementary</option>
                                    <option value="middle">Middle School</option>
                                    <option value="high">High School</option>
                                    <option value="college">College</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Date and Time -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" id="date" name="date" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                                <input type="time" id="start_time" name="start_time" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration</label>
                                <select id="duration" name="duration" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="30">30 minutes</option>
                                    <option value="60" selected>1 hour</option>
                                    <option value="90">1.5 hours</option>
                                    <option value="120">2 hours</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Pricing and Capacity -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price per Hour ($)</label>
                                <input type="number" id="price" name="price" min="0" step="0.01" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="35.00">
                            </div>
                            
                            <div>
                                <label for="max_students" class="block text-sm font-medium text-gray-700 mb-2">Max Students</label>
                                <select id="max_students" name="max_students" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="1" selected>1 (Individual)</option>
                                    <option value="2">2 students</option>
                                    <option value="3">3 students</option>
                                    <option value="4">4 students</option>
                                    <option value="5">5 students</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Session Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Session Type</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="session_type" value="online" class="text-indigo-600 focus:ring-indigo-500" checked>
                                    <div class="ml-3">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span class="font-medium text-gray-900">Online Session</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Video call via platform</p>
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
                                            <span class="font-medium text-gray-900">In-Person</span>
                                        </div>
                                        <p class="text-sm text-gray-500">Meet at agreed location</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Session Description</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Describe what will be covered in this session..."></textarea>
                        </div>
                        
                        <!-- Prerequisites -->
                        <div>
                            <label for="prerequisites" class="block text-sm font-medium text-gray-700 mb-2">Prerequisites (Optional)</label>
                            <input type="text" id="prerequisites" name="prerequisites" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Basic algebra knowledge, calculator required...">
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                                Save as Draft
                            </button>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                Create Session
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Recent Sessions -->
            <div class="mt-8">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Sessions</h2>
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4a1 1 0 001 1h2a1 1 0 011 1v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a1 1 0 011-1h2a1 1 0 001-1z"></path>
                    </svg>
                    <p class="text-gray-500">No sessions created yet</p>
                    <p class="text-sm text-gray-400 mt-2">Your created sessions will appear here</p>
                </div>
            </div>
        </div>
    </div>
@endsection
