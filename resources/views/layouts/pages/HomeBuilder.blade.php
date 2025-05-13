<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Home Builders | 1 Contractor | Construction Permitting Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery (needed for some components) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': '#0A2240',
                        'red': '#E31B23',
                        'homebuilder-red': '#E31B23',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        
        .trusted-logo {
    height: 60px;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s ease;
      }

       .trusted-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
            }
        .btn-primary {
            background-color: #E31B23;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(227, 27, 35, 0.25);
        }
        
        .btn-primary:hover {
            background-color: #c8171f;
            transform: translateY(-1px);
            box-shadow: 0 6px 8px rgba(227, 27, 35, 0.3);
        }
        
        .btn-red {
            background-color: #E31B23;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(227, 27, 35, 0.25);
        }
        
        .btn-red:hover {
            background-color: #c8171f;
            transform: translateY(-1px);
            box-shadow: 0 6px 8px rgba(227, 27, 35, 0.3);
        }
        
        .section-navy {
            background-color: #0A2240;
            color: white;
        }
        
        .section-homebuilder {
            background-color: #0A2240;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .section-homebuilder::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background-color: rgba(227, 27, 35, 0.1);
            clip-path: polygon(100% 0, 0 0, 100% 100%);
            z-index: 1;
        }
        
        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .workflow-step {
            background-color: #E31B23;
            color: white;
            transition: all 0.3s ease;
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(227, 27, 35, 0.3);
            position: relative;
            z-index: 2;
        }
        
        .workflow-step::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-color: #E31B23;
            z-index: -1;
            opacity: 0.3;
            transform: scale(1.2);
            transition: all 0.3s ease;
        }
        
        .workflow-step:hover {
            background-color: #c8171f;
            transform: scale(1.05);
        }
        
        .workflow-step:hover::before {
            transform: scale(1.4);
            opacity: 0.2;
        }
        
        .workflow-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }
        
        @media (min-width: 768px) {
            .workflow-row {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                position: relative;
            }
            
            .workflow-container {
                width: auto;
                margin-bottom: 0;
            }
            
            .workflow-connector {
                display: block;
                width: 100%;
                position: absolute;
                top: 36px;
                left: 0;
                right: 0;
                z-index: 1;
                border-top: 2px dashed rgba(10, 34, 64, 0.3);
            }
        }
        
        @media (max-width: 767px) {
            .workflow-connector {
                display: none;
            }
        }
        
        .workflow-title {
            font-size: 1.25rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        
        .workflow-desc {
            color: #4B5563;
            text-align: center;
            max-width: 18rem;
        }
        
        .testimonial-card {
            transition: all 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .feature-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background-color: rgba(227, 27, 35, 0.1);
            border-radius: 50%;
            margin-right: 1rem;
        }
        
        .feature-icon i {
            color: #E31B23;
            font-size: 1.5rem;
        }
        
        .section-divider {
            position: relative;
            height: 5rem;
            overflow: hidden;
        }
        
        .section-divider svg {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: translateY(1px);
        }
        
        .highlighted-text {
            color: #E31B23;
            font-weight: 600;
        }
        
        .faq-item {
            border-bottom: 1px solid #e5e7eb;
            padding: 1.5rem 0;
        }
        
        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        
        .trusted-logo {
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.4s ease;
            max-height: 50px;
        }
        
        .trusted-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
        }
        
        .section-overlay {
            position: relative;
        }
        
        .section-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 60%;
            height: 100%;
            background: linear-gradient(135deg, rgba(227, 27, 35, 0.05) 0%, rgba(10, 34, 64, 0.1) 100%);
            clip-path: polygon(100% 0, 40% 0, 100% 100%);
            z-index: 1;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section class="section-homebuilder min-h-[600px] relative pt-24 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-sm text-red-400 font-semibold uppercase tracking-wider mb-3">CONSTRUCTION PERMITTING SOLUTIONS</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight mb-6">Accelerate Your Building Permits & Construction Timeline</h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-8">Leading national home builders trust 1 Construction to reduce permit delays by up to 60%, increase efficiency, and deliver projects on time and under budget.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/get-started" class="btn-red inline-block text-center">
                            Schedule a Consultation
                        </a>
                        <a href="/resourcess" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-black transition-all inline-block text-center font-medium">
                            Resources
                        </a>
                    </div>
                    
                    <div class="mt-8 flex items-center">
                    <div class="flex -space-x-3">
    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=250&auto=format&fit=crop" class="w-10 h-10 rounded-full border-2 border-navy" alt="Client">
    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=250&auto=format&fit=crop" class="w-10 h-10 rounded-full border-2 border-navy" alt="Client">
    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=250&auto=format&fit=crop" class="w-10 h-10 rounded-full border-2 border-navy" alt="Client">
