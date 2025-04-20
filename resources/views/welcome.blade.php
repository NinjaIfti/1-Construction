<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PermitFlow Clone | Construction Permitting Software</title>
    <meta name="description" content="PermitFlow simplifies permit preparation, submission, and tracks nationwide. Our platform handles the paperwork across all municipalities.">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom configuration for Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0A7AFF',
                        secondary: '#F8AE0B',
                        dark: '#0F0E33',
                        light: '#F5F7FA',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Custom CSS for elements not easily handled with Tailwind -->
    <style>
        /* General styles */
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Animation classes */
        .fade-in-up {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Header sticky effect */
        .header {
            transition: background-color 0.3s ease;
        }

        .header.sticky {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Hero diagonal shape */
        .hero-diagonal {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 30%;
            height: 100%;
            background-color: #0F0E33;
            clip-path: polygon(100% 0, 100% 100%, 0 100%);
            z-index: -1;
        }

        /* Logo carousel animation */
        @keyframes logoScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        .logo-carousel {
            animation: logoScroll 30s linear infinite;
        }

        /* Progress bar animation for "How it works" */
        .progress-bar {
            height: 2px;
            width: 0;
            background-color: #0A7AFF;
            transition: width 0.3s ease;
        }

        .progress-step.active .progress-bar {
            width: 100%;
        }

        .progress-step.active .step-text {
            color: #0A7AFF;
        }

        /* Slider controls */
        .slider-control {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background-color: #0F0E33;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slider-control:hover {
            background-color: #0A7AFF;
        }

        /* Custom decorative lines */
        .decorative-line {
            height: 2px;
            background-color: rgba(10, 122, 255, 0.1);
        }

        /* Dropdown animations */
        .dropdown-menu {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            pointer-events: none;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* Mobile navigation slide-in effect */
        .mobile-nav {
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .mobile-nav.open {
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-white text-dark">
<!-- Notification Banner -->
<div id="notification-banner" class="bg-primary text-white px-4 py-3 flex justify-between items-center">
    <div class="flex-1 text-center md:text-left">
        <strong>Upcoming Webinar</strong> | Tariffs: What they Mean for Homebuilders & Contractors
    </div>
    <div class="flex items-center">
        <a href="#" class="text-white hover:underline mr-8 flex items-center">
            <strong>Register Now</strong>
            <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
        <button id="close-banner" class="text-white">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>

<!-- Header/Navigation -->
<header id="main-header" class="header fixed w-full top-0 mt-12 z-50 transition-all">
    <div class="container mx-auto px-4 md:px-8">
        <nav class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="#" class="flex-shrink-0">
                <img src="/api/placeholder/180/40" alt="PermitFlow Logo" class="h-10">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <!-- Nav Links -->
                <div class="relative dropdown group">
                    <button class="flex items-center space-x-1 text-dark hover:text-primary transition-colors">
                        <span>Product</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-80 bg-white shadow-lg rounded-md py-4 px-6 z-10">
                        <div class="grid grid-cols-1 gap-4">
                            <a href="#" class="flex items-start hover:bg-light p-3 rounded-lg">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="/api/placeholder/40/40" alt="Permit Research" class="w-10 h-10">
                                </div>
                                <div>
                                    <div class="font-semibold text-dark">Permit Research</div>
                                    <p class="text-sm text-gray-600 mt-1">Permit research for any project in any municipality.</p>
                                    <div class="flex items-center mt-2 text-primary text-sm">
                                        <span>Learn more</span>
                                        <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                            <!-- More menu items would go here -->
                        </div>
                    </div>
                </div>

                <div class="relative dropdown group">
                    <button class="flex items-center space-x-1 text-dark hover:text-primary transition-colors">
                        <span>Solutions</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-60 bg-white shadow-lg rounded-md py-4 px-6 z-10">
                        <div class="space-y-3">
                            <div class="text-sm font-medium text-gray-500">Who we serve</div>
                            <a href="#" class="block text-dark hover:text-primary">Home Builders</a>
                            <a href="#" class="block text-dark hover:text-primary">Developers</a>
                            <a href="#" class="block text-dark hover:text-primary">General Contractors</a>
                            <a href="#" class="block text-dark hover:text-primary">Subcontractors</a>
                            <a href="#" class="block text-dark hover:text-primary">Solar & EV</a>
                            <a href="#" class="block text-dark hover:text-primary">Architects</a>
                        </div>
                    </div>
                </div>

                <div class="relative dropdown group">
                    <button class="flex items-center space-x-1 text-dark hover:text-primary transition-colors">
                        <span>Resources</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div class="dropdown-menu absolute left-0 mt-2 w-80 bg-white shadow-lg rounded-md py-4 px-6 z-10">
                        <!-- Resource menu content -->
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="hidden lg:flex items-center space-x-4">
                <a href="#" class="px-5 py-2 border border-primary text-primary rounded-md hover:bg-primary hover:text-white transition-colors">
                    Sign In
                </a>
                <a href="#" class="px-5 py-2 bg-primary text-white rounded-md hover:bg-dark transition-colors">
                    Talk to an Expert
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </nav>
    </div>

    <!-- Mobile Navigation (Hidden by default) -->
    <div id="mobile-nav" class="mobile-nav fixed inset-0 bg-white z-50 lg:hidden pt-20 px-4 overflow-y-auto">
        <div class="space-y-6 pb-8">
            <div class="border-b pb-4">
                <button class="flex items-center justify-between w-full text-left py-2">
                    <span class="font-medium">Product</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="hidden pl-4 pt-2 pb-1 space-y-2">
                    <!-- Mobile submenu items -->
                </div>
            </div>

            <!-- More mobile menu items -->

            <div class="pt-4 space-y-4">
                <a href="#" class="block w-full px-5 py-3 text-center border border-primary text-primary rounded-md hover:bg-primary hover:text-white transition-colors">
                    Sign In
                </a>
                <a href="#" class="block w-full px-5 py-3 text-center bg-primary text-white rounded-md hover:bg-dark transition-colors">
                    Talk to an Expert
                </a>
            </div>
        </div>

        <!-- Mobile Menu Close Button -->
        <button id="close-mobile-menu" class="absolute top-4 right-4">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</header>

<!-- Hero Section -->
<section class="bg-dark text-white pt-32 pb-20 md:pt-40 md:pb-36 relative overflow-hidden">
    <div class="container mx-auto px-4 md:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="max-w-xl">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 fade-in-up">Fast, Easy Permitting</h1>
                <p class="text-lg md:text-xl mb-8 opacity-90 fade-in-up">
                    Permit software for developers, builders, contractors, and more. PermitFlow handles the permit preparation, submission, and tracking nationwide — across all municipalities you're building in.
                </p>
                <a href="#" class="inline-flex items-center px-8 py-4 bg-secondary text-dark rounded-md font-semibold hover:bg-white transition-colors fade-in-up">
                    <span>Talk to an Expert</span>
                    <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            <div class="relative hidden lg:block">
                <!-- Placeholder for video/image -->
                <div class="bg-primary bg-opacity-20 rounded-lg h-96 w-full"></div>
            </div>
        </div>
    </div>
    <!-- Decorative elements -->
    <div class="hero-diagonal"></div>
</section>

<!-- Client Logos Section -->
<section class="bg-dark text-white py-12">
    <div class="container mx-auto px-4 md:px-8">
        <h3 class="text-center text-lg font-medium mb-10">Trusted by the nation's leading construction teams</h3>

        <!-- Logo Carousel -->
        <div class="overflow-hidden relative">
            <div class="flex logo-carousel py-4">
                <!-- Duplicate these for continuous scroll effect -->
                <div class="flex items-center space-x-16 mx-8">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-10 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-8 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-10 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-7 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-9 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-8 w-auto">
                </div>
                <div class="flex items-center space-x-16 mx-8">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-10 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-8 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-10 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-7 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-9 w-auto">
                    <img src="/api/placeholder/150/50" alt="Client logo" class="h-8 w-auto">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Value Proposition Section -->
<section class="py-20 md:py-28">
    <div class="container mx-auto px-4 md:px-8">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 fade-in-up">Why builders permit with PermitFlow</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Value Card 1 -->
            <div class="fade-in-up">
                <div class="bg-light rounded-lg overflow-hidden mb-6 h-60 relative">
                    <img src="/api/placeholder/400/320" alt="Permits Faster & Easier" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4">
                        <img src="/api/placeholder/60/60" alt="Icon" class="w-14 h-14 rounded-lg">
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-3">01. Permits Faster & Easier</h3>
                <p class="text-gray-600">
                    We take paperwork and submittals off your hands. We combine software and local knowledge to prepare requirement ready, error-free applications that save your team hours of time.
                </p>
            </div>

            <!-- Value Card 2 -->
            <div class="fade-in-up" style="transition-delay: 0.1s;">
                <div class="bg-light rounded-lg overflow-hidden mb-6 h-60 relative">
                    <img src="/api/placeholder/400/320" alt="Team of Local Experts" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4">
                        <img src="/api/placeholder/60/60" alt="Icon" class="w-14 h-14 rounded-lg">
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-3">02. Team of Local Experts</h3>
                <p class="text-gray-600">
                    We are a team of highly experienced permitting professionals with years of collective experience. Our deep, local municipal expertise ensures your project is permitted smoothly.
                </p>
            </div>

            <!-- Value Card 3 -->
            <div class="fade-in-up" style="transition-delay: 0.2s;">
                <div class="bg-light rounded-lg overflow-hidden mb-6 h-60 relative">
                    <img src="/api/placeholder/400/320" alt="Permit in One Place" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4">
                        <img src="/api/placeholder/60/60" alt="Icon" class="w-14 h-14 rounded-lg">
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-3">03. Permit in One Place</h3>
                <p class="text-gray-600">
                    Submit, track, and pull permits all in one platform and avoid deciphering municipal websites. Collaborate with your architects, contractors, and stakeholders.
                </p>
            </div>

            <!-- Value Card 4 -->
            <div class="fade-in-up" style="transition-delay: 0.3s;">
                <div class="bg-light rounded-lg overflow-hidden mb-6 h-60 relative">
                    <img src="/api/placeholder/400/320" alt="Nationwide Coverage" class="w-full h-full object-cover">
                    <div class="absolute bottom-4 left-4">
                        <img src="/api/placeholder/60/60" alt="Icon" class="w-14 h-14 rounded-lg">
                    </div>
                </div>
                <h3 class="text-lg font-semibold mb-3">04. Nationwide Coverage</h3>
                <p class="text-gray-600">
                    With our nationwide coverage, we can help you with permits in a single municipality or across multiple states. Whether starting out or scaling quickly, we're here to partner with you.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How it Works Section -->
<section id="how-it-works" class="py-20 bg-light">
    <div class="container mx-auto px-4 md:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 fade-in-up">How it works</h2>
            <p class="text-xl text-gray-600 fade-in-up">Our streamlined, digitized process makes permitting faster, easier, and all in one place.</p>
        </div>

        <!-- Steps Navigation -->
        <div class="hidden md:flex justify-between mb-12 border-b border-gray-200 relative">
            <div class="progress-step active flex-1 pb-3 relative cursor-pointer" data-step="1">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 1</div>
                    <div class="step-text font-medium">Request a Free Quote</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="progress-step flex-1 pb-3 relative cursor-pointer" data-step="2">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 2</div>
                    <div class="step-text font-medium">Prepare Application</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="progress-step flex-1 pb-3 relative cursor-pointer" data-step="3">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 3</div>
                    <div class="step-text font-medium">Submit</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="progress-step flex-1 pb-3 relative cursor-pointer" data-step="4">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 4</div>
                    <div class="step-text font-medium">Tracking</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="progress-step flex-1 pb-3 relative cursor-pointer" data-step="5">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 5</div>
                    <div class="step-text font-medium">Comments & Corrections</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="progress-step flex-1 pb-3 relative cursor-pointer" data-step="6">
                <div class="flex flex-col items-center">
                    <div class="text-sm font-medium text-gray-500">Step 6</div>
                    <div class="step-text font-medium">Approvals</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>
        </div>

        <!-- Step Content (Only the active one is shown) -->
        <div class="steps-container">
            <!-- Step 1 -->
            <div class="step-content active" data-step="1">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="md:hidden text-sm font-medium text-primary mb-1">Step 1</div>
                        <h3 class="text-2xl font-bold mb-4">Request a Free Quote</h3>
                        <p class="text-gray-600 mb-6">
                            Complete our simple project intake form and receive an accurate price quote with estimated approval timelines. Planning, building, or addendums we're here to help you permit at any phase of your project.
                        </p>
                        <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                            <span>Learn more</span>
                            <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <img src="/api/placeholder/500/350" alt="Request a Free Quote" class="w-full h-auto rounded">
                    </div>
                </div>
            </div>

            <!-- Step 2 (Hidden initially) -->
            <div class="step-content hidden" data-step="2">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="md:hidden text-sm font-medium text-primary mb-1">Step 2</div>
                        <h3 class="text-2xl font-bold mb-4">Prepare Application</h3>
                        <p class="text-gray-600 mb-6">
                            Prepare the necessary permit application requirements all in PermitFlow. We've digitized the process to minimize errors, save time, and reduce your costs.
                        </p>
                        <a href="#" class="inline-flex items-center text-primary font-medium hover:underline">
                            <span>Learn more</span>
                            <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <img src="/api/placeholder/500/350" alt="Prepare Application" class="w-full h-auto rounded">
                    </div>
                </div>
            </div>

            <!-- Steps 3-6 would follow the same pattern -->
        </div>

        <!-- Mobile Steps Navigation -->
        <div class="flex justify-between mt-8 md:hidden">
            <button class="slider-control prev-step" aria-label="Previous step">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <button class="slider-control next-step" aria-label="Next step">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- Target Audience Section -->
<section class="py-20 bg-dark text-white">
    <div class="container mx-auto px-4 md:px-8">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 fade-in-up">Who is PermitFlow for?</h2>

        <!-- Audience Navigation -->
        <div class="hidden md:flex justify-between mb-8 border-b border-gray-700 relative">
            <div class="audience-tab active flex-1 pb-3 relative cursor-pointer" data-audience="1">
                <div class="text-center">
                    <div class="audience-text font-medium">Developers & Owners</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="audience-tab flex-1 pb-3 relative cursor-pointer" data-audience="2">
                <div class="text-center">
                    <div class="audience-text font-medium">Contractors & Subcontractors</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="audience-tab flex-1 pb-3 relative cursor-pointer" data-audience="3">
                <div class="text-center">
                    <div class="audience-text font-medium">Architects & Engineers</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>

            <div class="audience-tab flex-1 pb-3 relative cursor-pointer" data-audience="4">
                <div class="text-center">
                    <div class="audience-text font-medium">Permit Expediters</div>
                </div>
                <div class="progress-bar absolute bottom-0 left-0 right-0"></div>
            </div>
        </div>

        <!-- Audience Content -->
        <div class="audience-container">
            <!-- Audience 1 -->
            <div class="audience-content active" data-audience="1">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="md:hidden text-sm font-medium text-primary mb-1">Audience</div>
                        <h3 class="text-2xl font-bold mb-4">Developers & Owners</h3>
                        <p class="text-gray-300 mb-6">
                            We're here to help whether you're working on a single community or a nationwide rollout. We combine local expertise and software to ensure you have predictability and transparency on requirements, costs, and timelines. We permit faster so you can build faster.
                        </p>
                        <a href="#" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-md font-medium hover:bg-blue-600 transition-colors">
                            <span>Talk to an Expert</span>
                            <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="/api/placeholder/600/400" alt="Developers & Owners" class="w-full h-auto">
                    </div>
                </div>
            </div>

            <!-- Audience 2-4 would follow the same pattern (hidden initially) -->
        </div>

        <!-- Mobile Audience Navigation -->
        <div class="flex justify-between mt-8 md:hidden">
            <button class="slider-control prev-audience" aria-label="Previous audience">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <button class="slider-control next-audience" aria-label="Next audience">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- Services Offered Section -->
<section class="py-20">
    <div class="container mx-auto px-4 md:px-8">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 fade-in-up">What do we offer?</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            <!-- Column 1 -->
            <div class="fade-in-up">
                <h3 class="text-xl font-semibold mb-6 text-dark">Software Solutions</h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700">ADU</span>
                    </li>
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                            <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="ml-3 text-gray-700">Hospitality & Restaurants</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-light">
    <div class="container mx-auto px-4 md:px-8">
        <h2 class="text-4xl md:text-5xl font-bold mb-16 fade-in-up">What our users say</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white p-8 rounded-lg shadow-lg fade-in-up">
                <div class="flex mb-4">
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <p class="text-gray-700 mb-8">
                    "It used to take 2-3 months to get a permit. PermitFlow cut that in half, plus their website handles all the permitting paperwork."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 overflow-hidden">
                        <img src="/api/placeholder/48/48" alt="Customer" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center">
                            <div class="h-px w-6 bg-gray-400 mr-2"></div>
                            <div class="text-sm text-gray-500">Project Manager</div>
                        </div>
                        <div class="text-sm font-medium">General Contractor</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white p-8 rounded-lg shadow-lg fade-in-up" style="transition-delay: 0.1s;">
                <div class="flex mb-4">
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <p class="text-gray-700 mb-8">
                    "I would be depressed if I lost PermitFlow. It is a platform that I depend on. I have it open daily and our whole team uses it to monitor projects."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 overflow-hidden">
                        <img src="/api/placeholder/48/48" alt="Customer" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center">
                            <div class="h-px w-6 bg-gray-400 mr-2"></div>
                            <div class="text-sm text-gray-500">Ops Manager</div>
                        </div>
                        <div class="text-sm font-medium">General Contractor</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white p-8 rounded-lg shadow-lg fade-in-up" style="transition-delay: 0.2s;">
                <div class="flex mb-4">
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <p class="text-gray-700 mb-8">
                    "My expediter went on vacation, leaving me empty-handed on a time-sensitive project. PermitFlow kept that project on track, and it's reliable and easy-to-use."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gray-200 rounded-full mr-4 overflow-hidden">
                        <img src="/api/placeholder/48/48" alt="Customer" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center">
                            <div class="h-px w-6 bg-gray-400 mr-2"></div>
                            <div class="text-sm text-gray-500">Owner</div>
                        </div>
                        <div class="text-sm font-medium">General Contractor</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonial Controls (Mobile) -->
        <div class="flex justify-center mt-10 md:hidden">
            <button class="slider-control prev-testimonial mx-2" aria-label="Previous testimonial">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
            <button class="slider-control next-testimonial mx-2" aria-label="Next testimonial">
                <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 relative">
    <div class="container mx-auto px-4 md:px-8">
        <div class="bg-primary rounded-lg overflow-hidden shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="relative p-8 lg:p-12">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600 rounded-bl-full opacity-20"></div>
                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Experience a 60% faster time to permit with PermitFlow</h2>
                        <a href="#" class="inline-flex items-center px-8 py-4 bg-secondary text-dark rounded-md font-semibold hover:bg-white transition-colors">
                            <span>Talk to an Expert</span>
                            <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="/api/placeholder/600/400" alt="Building work" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white pt-16 pb-8">
    <div class="container mx-auto px-4 md:px-8">
        <!-- Main Footer -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
            <!-- Column 1: Logo and Social Links -->
            <div>
                <a href="#" class="inline-block mb-6">
                    <img src="/api/placeholder/160/40" alt="PermitFlow" class="h-10">
                </a>
                <div class="flex space-x-4 mb-8">
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Column 2: Product Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Product</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Permit Research</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Permit Preparation & Submittals</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Permit Management & Monitoring</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Permit Data</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Expediting</a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Solutions Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Solutions</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Home Builders</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Developers</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">General Contractors</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Subcontractors</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Solar & EV</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Architects</a>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Resources & Company Links -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Resources</h3>
                <ul class="space-y-3 mb-6">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Talk to Sales</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">News</a>
                    </li>
                </ul>

                <h3 class="text-lg font-semibold mb-4">Company</h3>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom: Copyright & Legal -->
        <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-400 text-sm mb-4 md:mb-0">
                &copy; <span id="current-year"></span> PermitFlow. All Rights Reserved.
            </div>
            <div class="flex space-x-6">
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Use</a>
                <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript for interactive elements -->
<script>
    // Set current year in footer copyright
    document.getElementById('current-year').textContent = new Date().getFullYear();

    // Banner close functionality
    document.getElementById('close-banner').addEventListener('click', function() {
        document.getElementById('notification-banner').style.display = 'none';
        document.getElementById('main-header').classList.remove('mt-12');
    });

    // Sticky header
    window.addEventListener('scroll', function() {
        const header = document.getElementById('main-header');
        if (window.scrollY > 50) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
    });

    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-nav').classList.add('open');
    });

    document.getElementById('close-mobile-menu').addEventListener('click', function() {
        document.getElementById('mobile-nav').classList.remove('open');
    });

    // Fade-in animations on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in-up');

        function checkFade() {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;

                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('active');
                }
            });
        }

        // Check on initial load
        checkFade();

        // Check on scroll
        window.addEventListener('scroll', checkFade);
    });

    // How it works steps interaction
    document.addEventListener('DOMContentLoaded', function() {
        const steps = document.querySelectorAll('.progress-step');
        const stepContents = document.querySelectorAll('.step-content');

        steps.forEach(step => {
            step.addEventListener('click', function() {
                const stepIndex = this.getAttribute('data-step');

                // Update active step indicator
                steps.forEach(s => s.classList.remove('active'));
                this.classList.add('active');

                // Show corresponding content
                stepContents.forEach(content => {
                    content.classList.add('hidden');
                    if (content.getAttribute('data-step') === stepIndex) {
                        content.classList.remove('hidden');
                        content.classList.add('active');
                    }
                });
            });
        });

        // Mobile slider controls
        const prevStepBtn = document.querySelector('.prev-step');
        const nextStepBtn = document.querySelector('.next-step');

        if (prevStepBtn && nextStepBtn) {
            let currentStep = 1;

            prevStepBtn.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep--;
                    const step = document.querySelector(`.progress-step[data-step="${currentStep}"]`);
                    if (step) step.click();
                }
            });

            nextStepBtn.addEventListener('click', function() {
                if (currentStep < steps.length) {
                    currentStep++;
                    const step = document.querySelector(`.progress-step[data-step="${currentStep}"]`);
                    if (step) step.click();
                }
            });
        }
    });

    // Target audience tabs interaction
    document.addEventListener('DOMContentLoaded', function() {
        const audienceTabs = document.querySelectorAll('.audience-tab');
        const audienceContents = document.querySelectorAll('.audience-content');

        audienceTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const audienceIndex = this.getAttribute('data-audience');

                // Update active tab indicator
                audienceTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Show corresponding content
                audienceContents.forEach(content => {
                    content.classList.add('hidden');
                    if (content.getAttribute('data-audience') === audienceIndex) {
                        content.classList.remove('hidden');
                        content.classList.add('active');
                    }
                });
            });
        });

        // Mobile audience slider controls
        const prevAudienceBtn = document.querySelector('.prev-audience');
        const nextAudienceBtn = document.querySelector('.next-audience');

        if (prevAudienceBtn && nextAudienceBtn) {
            let currentAudience = 1;

            prevAudienceBtn.addEventListener('click', function() {
                if (currentAudience > 1) {
                    currentAudience--;
                    const tab = document.querySelector(`.audience-tab[data-audience="${currentAudience}"]`);
                    if (tab) tab.click();
                }
            });

            nextAudienceBtn.addEventListener('click', function() {
                if (currentAudience < audienceTabs.length) {
                    currentAudience++;
                    const tab = document.querySelector(`.audience-tab[data-audience="${currentAudience}"]`);
                    if (tab) tab.click();
                }
            });
        }
    });

    // Logo carousel animation
    // The animation is handled by CSS, no JS required

    // Mobile testimonial slider
    document.addEventListener('DOMContentLoaded', function() {
        const testimonials = document.querySelectorAll('.bg-white.p-8.rounded-lg.shadow-lg');
        const prevTestimonialBtn = document.querySelector('.prev-testimonial');
        const nextTestimonialBtn = document.querySelector('.next-testimonial');

        if (window.innerWidth < 768 && prevTestimonialBtn && nextTestimonialBtn) {
            let currentTestimonial = 0;

            // Initially hide all but first testimonial on mobile
            testimonials.forEach((testimonial, index) => {
                if (index !== currentTestimonial) {
                    testimonial.style.display = 'none';
                }
            });

            prevTestimonialBtn.addEventListener('click', function() {
                testimonials[currentTestimonial].style.display = 'none';
                currentTestimonial = (currentTestimonial - 1 + testimonials.length) % testimonials.length;
                testimonials[currentTestimonial].style.display = 'block';
            });

            nextTestimonialBtn.addEventListener('click', function() {
                testimonials[currentTestimonial].style.display = 'none';
                currentTestimonial = (currentTestimonial + 1) % testimonials.length;
                testimonials[currentTestimonial].style.display = 'block';
            });
        }
    });
