@extends('layouts.app')

@section('title', __('session_requests.create.title') . ' - ' . $tutor->user->name)

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
            <div class="px-6 py-8">
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center space-x-4 mb-4">
                        <a href="{{ route('tutor.show', $tutor->id) }}"
                            class="text-white hover:text-indigo-200 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-white">{{ __('session_requests.create.title') }}</h1>
                    </div>
                    <p class="text-indigo-100">{{ __('session_requests.create.subtitle', ['tutor' => $tutor->user->name]) }}
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-8">
            <!-- Tutor Info Card -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-6 mb-8">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        @if ($tutor->profile_image)
                            <img src="{{ asset('storage/' . $tutor->profile_image) }}" alt="{{ $tutor->user->name }}"
                                class="w-16 h-16 rounded-full object-cover border-4 border-indigo-200 shadow-lg">
                        @else
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center border-4 border-indigo-200 shadow-lg">
                                <svg class="w-8 h-8 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $tutor->user->name }}</h2>
                        <p class="text-gray-600">{{ $tutor->university_name }}</p>
                        @if ($tutor->rating > 0)
                            <div class="flex items-center mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $tutor->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">{{ number_format($tutor->rating, 1) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Request Form -->
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ __('session_requests.create.form_title') }}</h3>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h4 class="text-red-800 font-medium">{{ __('session_requests.create.errors.title') }}</h4>
                                <ul class="text-red-700 text-sm mt-1 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('session-requests.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="tutor_id" value="{{ $tutor->id }}">

                    <!-- Subject Selection -->
                    <div>
                        <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('session_requests.create.subject') }} <span class="text-red-500">*</span>
                        </label>
                        <select name="subject_id" id="subject_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                            <option value="">{{ __('session_requests.create.select_subject') }}</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date and Time -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="requested_time" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('session_requests.create.preferred_datetime') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="datetime-local" name="requested_time" id="requested_time" required
                                value="{{ old('requested_time') }}" min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('session_requests.create.duration') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="duration" id="duration" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option value="">{{ __('session_requests.create.select_duration') }}</option>
                                <option value="30" {{ old('duration') == '30' ? 'selected' : '' }}>30
                                    {{ __('session_requests.create.minutes') }}</option>
                                <option value="60" {{ old('duration') == '60' ? 'selected' : '' }}>1
                                    {{ __('session_requests.create.hour') }}</option>
                                <option value="90" {{ old('duration') == '90' ? 'selected' : '' }}>1.5
                                    {{ __('session_requests.create.hours') }}</option>
                                <option value="120" {{ old('duration') == '120' ? 'selected' : '' }}>2
                                    {{ __('session_requests.create.hours') }}</option>
                                <option value="180" {{ old('duration') == '180' ? 'selected' : '' }}>3
                                    {{ __('session_requests.create.hours') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('session_requests.create.message') }}
                        </label>
                        <textarea name="message" id="message" rows="4" maxlength="500"
                            placeholder="{{ __('session_requests.create.message_placeholder') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">{{ old('message') }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">{{ __('session_requests.create.message_limit') }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('tutor.show', $tutor->id) }}"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            {{ __('session_requests.create.cancel') }}
                        </a>
                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            {{ __('session_requests.create.send_request') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
