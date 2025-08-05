@extends('layouts.app')

@section('title', __('messages.title') . ' - EduConnect')

@section('content')
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
            <div class="px-6 py-4">
                <div class="max-w-4xl mx-auto">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('messages.title') }}</h1>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">{{ __('messages.subtitle') }}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                                title="{{ __('messages.search_messages') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                            <button
                                class="p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                                title="{{ __('messages.more_options') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto">
            @if ($conversations->count() > 0)
                <div class="bg-white dark:bg-gray-800 shadow-sm">
                    @foreach ($conversations as $conversation)
                        <div class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                            <a href="{{ route('direct-chat', $conversation->id) }}"
                                class="flex items-center px-6 py-4 space-x-4">
                                <!-- Avatar -->
                                <div class="relative flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                        {{ strtoupper(substr($conversation->name, 0, 2)) }}
                                    </div>
                                    <div
                                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full">
                                    </div>
                                </div>

                                <!-- Conversation Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h3 class="text-base font-semibold text-gray-900 dark:text-white truncate">{{ $conversation->name }}
                                        </h3>
                                        <div class="flex items-center space-x-2">
                                            @if ($conversation->last_message)
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $conversation->last_message->sent_at->format('g:i A') }}
                                                </span>
                                            @endif
                                            @if ($conversation->unread_count > 0)
                                                <span
                                                    class="bg-green-500 dark:bg-green-600 text-white text-xs px-2 py-1 rounded-full min-w-[20px] text-center">
                                                    {{ $conversation->unread_count }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            @if ($conversation->last_message)
                                                <p class="text-sm text-gray-600 dark:text-gray-300 truncate">
                                                    @if ($conversation->last_message->sender->id === auth()->id())
                                                        <svg class="w-4 h-4 inline text-blue-500 dark:text-blue-400 mr-1" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                    {{ $conversation->last_message->message }}
                                                </p>
                                            @else
                                                <p class="text-sm text-gray-500 dark:text-gray-400 italic">{{ __('messages.no_messages_yet') }}</p>
                                            @endif
                                        </div>

                                        <div class="flex items-center space-x-1 ml-2">
                                            <span class="text-xs text-gray-400 dark:text-gray-500 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full">
                                                @if ($conversation->user_type === 'tutor')
                                                    {{ __('messages.tutor') }}
                                                @elseif($conversation->user_type === 'student')
                                                    {{ __('messages.student') }}
                                                @else
                                                    {{ __('messages.guardian') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ __('messages.no_conversations') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{{ __('messages.start_messaging') }}</p>
                    <a href="{{ route('search-tutor') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        {{ __('messages.find_tutors') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
