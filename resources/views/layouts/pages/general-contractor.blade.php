<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>General Contractors | 1 Contractor | Construction Permitting Software</title>
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
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section class="section-navy min-h-[550px] relative pt-16 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-12 items-center">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-sm text-yellow-400 font-semibold uppercase mb-2">GENERAL CONTRACTORS</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Build better with faster permits and less hassle</h1>
                    <p class="text-lg mb-8">Slash permitting timelines, reduce overhead, and keep your projects on schedule</p>
                    
                    <a href="/talk-to-expert" class="btn-primary inline-block">
                        Talk to an Expert
                    </a>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{ asset('images/general-contractor.jpg') }}" alt="Construction site with workers" class="w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-blue-100 -z-0" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    
    <!-- Trusted By Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-xl font-medium text-gray-800 mb-10" data-aos="fade-up" data-aos-duration="800">Trusted by leading general contractors nationwide</h2>
            
            <div class="flex justify-center items-center gap-16 flex-wrap">
                <img src="{{ asset('images/contractor-logo-1.png') }}" alt="Trusted Contractor" class="h-12 grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
                <img src="{{ asset('images/contractor-logo-2.png') }}" alt="Trusted Contractor" class="h-12 grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
                <img src="{{ asset('images/contractor-logo-3.png') }}" alt="Trusted Contractor" class="h-12 grayscale hover:grayscale-0 transition-all" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
            </div>
        </div>
    </section>
    
    <!-- Main Content Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-navy mb-12 text-center" data-aos="fade-up" data-aos-duration="800">
                Complete more projects, reduce delays, and maximize your team's productivity
            </h2>
            
            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="{{ asset('images/commercial-project.jpg') }}" alt="Commercial project" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Commercial Projects</h3>
                        <p class="text-gray-600">Streamline permitting for office buildings, retail spaces, and industrial facilities</p>
                    </div>
                </div>
                
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="{{ asset('images/residential-project.jpg') }}" alt="Residential project" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Residential Projects</h3>
                        <p class="text-gray-600">Navigate complex zoning and building code requirements for custom homes and multifamily</p>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden card" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="h-48 overflow-hidden bg-gray-200">
                        <img src="{{ asset('images/renovation-project.jpg') }}" alt="Renovation project" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-2 text-gray-900">Renovations & Retrofits</h3>
                        <p class="text-gray-600">Simplify permit compliance for existing structures and historic buildings</p>
                    </div>
                </div>
            </div>
            
            <!-- Demo Video Section -->
            <div class="max-w-4xl mx-auto bg-white p-4 rounded-lg shadow-md mb-20" data-aos="zoom-in" data-aos-duration="1000">
                <div class="aspect-w-16 aspect-h-9 bg-navy rounded-lg">
                    <!-- Video Placeholder -->
                    <div class="flex items-center justify-center h-64">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Platform Features -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-navy mb-8" data-aos="fade-up" data-aos-duration="800">The complete solution for your permitting challenges</h2>
            
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <p class="text-lg mb-6">With PermitFlow, general contractors can:</p>
                    
                    <ul class="space-y-4">
                        <li class="flex items-start" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Reduce overhead by eliminating permit runners</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-duration="600" data-aos-delay="200">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Get complete visibility across all active projects</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-duration="600" data-aos-delay="300">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Automate jurisdiction-specific requirements</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Improve cash flow with faster project completion</span>
                        </li>
                        <li class="flex items-start" data-aos="fade-up" data-aos-duration="600" data-aos-delay="500">
                            <div class="flex-shrink-0 h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center mt-0.5">
                                <svg class="h-4 w-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-gray-700">Share real-time updates with project owners</span>
                        </li>
                    </ul>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <img src="{{ asset('images/contractor-dashboard.jpg') }}" alt="Permitting dashboard" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-blue-500 text-white rounded-lg p-6 flex flex-col md:flex-row items-center justify-between" data-aos="fade-up" data-aos-duration="1000">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="mr-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Stop permitting headaches today</h3>
                </div>
                <a href="/talk-to-expert" class="bg-red hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full">Talk to an Expert</a>
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
                            <img src="{{ asset('images/contractor-testimonial-1.jpg') }}" alt="General contractor testimonial" class="w-16 h-16 rounded-full border-2 border-blue-500 object-cover">
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Robert Johnson</h4>
                            <p class="text-sm text-gray-600">Project Manager, Summit Construction</p>
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
                        <p class="text-gray-700 text-lg italic mb-4">"PermitFlow has saved us countless hours of paperwork and trips to city hall. Our team now focuses on actual construction instead of chasing permits."</p>
                        <p class="text-gray-700 text-lg italic">"We're completing projects 3-4 weeks faster on average since implementing the platform."</p>
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
                            <img src="{{ asset('images/contractor-testimonial-2.jpg') }}" alt="General contractor testimonial" class="w-16 h-16 rounded-full border-2 border-blue-500 object-cover">
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Maria Sanchez</h4>
                            <p class="text-sm text-gray-600">Operations Director, Elite Construction</p>
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
                        <p class="text-gray-700 text-lg italic mb-4">"The dashboard gives us instant visibility across all our projects. We can spot potential delays before they become problems and prioritize accordingly."</p>
                        <p class="text-gray-700 text-lg italic">"Our clients love the transparency too - they can see exactly where their project stands."</p>
                    </blockquote>
                </div>
            </div>
            
            <!-- Additional testimonial - Full width -->
            <div class="mt-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <div class="bg-blue-600 text-white p-8 rounded-lg shadow-md relative overflow-hidden">
                    <!-- Decorative background element -->
                    <div class="absolute bottom-0 right-0 w-48 h-48 bg-blue-500 rounded-full -mr-12 -mb-12"></div>
                    <div class="absolute top-0 left-0 w-24 h-24 bg-blue-500 rounded-full -ml-12 -mt-12"></div>
                    
                    <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                        <div class="md:w-1/4 flex justify-center mb-6 md:mb-0">
                            <img src="{{ asset('images/contractor-testimonial-3.jpg') }}" alt="CEO testimonial" class="w-24 h-24 rounded-full border-4 border-white object-cover">
                        </div>
                        <div class="md:w-3/4">
                            <blockquote class="mb-4">
                                <p class="text-xl italic">"I estimate we're saving at least $50,000 per year in labor costs by eliminating the need for permit runners and administrative overhead. PermitFlow pays for itself many times over."</p>
                            </blockquote>
                            <div class="flex justify-between items-center">
                                <div>
                                    <h4 class="text-lg font-bold">James Wilson</h4>
                                    <p class="text-blue-200">CEO, Wilson Construction Group</p>
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