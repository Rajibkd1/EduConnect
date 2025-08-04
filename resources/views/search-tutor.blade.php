@extends('layouts.app')

@section('title', __('search_tutor.title'))

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <!-- Enhanced Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
            <div class="px-6 py-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ __('search_tutor.page_title') }}</h1>
                    <p class="text-indigo-100">{{ __('search_tutor.page_description') }}</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Enhanced Search Filters -->
            <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/20 p-6 mb-8">
                <form method="GET" action="{{ route('search-tutor') }}" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Subject Filter -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.filters.subject') }}</label>
                            <select id="subject" name="subject"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                <option value="">{{ __('search_tutor.filters.all_subjects') }}</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search by Name -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.filters.tutor_name') }}</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                placeholder="{{ __('search_tutor.filters.search_by_name') }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        </div>

                        <!-- University Filter -->
                        <div>
                            <label for="university" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.filters.university') }}</label>
                            <input type="text" id="university" name="university" value="{{ request('university') }}"
                                placeholder="{{ __('search_tutor.filters.university_placeholder') }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        </div>

                        <!-- Department Filter -->
                        <div>
                            <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.filters.department') }}</label>
                            <input type="text" id="department" name="department" value="{{ request('department') }}"
                                placeholder="{{ __('search_tutor.filters.department_placeholder') }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400">
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-6">
                            <!-- Minimum Rating Filter -->
                            <div>
                                <label for="min_rating" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.filters.minimum_rating') }}</label>
                                <select id="min_rating" name="min_rating"
                                    class="px-4 py-2 border-2 border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                    <option value="">{{ __('search_tutor.filters.any_rating') }}</option>
                                    <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>{{ __('search_tutor.filters.4_plus_stars') }}</option>
                                    <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>{{ __('search_tutor.filters.3_plus_stars') }}</option>
                                    <option value="2" {{ request('min_rating') == '2' ? 'selected' : '' }}>{{ __('search_tutor.filters.2_plus_stars') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <a href="{{ route('search-tutor') }}"
                                class="px-6 py-3 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-500 transition-colors">
                                {{ __('search_tutor.filters.clear_filters') }}
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                {{ __('search_tutor.filters.search') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Search Results -->
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('search_tutor.results.available_tutors') }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $tutors->total() }} {{ $tutors->total() !== 1 ? __('search_tutor.results.tutors_found_plural') : __('search_tutor.results.tutors_found') }} {{ __('search_tutor.results.found') }}</p>
                </div>

                @if ($tutors->count() > 0)
                    <!-- Tutor Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($tutors as $tutor)
                            <div
                                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-white/20 dark:border-gray-700/20 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <!-- Tutor Header -->
                                <div class="flex items-center mb-4">
                                    <div class="relative">
                                        @if ($tutor->profile_image)
                                            <img src="{{ asset('storage/' . $tutor->profile_image) }}"
                                                alt="{{ $tutor->user->name }}"
                                                class="w-16 h-16 rounded-full object-cover border-4 border-indigo-200 shadow-lg">
                                        @else
                                            <div
                                                class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center border-4 border-indigo-200 shadow-lg">
                                                <svg class="w-8 h-8 text-indigo-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <!-- Online Status Indicator -->
                                        <div
                                            class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-2 border-white rounded-full">
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="font-bold text-gray-900 dark:text-white text-lg">{{ $tutor->user->name }}</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">{{ $tutor->university_name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tutor->department }}</p>
                                    </div>
                                </div>

                                <!-- Tutor Details -->
                                <div class="space-y-3 mb-4">
                                    @if ($tutor->rating > 0)
                                        <div class="flex items-center text-sm">
                                            <div class="flex items-center mr-2">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $tutor->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-gray-600 dark:text-gray-300">{{ number_format($tutor->rating, 1) }}
                                                {{ __('search_tutor.results.rating') }}</span>
                                        </div>
                                    @endif

                                    @if ($tutor->experience_years)
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $tutor->experience_years }}+ {{ __('search_tutor.results.years_experience') }}
                                        </div>
                                    @endif

                                    @if ($tutor->semester)
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-300">
                                            <svg class="w-4 h-4 mr-2 text-purple-500" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z" />
                                            </svg>
                                            {{ $tutor->semester }} {{ __('search_tutor.results.semester') }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Subjects -->
                                @if ($tutor->subjects->count() > 0)
                                    <div class="mb-4">
                                        <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-2">{{ __('search_tutor.results.subjects') }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($tutor->subjects->take(3) as $subject)
                                                <span
                                                    class="px-3 py-1 bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 text-xs rounded-full border border-indigo-200">
                                                    {{ $subject->name }}
                                                </span>
                                            @endforeach
                                            @if ($tutor->subjects->count() > 3)
                                                <span class="px-3 py-1 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300 text-xs rounded-full">
                                                    +{{ $tutor->subjects->count() - 3 }} {{ __('search_tutor.results.more') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Button -->
                                <a href="{{ route('tutor.show', $tutor->id) }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('search_tutor.results.view_profile') }}
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($tutors->hasPages())
                        <div class="mt-8">
                            {{ $tutors->appends(request()->query())->links() }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div
                            class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/20 p-12 max-w-md mx-auto">
                            <svg class="w-20 h-20 text-gray-400 dark:text-gray-500 mx-auto mb-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ __('search_tutor.empty_state.no_tutors_found') }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('search_tutor.empty_state.adjust_criteria') }}</p>
                            <a href="{{ route('search-tutor') }}"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                {{ __('search_tutor.empty_state.clear_all_filters') }}
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
