@extends('layouts.app')

@section('title', 'My Profile - EduConnect')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200">
            <div class="px-2 sm:px-4 lg:px-6 py-4 lg:py-6">
                <div class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
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

                    <!-- Profile Image and User Info Container -->
                    <div class="flex items-center space-x-4 flex-1">
                        <!-- Profile Image -->
                        <div class="relative flex-shrink-0">
                            @if ($profile && $profile->profile_image)
                                <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="Profile Picture"
                                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover border-4 border-white shadow-lg">
                            @else
                                <div
                                    class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gray-100 border-4 border-white shadow-lg flex items-center justify-center">
                                    <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- User Info -->
                        <div class="flex-1 min-w-0">
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 truncate">{{ $user->name }}</h1>
                            <p class="text-base sm:text-lg text-gray-600 mt-1">{{ ucfirst($user->user_type) }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1 sm:mt-2">Member since
                                {{ $user->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>

                    <!-- Edit Button -->
                    <div class="flex-shrink-0 w-full sm:w-auto">
                        <button id="edit-profile-btn"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Edit Profile
                        </button>

                        <button id="cancel-edit-btn" style="display: none;"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="px-2 sm:px-4 lg:px-6 pt-6">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="ml-3 text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Profile Form -->
        <div class="px-2 sm:px-4 lg:px-6 py-3">
            <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                    <div class="px-4 py-3 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Basic Information</h2>
                        <p class="text-sm text-gray-600 mt-1">Your account details and contact information</p>
                    </div>

                    <div class="p-4 space-y-4">
                        <!-- Profile Picture - Left Positioned -->
                        <div>
                            <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-2">
                                Profile Picture
                            </label>
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" disabled
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Upload a profile picture (JPG, PNG, GIF - Max 2MB)</p>
                        </div>

                        <!-- Full Name - Full Width -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}" readonly
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Phone Number - Left Position (Key Field) -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel" id="phone_number" name="phone_number"
                                    value="{{ $profile->phone_number ?? '' }}" readonly
                                    placeholder="Enter your phone number"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>

                            <!-- Account Type - Right Position -->
                            <div>
                                <label for="user_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Account Type
                                </label>
                                <input type="text" id="user_type" value="{{ ucfirst($user->user_type) }}" readonly
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-500 bg-gray-100 cursor-not-allowed">
                            </div>
                        </div>

                        <!-- Email Address (Non-editable) - Full Width -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-500 bg-gray-100 cursor-not-allowed">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Email cannot be changed for security reasons</p>
                        </div>
                    </div>
                </div>

                <!-- User Type Specific Information -->
                @if ($user->user_type === 'student')
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Student Information</h2>
                            <p class="text-sm text-gray-600 mt-1">Your academic details and educational background</p>
                        </div>

                        <div class="p-4 space-y-4">
                            <!-- Left Column Priority Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Birth Date - Left Position (Key Field) -->
                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Birth Date
                                    </label>
                                    <input type="date" id="birth_date" name="birth_date"
                                        value="{{ $profile->birth_date ?? '' }}" readonly
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- Educational Level - Right Position -->
                                <div>
                                    <label for="educational_level" class="block text-sm font-medium text-gray-700 mb-2">
                                        Educational Level
                                    </label>
                                    <input type="text" id="educational_level" name="educational_level"
                                        value="{{ $profile->educational_level ?? '' }}" readonly
                                        placeholder="e.g., High School, Undergraduate, etc."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Current Study Class - Left Position (Key Field) -->
                                <div>
                                    <label for="current_study_class" class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Study Class
                                    </label>
                                    <input type="text" id="current_study_class" name="current_study_class"
                                        value="{{ $profile->current_study_class ?? '' }}" readonly
                                        placeholder="e.g., Grade 12, Year 2, etc."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- School/College Name - Left Position (Key Field) -->
                                <div>
                                    <label for="school_college_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        School/College Name
                                    </label>
                                    <input type="text" id="school_college_name" name="school_college_name"
                                        value="{{ $profile->school_college_name ?? '' }}" readonly
                                        placeholder="Your institution name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <!-- Address - Full Width (Key Field) -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3" readonly placeholder="Your full address"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $profile->address ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                @elseif($user->user_type === 'tutor')
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Tutor Information</h2>
                            <p class="text-sm text-gray-600 mt-1">Your academic credentials and teaching details</p>
                        </div>

                        <div class="p-4 space-y-4">
                            <!-- Left Column Priority Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- University Name - Left Position (Key Field) -->
                                <div>
                                    <label for="university_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        University Name
                                    </label>
                                    <input type="text" id="university_name" name="university_name"
                                        value="{{ $profile->university_name ?? '' }}" readonly
                                        placeholder="Your university name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- University ID - Right Position -->
                                <div>
                                    <label for="university_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        University ID
                                    </label>
                                    <input type="text" id="university_id" name="university_id"
                                        value="{{ $profile->university_id ?? '' }}" readonly
                                        placeholder="Your student ID"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Department - Left Position (Key Field) -->
                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                                        Department
                                    </label>
                                    <input type="text" id="department" name="department"
                                        value="{{ $profile->department ?? '' }}" readonly placeholder="Your department"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- Semester - Right Position -->
                                <div>
                                    <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                                        Semester
                                    </label>
                                    <input type="text" id="semester" name="semester"
                                        value="{{ $profile->semester ?? '' }}" readonly placeholder="Current semester"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <!-- Address - Full Width (Key Field) -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3" readonly placeholder="Your full address"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $profile->address ?? '' }}</textarea>
                            </div>

                            <!-- University ID Image - Full Width -->
                            <div>
                                <label for="university_id_image" class="block text-sm font-medium text-gray-700 mb-2">
                                    University ID Image
                                </label>
                                <input type="file" id="university_id_image" name="university_id_image"
                                    accept="image/*" disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-xs text-gray-500 mt-1">Upload your university ID card image for
                                    verification</p>
                            </div>

                            <!-- Subjects Selection - Full Width -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Subjects You Want to Teach <span class="text-red-500">*</span>
                                </label>
                                <div class="subjects-grid max-h-48 overflow-y-auto p-4 border border-gray-300 rounded-lg bg-gray-50"
                                    id="subjects-container">
                                    @if (count($subjects) > 0)
                                        @foreach ($subjects as $subject)
                                            <div
                                                class="subject-item flex items-center p-2 mb-2 bg-white border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors">
                                                <input type="checkbox" id="subject_{{ $subject->id }}"
                                                    name="subjects[]" value="{{ $subject->id }}"
                                                    {{ in_array($subject->id, $tutorSubjects) ? 'checked' : '' }} disabled
                                                    class="subject-checkbox mr-3 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                <label for="subject_{{ $subject->id }}"
                                                    class="flex-1 text-sm font-medium text-gray-700 cursor-pointer">
                                                    {{ $subject->name }}
                                                </label>
                                                @if ($subject->description)
                                                    <span class="text-xs text-gray-500 ml-2"
                                                        title="{{ $subject->description }}">ℹ️</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500 text-center py-4">No subjects available. Please
                                            contact administrator.</p>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Select the subjects you are qualified to teach. You
                                    can select multiple subjects.</p>
                            </div>
                        </div>
                    </div>
                @elseif($user->user_type === 'guardian')
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Guardian Information</h2>
                            <p class="text-sm text-gray-600 mt-1">Information about your child and family details</p>
                        </div>

                        <div class="p-4 space-y-4">
                            <!-- Left Column Priority Fields -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Child Name - Left Position (Key Field) -->
                                <div>
                                    <label for="child_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Child Name
                                    </label>
                                    <input type="text" id="child_name" name="child_name"
                                        value="{{ $profile->child_name ?? '' }}" readonly placeholder="Your child's name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- Child Birth Date - Left Position (Key Field) -->
                                <div>
                                    <label for="child_birthdate" class="block text-sm font-medium text-gray-700 mb-2">
                                        Child Birth Date
                                    </label>
                                    <input type="date" id="child_birthdate" name="child_birthdate"
                                        value="{{ $profile->child_birthdate ?? '' }}" readonly
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Current Class - Left Position (Key Field) -->
                                <div>
                                    <label for="current_class" class="block text-sm font-medium text-gray-700 mb-2">
                                        Current Class
                                    </label>
                                    <input type="text" id="current_class" name="current_class"
                                        value="{{ $profile->current_class ?? '' }}" readonly
                                        placeholder="e.g., Grade 12, Year 2, etc."
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>

                                <!-- School/College Name - Left Position (Key Field) -->
                                <div>
                                    <label for="school_college_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        School/College Name
                                    </label>
                                    <input type="text" id="school_college_name" name="school_college_name"
                                        value="{{ $profile->school_college_name ?? '' }}" readonly
                                        placeholder="Your child's institution name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>

                            <!-- Address - Full Width (Key Field) -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3" readonly placeholder="Your full address"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-gray-900 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $profile->address ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div id="action-buttons"
                    class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-4"
                    style="display: none;">
                    <button type="button" id="cancel-btn"
                        class="w-full sm:w-auto px-6 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
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

                // Reset form to original values
                form.reset();
            }

            // Event listeners
            editBtn.addEventListener('click', enableEditMode);
            cancelEditBtn.addEventListener('click', disableEditMode);
            cancelBtn.addEventListener('click', disableEditMode);
        });
    </script>
@endsection
