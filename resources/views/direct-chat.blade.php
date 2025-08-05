@extends('layouts.app')

@section('title', __('messages.chat_with') . ' ' . $otherUser->name . ' - EduConnect')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Chat Header -->
        <div class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-10">
            <div class="max-w-4xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('messages') }}"
                            class="text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all duration-200 hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>

                        <!-- User Avatar with Profile Picture -->
                        <div class="relative">
                            @if ($otherUser->user_type === 'tutor' && $otherUser->tutor && $otherUser->tutor->profile_image)
                                <img src="{{ asset('storage/' . $otherUser->tutor->profile_image) }}"
                                    alt="{{ $otherUser->name }}"
                                    class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-white dark:border-gray-800">
                            @elseif($otherUser->user_type === 'student' && $otherUser->student && $otherUser->student->profile_image)
                                <img src="{{ asset('storage/' . $otherUser->student->profile_image) }}"
                                    alt="{{ $otherUser->name }}"
                                    class="w-12 h-12 rounded-full object-cover shadow-md border-2 border-white dark:border-gray-800">
                            @else
                                <div
                                    class="w-12 h-12 bg-gray-600 dark:bg-gray-700 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                                    {{ strtoupper(substr($otherUser->name, 0, 2)) }}
                                </div>
                            @endif
                            <div
                                class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white dark:border-gray-800 rounded-full shadow-sm">
                            </div>
                        </div>

                        <!-- User Info -->
                        <div>
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $otherUser->name }}</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center space-x-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <span>
                                    @if ($otherUser->user_type === 'tutor')
                                        {{ __('messages.tutor') }} • {{ __('messages.online') }}
                                    @elseif($otherUser->user_type === 'student')
                                        {{ __('messages.student') }} • {{ __('messages.online') }}
                                    @else
                                        {{ __('messages.guardian') }} • {{ __('messages.online') }}
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons with Hover Effects -->
                    <div class="flex items-center space-x-2">
                        <button
                            class="p-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-all duration-200"
                            title="{{ __('messages.search_messages') }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                        <button
                            class="p-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-all duration-200"
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

        <div class="max-w-4xl mx-auto">
            <!-- Messages Container with Beautiful Background -->
            <div class="flex flex-col h-screen">
                <!-- Messages Area - Fixed Container -->
                <div id="messages-container" class="flex-1 overflow-y-auto px-6 py-6"
                    style="height: calc(100vh - 160px); scroll-behavior: smooth; min-height: 400px;">
                    <div id="messages-list" class="space-y-4">
                        <!-- Encryption Badge -->
                        <div class="flex justify-center">
                            <div
                                class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-xs px-4 py-2 rounded-full flex items-center space-x-2 shadow-sm">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium">{{ __('messages.encrypted_notice') }}</span>
                            </div>
                        </div>

                        <!-- Loading State -->
                        <div id="loading-state" class="text-center text-gray-500 dark:text-gray-400 text-sm">
                            <div class="inline-flex items-center space-x-2">
                                <div class="w-2 h-2 bg-gray-400 dark:bg-gray-500 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-gray-400 dark:bg-gray-500 rounded-full animate-bounce"
                                    style="animation-delay: 0.1s">
                                </div>
                                <div class="w-2 h-2 bg-gray-400 dark:bg-gray-500 rounded-full animate-bounce"
                                    style="animation-delay: 0.2s">
                                </div>
                                <span class="ml-2">{{ __('messages.loading_messages') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message Input Area -->
                <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-4 shadow-sm">
                    <form id="message-form" class="flex items-end space-x-4">
                        <input type="hidden" id="receiver-user-id" value="{{ $otherUser->id }}">

                        <!-- File Upload Button with Gradient -->
                        <div class="relative">
                            <input type="file" id="file-input" class="hidden" accept="image/*,application/pdf,.doc,.docx"
                                multiple>
                            <button type="button" id="file-button"
                                class="flex-shrink-0 p-3 bg-gray-600 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white rounded-full transition-all duration-300"
                                title="{{ __('messages.attach_file') }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                            </button>
                        </div>

                        <!-- Message Input with Beautiful Styling -->
                        <div class="flex-1 relative">
                            <input type="text" id="message-input" placeholder="{{ __('messages.type_message') }}"
                                class="w-full px-6 py-4 pr-14 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 rounded-full focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-500 focus:border-gray-400 dark:focus:border-gray-500 transition-all duration-300 text-gray-800 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
                                style="min-height: 52px;" required>
                            <!-- Emoji Button with Hover Effect -->
                            <button type="button" id="emoji-button"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition-all duration-200"
                                title="{{ __('messages.add_emoji') }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>

                            <!-- Beautiful Emoji Picker -->
                            <div id="emoji-picker"
                                class="absolute bottom-full right-0 mb-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-2xl shadow-lg p-4 hidden z-20"
                                style="width: 320px;">
                                <div class="text-center mb-3">
                                    <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        {{ __('messages.choose_emoji') }}</h3>
                                </div>
                                <div class="grid grid-cols-8 gap-2 text-xl max-h-48 overflow-y-auto">
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😀</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😃</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😄</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😁</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😆</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😅</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😂</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤣</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😊</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😇</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🙂</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🙃</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😉</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😌</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😍</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🥰</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😘</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😗</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😙</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😚</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😋</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😛</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😝</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😜</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤪</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤨</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🧐</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤓</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😎</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤩</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🥳</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">😏</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">👍</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">👎</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">👌</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">✌️</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤞</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤟</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤘</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤙</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">👏</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🙌</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">👐</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤲</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🤝</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">🙏</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">❤️</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">💙</button>
                                    <button type="button"
                                        class="emoji-btn hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded-lg transition-all duration-200">💚</button>
                                </div>
                            </div>
                        </div>

                        <!-- Send Button -->
                        <button type="submit" id="send-button"
                            class="flex-shrink-0 w-14 h-14 bg-gray-600 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles for Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.3s ease-out;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.3s ease-out;
        }

        .message-bubble-sent {
            background-color: #667eea;
            color: white;
        }

        .message-bubble-received {
            background-color: #a3a3a3;
            color: white;
        }

        .message-item {
            opacity: 1;
            transition: opacity 0.2s ease-in-out;
        }

        .typing-indicator {
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* Custom scrollbar */
        #messages-container::-webkit-scrollbar {
            width: 6px;
        }

        #messages-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        #messages-container::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }

        #messages-container::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messagesContainer = document.getElementById('messages-container');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            const receiverUserId = document.getElementById('receiver-user-id').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const currentUserId = {{ auth()->id() }};
            const emojiButton = document.getElementById('emoji-button');
            const emojiPicker = document.getElementById('emoji-picker');
            const fileButton = document.getElementById('file-button');
            const fileInput = document.getElementById('file-input');

            // Enhanced emoji picker functionality
            emojiButton.addEventListener('click', function(e) {
                e.preventDefault();
                emojiPicker.classList.toggle('hidden');
                if (!emojiPicker.classList.contains('hidden')) {
                    emojiPicker.style.animation = 'fade-in 0.3s ease-out';
                }
            });

            // Close emoji picker when clicking outside
            document.addEventListener('click', function(e) {
                if (!emojiButton.contains(e.target) && !emojiPicker.contains(e.target)) {
                    emojiPicker.classList.add('hidden');
                }
            });

            // Add emoji to input with animation
            document.querySelectorAll('.emoji-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const emoji = this.textContent;
                    const cursorPos = messageInput.selectionStart;
                    const textBefore = messageInput.value.substring(0, cursorPos);
                    const textAfter = messageInput.value.substring(cursorPos);
                    messageInput.value = textBefore + emoji + textAfter;
                    messageInput.focus();
                    messageInput.setSelectionRange(cursorPos + emoji.length, cursorPos + emoji
                        .length);
                    emojiPicker.classList.add('hidden');

                    // Add a little animation to the input
                    messageInput.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        messageInput.style.transform = 'scale(1)';
                    }, 150);
                });
            });

            // Enhanced file upload functionality
            fileButton.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                const files = this.files;
                if (files.length > 0) {
                    const fileNames = Array.from(files).map(file => file.name).join(', ');
                    messageInput.value = `📎 ${fileNames}`;
                    messageInput.style.background = 'linear-gradient(135deg, #e0f2fe 0%, #f3e5f5 100%)';
                    setTimeout(() => {
                        messageInput.style.background = '';
                    }, 2000);
                }
            });

            // Enhanced input animations
            messageInput.addEventListener('input', function() {
                if (this.value.trim()) {
                    sendButton.classList.remove('bg-gray-400');
                    sendButton.classList.add('bg-gray-600');
                    sendButton.style.transform = 'scale(1.05)';
                } else {
                    sendButton.classList.remove('bg-gray-600');
                    sendButton.classList.add('bg-gray-400');
                    sendButton.style.transform = 'scale(1)';
                }
            });

            // Load messages without blinking
            let currentMessages = [];
            let isLoading = false;

            function loadMessages() {
                if (isLoading) return;
                isLoading = true;

                fetch(`/api/direct-messages/${receiverUserId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (JSON.stringify(data.messages) !== JSON.stringify(currentMessages)) {
                            currentMessages = data.messages || [];
                            displayMessages(currentMessages);
                        }
                        isLoading = false;
                    })
                    .catch(error => {
                        console.error('Error loading messages:', error);
                        const messagesList = document.getElementById('messages-list');
                        messagesList.innerHTML = `
                        <div class="flex justify-center">
                            <div class="bg-red-100 text-red-800 text-xs px-4 py-2 rounded-full shadow-lg">
                                Failed to load messages
                            </div>
                        </div>
                    `;
                        isLoading = false;
                    });
            }

            // Enhanced message display with beautiful styling
            function displayMessages(messages) {
                if (messages.length === 0) {
                    messagesContainer.innerHTML = `
                    <div class="flex justify-center">
                        <div class="bg-gradient-to-r from-yellow-100 to-amber-100 text-amber-800 text-xs px-4 py-2 rounded-full flex items-center space-x-2 shadow-lg border border-amber-200 animate-fade-in">
                            <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            <span class="font-medium">{{ __('messages.encrypted_notice') }}</span>
                        </div>
                    </div>
                    <div class="text-center text-gray-500 text-sm mt-6 animate-fade-in">
                        <div class="bg-white/50 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="font-semibold text-gray-700 mb-2">No messages yet</h3>
                            <p class="text-gray-500">Start the conversation with a friendly message!</p>
                        </div>
                    </div>
                `;
                    return;
                }

                // Sort messages chronologically
                messages.sort((a, b) => new Date(a.sent_at) - new Date(b.sent_at));

                let messagesHTML = `
                <div class="flex justify-center">
                    <div class="bg-gradient-to-r from-yellow-100 to-amber-100 text-amber-800 text-xs px-4 py-2 rounded-full flex items-center space-x-2 shadow-lg border border-amber-200 animate-fade-in">
                        <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ __('messages.encrypted_notice') }}</span>
                    </div>
                </div>
            `;

                messages.forEach(message => {
                    const isSent = message.sender_user_id == currentUserId;
                    // Display timestamp in Dhaka timezone (database default)
                    let messageTime;
                    try {
                        // Handle different timestamp formats - database stores in Dhaka timezone
                        let timestamp = message.sent_at;
                        if (timestamp.includes('T')) {
                            // ISO format: 2024-01-15T10:30:45.000000Z
                            // Since database stores in Dhaka timezone, display as-is
                            messageTime = new Date(timestamp).toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                timeZone: 'Asia/Dhaka'
                            });
                        } else {
                            // MySQL format: 2024-01-15 10:30:45 (already in Dhaka timezone)
                            // Parse as local time since it's already in Dhaka timezone
                            messageTime = new Date(timestamp.replace(' ', 'T')).toLocaleTimeString(
                                'en-US', {
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    timeZone: 'Asia/Dhaka'
                                });
                        }
                    } catch (error) {
                        console.error('Error parsing timestamp:', error);
                        // Fallback to current Dhaka time
                        messageTime = new Date().toLocaleTimeString('en-US', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            timeZone: 'Asia/Dhaka'
                        });
                    }

                    messagesHTML += `
                    <div class="flex ${isSent ? 'justify-end' : 'justify-start'} mb-4">
                        <div class="max-w-xs lg:max-w-md px-4 py-3 rounded-2xl shadow-lg ${isSent ? 'message-bubble-sent text-white' : 'message-bubble-received text-white'} relative">
                            <p class="text-sm leading-relaxed">${escapeHtml(message.message)}</p>
                            <div class="flex items-center justify-end mt-2 space-x-1">
                                <span class="text-xs opacity-75">${messageTime}</span>
                                ${isSent ? `
                                                        <svg class="w-4 h-4 opacity-75" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    ` : ''}
                            </div>
                            <!-- Message tail -->
                            <div class="absolute ${isSent ? 'right-0 -mr-2' : 'left-0 -ml-2'} top-4">
                                <div class="w-4 h-4 ${isSent ? 'message-bubble-sent' : 'message-bubble-received'} transform rotate-45"></div>
                            </div>
                        </div>
                    </div>
                `;
                });

                messagesContainer.innerHTML = messagesHTML;
                scrollToBottom();
            }

            // Enhanced message sending with animations
            messageForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                // Add sending animation
                sendButton.style.transform = 'scale(0.95)';
                sendButton.innerHTML = `
                <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            `;

                // Disable form during sending
                messageInput.disabled = true;
                sendButton.disabled = true;

                fetch('/api/direct-messages', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            receiver_user_id: receiverUserId,
                            message: message
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            messageInput.value = '';
                            loadMessages();

                            // Success animation
                            sendButton.style.background = 'linear-gradient(135deg, #10b981, #059669)';
                            sendButton.innerHTML = `
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        `;

                            setTimeout(() => {
                                resetSendButton();
                            }, 1000);
                        } else {
                            throw new Error(data.error || 'Failed to send message');
                        }
                    })
                    .catch(error => {
                        console.error('Error sending message:', error);

                        // Error animation
                        sendButton.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
                        sendButton.innerHTML = `
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    `;

                        setTimeout(() => {
                            resetSendButton();
                        }, 2000);
                    });
            });

            // Reset send button to original state
            function resetSendButton() {
                sendButton.style.transform = 'scale(1)';
                sendButton.style.background = '';
                sendButton.classList.remove('bg-gray-400');
                sendButton.classList.add('bg-gray-600');
                sendButton.innerHTML = `
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            `;
                messageInput.disabled = false;
                sendButton.disabled = false;
                messageInput.focus();
            }

            // Utility functions
            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            // Enhanced keyboard shortcuts
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    messageForm.dispatchEvent(new Event('submit'));
                }
            });

            // Auto-resize input and focus effects
            messageInput.addEventListener('focus', function() {
                this.style.borderColor = '#6b7280';
                this.style.boxShadow = '0 0 0 2px rgba(107, 114, 128, 0.1)';
            });

            messageInput.addEventListener('blur', function() {
                this.style.borderColor = '#d1d5db';
                this.style.boxShadow = '';
            });

            // Improved notification system
            let lastMessageCount = 0;

            function checkForNewMessages() {
                if (currentMessages.length > lastMessageCount && lastMessageCount > 0) {
                    // Show notification for new messages
                    showNotification('New message received!');

                    // Browser notification
                    if ('Notification' in window && Notification.permission === 'granted') {
                        new Notification('New Message', {
                            body: `New message from {{ $otherUser->name }}`,
                            icon: '/favicon.ico'
                        });
                    }
                }
                lastMessageCount = currentMessages.length;
            }

            function showNotification(message) {
                // Create a temporary notification element
                const notification = document.createElement('div');
                notification.className =
                    'fixed top-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg shadow-lg z-50 animate-fade-in';
                notification.textContent = message;
                document.body.appendChild(notification);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }

            // Request notification permission
            if ('Notification' in window && Notification.permission === 'default') {
                Notification.requestPermission();
            }

            // Load messages on page load
            loadMessages();

            // Auto-refresh messages every 5 seconds (reduced frequency to prevent blinking)
            setInterval(() => {
                loadMessages();
                checkForNewMessages();
            }, 5000);

            // Focus on input when page loads
            messageInput.focus();
        });
    </script>
@endpush
