<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Solar & EV Solutions | 1 Contractor | Construction Permitting Software</title>
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
                        'green': '#2F855A',
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
        
        .btn-green {
            background-color: #2F855A;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-green:hover {
            background-color: #276749;
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
                    <div class="text-sm text-green-400 font-semibold uppercase mb-2">SOLAR & EV CHARGING</div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Fast-track renewable energy project permitting</h1>
                    <p class="text-lg mb-8">Simplify solar installations and EV charging infrastructure projects with automated permitting solutions</p>
                    
                    <a href="/talk-to-expert" class="btn-green inline-block">
                        Schedule a Demo
                    </a>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67d44ad8dad67ac7df02e3c2_solar-4824604-small-p-2000.avif" alt="Solar panel installation" class="w-full object-cover rounded-lg">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect with green gradient -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full bg-gradient-to-r from-green-700 to-green-500 -z-0" style="clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    
  
    
    <!-- Feature Cards -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Solutions for renewable energy projects</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Specialized permitting tools for solar installations and EV charging infrastructure</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Residential Solar Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c9d0cad1dbee9044c9f7fd_house-6935453.webp" alt="Residential Solar Installation" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Residential Solar</h3>
                        <p class="text-gray-600 mb-4">Streamline permits for home solar installations with automated documentation and faster approvals.</p>
                        <a href="/residential-solar" class="text-green-600 font-medium hover:text-green-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Commercial Solar Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67c9d0c9640926eea6c76bf7_jeroen-van-de-water-aQOzmgcT6sI-unsplash.webp" alt="Commercial Solar Installation" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">Commercial Solar</h3>
                        <p class="text-gray-600 mb-4">Manage complex permitting for large-scale solar projects, from rooftop to ground-mounted arrays.</p>
                        <a href="/commercial-solar" class="text-green-600 font-medium hover:text-green-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- EV Charging Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden card" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 overflow-hidden">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/6388a089c0a35a638c2b569b_nationwide-coverage.webp" alt="EV Charging Station" class="w-full object-cover h-full">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">EV Charging Infrastructure</h3>
                        <p class="text-gray-600 mb-4">Navigate electrical, zoning, and utility requirements for EV charging station installations.</p>
                        <a href="/ev-charging" class="text-green-600 font-medium hover:text-green-800 transition-colors">Learn more <i class="bi bi-arrow-right"></i></a>
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
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">How 1 Construction helps solar & EV providers</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Renewable-specific workflows</h3>
                                <p class="text-gray-600">Built-in templates for solar and EV projects with jurisdiction-specific requirements.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Utility coordination</h3>
                                <p class="text-gray-600">Manage interconnection applications and utility approvals alongside building permits.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Batch permitting</h3>
                                <p class="text-gray-600">Submit and track multiple residential installations in a single workflow.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Incentive management</h3>
                                <p class="text-gray-600">Track renewable energy credits, tax incentives, and rebate documentation.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                <i class="bi bi-check-circle-fill text-green-500 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-semibold mb-1">Customer portal</h3>
                                <p class="text-gray-600">Give homeowners and commercial clients visibility into their project status.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="relative">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67d1a734b2704be0a570015b_justin-lim-Fpcy-AdFhUg-unsplash-p-2000.webp" alt="Solar Project Dashboard" class="rounded-lg shadow-xl">
                        <div class="absolute -bottom-6 -right-6 bg-green-600 text-white p-4 rounded-lg shadow-lg">
                            <p class="font-bold">Save up to 50%</p>
                            <p class="text-sm">on permitting time</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Stats Section -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">The 1 Construction advantage</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Transform your renewable energy permitting process</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-4xl font-bold text-green-600 mb-2">70%</div>
                    <p class="text-gray-700">Faster permit approvals for residential solar projects</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-4xl font-bold text-green-600 mb-2">85%</div>
                    <p class="text-gray-700">Of jurisdictions supported nationwide</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-4xl font-bold text-green-600 mb-2">45%</div>
                    <p class="text-gray-700">Reduction in documentation errors</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-4xl font-bold text-green-600 mb-2">30%</div>
                    <p class="text-gray-700">Increase in project completion rates</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Banner -->
    <section class="py-12 bg-green-700 text-white">
        <div class="container mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">Power up your permitting process</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Join the renewable energy companies that are accelerating clean energy adoption with streamlined permitting.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
                <a href="/schedule-demo" class="btn-green text-lg">
                    Schedule a Demo
                </a>
                <a href="/pricing" class="border-2 border-white text-white px-6 py-2 rounded-full hover:bg-white hover:text-green-700 transition-colors font-medium">
                    View Pricing
                </a>
            </div>
        </div>
    </section>
    
    <!-- Testimonials -->
    <section class="py-16 bg-gray-200">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">What solar & EV providers are saying</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Hear from companies who've revolutionized their permitting process</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Featured Testimonial -->
                <div class="bg-green-700 text-white rounded-lg shadow-lg p-6 md:col-span-3 relative" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="md:w-1/4 flex flex-col items-center md:items-start">
                            <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Jennifer Lee" class="w-24 h-24 rounded-full mb-4 object-cover">
                            <div>
                                <p class="font-bold">Jennifer Lee</p>
                                <p class="text-sm text-green-200">Operations Director, SunPower Solutions</p>
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
                            <p class="text-xl italic mb-4">"Before 1 Construction, permitting was our biggest bottleneck. Now we're installing 30% more residential systems each month with the same team size. Our customers are amazed at how quickly we can move from contract to installation."</p>
                            <p>SunPower Solutions has completed over 1,200 solar installations using the 1 Construction platform in the past year.</p>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 w-32 h-32 opacity-10">
                        <i class="bi bi-quote text-8xl"></i>
                    </div>
                </div>
                
                <!-- Regular Testimonials -->
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Marcus Johnson" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Marcus Johnson</p>
                            <p class="text-sm text-gray-500">CEO, EV Charge Pro</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The utility coordination feature has been a game-changer for our EV charging projects. We can track interconnection applications right alongside building permits."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Amara Singh" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Amara Singh</p>
                            <p class="text-sm text-gray-500">Permit Manager, GreenTech Solar</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The batch permitting feature has transformed our business model. We can now handle large residential solar contracts for entire neighborhoods efficiently."</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Thomas Chen" class="w-16 h-16 rounded-full mr-4 object-cover">
                        <div>
                            <p class="font-bold">Thomas Chen</p>
                            <p class="text-sm text-gray-500">Project Director, Charge Forward</p>
                            <div class="flex mt-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                <i class="bi bi-star-fill text-yellow-400"></i>
                            </div>
                        </div>
                    </div>
                    <p class="italic">"The customer portal gives our clients real-time updates on their EV charging station installations. It's dramatically improved our customer satisfaction scores."</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Find answers to common questions from solar installers and EV charging providers</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold mb-3">How does the platform handle different AHJ requirements?</h3>
                    <p class="text-gray-600">Our system maintains up-to-date requirements for over 3,500 authorities having jurisdiction (AHJs) and automatically populates the correct forms and requirements for each location.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold mb-3">Can it handle utility interconnection applications?</h3>
                    <p class="text-gray-600">Yes! Our platform manages both building permits and utility interconnection applications, providing a complete solution for solar and EV projects.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="text-xl font-bold mb-3">How does pricing work for high-volume installations?</h3>
                    <p class="text-gray-600">We offer volume-based pricing tiers that scale with your business. Our enterprise plans include unlimited permits for high-volume installers with predictable monthly pricing.</p>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-bold mb-3">Can I integrate with my CRM or project management software?</h3>
                    <p class="text-gray-600">Absolutely! We offer API integration with popular CRM platforms, design software, and project management tools to create a seamless workflow.</p>
                </div>
            </div>
            
            <div class="text-center mt-10" data-aos="fade-up" data-aos-delay="500">
                <a href="/faq" class="text-green-600 font-medium hover:text-green-800 transition-colors">
                    View all FAQs <i class="bi bi-arrow-right"></i>
                </a>
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