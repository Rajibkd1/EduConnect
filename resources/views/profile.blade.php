@extends('layouts.app')

@section('title', 'Profile - EduConnect')

@section('content')
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
                    <p class="text-gray-600">Manage your account information and preferences</p>
                </div>
                <button id="editToggle" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Profile
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Profile Information -->
            <div class="max-w-4xl">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg p-6 text-white mb-8">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-full p-4">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-6">
                            <h2 class="text-2xl font-bold">{{ auth()->user()->name }}</h2>
                            <p class="text-indigo-100 text-lg">{{ ucfirst(auth()->user()->user_type) }}</p>
                            <p class="text-indigo-200 text-sm">Member since {{ auth()->user()->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Form -->
                <form id="profileForm" class="space-y-8">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" 
                                       class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white" 
                                       readonly>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" 
                                       class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white" 
                                       readonly>
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="" 
                                       class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white" 
                                       placeholder="+1 (555) 123-4567" readonly>
                            </div>
                            
                            <div>
                                <label for="user_type" class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                                <input type="text" id="user_type" value="{{ ucfirst(auth()->user()->user_type) }}" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Information</h3>
                        <div class="space-y-6">
                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                                    @if(auth()->user()->isTutor())
                                        About Me (Tell students about your teaching experience)
                                    @else
                                        About Me
                                    @endif
                                </label>
                                <textarea id="bio" name="bio" rows="4" 
                                          class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                                          placeholder="Tell us about yourself..." readonly></textarea>
                            </div>
                            
                            @if(auth()->user()->isTutor())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="subjects" class="block text-sm font-medium text-gray-700 mb-2">Subjects I Teach</label>
                                        <input type="text" id="subjects" name="subjects" 
                                               class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                                               placeholder="Mathematics, Physics, Chemistry..." readonly>
                                    </div>
                                    
                                    <div>
                                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Years of Experience</label>
                                        <select id="experience" name="experience" 
                                                class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white" 
                                                disabled>
                                            <option value="">Select experience</option>
                                            <option value="1">Less than 1 year</option>
                                            <option value="2">1-2 years</option>
                                            <option value="5">3-5 years</option>
                                            <option value="10">5-10 years</option>
                                            <option value="10+">More than 10 years</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="hourly_rate" class="block text-sm font-medium text-gray-700 mb-2">Hourly Rate ($)</label>
                                    <input type="number" id="hourly_rate" name="hourly_rate" min="0" step="0.01" 
                                           class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                                           placeholder="35.00" readonly>
                                </div>
                            @endif
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                <input type="text" id="location" name="location" 
                                       class="profile-input w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 bg-white"
                                       placeholder="City, State" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div id="formActions" class="flex justify-end space-x-4 hidden">
                        <button type="button" id="cancelEdit" class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
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
            const editToggle = document.getElementById('editToggle');
            const cancelEdit = document.getElementById('cancelEdit');
            const formActions = document.getElementById('formActions');
            const profileInputs = document.querySelectorAll('.profile-input');
            const experienceSelect = document.getElementById('experience');
            
            let isEditing = false;
            
            editToggle.addEventListener('click', function() {
                if (!isEditing) {
                    // Enable editing
                    profileInputs.forEach(input => {
                        input.removeAttribute('readonly');
                        input.classList.remove('bg-white');
                        input.classList.add('bg-white');
                    });
                    
                    if (experienceSelect) {
                        experienceSelect.removeAttribute('disabled');
                    }
                    
                    formActions.classList.remove('hidden');
                    editToggle.innerHTML = `
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel Edit
                    `;
                    editToggle.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                    editToggle.classList.add('bg-gray-600', 'hover:bg-gray-700');
                    isEditing = true;
                } else {
                    cancelEditing();
                }
            });
            
            cancelEdit.addEventListener('click', function() {
                cancelEditing();
            });
            
            function cancelEditing() {
                // Disable editing
                profileInputs.forEach(input => {
                    input.setAttribute('readonly', true);
                });
                
                if (experienceSelect) {
                    experienceSelect.setAttribute('disabled', true);
                }
                
                formActions.classList.add('hidden');
                editToggle.innerHTML = `
                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Profile
                `;
                editToggle.classList.remove('bg-gray-600', 'hover:bg-gray-700');
                editToggle.classList.add('bg-indigo-600', 'hover:bg-indigo-700');
                isEditing = false;
            }
            
            // Handle form submission
            document.getElementById('profileForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Show success message (in a real app, this would submit to server)
                alert('Profile updated successfully!');
                cancelEditing();
            });
        });
    </script>
@endsection