</div>
                        <div class="ml-3">
                            <div class="flex items-center text-yellow-400">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <span class="ml-2 text-white font-medium">4.9/5</span>
                            </div>
                            <p class="text-sm text-gray-300">From over 500 home builders nationwide</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg shadow-2xl">
                        <img src="{{ asset('images/home.png') }}" alt="Home construction site" class="w-full object-cover rounded-lg">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-navy to-transparent p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-white font-bold">Average Permit Reduction Time</p>
                                    <p class="text-red-400 font-bold text-3xl">60%</p>
                                </div>
                                <a href="/case-studies" class="text-white hover:text-red-400 transition-colors">
                                    <i class="bi bi-arrow-right text-2xl"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled background element -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-gradient-to-r from-red-600 to-red-500 opacity-10 -z-0" style="clip-path: polygon(100% 0, 30% 100%, 100% 100%);"></div>
    </section>
    
<!-- Trusted By Section -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto px-6 lg:px-8">
        <h2 class="text-center text-md text-gray-600 font-semibold uppercase tracking-wider mb-10" data-aos="fade-up">TRUSTED BY LEADING HOME BUILDERS NATIONWIDE</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 items-center">
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="100">
                <img src="https://cdn.pixabay.com/photo/2017/03/16/21/18/logo-2150297_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="200">
                <img src="https://cdn.pixabay.com/photo/2017/01/31/13/14/animal-2023924_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="300">
                <img src="https://cdn.pixabay.com/photo/2017/01/13/01/22/rocket-1976107_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="400">
                <img src="https://cdn.pixabay.com/photo/2016/08/25/07/30/orange-1618917_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="500">
                <img src="https://cdn.pixabay.com/photo/2017/01/31/23/42/animal-2028334_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
            <div class="flex justify-center" data-aos="fade-up" data-aos-delay="600">
                <img src="https://cdn.pixabay.com/photo/2016/11/07/13/04/yoga-1805784_640.png" alt="Home Builder Logo" class="trusted-logo">
            </div>
        </div>
    </div>
</section>
    
