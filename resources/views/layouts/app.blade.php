<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'EduConnect - Connect. Learn. Grow.')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Additional Styles -->
    @stack('styles')

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="@yield('body-class', 'bg-gray-50 text-gray-900')">
    <!-- Navigation -->
    @include('layouts.partials.navigation')

    @auth
        <!-- Main Content Area for Authenticated Users -->
        <section class="lg:ml-64 min-h-screen bg-gray-50 pt-16 lg:pt-0">
            <div class="px-2 sm:px-3 lg:px-4 py-4">
                @yield('content')
            </div>
        </section>
    @else
        <!-- Main Content for Guest Users -->
        <main>
            @yield('content')
        </main>

        <!-- Footer for Guest Users -->
        @include('layouts.partials.footer')
    @endauth

    <!-- Scripts -->
    @stack('scripts')

    <!-- Base Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar functionality for authenticated users
            const openSidebarBtn = document.getElementById('open-sidebar');
            const closeSidebarBtn = document.getElementById('close-sidebar');
            const mobileSidebar = document.getElementById('mobile-sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            if (openSidebarBtn && mobileSidebar && sidebarOverlay) {
                openSidebarBtn.addEventListener('click', function() {
                    mobileSidebar.classList.remove('-translate-x-full');
                    sidebarOverlay.classList.remove('hidden');
                });

                closeSidebarBtn.addEventListener('click', function() {
                    mobileSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });

                sidebarOverlay.addEventListener('click', function() {
                    mobileSidebar.classList.add('-translate-x-full');
                    sidebarOverlay.classList.add('hidden');
                });
            }

            // Mobile menu functionality for guest users
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Close mobile menu if open
                        if (mobileMenu) {
                            mobileMenu.classList.add('hidden');
                        }
                        // Close mobile sidebar if open
                        if (mobileSidebar && sidebarOverlay) {
                            mobileSidebar.classList.add('-translate-x-full');
                            sidebarOverlay.classList.add('hidden');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
