@extends('layouts.app')

@section('title', 'EduConnect - Connect. Learn. Grow.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-white to-gray-100 hero-pattern">
        <!-- Floating Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-gray-100 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-48 h-48 bg-gray-200 rounded-full opacity-15 animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 right-1/3 w-32 h-32 bg-gray-150 rounded-full opacity-10 animate-pulse" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-8">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-gradient mb-6 leading-tight">
                    Connect. Learn. <span class="text-gray-800">Grow.</span>
                </h1>
                <div class="w-24 h-1 bg-gray-800 mx-auto mb-8 rounded-full"></div>
                <p class="text-xl sm:text-2xl lg:text-3xl text-gray-600 mb-12 max-w-4xl mx-auto font-light leading-relaxed">
                    EduConnect bridges the gap between students, tutors, and guardians, creating a seamless educational ecosystem for enhanced learning experiences.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('signup.show') }}" class="group bg-gray-900 hover:bg-gray-800 text-white px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 elegant-shadow hover:shadow-2xl transform hover:-translate-y-1">
                    <span class="flex items-center">
                        Start Learning Today
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </span>
                </a>
                <a href="#features" class="group text-gray-700 hover:text-gray-900 px-10 py-5 rounded-2xl text-lg font-semibold border-2 border-gray-300 hover:border-gray-400 transition-all duration-300 subtle-shadow hover:shadow-lg transform hover:-translate-y-1">
                    <span class="flex items-center">
                        Learn More
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Why Choose EduConnect?</h2>
                <div class="w-16 h-1 bg-gray-800 mx-auto mb-6 rounded-full"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                    Our platform offers comprehensive features designed to enhance the educational experience for all users through elegant simplicity and powerful functionality.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">For Students</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Access qualified tutors, schedule sessions, track progress, and enhance your learning journey with personalized support tailored to your needs.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">For Tutors</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Share your expertise, manage students, create flexible schedules, and build your teaching reputation on our intuitive platform.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">For Guardians</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Monitor your child's progress, communicate with tutors, and stay actively involved in their educational development journey.
                    </p>
                </div>
                
                <!-- Feature 4 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Secure Platform</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Your data is protected with advanced security measures, email verification, and secure authentication systems you can trust.
                    </p>
                </div>
                
                <!-- Feature 5 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Flexible Scheduling</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Book sessions at your convenience with our flexible scheduling system that adapts to your busy lifestyle and preferences.
                    </p>
                </div>
                
                <!-- Feature 6 -->
                <div class="feature-card group bg-white rounded-2xl p-8 subtle-shadow hover:elegant-shadow border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-gray-200 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-gray-900 mb-4">Progress Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Monitor learning progress with detailed analytics, session reports, and performance insights for continuous improvement and growth.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-8">About EduConnect</h2>
                    <div class="w-16 h-1 bg-gray-800 mb-8 rounded-full"></div>
                    <p class="text-xl text-gray-600 mb-8 font-light leading-relaxed">
                        EduConnect is a comprehensive educational platform designed to create meaningful connections between students, tutors, and guardians. Our mission is to make quality education accessible, personalized, and effective for everyone.
                    </p>
                    <p class="text-lg text-gray-600 mb-12 leading-relaxed">
                        With features like secure authentication, flexible scheduling, progress tracking, and real-time communication, we're revolutionizing the way education happens in the digital age.
                    </p>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center p-6 bg-white rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 mb-2">1000+</div>
                            <div class="text-gray-600 font-medium">Active Students</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 mb-2">500+</div>
                            <div class="text-gray-600 font-medium">Qualified Tutors</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 mb-2">50+</div>
                            <div class="text-gray-600 font-medium">Subjects Covered</div>
                        </div>
                        <div class="text-center p-6 bg-white rounded-2xl subtle-shadow">
                            <div class="text-4xl font-bold text-gray-900 mb-2">98%</div>
                            <div class="text-gray-600 font-medium">Satisfaction Rate</div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="bg-white rounded-3xl p-10 elegant-shadow border border-gray-100">
                        <h3 class="text-3xl font-semibold text-gray-900 mb-8">How It Works</h3>
                        <div class="space-y-8">
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 text-white rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 transition-colors">1</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Sign Up</h4>
                                    <p class="text-gray-600 leading-relaxed">Create your account as a student, tutor, or guardian with secure email verification.</p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 text-white rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 transition-colors">2</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Connect</h4>
                                    <p class="text-gray-600 leading-relaxed">Find the perfect tutor or student match based on subjects and preferences.</p>
                                </div>
                            </div>
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-12 h-12 bg-gray-900 text-white rounded-2xl flex items-center justify-center text-lg font-semibold group-hover:bg-gray-800 transition-colors">3</div>
                                <div class="ml-6">
                                    <h4 class="text-xl font-semibold text-gray-900 mb-2">Learn & Grow</h4>
                                    <p class="text-gray-600 leading-relaxed">Schedule sessions, track progress, and achieve your educational goals together.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gray-900 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, white 2px, transparent 2px), radial-gradient(circle at 75% 75%, white 2px, transparent 2px); background-size: 100px 100px;"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-8 leading-tight">Ready to Start Your Learning Journey?</h2>
            <div class="w-24 h-1 bg-white mx-auto mb-8 rounded-full"></div>
            <p class="text-xl sm:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto font-light leading-relaxed">
                Join thousands of students, tutors, and guardians who are already part of the EduConnect community and transforming education together.
            </p>
            <a href="{{ route('signup.show') }}" class="group inline-flex items-center bg-white text-gray-900 hover:bg-gray-100 px-10 py-5 rounded-2xl text-lg font-semibold transition-all duration-300 elegant-shadow hover:shadow-2xl transform hover:-translate-y-1">
                <span>Get Started Now</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Get in Touch</h2>
                <div class="w-16 h-1 bg-gray-800 mx-auto mb-6 rounded-full"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                    Have questions? We're here to help you get started with EduConnect and support your educational journey.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center p-8 bg-gray-50 rounded-2xl hover:bg-white subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 group-hover:bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Email Us</h3>
                    <p class="text-gray-600 font-medium">support@educonnect.com</p>
                </div>
                
                <div class="group text-center p-8 bg-gray-50 rounded-2xl hover:bg-white subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 group-hover:bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Call Us</h3>
                    <p class="text-gray-600 font-medium">+1 (555) 123-4567</p>
                </div>
                
                <div class="group text-center p-8 bg-gray-50 rounded-2xl hover:bg-white subtle-shadow hover:elegant-shadow transition-all duration-300 border border-gray-100">
                    <div class="w-16 h-16 bg-gray-100 group-hover:bg-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6 transition-colors">
                        <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Visit Us</h3>
                    <p class="text-gray-600 font-medium">123 Education St, Learning City</p>
                </div>
            </div>
        </div>
    </section>

@endsection
