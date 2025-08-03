<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-4">EduConnect</h3>
                <p class="text-gray-400 mb-4 max-w-md">
                    Connecting students, tutors, and guardians for a better educational experience. Join our community and start your learning journey today.
                </p>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}#features" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                    <li><a href="{{ route('home') }}#about" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                    <li><a href="{{ route('home') }}#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    <li><a href="{{ route('signup.show') }}" class="text-gray-400 hover:text-white transition-colors">Sign Up</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Support</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">FAQ</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8 text-center">
            <p class="text-gray-400">&copy; {{ date('Y') }} EduConnect. All rights reserved.</p>
        </div>
    </div>
</footer>
