@extends('layouts.app')

@section('title', __('favorites.title') . ' - EduConnect')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-700 shadow-lg">
            <div class="px-6 py-8">
                <div class="max-w-7xl mx-auto">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ __('favorites.title') }}</h1>
                    <p class="text-indigo-100 dark:text-indigo-200">{{ __('favorites.subtitle') }}</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            @if($favorites->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($favorites as $favorite)
                        @php $tutor = $favorite->tutor @endphp
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/20 p-6 hover:shadow-2xl transition-all duration-200">
                            <!-- Tutor Info -->
                            <div class="flex items-start space-x-4 mb-4">
                                <div class="relative">
                                    @if($tutor->profile_image)
                                        <img src="{{ asset('storage/' . $tutor->profile_image) }}" 
                                             alt="{{ $tutor->user->name }}"
                                             class="w-16 h-16 rounded-full object-cover border-4 border-indigo-200 shadow-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-800 dark:to-purple-800 rounded-full flex items-center justify-center border-4 border-indigo-200 dark:border-indigo-600 shadow-lg">
                                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>

                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $tutor->user->name }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-1">{{ $tutor->university_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tutor->department }}</p>
                                    
                                    @if($tutor->rating > 0)
                                        <div class="flex items-center mt-2">
                                            <div class="flex items-center mr-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $tutor->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <span class="text-xs text-gray-600 dark:text-gray-300">{{ number_format($tutor->rating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Subjects -->
                            @if($tutor->subjects->count() > 0)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($tutor->subjects->take(3) as $subject)
                                            <span class="bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-800 dark:to-purple-800 text-indigo-800 dark:text-indigo-200 text-xs px-2 py-1 rounded-full border border-indigo-200 dark:border-indigo-600">
                                                {{ $subject->name }}
                                            </span>
                                        @endforeach
                                        @if($tutor->subjects->count() > 3)
                                            <span class="text-xs text-gray-500 dark:text-gray-400 px-2 py-1">
                                                +{{ $tutor->subjects->count() - 3 }} {{ __('favorites.more_subjects') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Actions -->
                            <div class="space-y-2">
                                <a href="{{ route('tutor.show', $tutor->id) }}" 
                                   class="w-full px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-700 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 transition-all duration-200 text-sm font-medium text-center inline-block">
                                    {{ __('favorites.view_profile') }}
                                </a>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('direct-chat', $tutor->user->id) }}" 
                                       class="flex-1 px-3 py-2 bg-white dark:bg-gray-700 border border-indigo-200 dark:border-indigo-600 text-indigo-600 dark:text-indigo-300 rounded-lg hover:bg-indigo-50 dark:hover:bg-gray-600 transition-all duration-200 text-sm font-medium text-center">
                                        {{ __('favorites.message') }}
                                    </a>
                                    
                                    <form action="{{ route('favorites.destroy', $tutor->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-2 bg-white dark:bg-gray-700 border border-red-200 dark:border-red-600 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-50 dark:hover:bg-gray-600 transition-all duration-200 text-sm font-medium"
                                                onclick="return confirm('{{ __('favorites.remove_confirm') }}')">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Favorited Date -->
                            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ __('favorites.added_ago') }} {{ $favorite->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($favorites->hasPages())
                    <div class="mt-8">
                        {{ $favorites->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-800 dark:to-purple-800 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('favorites.no_favorites') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('favorites.no_favorites_desc') }}</p>
                    <a href="{{ route('search-tutor') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-700 text-white rounded-xl hover:from-indigo-700 hover:to-purple-700 dark:hover:from-indigo-600 dark:hover:to-purple-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        {{ __('favorites.find_tutors') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