</script>
</body>
</html>

</div>
<span class="ml-3 text-gray-700">Signage</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>dd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Expediting</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Permit Research</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Application & Submittals</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Approval Tracking & Municipal Comments</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Management & Expirations</span>
</li>
<li class="flex items-start">
    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
    <span class="ml-3 text-gray-700">Permit Data</span>
</li>
</ul>
</div>

<!-- Column 2 -->
<div class="fade-in-up" style="transition-delay: 0.1s;">
    <h3 class="text-xl font-semibold mb-6 text-dark">Permits</h3>
    <ul class="space-y-4">
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Building Permits</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Construction Permits</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Mechanical Permits</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Electrical Permits</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Plumbing Permits</span>
        </li>
    </ul>
</div>

<!-- Column 3 -->
<div class="fade-in-up" style="transition-delay: 0.2s;">
    <h3 class="text-xl font-semibold mb-6 text-dark">Project Types</h3>
    <ul class="space-y-4">
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">New Construction</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Tenant Improvements</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Single & Multi-Family Homes</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Roofing</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="ml-3 text-gray-700">Signage</span>
        </li>
        <li class="flex items-start">
            <div class="flex-shrink-0 w-6 h-6 rounded-full bg-primary flex items-center justify-center mt-0.5">
                <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="eveno
