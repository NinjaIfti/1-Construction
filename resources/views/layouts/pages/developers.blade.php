<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Developers | 1 Contractor | Construction Permitting Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
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
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        .btn-primary {
            background-color: #E31B23;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #c8171f;
        }
        
        .section-navy {
            background-color: #0A2240;
            color: white;
        }
        
        .card {
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }

        /* Additional theme styles */
        .theme-navy-bg {
            background-color: #0A2240 !important;
        }
        
        .theme-red-bg {
            background-color: #E31B23 !important;
        }
        
        .theme-navy-text {
            color: #0A2240 !important;
        }
        
        .theme-red-text {
            color: #E31B23 !important;
        }
        
        .theme-gradient-bg {
            background: linear-gradient(135deg, #0A2240, #091a32) !important;
        }
        
        .theme-feature-item {
            background: linear-gradient(135deg, #0A2240, #091a32) !important;
            border-left: 4px solid #E31B23 !important;
            color: white !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08) !important;
        }
        
        .theme-feature-accent {
            background-color: #E31B23 !important;
            color: white !important;
        }
        
        .platform-features-section {
            background-color: #0A2240 !important;
            color: white !important;
        }
        
        .platform-features-heading {
            background: linear-gradient(135deg, #0A2240, #091a32) !important;
            border-left: 4px solid #E31B23 !important;
            color: white !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section - Using HomeBuilder structure -->
    <section class="section-navy min-h-[550px] relative pt-16 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-12 items-center">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-sm text-yellow-400 font-semibold uppercase mb-2">DEVELOPERS</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Keep every project on schedule, everywhere you build</h1>
                    <p class="text-lg mb-8">Eliminate permitting delays so you can close out construction on time and start generating revenue</p>
                    
                    <a href="/talk-to-expert" class="btn-primary inline-block">
                        Talk to an Expert
                    </a>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e3e0bf7a62cc17d4fe04_Vertical%20Page%20-%20Developers%20-%20Hero-p-2000.avif" alt="Modern office building" class="w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-[#0A2240] opacity-10 -z-0" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    
    <!-- Trusted By Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-xl font-medium text-gray-800 mb-10" data-aos="fade-up" data-aos-duration="800">Leading developers trust PermitFlow</h2>
            
            <div class="flex justify-center items-center gap-16 flex-wrap">
                <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2ab0353519afef3bed002_JLL%20logo.png" alt="JLL" class="h-12 grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2ad556ea8128d4909b0d0_cushman%20logo.png" alt="Cushman & Wakefield" class="h-12 grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
            </div>
        </div>
    </section>
    
    <!-- Main Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-navy mb-12 text-center" data-aos="fade-up" data-aos-duration="800">
                Fast, easy permitting. Keep projects on time with complete visibility and control.
            </h2>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e3df9214c9ffcaf3c776_D-small-%20Mixed%20Use%20Developments.avif" alt="Mixed-use development" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Mixed-use developments</h3>
                        <p class="text-gray-600">Balance residential and commercial requirements with project goals</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e3df6f8769e0a1c8dafd_D-small%20-%20Master%20Planned%20Communities.avif" alt="Master-planned community" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Master-planned communities</h3>
                        <p class="text-gray-600">Coordinate long-term infrastructure and phased approvals</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e3ddc05f8f9903b380c9_D-small-%20Commercial%20Projects.avif" alt="Commercial project" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Commercial projects</h3>
                        <p class="text-gray-600">Navigate high-impact permits for retail, medical facilities, and logistics centers</p>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
    
    <!-- Platform Features -->
    <section class="py-16 bg-[#0A2240] platform-features-section">
        <div class="container mx-auto px-6">
            <div class="bg-gradient-to-br from-[#0A2240] to-[#091a32] rounded-lg p-8 shadow-lg relative overflow-hidden mb-12 platform-features-heading" style="background-image: linear-gradient(rgba(10, 34, 64, 0.95), rgba(10, 34, 64, 0.95)), url('https://cdn.pixabay.com/photo/2016/11/22/19/17/buildings-1850129_1280.jpg'); background-size: cover; background-position: center;">
                <!-- Decorative elements -->
                <div class="absolute top-0 left-0 w-2 h-full bg-[#E31B23] theme-red-bg"></div>
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#E31B23] opacity-20 rounded-full -mr-12 -mt-12 theme-red-bg"></div>
                <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#E31B23] opacity-20 rounded-full -mr-12 -mb-12 theme-red-bg"></div>
                <div class="absolute bottom-0 left-1/2 w-3/4 h-1 bg-gradient-to-r from-transparent via-[#E31B23] to-transparent opacity-30"></div>
                
                <h2 class="text-3xl font-bold text-white relative pl-4" data-aos="fade-up" data-aos-duration="800">
                    <span class="absolute left-0 top-0 h-full w-1 bg-[#E31B23] theme-red-bg"></span>
                    Streamline Your Permitting Process with Enterprise-Grade Solutions
                </h2>
            </div>
            
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <p class="text-lg mb-6 text-white font-medium">PermitFlow delivers comprehensive solutions:</p>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start bg-gradient-to-r from-[#0A2240] to-[#091a32] p-4 rounded-lg border-l-4 border-[#E31B23] shadow-md theme-feature-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#E31B23] flex items-center justify-center mt-0.5 theme-feature-accent">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Optimize project timelines with strategic planning</span>
                        </li>
                        <li class="flex items-start bg-gradient-to-r from-[#0A2240] to-[#091a32] p-4 rounded-lg border-l-4 border-[#E31B23] shadow-md theme-feature-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#E31B23] flex items-center justify-center mt-0.5 theme-feature-accent">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Seamless integration across all jurisdictions</span>
                        </li>
                        <li class="flex items-start bg-gradient-to-r from-[#0A2240] to-[#091a32] p-4 rounded-lg border-l-4 border-[#E31B23] shadow-md theme-feature-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#E31B23] flex items-center justify-center mt-0.5 theme-feature-accent">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Comprehensive research and documentation support</span>
                        </li>
                        <li class="flex items-start bg-gradient-to-r from-[#0A2240] to-[#091a32] p-4 rounded-lg border-l-4 border-[#E31B23] shadow-md theme-feature-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#E31B23] flex items-center justify-center mt-0.5 theme-feature-accent">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Real-time monitoring and analytics dashboard</span>
                        </li>
                        <li class="flex items-start bg-gradient-to-r from-[#0A2240] to-[#091a32] p-4 rounded-lg border-l-4 border-[#E31B23] shadow-md theme-feature-item" data-aos="fade-up" data-aos-duration="600" data-aos-delay="500">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-[#E31B23] flex items-center justify-center mt-0.5 theme-feature-accent">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-white">Enhanced stakeholder collaboration tools</span>
                        </li>
                    </ul>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e3e2105407afc7d1a830_D-small-%20Value%20Adds.avif" alt="Enterprise construction management platform" class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-[#0A2240] text-white rounded-lg p-6 flex flex-col md:flex-row items-center justify-between relative overflow-hidden" data-aos="fade-up" data-aos-duration="1000" style="background: linear-gradient(rgba(10, 34, 64, 0.95), rgba(10, 34, 64, 0.95)), url('https://cdn.pixabay.com/photo/2018/01/31/07/36/architecture-3120904_1280.jpg'); background-size: cover; background-position: center;">
                <!-- Decorative accent -->
                <div class="absolute top-0 bottom-0 right-0 w-24 bg-[#E31B23] opacity-20" style="clip-path: polygon(100% 0, 0 0, 100% 100%);"></div>
                
                <div class="flex items-center mb-4 md:mb-0 relative z-10">
                    <div class="mr-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Prepare and submit permits in days, not weeks</h3>
                </div>
                <a href="/talk-to-expert" class="bg-[#E31B23] hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full relative z-10">Talk to an Expert</a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-navy text-center mb-12" data-aos="fade-up" data-aos-duration="800">
                What our customers say
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md relative overflow-hidden" data-aos="fade-right" data-aos-duration="800">
                    <!-- Quote icon -->
                    <div class="absolute top-4 right-4 text-gray-200">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 32 32">
                            <path d="M10,8c-4.411,0-8,3.589-8,8s3.589,8,8,8c0.766,0,2-0.271,2-0.271V26c0,0,0,0-2,0c-4.072,0-5.655-3.804-5.946-5.521 C3.363,17.365,3,13.741,3,11c0-2.588,1.337-3.958,2.121-4.742C6.935,4.444,9.242,3.664,12,3.636v4.015 C12,7.651,10.533,8,10,8z M24,8c-4.411,0-8,3.589-8,8s3.589,8,8,8c0.766,0,2-0.271,2-0.271V26c0,0,0,0-2,0 c-4.072,0-5.654-3.804-5.946-5.521C17.363,17.365,17,13.741,17,11c0-2.588,1.336-3.958,2.121-4.742 C20.935,4.444,23.242,3.664,26,3.636v4.015C26,7.651,24.533,8,24,8z"></path>
                        </svg>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 mb-6 relative z-10">
                        <div class="flex-shrink-0">
                            <img src="https://cdn.pixabay.com/photo/2017/11/02/14/27/model-2911332_1280.jpg" alt="Developer testimonial" class="w-16 h-16 rounded-full border-2 border-[#E31B23] object-cover">
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Michael Rodriguez</h4>
                            <p class="text-sm text-gray-600">VP of Construction, Madison Developers</p>
                            <div class="flex text-yellow-400 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                        </div>
                    </div>
                    
                    <blockquote class="relative z-10">
                        <p class="text-gray-700 text-lg italic mb-4">"PermitFlow helped us achieve far more visibility and control over our permitting processes. We've cut our project delays by 60% and can now forecast completion dates with much greater accuracy."</p>
                        <p class="text-gray-700 text-lg italic">"The ROI is clear - we're getting to revenue generation faster on every project."</p>
                    </blockquote>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md relative overflow-hidden" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                    <!-- Quote icon -->
                    <div class="absolute top-4 right-4 text-gray-200">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 32 32">
                            <path d="M10,8c-4.411,0-8,3.589-8,8s3.589,8,8,8c0.766,0,2-0.271,2-0.271V26c0,0,0,0-2,0c-4.072,0-5.655-3.804-5.946-5.521 C3.363,17.365,3,13.741,3,11c0-2.588,1.337-3.958,2.121-4.742C6.935,4.444,9.242,3.664,12,3.636v4.015 C12,7.651,10.533,8,10,8z M24,8c-4.411,0-8,3.589-8,8s3.589,8,8,8c0.766,0,2-0.271,2-0.271V26c0,0,0,0-2,0 c-4.072,0-5.654-3.804-5.946-5.521C17.363,17.365,17,13.741,17,11c0-2.588,1.336-3.958,2.121-4.742 C20.935,4.444,23.242,3.664,26,3.636v4.015C26,7.651,24.533,8,24,8z"></path>
                        </svg>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 mb-6 relative z-10">
                        <div class="flex-shrink-0">
                            <img src="https://cdn.pixabay.com/photo/2019/11/03/20/11/portrait-4599553_1280.jpg" alt="Developer testimonial" class="w-16 h-16 rounded-full border-2 border-[#E31B23] object-cover">
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Sarah Jennings</h4>
                            <p class="text-sm text-gray-600">Director of Operations, Horizon Developments</p>
                            <div class="flex text-yellow-400 mt-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </div>
                        </div>
                    </div>
                    
                    <blockquote class="relative z-10">
                        <p class="text-gray-700 text-lg italic mb-4">"As we're growing, it's helpful that PermitFlow is there to help us grow too. We've expanded from 3 markets to 12 in the last year, and the platform works everywhere we build."</p>
                        <p class="text-gray-700 text-lg italic">"The ability to track everything in one place has been a game-changer for our operations team."</p>
                    </blockquote>
                </div>
            </div>
            
            <!-- Additional testimonial - Full width -->
            <div class="mt-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <div class="bg-[#0A2240] text-white p-8 rounded-lg shadow-md relative overflow-hidden" style="background: linear-gradient(rgba(10, 34, 64, 0.95), rgba(10, 34, 64, 0.95)), url('https://cdn.pixabay.com/photo/2015/07/28/20/55/office-864369_1280.jpg'); background-size: cover; background-position: center;">
                    <!-- Decorative background elements -->
                    <div class="absolute bottom-0 right-0 w-48 h-48 bg-[#E31B23] opacity-30 rounded-full -mr-12 -mb-12"></div>
                    <div class="absolute top-0 left-0 w-24 h-24 bg-[#E31B23] opacity-30 rounded-full -ml-12 -mt-12"></div>
                    <div class="absolute top-1/2 transform -translate-y-1/2 right-0 w-2 h-20 bg-[#E31B23]"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                        <div class="md:w-1/4 flex justify-center mb-6 md:mb-0">
                            <div class="relative">
                                <div class="absolute inset-0 border-4 border-[#E31B23] rounded-full -m-2 opacity-30"></div>
                                <img src="https://cdn.pixabay.com/photo/2018/03/06/22/57/portrait-3204843_1280.jpg" alt="CEO testimonial" class="w-24 h-24 rounded-full border-4 border-white object-cover shadow-lg">
                            </div>
                        </div>
                        <div class="md:w-3/4">
                            <blockquote class="mb-4">
                                <div class="text-[#E31B23] mb-2 text-4xl opacity-30">"</div>
                                <p class="text-xl italic">"PermitFlow has transformed our development timeline. We've seen a 40% reduction in the time from planning to breaking ground, which has a massive impact on our bottom line and investor relationships."</p>
                            </blockquote>
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-bold">David Chen</h4>
                                    <p class="text-gray-200">CEO, Pinnacle Development Group</p>
                                </div>
                                <div class="flex text-yellow-300">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Partners Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold mb-12 text-center text-navy" data-aos="fade-up" data-aos-duration="800">Partners and integrations</h2>
            
            <div class="flex flex-wrap items-center justify-center gap-12">
                <div class="grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="100">
                    <span class="text-xl font-bold">PROCORE</span>
                </div>
                <div class="grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                    <span class="text-xl font-bold">ServiceTitan</span>
                </div>
                <div class="grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="300">
                    <span class="text-xl font-bold">AUTODESK</span>
                </div>
                <div class="grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="400">
                    <span class="text-xl font-bold">bigrentz</span>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Include Footer Component -->
    @include('components.footer')
    
    <!-- AOS JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            once: true, // Whether animation should happen only once - while scrolling down
            offset: 120, // Offset (in px) from the original trigger point
            easing: 'ease-out-sine', // Default easing for AOS animations
        });
    </script>
</body>
</html>