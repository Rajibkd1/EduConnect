@extends('layouts.app')

@section('title', 'Dashboard - EduConnect')

@section('content')
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="border-4 border-dashed border-gray-200 rounded-lg p-8">
                <div class="text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to EduConnect Dashboard</h2>
                    <p class="text-xl text-gray-600 mb-6">
                        Hello, {{ auth()->user()->name }}! You're logged in as a {{ ucfirst(auth()->user()->user_type) }}.
                    </p>
                    
                    <div class="bg-white rounded-lg shadow p-6 max-w-md mx-auto">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Account Details</h3>
                        <div class="space-y-2 text-left">
                            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            <p><strong>User Type:</strong> {{ ucfirst(auth()->user()->user_type) }}</p>
                            <p><strong>Member Since:</strong> {{ auth()->user()->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <p class="text-gray-600">
                            This is your dashboard. More features will be added soon!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
