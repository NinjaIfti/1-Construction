<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Get Started | 1 Contractor | Construction Permitting Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- jQuery (needed for some components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
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
        .gradient-bg {
            background: linear-gradient(135deg, #0A2240 0%, #1e3a5f 100%);
        }
        .form-input:focus {
            outline: none;
            border-color: #E31B23;
            box-shadow: 0 0 0 3px rgba(227, 27, 35, 0.2);
        }
        .step-connector {
            position: absolute;
            top: 36px;
            left: 18px;
            bottom: -12px;
            width: 2px;
            background-color: #E31B23;
            z-index: 0;
        }
        .last-step .step-connector {
            display: none;
        }
        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #E31B23;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 1;
        }
        .testimonial-card {
            position: relative;
            overflow: hidden;
        }
        .testimonial-quote {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 4rem;
            color: rgba(227, 27, 35, 0.1);
            line-height: 1;
        }
        /* Form input styles */
        .form-group label {
            @apply block text-sm font-medium text-gray-700 mb-1;
        }
        .form-group input, 
        .form-group select, 
        .form-group textarea {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-red-500 focus:ring focus:ring-red-200 focus:ring-opacity-50;
        }
        .form-group {
            @apply mb-4;
        }
        /* Progress bar styles */
        .progress-bar {
            height: 8px;
            border-radius: 4px;
            background-color: #EDF2F7;
            overflow: hidden;
        }
        .progress-value {
            height: 100%;
            background-color: #E31B23;
            transition: width 0.5s ease;
        }
        /* Tabs styles */
        .tab-btn {
            @apply px-4 py-2 font-medium rounded-t-lg border-b-2 border-transparent;
            transition: all 0.3s ease;
        }
        .tab-btn.active {
            @apply border-red-500 text-red-500;
        }
        @media (max-width: 640px) {
            .step-connector {
                left: 20px;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50">
    {{-- Include Navbar --}}
    @include('components.navbar')

    <!-- Hero Section -->
    <section class="gradient-bg text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-1 rounded-full text-white text-sm font-semibold mb-4">
                    Start Your Journey
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Get Started with <span class="text-[#E31B23]">1 Contractor</span></h1>
                <p class="text-xl mb-10 opacity-90 max-w-3xl mx-auto">Complete the steps below to create your account and start streamlining your permitting process today.</p>
                
                <!-- Progress indicator -->
                <div class="max-w-lg mx-auto mb-12">
                    <div class="flex justify-between mb-2 text-sm">
                        <span>Getting Started</span>
                        <span>3 simple steps</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-value" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Tabs Navigation -->
                <div class="mb-12 border-b border-gray-200">
                    <div class="flex overflow-x-auto space-x-4 pb-1">
                        <button class="tab-btn active" data-tab="account">
                            <span class="flex items-center">
                                <span class="w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center text-xs mr-2">1</span>
                                Account Info
                            </span>
                        </button>
                        <button class="tab-btn" data-tab="company">
                            <span class="flex items-center">
                                <span class="w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center text-xs mr-2">2</span>
                                Company Details
                            </span>
                        </button>
                        <button class="tab-btn" data-tab="preferences">
                            <span class="flex items-center">
                                <span class="w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center text-xs mr-2">3</span>
                                Preferences
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Tab Panels -->
                <div class="tab-content">
                    <!-- Account Info Tab -->
                    <div id="account-tab" class="tab-panel active">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-1/2 md:pr-8 mb-8 md:mb-0">
                                    <h2 class="text-2xl font-bold text-navy mb-4">Create Your Account</h2>
                                    <p class="text-gray-600 mb-6">Let's get started by setting up your account credentials. This information will be used to access your dashboard and manage your projects.</p>
                                    
                                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-info-circle text-blue-500"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-700">
                                                    Your data is secure and protected. We never share your information with third parties without your consent.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <form id="signup-form" method="POST" action="{{ route('register.contractor') }}" class="space-y-4">
                                        @csrf
                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" id="email" name="email" placeholder="your@email.com" required />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" name="password" placeholder="Create a secure password" required />
                                            <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters with 1 uppercase letter, 1 number, and 1 special character</p>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirm Password</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required />
                                        </div>
                                        
                                        <div class="form-group flex items-start">
                                            <input type="checkbox" id="terms" name="terms" class="mt-1 mr-2" required />
                                            <label for="terms" class="text-sm">
                                                I agree to the <a href="#" class="text-red-500 hover:underline">Terms of Service</a> and <a href="#" class="text-red-500 hover:underline">Privacy Policy</a>
                                            </label>
                                        </div>
                                        
                                        <div class="pt-4">
                                            <button type="button" id="next-to-company" class="w-full bg-red text-white py-3 px-4 rounded-lg font-medium hover:bg-opacity-90 transition-all duration-300 flex items-center justify-center">
                                                Continue to Company Details
                                                <i class="bi bi-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="w-full md:w-1/2">
                                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                                        <h3 class="text-xl font-semibold text-navy mb-4">Why choose 1 Contractor?</h3>
                                        
                                        <div class="space-y-4">
                                            <div class="flex">
                                                <div class="flex-shrink-0 text-red">
                                                    <i class="bi bi-check-circle-fill text-xl"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-base font-medium text-navy">Streamlined Permit Management</h4>
                                                    <p class="text-sm text-gray-600">All your permits in one place, with real-time status updates</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex">
                                                <div class="flex-shrink-0 text-red">
                                                    <i class="bi bi-check-circle-fill text-xl"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-base font-medium text-navy">Expert Guidance</h4>
                                                    <p class="text-sm text-gray-600">Get help from our team of permitting specialists</p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex">
                                                <div class="flex-shrink-0 text-red">
                                                    <i class="bi bi-check-circle-fill text-xl"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="text-base font-medium text-navy">Time & Cost Savings</h4>
                                                    <p class="text-sm text-gray-600">Reduce approval times by up to 60% and avoid costly delays</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-8">
                                            <div class="p-4 bg-white rounded-lg border border-gray-200">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0">
                                                        <img src="/api/placeholder/60/60" alt="Customer" class="w-12 h-12 rounded-full object-cover" />
                                                    </div>
                                                    <div class="ml-4">
                                                        <p class="text-sm text-gray-600 italic">"1 Contractor has revolutionized our permitting process. What used to take weeks now takes days!"</p>
                                                        <p class="text-sm font-medium text-navy mt-2">- Sarah Johnson, Johnson Construction</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Company Details Tab -->
                    <div id="company-tab" class="tab-panel hidden">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-1/2 md:pr-8 mb-8 md:mb-0">
                                    <h2 class="text-2xl font-bold text-navy mb-4">Company Information</h2>
                                    <p class="text-gray-600 mb-6">Tell us about your company so we can tailor our services to your specific needs.</p>
                                    
                                    <form class="space-y-4">
                                        <div class="form-group">
                                            <label for="company-name">Company Name</label>
                                            <input type="text" id="company-name" name="company_name" form="signup-form" placeholder="Enter your company name" required />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="company-type">Company Type</label>
                                            <select id="company-type" name="company_type" form="signup-form" required>
                                                <option value="" disabled selected>Select your company type</option>
                                                <option value="general-contractor">General Contractor</option>
                                                <option value="subcontractor">Subcontractor</option>
                                                <option value="developer">Developer</option>
                                                <option value="architect">Architecture Firm</option>
                                                <option value="engineering">Engineering Firm</option>
                                                <option value="owner">Property Owner</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="company-size">Company Size</label>
                                            <select id="company-size" name="company_size" form="signup-form" required>
                                                <option value="" disabled selected>Select your company size</option>
                                                <option value="1-5">1-5 employees</option>
                                                <option value="6-20">6-20 employees</option>
                                                <option value="21-50">21-50 employees</option>
                                                <option value="51-200">51-200 employees</option>
                                                <option value="201+">201+ employees</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" id="phone" name="phone" form="signup-form" placeholder="(123) 456-7890" />
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="address">Company Address</label>
                                            <input type="text" id="address" name="address" form="signup-form" placeholder="Street Address" />
                                        </div>
                                        
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" id="city" name="city" form="signup-form" />
                                            </div>
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" id="state" name="state" form="signup-form" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="zip">ZIP Code</label>
                                            <input type="text" id="zip" name="zip" form="signup-form" placeholder="12345" />
                                        </div>
                                        
                                        <div class="pt-4 flex space-x-4">
                                            <button type="button" id="back-to-account" class="w-1/2 border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition-all duration-300">
                                                <i class="bi bi-arrow-left mr-2"></i>
                                                Back
                                            </button>
                                            <button type="button" id="next-to-preferences" class="w-1/2 bg-red text-white py-3 px-4 rounded-lg font-medium hover:bg-opacity-90 transition-all duration-300">
                                                Continue
                                                <i class="bi bi-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="w-full md:w-1/2">
                                    <div class="bg-navy text-white p-6 rounded-lg">
                                        <h3 class="text-xl font-semibold mb-4">How we work with different companies</h3>
                                        
                                        <div class="space-y-6">
                                            <div>
                                                <h4 class="text-lg font-medium flex items-center">
                                                    <i class="bi bi-building mr-2"></i>
                                                    General Contractors
                                                </h4>
                                                <p class="text-white/80 text-sm mt-1">We help streamline the permit process, allowing you to focus on project execution rather than paperwork.</p>
                                            </div>
                                            
                                            <div>
                                                <h4 class="text-lg font-medium flex items-center">
                                                    <i class="bi bi-house mr-2"></i>
                                                    Developers
                                                </h4>
                                                <p class="text-white/80 text-sm mt-1">From single developments to nationwide rollouts, we ensure predictable timelines and requirements.</p>
                                            </div>
                                            
                                            <div>
                                                <h4 class="text-lg font-medium flex items-center">
                                                    <i class="bi bi-pencil-square mr-2"></i>
                                                    Architects & Engineers
                                                </h4>
                                                <p class="text-white/80 text-sm mt-1">Submit and track permits, receive and respond to municipal comments all in one platform.</p>
                                            </div>
                                            
                                            <div>
                                                <h4 class="text-lg font-medium flex items-center">
                                                    <i class="bi bi-person mr-2"></i>
                                                    Property Owners
                                                </h4>
                                                <p class="text-white/80 text-sm mt-1">Navigate complex permitting requirements with expert guidance, even if you're not a construction professional.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-6 pt-6 border-t border-white/20">
                                            <p class="text-sm">Need help determining if 1 Contractor is right for your business?</p>
                                            <a href="#" class="inline-block mt-2 text-sm text-white font-medium border-b border-white/60 hover:border-white transition-colors">
                                                Schedule a consultation call →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Preferences Tab -->
                    <div id="preferences-tab" class="tab-panel hidden">
                        <div class="bg-white rounded-lg shadow-lg p-8">
                            <div class="flex flex-col md:flex-row">
                                <div class="w-full md:w-1/2 md:pr-8 mb-8 md:mb-0">
                                    <h2 class="text-2xl font-bold text-navy mb-4">Almost Done! Set Your Preferences</h2>
                                    <p class="text-gray-600 mb-6">Customize your experience to get the most out of 1 Contractor.</p>
                                    
                                    <form class="space-y-4">
                                        <div class="form-group">
                                            <label class="text-base font-medium">Primary focus of your projects</label>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="residential" name="project_types[]" form="signup-form" value="residential" class="mt-1 mr-2" />
                                                    <label for="residential" class="text-sm">Residential Construction</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="commercial" name="project_types[]" form="signup-form" value="commercial" class="mt-1 mr-2" />
                                                    <label for="commercial" class="text-sm">Commercial Construction</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="industrial" name="project_types[]" form="signup-form" value="industrial" class="mt-1 mr-2" />
                                                    <label for="industrial" class="text-sm">Industrial Construction</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="infrastructure" name="project_types[]" form="signup-form" value="infrastructure" class="mt-1 mr-2" />
                                                    <label for="infrastructure" class="text-sm">Infrastructure & Civil</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="text-base font-medium">Services you're interested in</label>
                                            <div class="mt-2 space-y-2">
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="permit-research" name="services[]" form="signup-form" value="permit-research" class="mt-1 mr-2" />
                                                    <label for="permit-research" class="text-sm">Permit Research & Requirements</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="permit-submission" name="services[]" form="signup-form" value="permit-submission" class="mt-1 mr-2" />
                                                    <label for="permit-submission" class="text-sm">Permit Submission & Management</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="expediting" name="services[]" form="signup-form" value="expediting" class="mt-1 mr-2" />
                                                    <label for="expediting" class="text-sm">Permit Expediting Services</label>
                                                </div>
                                                <div class="flex items-start">
                                                    <input type="checkbox" id="consulting" name="services[]" form="signup-form" value="consulting" class="mt-1 mr-2" />
                                                    <label for="consulting" class="text-sm">Compliance Consulting</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="project-volume">How many permitting projects do you handle per year?</label>
                                            <select id="project-volume" name="project_volume" form="signup-form">
                                                <option value="" disabled selected>Select option</option>
                                                <option value="1-5">1-5 projects</option>
                                                <option value="6-20">6-20 projects</option>
                                                <option value="21-50">21-50 projects</option>
                                                <option value="51+">51+ projects</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="hear-about">How did you hear about us?</label>
                                            <select id="hear-about" name="hear_about" form="signup-form">
                                                <option value="" disabled selected>Select option</option>
                                                <option value="search">Search Engine</option>
                                                <option value="social">Social Media</option>
                                                <option value="referral">Referral from Colleague</option>
                                                <option value="event">Industry Event</option>
                                                <option value="advertisement">Advertisement</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="pt-4 flex space-x-4">
                                            <button type="button" id="back-to-company" class="w-1/2 border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition-all duration-300">
                                                <i class="bi bi-arrow-left mr-2"></i>
                                                Back
                                            </button>
                                            <button type="submit" form="signup-form" class="w-1/2 bg-red text-white py-3 px-4 rounded-lg font-medium hover:bg-opacity-90 transition-all duration-300">
                                                Complete Registration
                                                <i class="bi bi-check-circle ml-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="w-full md:w-1/2">
                                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                                        <h3 class="text-xl font-semibold text-navy mb-4">What happens next?</h3>
                                        
                                        <div class="relative pl-10 pb-6">
                                            <div class="step-circle">1</div>
                                            <div class="step-connector"></div>
                                            <div class="ml-4 mt-4">
                                                <h4 class="text-lg font-medium text-navy">Account Activation</h4>
                                                <p class="text-sm text-gray-600 mt-1">After completing registration, you'll receive an email to verify your account.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="relative pl-10 pb-6">
                                            <div class="step-circle">2</div>
                                            <div class="step-connector"></div>
                                            <div class="ml-4 mt-4">
                                                <h4 class="text-lg font-medium text-navy">Platform Tour</h4>
                                                <p class="text-sm text-gray-600 mt-1">One of our onboarding specialists will give you a personalized tour of the platform.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="relative pl-10 pb-6">
                                            <div class="step-circle">3</div>
                                            <div class="step-connector"></div>
                                            <div class="ml-4 mt-4">
                                                <h4 class="text-lg font-medium text-navy">Set Up Your Profile</h4>
                                                <p class="text-sm text-gray-600 mt-1">Complete your profile by adding team members and project details.</p>
                                            </div>
                                        </div>
                                        
                                        <div class="relative pl-10 last-step">
                                            <div class="step-circle">4</div>
                                            <div class="step-connector"></div>
                                            <div class="ml-4 mt-4">
                                                <h4 class="text-lg font-medium text-navy">Start Submitting Permits</h4>
                                                <p class="text-sm text-gray-600 mt-1">Begin using our platform to streamline your permitting process!</p>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                                            <p class="text-sm text-blue-800">Need help with the registration process? Our support team is available Monday-Friday from 8am-6pm EST.</p>
                                            <p class="text-sm font-medium text-blue-800 mt-2">Call us at (555) 123-4567 or email <a href="mailto:support@1contractor.com" class="underline">support@1contractor.com</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@include('components.footer')
   </body>
</html>

<script>
    // Update progress bar when changing tabs
    document.getElementById('next-to-company').addEventListener('click', function() {
        document.querySelector('.progress-value').style.width = '33%';
        document.querySelector('[data-tab="account"]').classList.remove('active');
        document.querySelector('[data-tab="company"]').classList.add('active');
        document.querySelector('#account-tab').classList.add('hidden');
        document.querySelector('#company-tab').classList.remove('hidden');
    });
    
    document.getElementById('back-to-account').addEventListener('click', function() {
        document.querySelector('.progress-value').style.width = '0%';
        document.querySelector('[data-tab="company"]').classList.remove('active');
        document.querySelector('[data-tab="account"]').classList.add('active');
        document.querySelector('#company-tab').classList.add('hidden');
        document.querySelector('#account-tab').classList.remove('hidden');
    });
    
    document.getElementById('next-to-preferences').addEventListener('click', function() {
        document.querySelector('.progress-value').style.width = '66%';
        document.querySelector('[data-tab="company"]').classList.remove('active');
        document.querySelector('[data-tab="preferences"]').classList.add('active');
        document.querySelector('#company-tab').classList.add('hidden');
        document.querySelector('#preferences-tab').classList.remove('hidden');
    });
    
    document.getElementById('back-to-company').addEventListener('click', function() {
        document.querySelector('.progress-value').style.width = '33%';
        document.querySelector('[data-tab="preferences"]').classList.remove('active');
        document.querySelector('[data-tab="company"]').classList.add('active');
        document.querySelector('#preferences-tab').classList.add('hidden');
        document.querySelector('#company-tab').classList.remove('hidden');
    });
    
    // Complete progress bar when submitting the form
    document.getElementById('signup-form').addEventListener('submit', function() {
        document.querySelector('.progress-value').style.width = '100%';
    });
</script>
