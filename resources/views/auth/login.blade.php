<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login | 1 Contractor | Construction Permitting Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <!-- jQuery (needed for some components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        .text-navy {
            color: #0A2240;
        }
        .bg-navy {
            background-color: #0A2240;
        }
        .text-red {
            color: #E31B23;
        }
        .bg-red {
            background-color: #E31B23;
        }
        .border-red {
            border-color: #E31B23;
        }
        .focus\:ring-red:focus {
            --tw-ring-color: rgba(227, 27, 35, 0.5);
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);
            box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            border-color: #E31B23;
        }
        .hover\:bg-red-800:hover {
            background-color: #b91922;
        }
        .form-input:focus {
            outline: none;
            border-color: #E31B23;
            box-shadow: 0 0 0 3px rgba(227, 27, 35, 0.2);
        }
        .login-bg-pattern {
            background-color: #0A2240;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23E31B23' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        /* Custom checkbox styling */
        .custom-checkbox {
            position: relative;
            padding-left: 2rem;
            cursor: pointer;
            user-select: none;
        }
        .custom-checkbox input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            height: 0;
            width: 0;
        }
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 18px;
            width: 18px;
            border: 2px solid #0A2240;
            border-radius: 4px;
        }
        .custom-checkbox input:checked ~ .checkmark {
            background-color: #E31B23;
            border-color: #E31B23;
        }
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        .custom-checkbox input:checked ~ .checkmark:after {
            display: block;
        }
        .custom-checkbox .checkmark:after {
            left: 5px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .login-container {
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                border-radius: 0.5rem;
                overflow: hidden;
                background-color: white;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50">
    {{-- Include Navbar --}}
    @include('components.navbar')

    <!-- Login Section -->
    <section class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl w-full login-container">
            <!-- On mobile: just the form -->
            <div class="lg:hidden w-full bg-white p-6 sm:p-10 rounded-lg shadow-lg">
                <div class="w-full max-w-md mx-auto">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl sm:text-3xl font-bold text-navy mb-2">Welcome back</h2>
                        <p class="text-gray-600">Sign in to access your account</p>
                    </div>
                    
                    @if ($errors->any())
                    <div class="bg-red-50 p-4 rounded mb-6">
                        <div class="text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email-mobile" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <input id="email-mobile" name="email" type="email" autocomplete="email" required 
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900" 
                                placeholder="name@company.com">
                        </div>
                        
                        <div>
                            <label for="password-mobile" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input id="password-mobile" name="password" type="password" autocomplete="current-password" required 
                                class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900" 
                                placeholder="••••••••">
                        </div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-center">
                                <label class="custom-checkbox relative flex items-start">
                                    <input type="checkbox" class="sr-only" name="remember">
                                    <span class="checkmark"></span>
                                    <span class="ml-6 text-sm text-gray-600">Remember me</span>
                                </label>
                            </div>
                            
                            <div class="text-sm">
                                <a href="#" class="font-medium text-red hover:text-red-800 hover:underline">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>
                        
                        <div>
                            <button type="submit" 
                                class="w-full bg-red text-white py-3 px-4 rounded-lg font-medium hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red shadow-md transition-all duration-300">
                                Sign in
                            </button>
                        </div>
                        
                    </form>
                    
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="px-4 bg-white text-sm text-gray-500">Or continue with</span>
                            </div>
                        </div>
                        
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('socialite.redirect', 'google') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M23.745 12.27c0-.79-.07-1.54-.19-2.27h-11.3v4.51h6.47c-.29 1.48-1.14 2.73-2.4 3.58v3h3.86c2.26-2.09 3.56-5.17 3.56-8.82z"></path>
                                    <path fill="#34A853" d="M12.255 24c3.24 0 5.95-1.08 7.93-2.91l-3.86-3c-1.08.72-2.45 1.16-4.07 1.16-3.13 0-5.78-2.11-6.73-4.96h-3.98v3.09c1.97 3.92 6.02 6.62 10.71 6.62z"></path>
                                    <path fill="#FBBC05" d="M5.525 14.29c-.25-.72-.38-1.49-.38-2.29s.14-1.57.38-2.29v-3.09h-3.98c-.82 1.62-1.29 3.44-1.29 5.38s.47 3.76 1.29 5.38l3.98-3.09z"></path>
                                    <path fill="#EA4335" d="M12.255 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42c-2.08-1.94-4.78-3.13-8.02-3.13-4.69 0-8.74 2.7-10.71 6.62l3.98 3.09c.95-2.85 3.6-4.96 6.73-4.96z"></path>
                                </svg>
                                Google
                            </a>
                            <a href="{{ route('socialite.redirect', 'linkedin') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0077B5]" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                                LinkedIn
                            </a>
                        </div>
                    </div>
                    
                    <div class="text-center mt-8">
                        <p class="text-sm text-gray-600">
                            Don't have an account? 
                            <a href="/get-started" class="font-medium text-red hover:text-red-800 hover:underline">
                                Sign up now
                            </a>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- On desktop: split view -->
            <div class="hidden lg:flex rounded-2xl shadow-2xl overflow-hidden">
                <!-- Left Side - Form -->
                <div class="w-1/2 bg-white p-12 xl:p-16">
                    <div class="w-full max-w-md mx-auto">
                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-bold text-navy mb-2">Welcome back</h2>
                            <p class="text-gray-600">Sign in to access your account</p>
                        </div>
                        
                        @if ($errors->any())
                        <div class="bg-red-50 p-4 rounded mb-6">
                            <div class="text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <form class="space-y-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                                <input id="email" name="email" type="email" autocomplete="email" required 
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900" 
                                    placeholder="name@company.com">
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <input id="password" name="password" type="password" autocomplete="current-password" required 
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900" 
                                    placeholder="••••••••">
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <label class="custom-checkbox relative flex items-start">
                                        <input type="checkbox" class="sr-only" name="remember">
                                        <span class="checkmark"></span>
                                        <span class="ml-6 text-sm text-gray-600">Remember me</span>
                                    </label>
                                </div>
                                
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-red hover:text-red-800 hover:underline">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>
                            <div>
                                <button type="submit" 
                                    class="w-full bg-red text-white py-3 px-4 rounded-lg font-medium hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red shadow-md transition-all duration-300">
                                    Sign in 
                                </button>
                            </div>
                            
                        </form>
                        
                        <div class="mt-8">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="px-4 bg-white text-sm text-gray-500">Or continue with</span>
                                </div>
                            </div>
                            
                            <div class="mt-6 grid grid-cols-2 gap-3">
                                <a href="{{ route('socialite.redirect', 'google') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg class="h-5 w-5 mr-2" viewBox="0 0 24 24">
                                        <path fill="#4285F4" d="M23.745 12.27c0-.79-.07-1.54-.19-2.27h-11.3v4.51h6.47c-.29 1.48-1.14 2.73-2.4 3.58v3h3.86c2.26-2.09 3.56-5.17 3.56-8.82z"></path>
                                        <path fill="#34A853" d="M12.255 24c3.24 0 5.95-1.08 7.93-2.91l-3.86-3c-1.08.72-2.45 1.16-4.07 1.16-3.13 0-5.78-2.11-6.73-4.96h-3.98v3.09c1.97 3.92 6.02 6.62 10.71 6.62z"></path>
                                        <path fill="#FBBC05" d="M5.525 14.29c-.25-.72-.38-1.49-.38-2.29s.14-1.57.38-2.29v-3.09h-3.98c-.82 1.62-1.29 3.44-1.29 5.38s.47 3.76 1.29 5.38l3.98-3.09z"></path>
                                        <path fill="#EA4335" d="M12.255 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42c-2.08-1.94-4.78-3.13-8.02-3.13-4.69 0-8.74 2.7-10.71 6.62l3.98 3.09c.95-2.85 3.6-4.96 6.73-4.96z"></path>
                                    </svg>
                                    Google
                                </a>
                                <a href="{{ route('socialite.redirect', 'linkedin') }}" class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#0077B5]" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                        
                        <div class="text-center mt-8">
                            <p class="text-sm text-gray-600">
                                Don't have an account? 
                                <a href="/get-started" class="font-medium text-red hover:text-red-800 hover:underline">
                                    Sign up now
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side - Image and Content -->
                <div class="w-1/2 login-bg-pattern">
                    <div class="flex items-center justify-center h-full px-12">
                        <div class="max-w-lg">
                            <div class="mb-8">
                                <div class="inline-block bg-white px-3 py-1 rounded-full text-navy text-sm font-semibold mb-4">
                                    Client Portal
                                </div>
                                <h1 class="text-4xl font-bold text-white mb-4">Manage your projects with ease</h1>
                                <p class="text-white text-lg opacity-90">
                                    Access all your permits, track application status, and manage your construction projects in one centralized dashboard.
                                </p>
                            </div>
                            
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20">
                                <div class="flex items-start mb-4">
                                    <div class="w-10 h-10 rounded-full bg-[#E31B23] bg-opacity-15 flex items-center justify-center mr-4 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Real-time updates</h3>
                                        <p class="text-white/75 text-sm">Get notified instantly about permit status changes</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="w-10 h-10 rounded-full bg-[#E31B23] bg-opacity-15 flex items-center justify-center mr-4 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-white font-semibold text-lg">Document management</h3>
                                        <p class="text-white/75 text-sm">All project documents securely stored in one place</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
   @include('components.footer')

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize mobile menu
            initMobileMenu();
            
            // Initialize sticky header
            initStickyHeader();
        });

        function initMobileMenu() {
            // Mobile menu toggle functionality
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                // Remove any initial classes that might interfere
                if (mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.remove('hidden');
                }
                
                mobileMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Toggle the 'show' class for dropdown effect
                    mobileMenu.classList.toggle('show');
                });
                
                // Close mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    const isClickInsideButton = mobileMenuButton.contains(event.target);
                    const isClickInsideMenu = mobileMenu.contains(event.target);
                    
                    if (!isClickInsideButton && !isClickInsideMenu && mobileMenu.classList.contains('show')) {
                        mobileMenu.classList.remove('show');
                    }
                });
                
                // Add ESC key support to close menu
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && mobileMenu.classList.contains('show')) {
                        mobileMenu.classList.remove('show');
                    }
                });
            }
        }

        function initStickyHeader() {
            // Sticky header functionality
            const header = document.getElementById('main-navbar');
            
            if (header) {
                const headerHeight = header.offsetHeight;
                
                function handleSticky() {
                    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
                    
                    if (scrollPosition > 10) {
                        if (!header.classList.contains('sticky-header')) {
                            header.classList.add('sticky-header');
                            document.body.style.paddingTop = headerHeight + 'px';
                        }
                    } else {
                        if (header.classList.contains('sticky-header')) {
                            header.classList.remove('sticky-header');
                            document.body.style.paddingTop = '0';
                        }
                    }
                }
                
                // Run on page load
                handleSticky();
                
                // Run on scroll
                window.addEventListener('scroll', handleSticky);
                
                // Update on window resize
                window.addEventListener('resize', function() {
                    if (header.classList.contains('sticky-header')) {
                        document.body.style.paddingTop = header.offsetHeight + 'px';
                    }
                });
            }
        }
    </script>
</body>
</html> 