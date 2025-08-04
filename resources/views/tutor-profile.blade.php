@extends('layouts.app')

@section('title', $tutor->user->name . ' - Tutor Profile - EduConnect')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Enhanced Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
            <div class="px-6 py-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('search-tutor') }}" class="text-white hover:text-indigo-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-white">Tutor Profile</h1>
                    </div>
                    <p class="text-indigo-100">Connect with {{ $tutor->user->name }} for personalized learning</p>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Tutor Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Profile Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                        <div class="flex items-start space-x-6 mb-6">
                            <div class="relative">
                                @if($tutor->profile_image)
                                    <img src="{{ asset('storage/' . $tutor->profile_image) }}" alt="{{ $tutor->user->name }}" 
                                         class="w-24 h-24 rounded-full object-cover border-4 border-indigo-200 shadow-lg">
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center border-4 border-indigo-200 shadow-lg">
                                        <svg class="w-12 h-12 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 border-2 border-white rounded-full"></div>
                            </div>
                            
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $tutor->user->name }}</h2>
                                <p class="text-lg text-gray-600 mb-1">{{ $tutor->university_name }}</p>
                                <p class="text-sm text-gray-500 mb-3">{{ $tutor->department }} • {{ $tutor->semester }} Semester</p>
                                
                                @if($tutor->rating > 0)
                                    <div class="flex items-center mb-3">
                                        <div class="flex items-center mr-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $tutor->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="text-gray-600 font-medium">{{ number_format($tutor->rating, 1) }} rating</span>
                                    </div>
                                @endif
                                
                                @if($tutor->experience_years)
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $tutor->experience_years }}+ years of teaching experience
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($tutor->bio)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">About Me</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $tutor->bio }}</p>
                            </div>
                        @endif
                        
                        @if($tutor->qualifications)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3">Qualifications</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $tutor->qualifications }}</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Subjects Card -->
                    @if($tutor->subjects->count() > 0)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Subjects I Teach
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach($tutor->subjects as $subject)
                                    <div class="bg-gradient-to-r from-indigo-100 to-purple-100 border border-indigo-200 rounded-lg p-3 text-center">
                                        <h4 class="font-semibold text-indigo-800 text-sm">{{ $subject->name }}</h4>
                                        @if($subject->description)
                                            <p class="text-xs text-indigo-600 mt-1">{{ $subject->description }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Right Column - Contact & Actions -->
                <div class="space-y-6">
                    <!-- Contact Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Contact Information</h3>
                        
                        <div class="space-y-4">
                            @if($tutor->phone_number)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <span class="text-gray-700">{{ $tutor->phone_number }}</span>
                                </div>
                            @endif
                            
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-700">{{ $tutor->user->email }}</span>
                            </div>
                            
                            @if($tutor->address)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-gray-700">{{ $tutor->address }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Get Started</h3>
                        
                        <div class="space-y-3">
                            <button class="w-full px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Send Message
                            </button>
                            
                            <button class="w-full px-6 py-3 bg-white border-2 border-indigo-200 text-indigo-600 rounded-xl hover:bg-indigo-50 hover:border-indigo-300 transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h6m-6 0l-.5 9a2 2 0 002 2h3a2 2 0 002-2L16 7m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1"/>
                                </svg>
                                Request Session
                            </button>
                            
                            <button class="w-full px-6 py-3 bg-white border-2 border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                Save to Favorites
                            </button>
                        </div>
                    </div>
                    
                    <!-- University ID Verification -->
                    @if($tutor->university_id_image)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Verified Tutor
                            </h3>
                            <p class="text-sm text-gray-600">This tutor has been verified with university credentials.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
