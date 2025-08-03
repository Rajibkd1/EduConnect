@extends('layouts.app')

@section('title', 'Search Tutor - EduConnect')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Search Tutors</h1>
            <p class="text-gray-600">Find the perfect tutor for your learning needs</p>
        </div>
        
        <div class="p-6">
            <!-- Search Filters -->
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <form class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <select id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Subjects</option>
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
                                <option value="">All Levels</option>
                                <option value="elementary">Elementary</option>
                                <option value="middle">Middle School</option>
                                <option value="high">High School</option>
                                <option value="college">College</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">Price Range</label>
                            <select id="price_range" name="price_range" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Any Price</option>
                                <option value="0-25">$0 - $25/hour</option>
                                <option value="25-50">$25 - $50/hour</option>
                                <option value="50-100">$50 - $100/hour</option>
                                <option value="100+">$100+/hour</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Available now</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-700">Verified tutors only</span>
                            </label>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Search
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Search Results -->
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Available Tutors</h2>
                    <p class="text-sm text-gray-500">0 tutors found</p>
                </div>
                
                <!-- Empty State -->
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No tutors found</h3>
                    <p class="text-gray-500 mb-4">Try adjusting your search criteria to find more tutors.</p>
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Clear Filters
                    </button>
                </div>
                
                <!-- Sample Tutor Cards (Hidden by default) -->
                <div class="hidden grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-4">
                            <div class="bg-indigo-100 rounded-full p-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold text-gray-900">John Doe</h3>
                                <p class="text-sm text-gray-500">Mathematics Tutor</p>
                            </div>
                        </div>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                5+ years experience
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                $35/hour
                            </div>
                        </div>
                        
                        <div class="flex space-x-2 mb-4">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Algebra</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Calculus</span>
                        </div>
                        
                        <button class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            View Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
