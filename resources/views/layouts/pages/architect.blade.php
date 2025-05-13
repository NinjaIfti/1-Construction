<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Architects | 1 Contractor | Construction Permitting Software</title>
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
                        'architect-blue': '#1E3A8A',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f0f0f0; /* Light grey background */
        }
        
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
        
        .btn-blue {
            background-color: #1E3A8A;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-blue:hover {
            background-color: #1e3470;
        }
        
        .section-navy {
            background-color: #0A2240;
            color: white;
        }
        
        .section-architect {
            background-color: #1E3A8A;
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
<body class="font-sans antialiased bg-gray-200">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section class="section-architect min-h-[550px] relative pt-16 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-12 items-center">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-sm text-blue-300 font-semibold uppercase mb-2">ARCHITECTS & DESIGNERS</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Streamline your design approval process</h1>
                    <p class="text-lg mb-8">Focus on design excellence while we handle permit complexities, code compliance, and agency approvals</p>
                    
                    <a href="/talk-to-expert" class="btn-blue inline-block">
                        Book a Consultation
                    </a>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac513bec0ce6917ac90_Vertical%20Page%20-%20Architects%20-%20Hero-p-2000.jpg" alt="Architecture blueprint and model" class="w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-gradient-to-r from-blue-800 to-blue-600 -z-0" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    
   
    
    <!-- Feature Cards -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Architect-focused permitting solutions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Specialized tools to help architecture firms navigate complex approval processes</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Code Compliance Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac26769581932a5c52f_Arch-small-%20Full%20Service%20Firm.jpg" alt="Code Compliance Check" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Code Compliance</h3>
                        <p class="text-gray-600 mb-4">Automated code checks against local, state, and national building codes for your designs.</p>
                        <a href="/code-compliance" class="text-blue-700 font-medium hover:text-blue-900 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Design Review Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac4e950c0721a12cdf9_Arch-small%20-%20Commercial.jpg" alt="Design Review Process" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Design Review Management</h3>
                        <p class="text-gray-600 mb-4">Track design review submissions, respond to comments, and manage revisions efficiently.</p>
                        <a href="/design-review" class="text-blue-700 font-medium hover:text-blue-900 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Permit Tracking Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac486f97c3a7443d5bd_Arch-small%20-%20Tenant%20Improvements.jpg" alt="Permit Tracking Dashboard" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Permit Dashboard</h3>
                        <p class="text-gray-600 mb-4">Real-time tracking of all permit applications across your entire project portfolio.</p>
                        <a href="/permit-dashboard" class="text-blue-700 font-medium hover:text-blue-900 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Workflow Diagram -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Seamless integration with your design workflow</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Our platform works with your existing design tools and processes</p>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="relative mb-8 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">1</div>
                    <h3 class="text-xl font-bold text-center mb-2">Design</h3>
                    <p class="text-gray-600 text-center max-w-xs">Work in your preferred design software</p>
                </div>
                
                <div class="hidden md:block w-24 border-t-2 border-dashed border-blue-300"></div>
                
                <div class="relative mb-8 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">2</div>
                    <h3 class="text-xl font-bold text-center mb-2">Submit</h3>
                    <p class="text-gray-600 text-center max-w-xs">Upload drawings to our platform</p>
                </div>
                
                <div class="hidden md:block w-24 border-t-2 border-dashed border-blue-300"></div>
                
                <div class="relative mb-8 md:mb-0 w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">3</div>
                    <h3 class="text-xl font-bold text-center mb-2">Review</h3>
                    <p class="text-gray-600 text-center max-w-xs">AI-powered code compliance check</p>
                </div>
                
                <div class="hidden md:block w-24 border-t-2 border-dashed border-blue-300"></div>
                
                <div class="relative w-full md:w-auto flex flex-col items-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-blue-700 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mb-4">4</div>
                    <h3 class="text-xl font-bold text-center mb-2">Approve</h3>
                    <p class="text-gray-600 text-center max-w-xs">Fast-track approvals and permits</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Platform Features -->
    <section class="py-16" style="background-color: #e5e7eb;">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">How 1 Construction empowers architects</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">BIM integration</h3>
                                <p class="text-gray-600">Seamlessly connect with Revit, ArchiCAD, and other BIM platforms.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Drawing management</h3>
                                <p class="text-gray-600">Centralized storage for all project drawings, revisions, and markups.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Automated code verification</h3>
                                <p class="text-gray-600">Identify potential code issues before submission to reduce revision cycles.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Client collaboration</h3>
                                <p class="text-gray-600">Share project status updates and approvals directly with clients.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Historical data analytics</h3>
                                <p class="text-gray-600">Learn from past projects to improve future permit success rates.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac4f8a239f60ae930cc_Arch-small%20-%20Value%20Adds.jpg" alt="Architect Dashboard" class="rounded-lg shadow-xl">
                        <div style="background-color: #1E3A8A;" class="absolute -bottom-6 -right-6 text-white p-4 rounded-lg shadow-lg">
                            <p class="font-bold">Up to 60% faster</p>
                            <p class="text-sm">design approvals</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-12 text-white" style="background-color: #1E3A8A;">
        <div class="container mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">Ready to transform your permitting process?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Join hundreds of architecture firms across the country who are saving time and reducing revision cycles.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
                <a href="/schedule-demo" class="btn-blue text-lg">
                    Book a Consultation
                </a>
                <a href="/pricing" class="border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-blue-800 transition-colors font-medium">
                    View Pricing
                </a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What architects are saying</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from design professionals who've transformed their approval process</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Featured Testimonial -->
                <div style="background-color: #1E3A8A;" class="text-white rounded-lg shadow-lg p-6 md:col-span-3 relative" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="md:w-1/4 flex flex-col items-center md:items-start">
                            <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Alexandra Reynolds" class="w-24 h-24 rounded-full mb-4 object-cover">
                            <div>
                                <p class="font-bold">Alexandra Reynolds</p>
                                <p class="text-sm text-blue-200">Principal, Reynolds Architecture</p>
                                <div class="flex mt-2">
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                    <i class="bi bi-star-fill text-yellow-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-3/4">
                            <p class="text-xl italic mb-4">"1 Construction has transformed how we manage the approval process. What used to be the most frustrating part of our workflow is now streamlined and predictable. We're spending more time designing and less time dealing with permit bureaucracy."</p>
                            <p>Reynolds Architecture has reduced permit approval times by 58% across their commercial and residential projects.</p>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                        <i class="bi bi-quote text-8xl"></i>
                    </div>
                </div>
                
                <!-- Regular Testimonials -->
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="James Kim" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">James Kim</p>
                            <p class="text-sm text-gray-500">Project Manager, Urban Design Associates</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The code compliance verification has saved us countless hours of back-and-forth with review boards. We catch issues before submission now."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=689&q=80" alt="Sophia Martinez" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Sophia Martinez</p>
                            <p class="text-sm text-gray-500">Director, Martinez & Associates</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The BIM integration is seamless. We're able to export directly from Revit and the system automatically identifies potential permitting issues."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1615813967515-e1838c1c5116?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Daniel Patel" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Daniel Patel</p>
                            <p class="text-sm text-gray-500">Founder, Innovative Architects</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"Our clients love the transparency. They can see exactly where their project stands in the approval process without constant status updates from us."</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions from architects and designers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-3">Which design software do you integrate with?</h3>
                    <p class="text-gray-600">We offer direct integration with Revit, ArchiCAD, SketchUp, AutoCAD, and Rhino. For other software, we support standard file formats including DWG, IFC, and PDF.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-3">How does the code compliance check work?</h3>
                    <p class="text-gray-600">Our system uses AI to scan your drawings against current building codes and zoning regulations. It identifies potential issues and suggests corrections before you submit for official review.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-3">Can I track multiple projects at once?</h3>
                    <p class="text-gray-600">Yes! Our dashboard allows you to manage your entire portfolio of projects at a glance, with detailed status tracking for each submission and approval milestone.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold mb-3">Do you support historical preservation reviews?</h3>
                    <p class="text-gray-600">Absolutely. We have specialized workflows for historic district reviews, landmark commissions, and other special approval processes that require additional documentation.</p>
                </div>
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
        });
    </script>
</body>
</html> 