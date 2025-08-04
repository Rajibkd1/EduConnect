@extends('layouts.app')

@section('title', __('profile.title'))

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Enhanced Header with Gradient Background -->
        <div class="relative bg-gradient-to-r from-indigo-600 via-blue-600 to-purple-600 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60"
                viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg
                fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"
                /%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

            <div class="relative px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-6 sm:space-y-0 sm:space-x-8">
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

                        <!-- Enhanced Profile Image and User Info -->
                        <div class="flex items-center space-x-6 flex-1">
                            <!-- Profile Image with Glow Effect -->
                            <div class="relative flex-shrink-0">
                                @if ($profile && $profile->profile_image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture"
                                            class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-white shadow-2xl ring-4 ring-white/20">
                                        <div
                                            class="absolute inset-0 rounded-full bg-gradient-to-tr from-transparent via-white/20 to-transparent">
                                        </div>
                                    </div>
                                @else
                                    <div class="relative">
                                        <div
                                            class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gradient-to-br from-white/90 to-white/70 border-4 border-white shadow-2xl ring-4 ring-white/20 flex items-center justify-center backdrop-blur-sm">
                                            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-indigo-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="absolute inset-0 rounded-full bg-gradient-to-tr from-transparent via-white/30 to-transparent">
                                        </div>
                                    </div>
                                @endif

                                <!-- Status Indicator -->
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 border-3 border-white rounded-full shadow-lg flex items-center justify-center">
                                    <div class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></div>
                                </div>
                            </div>

                            <!-- Enhanced User Info -->
                            <div class="flex-1 min-w-0 text-white">
                                <h1
                                    class="text-3xl sm:text-4xl font-bold truncate mb-2 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                                    {{ $user->name }}
                                </h1>
                                <div class="flex items-center space-x-3 mb-3">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white backdrop-blur-sm border border-white/30">
                                        @if ($user->user_type === 'student')
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                            </svg>
                                        @elseif($user->user_type === 'tutor')
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 5a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm0 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                        {{ ucfirst($user->user_type) }}
                                    </span>
                                    @if ($user->user_type === 'tutor' && $profile && isset($tutorSubjects) && count($tutorSubjects) > 0)
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-400/20 text-yellow-100 backdrop-blur-sm border border-yellow-400/30">
                                            {{ count($tutorSubjects) }} Subject{{ count($tutorSubjects) > 1 ? 's' : '' }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-blue-100 text-sm sm:text-base flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('profile.member_since', ['date' => $user->created_at->format('F j, Y')]) }}
                                </p>
                            </div>
                        </div>

                        <!-- Enhanced Edit Button -->
                        <div class="flex-shrink-0 w-full sm:w-auto">
                            <button id="edit-profile-btn"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl text-sm font-medium text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                {{ __('profile.edit_profile') }}
                            </button>

                            <button id="cancel-edit-btn" style="display: none;"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-red-500/10 backdrop-blur-sm border border-red-400/20 rounded-xl text-sm font-medium text-white hover:bg-red-500/20 focus:outline-none focus:ring-2 focus:ring-red-400/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ __('profile.cancel') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="px-4 sm:px-6 lg:px-8 pt-6">
                <div class="max-w-7xl mx-auto">
                    <div
                        class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 shadow-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Profile Form -->
        <div class="px-4 sm:px-6 lg:px-8 py-6">
            <div class="max-w-7xl mx-auto">
                <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Enhanced Basic Information Card -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 mb-6 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ __('profile.basic_info.title') }}
                            </h2>
                            <p class="text-indigo-100 text-sm mt-1">{{ __('profile.basic_info.description') }}</p>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Profile Picture -->
                            <div class="flex items-center space-x-6">
                                <div class="flex-shrink-0">
                                    @if ($profile && $profile->profile_image)
                                        <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture"
                                            class="w-20 h-20 rounded-full object-cover border-4 border-indigo-200 shadow-lg">
                                    @else
                                        <div
                                            class="w-20 h-20 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 border-4 border-indigo-200 shadow-lg flex items-center justify-center">
                                            <svg class="w-10 h-10 text-indigo-400" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('profile.basic_info.profile_picture') }}
                                    </label>
                                    <input type="file" id="profile_image" name="profile_image" accept="image/*"
                                        disabled
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    <p class="text-xs text-gray-500 mt-2">{{ __('profile.basic_info.profile_picture_help') }}</p>
                                </div>
                            </div>

                            <!-- Full Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('profile.basic_info.full_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" readonly
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Phone Number -->
                                <div>
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('profile.basic_info.phone_number') }}
                                    </label>
                                    <input type="tel" id="phone_number" name="phone_number"
                                        value="{{ $profile->phone_number ?? '' }}" readonly
                                        placeholder="{{ __('profile.basic_info.phone_placeholder') }}"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                                </div>

                                <!-- Account Type -->
                                <div>
                                    <label for="user_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('profile.basic_info.account_type') }}
                                    </label>
                                    <input type="text" id="user_type" value="{{ ucfirst($user->user_type) }}"
                                        readonly
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-500 bg-gray-100 cursor-not-allowed">
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('profile.basic_info.email_address') }}
                                </label>
                                <div class="relative">
                                    <input type="email" id="email" name="email" value="{{ $user->email }}"
                                        readonly
                                        class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl text-gray-500 bg-gray-100 cursor-not-allowed">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">{{ __('profile.basic_info.email_locked') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- User Type Specific Information -->
                    @if ($user->user_type === 'student')
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 mb-6 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-6 py-4">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                    </svg>
                                    {{ __('profile.student_info.title') }}
                                </h2>
                                <p class="text-blue-100 text-sm mt-1">{{ __('profile.student_info.description') }}</p>
                            </div>

                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Birth Date -->
                                    <div>
                                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.student_info.birth_date') }}
                                        </label>
                                        <input type="date" id="birth_date" name="birth_date"
                                            value="{{ $profile->birth_date ?? '' }}" readonly
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    </div>

                                    <!-- Educational Level -->
                                    <div>
                                        <label for="educational_level"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.student_info.educational_level') }}
                                        </label>
                                        <input type="text" id="educational_level" name="educational_level"
                                            value="{{ $profile->educational_level ?? '' }}" readonly
                                            placeholder="{{ __('profile.student_info.educational_level_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Current Study Class -->
                                    <div>
                                        <label for="current_study_class"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.student_info.current_study_class') }}
                                        </label>
                                        <input type="text" id="current_study_class" name="current_study_class"
                                            value="{{ $profile->current_study_class ?? '' }}" readonly
                                            placeholder="{{ __('profile.student_info.current_study_class_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    </div>

                                    <!-- School/College Name -->
                                    <div>
                                        <label for="school_college_name"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.student_info.school_college_name') }}
                                        </label>
                                        <input type="text" id="school_college_name" name="school_college_name"
                                            value="{{ $profile->school_college_name ?? '' }}" readonly
                                            placeholder="{{ __('profile.student_info.school_college_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ __('profile.student_info.address') }}
                                    </label>
                                    <textarea id="address" name="address" rows="3" readonly placeholder="{{ __('profile.student_info.address_placeholder') }}"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none">{{ $profile->address ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @elseif($user->user_type === 'tutor')
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 mb-6 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-500 to-pink-600 px-6 py-4">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ __('profile.tutor_info.title') }}
                                </h2>
                                <p class="text-purple-100 text-sm mt-1">{{ __('profile.tutor_info.description') }}</p>
                            </div>

                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- University Name -->
                                    <div>
                                        <label for="university_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.tutor_info.university_name') }}
                                        </label>
                                        <input type="text" id="university_name" name="university_name"
                                            value="{{ $profile->university_name ?? '' }}" readonly
                                            placeholder="{{ __('profile.tutor_info.university_name_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    </div>

                                    <!-- University ID -->
                                    <div>
                                        <label for="university_id" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.tutor_info.university_id') }}
                                        </label>
                                        <input type="text" id="university_id" name="university_id"
                                            value="{{ $profile->university_id ?? '' }}" readonly
                                            placeholder="{{ __('profile.tutor_info.university_id_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Department -->
                                    <div>
                                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.tutor_info.department') }}
                                        </label>
                                        <input type="text" id="department" name="department"
                                            value="{{ $profile->department ?? '' }}" readonly
                                            placeholder="{{ __('profile.tutor_info.department_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    </div>

                                    <!-- Semester -->
                                    <div>
                                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('profile.tutor_info.semester') }}
                                        </label>
                                        <input type="text" id="semester" name="semester"
                                            value="{{ $profile->semester ?? '' }}" readonly
                                            placeholder="{{ __('profile.tutor_info.semester_placeholder') }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        Address
                                    </label>
                                    <textarea id="address" name="address" rows="3" readonly placeholder="Your full address"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 resize-none">{{ $profile->address ?? '' }}</textarea>
                                </div>

                                <!-- University ID Image -->
                                <div>
                                    <label for="university_id_image" class="block text-sm font-medium text-gray-700 mb-2">
                                        University ID Image
                                    </label>
                                    <input type="file" id="university_id_image" name="university_id_image"
                                        accept="image/*" disabled
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100">
                                    <p class="text-xs text-gray-500 mt-2">Upload your university ID card image for
                                        verification</p>
                                </div>

                                <!-- Enhanced Subjects Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        <span class="flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Subjects You Want to Teach
                                            <span class="text-red-500 ml-1">*</span>
                                        </span>
                                    </label>
                                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 border-2 border-purple-200 rounded-xl p-4"
                                        id="subjects-container">
                                        @if (isset($subjects) && count($subjects) > 0)
                                            <div
                                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 max-h-64 overflow-y-auto">
                                                @foreach ($subjects as $subject)
                                                    <div class="subject-item group">
                                                        <label for="subject_{{ $subject->id }}"
                                                            class="flex items-center p-3 bg-white border-2 border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 cursor-pointer group-hover:shadow-md">
                                                            <input type="checkbox" id="subject_{{ $subject->id }}"
                                                                name="subjects[]" value="{{ $subject->id }}"
                                                                {{ isset($tutorSubjects) && in_array($subject->id, $tutorSubjects) ? 'checked' : '' }}
                                                                disabled
                                                                class="subject-checkbox mr-3 h-5 w-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded transition-colors">
                                                            <div class="flex-1">
                                                                <span
                                                                    class="text-sm font-medium text-gray-800 group-hover:text-purple-700">
                                                                    {{ $subject->name }}
                                                                </span>
                                                                @if ($subject->description)
                                                                    <p class="text-xs text-gray-500 mt-1">
                                                                        {{ $subject->description }}</p>
                                                                @endif
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="text-center py-8">
                                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                                <p class="text-sm text-gray-500">No subjects available. Please contact
                                                    administrator.</p>
                                            </div>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-purple-400" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Select the subjects you are qualified to teach. You can select multiple subjects.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif($user->user_type === 'guardian')
                        <div
                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 mb-6 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-500 to-teal-600 px-6 py-4">
                                <h2 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 5a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1zm0 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Guardian Information
                                </h2>
                                <p class="text-green-100 text-sm mt-1">Information about your child and family details</p>
                            </div>

                            <div class="p-6 space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Child Name -->
                                    <div>
                                        <label for="child_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Child Name
                                        </label>
                                        <input type="text" id="child_name" name="child_name"
                                            value="{{ $profile->child_name ?? '' }}" readonly
                                            placeholder="Your child's name"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                    </div>

                                    <!-- Child Birth Date -->
                                    <div>
                                        <label for="child_birthdate" class="block text-sm font-medium text-gray-700 mb-2">
                                            Child Birth Date
                                        </label>
                                        <input type="date" id="child_birthdate" name="child_birthdate"
                                            value="{{ $profile->child_birthdate ?? '' }}" readonly
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Current Class -->
                                    <div>
                                        <label for="current_class" class="block text-sm font-medium text-gray-700 mb-2">
                                            Current Class
                                        </label>
                                        <input type="text" id="current_class" name="current_class"
                                            value="{{ $profile->current_class ?? '' }}" readonly
                                            placeholder="e.g., Grade 12, Year 2, etc."
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                    </div>

                                    <!-- School/College Name -->
                                    <div>
                                        <label for="school_college_name"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            School/College Name
                                        </label>
                                        <input type="text" id="school_college_name" name="school_college_name"
                                            value="{{ $profile->school_college_name ?? '' }}" readonly
                                            placeholder="Your child's institution name"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        Address
                                    </label>
                                    <textarea id="address" name="address" rows="3" readonly placeholder="Your full address"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl text-gray-900 bg-gray-50 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 resize-none">{{ $profile->address ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Enhanced Action Buttons -->
                    <div id="action-buttons"
                        class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-4"
                        style="display: none;">
                        <button type="button" id="cancel-btn"
                            class="w-full sm:w-auto px-8 py-3 bg-white border-2 border-gray-300 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Cancel
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border-2 border-transparent rounded-xl text-sm font-medium text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editBtn = document.getElementById('edit-profile-btn');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const cancelBtn = document.getElementById('cancel-btn');
            const actionButtons = document.getElementById('action-buttons');
            const form = document.getElementById('profile-form');

            // Get all form inputs except email and user_type
            const readonlyInputs = form.querySelectorAll(
                'input[readonly]:not(#email):not(#user_type), textarea[readonly]');
            const fileInputs = form.querySelectorAll('input[type="file"]');
            const subjectCheckboxes = form.querySelectorAll('.subject-checkbox');

            function enableEditMode() {
                // Show cancel button and action buttons
                editBtn.style.display = 'none';
                cancelEditBtn.style.display = 'inline-flex';
                actionButtons.style.display = 'flex';

                // Enable readonly inputs (except email and user_type)
                readonlyInputs.forEach(input => {
                    input.removeAttribute('readonly');
                    input.classList.remove('bg-gray-50', 'cursor-not-allowed');
                    input.classList.add('bg-white');
                });

                // Enable file inputs
                fileInputs.forEach(input => {
                    input.removeAttribute('disabled');
                    input.classList.remove('bg-gray-50');
                    input.classList.add('bg-white');
                });

                // Enable subject checkboxes
                subjectCheckboxes.forEach(checkbox => {
                    checkbox.removeAttribute('disabled');
                });

                // Add visual feedback for edit mode
                const cards = document.querySelectorAll('.bg-white\\/80');
                cards.forEach(card => {
                    card.classList.add('ring-2', 'ring-indigo-200', 'ring-opacity-50');
                });
            }

            function disableEditMode() {
                // Show edit button and hide others
                editBtn.style.display = 'inline-flex';
                cancelEditBtn.style.display = 'none';
                actionButtons.style.display = 'none';

                // Disable inputs
                readonlyInputs.forEach(input => {
                    input.setAttribute('readonly', 'readonly');
                    input.classList.add('bg-gray-50');
                    input.classList.remove('bg-white');
                });

                // Disable file inputs
                fileInputs.forEach(input => {
                    input.setAttribute('disabled', 'disabled');
                    input.classList.add('bg-gray-50');
                    input.classList.remove('bg-white');
                });

                // Disable subject checkboxes
                subjectCheckboxes.forEach(checkbox => {
                    checkbox.setAttribute('disabled', 'disabled');
                });

                // Remove visual feedback for edit mode
                const cards = document.querySelectorAll('.bg-white\\/80');
                cards.forEach(card => {
                    card.classList.remove('ring-2', 'ring-indigo-200', 'ring-opacity-50');
                });

                // Reset form to original values
                form.reset();
            }

            // Event listeners
            editBtn.addEventListener('click', enableEditMode);
            cancelEditBtn.addEventListener('click', disableEditMode);
            cancelBtn.addEventListener('click', disableEditMode);

            // Add smooth animations for subject checkboxes
            subjectCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const label = this.closest('label');
                    if (this.checked) {
                        label.classList.add('bg-purple-100', 'border-purple-400', 'shadow-md');
                        label.classList.remove('bg-white', 'border-gray-200');
                    } else {
                        label.classList.remove('bg-purple-100', 'border-purple-400', 'shadow-md');
                        label.classList.add('bg-white', 'border-gray-200');
                    }
                });
            });
        });
    </script>
@endsection
