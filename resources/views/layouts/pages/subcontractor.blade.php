<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Subcontractors | 1 Contractor | Construction Permitting Software</title>
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
<body class="font-sans antialiased bg-gray-200">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section class="section-navy min-h-[550px] relative pt-16 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-6 lg:gap-12 items-center">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="1000">
                    <div class="text-sm text-yellow-400 font-semibold uppercase mb-2">SUBCONTRACTORS</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Streamline your specialty trade permitting process</h1>
                    <p class="text-lg mb-8">Fast-track permits, coordinate with general contractors, and manage inspections all in one place</p>
                    
                    <a href="/get-started" class="btn-primary inline-block">
                        Get Started
                    </a>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e186fa51fe0ce95c603b_Vertical%20Page%20-%20Subcontractors%20-%20Hero-p-2000.avif" alt="Specialty trade workers on site" class="w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-blue-100 -z-0" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    

    
    <!-- Feature Cards -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Solutions for every specialty trade</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Specialized permitting tools for your specific trade requirements</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Electrical Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e182503ac789fb37333c_SB-small-Signage.avif" alt="Electrical Work" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Electrical</h3>
                        <p class="text-gray-600 mb-4">Streamline electrical permits, inspections, and code compliance for all your projects.</p>
                        <a href="/electrical-permits" class="text-red-600 font-medium hover:text-red-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Plumbing Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e182a0958b53d794ecf3_SB-small-Pool%20Builder.avif" alt="Plumbing Work" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Plumbing</h3>
                        <p class="text-gray-600 mb-4">Simplify plumbing permits, backflow certifications, and water connection approvals.</p>
                        <a href="/plumbing-permits" class="text-red-600 font-medium hover:text-red-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- HVAC Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e17fa05e653a5f0353cf_SB-small-HVAC.avif" alt="HVAC Systems" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">HVAC</h3>
                        <p class="text-gray-600 mb-4">Manage mechanical permits, energy compliance documents, and system inspections.</p>
                        <a href="/hvac-permits" class="text-red-600 font-medium hover:text-red-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    
    <!-- Platform Features -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 items-center">
                <div class="lg:w-1/2" data-aos="fade-right">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">How 1 Construction empowers subcontractors</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Trade-specific knowledge</h3>
                                <p class="text-gray-600">We understand your specialty trade requirements and local code specifics.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Seamless GC coordination</h3>
                                <p class="text-gray-600">Collaborate easily with general contractors using our integrated platform.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Inspection scheduling</h3>
                                <p class="text-gray-600">Schedule and manage inspections online, with automatic reminders.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Mobile access</h3>
                                <p class="text-gray-600">Access permits, plans, and inspection results from your phone or tablet on-site.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Digital document storage</h3>
                                <p class="text-gray-600">Store licenses, certifications, and approved plans in one secure location.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2e185134266777e17e574_SB-small-Value%20Adds.avif" alt="Subcontractor Dashboard" class="rounded-lg shadow-xl">
                        <div class="absolute -bottom-6 -right-6 bg-red-600 text-white p-4 rounded-lg shadow-lg">
                            <p class="font-bold">Save up to 40%</p>
                            <p class="text-sm">on administrative time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Process Steps -->
    <section class="py-16" style="background-color: #e5e7eb;">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">How it works</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Get started in three simple steps</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-lg shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div style="background-color: #0A2240;" class="text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-6">1</div>
                    <h3 class="text-xl font-bold mb-3">Set up your account</h3>
                    <p class="text-gray-600">Create your profile with trade specialties, licenses, and service areas.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white rounded-lg shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div style="background-color: #0A2240;" class="text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-6">2</div>
                    <h3 class="text-xl font-bold mb-3">Create your first project</h3>
                    <p class="text-gray-600">Enter project details, connect with the GC, and access permit requirements.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white rounded-lg shadow-lg p-8 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div style="background-color: #0A2240;" class="text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold mx-auto mb-6">3</div>
                    <h3 class="text-xl font-bold mb-3">Submit and track</h3>
                    <p class="text-gray-600">Submit permit applications online and track status through to final approval.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-12 text-white" style="background-color: #0A2240;">
        <div class="container mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">Ready to simplify your permitting process?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Join thousands of specialty contractors who are saving time and reducing headaches with 1 Construction.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
                <a href="/get-started" class="btn-primary text-lg">
                    Schedule a Demo
                </a>
                <a href="/get-started" class="border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-navy transition-colors font-medium">
                    View Pricing
                </a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What specialty contractors are saying</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from subcontractors who've transformed their permitting process</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Featured Testimonial -->
                <div style="background-color: #0A2240;" class="text-white rounded-lg shadow-lg p-6 md:col-span-3 relative" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="md:w-1/4 flex flex-col items-center md:items-start">
                            <img src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Michael Jones" class="w-24 h-24 rounded-full mb-4 object-cover">
                            <div>
                                <p class="font-bold">Michael Jones</p>
                                <p class="text-sm text-gray-300">Owner, Jones Electrical Services</p>
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
                            <p class="text-xl italic mb-4">"As an electrical contractor working across multiple jurisdictions, permitting used to be my biggest headache. 1 Construction has streamlined the entire process. I can pull permits in 25% of the time it used to take."</p>
                            <p>Jones Electrical has completed over 300 projects through the 1 Construction platform in the past year.</p>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                        <i class="bi bi-quote text-8xl"></i>
                    </div>
                </div>
                
                <!-- Regular Testimonials -->
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=688&q=80" alt="Sarah Williams" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Sarah Williams</p>
                            <p class="text-sm text-gray-500">Manager, Williams Plumbing</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The inspection scheduling feature alone is worth the investment. We never miss an inspection and inspectors arrive when expected."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="David Nguyen" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">David Nguyen</p>
                            <p class="text-sm text-gray-500">CEO, Nguyen HVAC Solutions</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"Working with general contractors is seamless. We can see exactly what's happening with all permits on a project and coordinate our work perfectly."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1176&q=80" alt="Carlos Rodriguez" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Carlos Rodriguez</p>
                            <p class="text-sm text-gray-500">Owner, Rodriguez Fire Protection</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"Their mobile app lets me check permit status from the field. I was able to reduce office staff hours by 15 hours per week."</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions from specialty contractors</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-3">How does pricing work for subcontractors?</h3>
                    <p class="text-gray-600">We offer flexible pricing based on your volume of permits. Most subcontractors choose our pay-per-permit option, which includes all features with no monthly commitment.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-3">Can I use this with any general contractor?</h3>
                    <p class="text-gray-600">Yes! Even if your GC isn't using 1 Construction, you can still manage your permits through our platform and share status updates with them automatically.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-3">What jurisdictions do you support?</h3>
                    <p class="text-gray-600">We currently support over 2,000 jurisdictions across the United States, with new ones added weekly. Contact us to check availability in your area.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold mb-3">Can I track multiple projects at once?</h3>
                    <p class="text-gray-600">Absolutely! Our dashboard allows you to track all your active projects simultaneously, with custom filters to quickly find what you need.</p>
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