<!-- Feature Cards -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="text-sm text-red-600 font-semibold uppercase tracking-wider mb-2">TAILORED SOLUTIONS</div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-navy">Solutions for Every Type of Residential Project</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Specialized permitting tools designed for home builders of all sizes</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Production Builders Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="100">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://cdn.pixabay.com/photo/2016/11/18/17/46/house-1836070_1280.jpg" alt="Production Builders" class="w-full object-cover h-full transition-transform duration-700 hover:scale-110">
                    <div class="absolute top-0 left-0 bg-red-600 text-white py-1 px-3">
                        <span class="text-sm font-semibold">HIGH VOLUME</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 text-navy">Production Builders</h3>
                    <p class="text-gray-600 mb-4">Streamline permit processing for high-volume residential developments and reduce cycle times with our parallel submission system.</p>
                    <a href="/production-builders" class="text-red-600 font-medium hover:text-red-800 transition-colors group flex items-center">
                        Learn more <i class="bi bi-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
            
            <!-- Scatter Lot Communities Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="200">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2dbcb93f49b4a78b1b118_Home%20Builders%20-small-%20Scatter%20Lot%20Communities.avif" alt="Scatter Lot Communities" class="w-full object-cover h-full transition-transform duration-700 hover:scale-110">
                    <div class="absolute top-0 left-0 bg-red-600 text-white py-1 px-3">
                        <span class="text-sm font-semibold">MULTI-JURISDICTION</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 text-navy">Scatter Lot Communities</h3>
                    <p class="text-gray-600 mb-4">Manage multiple permits across various jurisdictions with centralized tracking and sophisticated coordination tools.</p>
                    <a href="/scatter-lot-communities" class="text-red-600 font-medium hover:text-red-800 transition-colors group flex items-center">
                        Learn more <i class="bi bi-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
            
            <!-- Custom Home Builders Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="300">
                <div class="h-56 overflow-hidden relative">
                    <img src="https://cdn.pixabay.com/photo/2017/04/10/22/28/residence-2219972_1280.jpg" alt="Custom Home Builders" class="w-full object-cover h-full transition-transform duration-700 hover:scale-110">
                    <div class="absolute top-0 left-0 bg-red-600 text-white py-1 px-3">
                        <span class="text-sm font-semibold">PREMIUM</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 text-navy">Custom Home Builders</h3>
                    <p class="text-gray-600 mb-4">Navigate complex permitting requirements for unique, high-end residential projects with our concierge service.</p>
                    <a href="/custom-home-builders" class="text-red-600 font-medium hover:text-red-800 transition-colors group flex items-center">
                        Learn more <i class="bi bi-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <!-- Platform Features -->
    <section class="py-20 bg-gray-100 section-overlay">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <div class="text-sm text-red-600 font-semibold uppercase tracking-wider mb-2">PLATFORM BENEFITS</div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-8 text-navy">How 1 Construction Empowers Home Builders</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start bg-white p-5 rounded-lg shadow-md transition-all hover:shadow-lg">
                            <div class="feature-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-navy">Complete Jurisdiction Coverage</h3>
                                <p class="text-gray-600">Built-in requirements for over 3,000 building departments nationwide with automatic updates when codes change.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-5 rounded-lg shadow-md transition-all hover:shadow-lg">
                            <div class="feature-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-navy">End-to-End Tracking</h3>
                                <p class="text-gray-600">Monitor permit status from application to final inspection in one dashboard with real-time updates and notifications.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-5 rounded-lg shadow-md transition-all hover:shadow-lg">
                            <div class="feature-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-navy">Team Collaboration</h3>
                                <p class="text-gray-600">Connect GCs, subs, designers, and internal teams on one platform with role-based permissions and document sharing.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-5 rounded-lg shadow-md transition-all hover:shadow-lg">
                            <div class="feature-icon">
                                <i class="bi bi-lightning"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-navy">Permit Expediting</h3>
                                <p class="text-gray-600">Optional white-glove service for complex or time-sensitive projects with dedicated permit specialists.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start bg-white p-5 rounded-lg shadow-md transition-all hover:shadow-lg">
                            <div class="feature-icon">
                                <i class="bi bi-layers"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold mb-2 text-navy">Enterprise Integrations</h3>
                                <p class="text-gray-600">Connect with your project management and ERP systems for seamless workflows through our open API architecture.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <img src="https://cdn.pixabay.com/photo/2017/05/09/13/33/laptop-2298286_1280.jpg" alt="Home Builder Dashboard" class="rounded-lg shadow-2xl">
                        <div class="absolute -bottom-6 -right-6 bg-red-600 text-white p-6 rounded-lg shadow-xl">
                            <div class="flex items-baseline">
                                <span class="text-4xl font-bold">60%</span>
                                <span class="ml-1 text-xl">Faster</span>
                            </div>
                            <p class="text-sm opacity-90">Permit cycle reduction</p>
                        </div>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <a href="/see-demo" class="bg-navy bg-opacity-80 hover:bg-opacity-90 transition-all text-white rounded-full w-20 h-20 flex items-center justify-center">
                                <i class="bi bi-play-fill text-4xl"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-12 grid grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <div class="text-red-600 font-bold text-2xl">500+</div>
                            <div class="text-gray-600 text-sm">Projects Managed</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <div class="text-red-600 font-bold text-2xl">3,000+</div>
                            <div class="text-gray-600 text-sm">Jurisdictions</div>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <div class="text-red-600 font-bold text-2xl">8 Weeks</div>
                            <div class="text-gray-600 text-sm">Average Time Saved</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Workflow Steps -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="text-sm text-red-600 font-semibold uppercase tracking-wider mb-2">STREAMLINED PROCESS</div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-navy">Our Streamlined Permitting Process</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">From application to approval in four simple steps</p>
            </div>
            
            <div class="relative">
                <div class="hidden md:block absolute top-36 left-0 right-0 h-1 bg-gray-200 z-0"></div>
                
                <div class="flex flex-col md:flex-row justify-between items-center relative z-10">
                    <div class="mb-12 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="workflow-step">1</div>
                        <h3 class="text-xl font-bold text-center mb-2 text-navy">Submit</h3>
                        <p class="text-gray-600 text-center max-w-xs">Upload your project documents through our secure portal</p>
                    </div>
                    
                    <div class="mb-12 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="workflow-step">2</div>
                        <h3 class="text-xl font-bold text-center mb-2 text-navy">Process</h3>
                        <p class="text-gray-600 text-center max-w-xs">Our experts prepare and file all required applications</p>
                    </div>
                    
                    <div class="mb-12 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="workflow-step">3</div>
                        <h3 class="text-xl font-bold text-center mb-2 text-navy">Track</h3>
                        <p class="text-gray-600 text-center max-w-xs">Monitor review status in real-time on your dashboard</p>
                    </div>
                    
                    <div class="w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="workflow-step">4</div>
                        <h3 class="text-xl font-bold text-center mb-2 text-navy">Build</h3>
                        <p class="text-gray-600 text-center max-w-xs">Start construction on time, every time, with confidence</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 text-center" data-aos="fade-up" data-aos-delay="500">
            <a href="/how-it-works" class="bg-navy hover:bg-opacity-90 text-white px-8 py-3 rounded-lg inline-flex items-center transition-colors">
                    See How It Works <i class="bi bi-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-16 bg-navy text-white relative overflow-hidden" style="background: linear-gradient(rgba(10, 34, 64, 0.9), rgba(10, 34, 64, 0.9)), url('https://cdn.pixabay.com/photo/2018/03/15/07/03/construction-3227657_1280.jpg'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6" data-aos="fade-up">Ready to Accelerate Your Permitting Process?</h2>
                <p class="text-lg mb-8 text-gray-300" data-aos="fade-up" data-aos-delay="100">Join the top home builders who are getting permits 60% faster and keeping projects on schedule with our industry-leading platform.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
                    <a href="/get-started" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-lg font-medium transition-colors text-lg inline-flex items-center justify-center">
                        <i class="bi bi-calendar-check mr-2"></i> Schedule a Demo
                    </a>
                    <a href="/get-started" class="border-2 border-white text-white px-8 py-3 rounded-lg hover:bg-white hover:text-navy transition-colors font-medium inline-flex items-center justify-center">
                        <i class="bi bi-tag mr-2"></i> View Pricing
                    </a>
                </div>
                <p class="text-sm mt-6 text-gray-400" data-aos="fade-up" data-aos-delay="300">No long-term contracts required. Free onboarding and training included.</p>
            </div>
        </div>
        
        <!-- Background elements -->
        <div class="absolute top-0 right-0 w-1/3 h-full bg-red-600 opacity-10" style="clip-path: polygon(100% 0, 0 0, 100% 100%);"></div>
        <div class="absolute bottom-0 left-0 w-1/3 h-1/2 bg-red-600 opacity-10" style="clip-path: polygon(0 100%, 100% 100%, 0 0);"></div>
    </section>
    
    <!-- Testimonials -->
<section class="py-20 bg-gray-100" style="background-color: #f3f4f6;">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="text-sm text-red-600 font-semibold uppercase tracking-wider mb-2">CLIENT SUCCESS</div>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-navy">What Home Builders Are Saying</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from builders who've transformed their permitting process with 1 Construction</p>
        </div>
        
        <div class="grid grid-cols-1 gap-8">
            <!-- Featured Testimonial -->
            <div class="bg-navy text-white rounded-lg shadow-xl p-8 md:p-10 relative overflow-hidden" data-aos="fade-up" style="background: linear-gradient(rgba(12, 35, 64, 0.95), rgba(12, 35, 64, 0.95)), url('https://cdn.pixabay.com/photo/2016/11/18/17/46/house-1836070_1280.jpg'); background-size: cover; background-position: center;">
                <div class="flex flex-col md:flex-row gap-8 items-start relative z-10">
                    <div class="md:w-1/4 flex flex-col items-center md:items-start">
                        <img src="https://cdn.pixabay.com/photo/2019/11/11/04/33/man-4617089_1280.jpg" alt="Robert Johnson" class="w-28 h-28 rounded-full mb-4 border-4 border-red-500 object-cover">
                        <div>
                            <p class="font-bold text-xl">Robert Johnson</p>
                            <p class="text-sm text-blue-100">VP of Operations, Johnson Homes</p>
                            <div class="flex mt-3">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="md:w-3/4">
                        <p class="text-2xl italic mb-6 leading-relaxed">"1 Construction has completely transformed how we handle permitting. What used to be a major bottleneck in our production schedule is now a streamlined process. We've reduced our permit cycle times by over 60% in multiple jurisdictions, which has been a game-changer for our business."</p>
                        <div class="flex items-center justify-between">
                            <p class="text-gray-300">Johnson Homes builds over 500 homes annually across 12 different municipalities.</p>
                            <a href="/case-studies/johnson-homes" class="text-red-400 hover:text-red-300 transition-colors font-medium flex items-center">
                                Read Case Study <i class="bi bi-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-48 h-48 opacity-5">
                    <i class="bi bi-quote text-9xl"></i>
                </div>
            </div>
            
            <!-- Regular Testimonials -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-6">
                <div class="bg-white rounded-lg shadow-lg p-6 testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn.pixabay.com/photo/2018/01/21/14/16/woman-3096664_1280.jpg" alt="Sarah Miller" class="w-16 h-16 rounded-full mr-4 border-2 border-red-500 object-cover">
                        <div>
                            <p class="font-bold text-lg text-navy">Sarah Miller</p>
                            <p class="text-sm text-gray-500">Project Manager, Miller Custom Homes</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-700">"The tracking dashboard has completely eliminated the guesswork from our permit status. We always know exactly where we stand with each application, which has dramatically improved our planning and scheduling."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn.pixabay.com/photo/2017/08/01/01/33/beanie-2562646_1280.jpg" alt="Michael Chen" class="w-16 h-16 rounded-full mr-4 border-2 border-red-500 object-cover">
                        <div>
                            <p class="font-bold text-lg text-navy">Michael Chen</p>
                            <p class="text-sm text-gray-500">CEO, Horizon Builders</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-700">"The ROI is incredible. We've eliminated the need for dedicated permit coordinators and reduced our cycle times by 8 weeks on average, allowing us to start more projects and grow our business faster."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <img src="https://cdn.pixabay.com/photo/2017/02/16/23/10/smile-2072907_1280.jpg" alt="Jennifer Garcia" class="w-16 h-16 rounded-full mr-4 border-2 border-red-500 object-cover">
                        <div>
                            <p class="font-bold text-lg text-navy">Jennifer Garcia</p>
                            <p class="text-sm text-gray-500">Operations Director, Garcia Homes</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic text-gray-700">"As we expanded into new municipalities, 1 Construction made the transition seamless. They already knew the requirements for each jurisdiction, saving us months of research and trial and error."</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="/testimonials" class="text-red-600 font-medium hover:text-red-800 transition-colors inline-flex items-center">
                View all testimonials <i class="bi bi-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
    
    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <div class="text-sm text-red-600 font-semibold uppercase tracking-wider mb-2">QUESTIONS ANSWERED</div>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-navy">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions from home builders about our permitting solution</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 max-w-4xl mx-auto">
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-3 text-navy">How many jurisdictions do you support?</h3>
                    <p class="text-gray-600">We currently support over 3,000 building departments across all 50 states, covering more than 95% of active residential construction markets in the United States.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-3 text-navy">Can you handle multiple projects simultaneously?</h3>
                    <p class="text-gray-600">Absolutely! Our enterprise platform is designed for volume builders and can manage hundreds of active permits across multiple jurisdictions from a single dashboard with customizable views.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-3 text-navy">How do you handle plan revisions?</h3>
                    <p class="text-gray-600">Our system tracks all revisions with version control and automatically routes updated documents to the appropriate reviewers, significantly reducing resubmission delays and confusion.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold mb-3 text-navy">Can I integrate with my project management software?</h3>
                    <p class="text-gray-600">Yes! We offer API integration with most popular construction management platforms including Procore, Buildertrend, and CoConstruct to ensure seamless data flow between systems.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="500">
                    <h3 class="text-xl font-bold mb-3 text-navy">Do you offer support for complex projects?</h3>
                    <p class="text-gray-600">Yes, our Premium tier includes dedicated permit specialists who can handle complex projects, variance requests, zoning challenges, and special approvals with personalized attention.</p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-xl font-bold mb-3 text-navy">What kind of time savings can we expect?</h3>
                    <p class="text-gray-600">Our clients typically see a 40-60% reduction in permit cycles, with an average time savings of 8 weeks from submission to approval compared to traditional methods.</p>
                </div>
            </div>
            
           
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="text-red-400 text-4xl font-bold mb-2">3,000+</div>
                    <p class="text-gray-300">Jurisdictions Supported</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="text-red-400 text-4xl font-bold mb-2">60%</div>
                    <p class="text-gray-300">Average Time Savings</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="text-red-400 text-4xl font-bold mb-2">10,000+</div>
                    <p class="text-gray-300">Permits Processed</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="text-red-400 text-4xl font-bold mb-2">98%</div>
                    <p class="text-gray-300">Client Satisfaction Rate</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Final CTA -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-navy" data-aos="fade-up">Start Building Faster Today</h2>
                <p class="text-lg text-gray-600 mb-8" data-aos="fade-up" data-aos-delay="100">Join the leading home builders who are revolutionizing their permitting process and accelerating construction timelines.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
                    <a href="/get-started" class="bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-lg font-medium transition-colors text-lg shadow-lg hover:shadow-xl">
                        Schedule Your Free Consultation
                    </a>
                </div>
                <p class="text-sm mt-6 text-gray-500" data-aos="fade-up" data-aos-delay="300">Have questions? Call us at (800) 555-1234</p>
            </div>
        </div>
    </section>
    
    <!-- Include Footer Component -->
    @include('components.footer')
    
    <!-- AOS Init -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    </script>
</body>
</html>