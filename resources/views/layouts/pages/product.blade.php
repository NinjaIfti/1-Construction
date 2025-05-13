<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>1 Contractor | Construction Permitting Software</title>
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
    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0A2240 0%, #1e3a5f 100%);
        }
        .cta-gradient {
            background: linear-gradient(90deg, #E31B23 0%, #c41016 100%);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        .nav-link {
            position: relative;
        }
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #E31B23;
            transition: width 0.3s ease;
        }
        .nav-link:hover:after {
            width: 100%;
        }
        .stat-counter {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0A2240;
        }
        
        /* Dashboard grid pattern */
        .bg-grid-pattern {
            background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px), 
                            linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        /* Animation keyframes */
        @keyframes float {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-15px, 15px) rotate(5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }
        
        @keyframes floatReverse {
            0% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(15px, -15px) rotate(-5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        @media (max-width: 640px) {
            .stat-counter {
                font-size: 2rem;
            }
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .feature-card {
                height: 100%;
            }
            
            .tab-btn {
                width: 100%;
                margin-bottom: 0.5rem;
                text-align: center;
            }
            
            .benefit-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    {{-- Include Navbar --}}
    @include('components.navbar')

    {{-- Hero Section --}}
    <section class="gradient-bg text-white py-12 md:py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-1/2 mb-10 lg:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <div class="w-16 h-1.5 bg-[#E31B23] mb-6"></div>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 leading-tight">Streamline Your <span class="text-[#E31B23]">Permitting</span> Process</h1>
                    <p class="text-base md:text-xl mb-8 opacity-90 leading-relaxed">Our comprehensive permit management solution helps contractors navigate complex regulations, reduce approval times, and minimize compliance risks.</p>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#contact" class="w-full sm:w-auto px-6 py-3 bg-[#E31B23] text-white font-medium rounded-lg hover:bg-[#c8171f] transition-colors duration-300 shadow-lg text-center">
                            Get Started Today
                        </a>
                        <a href="#features" class="w-full sm:w-auto px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-[#0A2240] transition-colors duration-300 text-center mt-3 sm:mt-0">
                            Learn More
                        </a>
                    </div>
                    <div class="mt-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-[#E31B23] text-xl mr-2"></i>
                            <span>60% Faster Approvals</span>
                        </div>
                        <div class="flex items-center">
                            <i class="bi bi-check-circle-fill text-[#E31B23] text-xl mr-2"></i>
                            <span>100% Compliance</span>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                    <div class="relative max-w-lg mx-auto">
                        <div class="absolute bg-[#E31B23] rounded-xl w-full sm:w-4/5 h-full sm:h-4/5 right-0 top-0 z-0 opacity-90 transform transition-transform duration-500 hover:translate-x-2 hover:translate-y-2"></div>
                        <div class="relative rounded-xl shadow-xl overflow-hidden z-10 mt-5 ml-5 transform hover:scale-105 transition-all duration-500">
                            <!-- Professional looking border and frame -->
                            <div class="relative bg-gradient-to-b from-[#0c2d5a] to-[#0A2240] rounded-xl overflow-hidden border border-gray-700">
                                <!-- Dashboard image with professional overlay -->
                                <div class="relative overflow-hidden group rounded-t-xl">
                                    <!-- Subtle overlay grid pattern for professional UI look -->
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/10 to-transparent z-10 pointer-events-none opacity-70 rounded-t-xl"></div>
                                    <div class="absolute inset-0 bg-grid-pattern opacity-10 z-20 pointer-events-none rounded-t-xl"></div>
                                    
                                    <img src="/images/dashboard.jpg" alt="Permit Management Dashboard" class="w-full h-auto rounded-t-xl" style="min-height: 300px;">
                                    
                                    <!-- Glass morphism UI elements suggesting interactivity -->
                                    <div class="absolute bottom-4 right-4 bg-black backdrop-blur-sm rounded-xl p-3 shadow-lg border border-white/20 z-30 transform transition-transform duration-300 group-hover:scale-110">
                                        <div class="flex items-center space-x-2">
                                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                                            <span class="text-xs font-medium text-white">Live Dashboard</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Hover reveal info panel -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A2240]/90 to-transparent flex items-end justify-center p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-40 rounded-t-xl">
                                        <div class="text-black text-center">
                                            <p class="text-sm font-medium">Interactive project management</p>
                                            <p class="text-xs opacity-80 mt-1">Real-time analytics & insights</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Dashboard UI status bar -->
                                <div class="bg-[#0A2240] border-t border-gray-700 p-3 flex justify-between items-center rounded-b-xl">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                        <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    </div>
                                    <div class="text-xs text-gray-400">Enterprise Dashboard v2.5</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="py-8 md:py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-counter text-2xl sm:text-3xl md:text-4xl" id="projectsCounter">0</div>
                    <p class="text-gray-600 font-medium text-sm md:text-base">Projects Completed</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-counter text-2xl sm:text-3xl md:text-4xl" id="clientsCounter">0</div>
                    <p class="text-gray-600 font-medium text-sm md:text-base">Satisfied Clients</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-counter text-2xl sm:text-3xl md:text-4xl" id="timeCounter">0</div>
                    <p class="text-gray-600 font-medium text-sm md:text-base">Time Saved (%)</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-counter text-2xl sm:text-3xl md:text-4xl" id="citiesCounter">0</div>
                    <p class="text-gray-600 font-medium text-sm md:text-base">Cities Covered</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Trusted By Section --}}
    @include('components.slider')

    {{-- Features Section --}}
    <section id="features" class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Our Permit Management Solution</h2>
                <div class="h-1 w-20 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">Experience a faster, more efficient permitting process</p>
            </div>

            <div class="flex flex-wrap mb-16">
                <div class="w-full lg:w-1/2 mb-8 lg:mb-0 lg:pr-8" data-aos="fade-right">
                    <h3 class="text-2xl font-bold mb-6">Your projects, our expertise</h3>
                    <p class="mb-6 text-gray-600">Give your team back valuable time by utilizing our pre-vetted research and submission processes. Our team will review your scope of work and project plans to create a comprehensive list of permits needed to complete it.</p>
                    
                    <div class="mb-8">
                        <div class="flex flex-wrap mb-4 gap-2">
                            <button class="w-full sm:w-auto px-5 py-2 border border-gray-300 rounded-lg tab-btn active" id="old-way-tab">Old Way</button>
                            <button class="w-full sm:w-auto px-5 py-2 border border-gray-300 rounded-lg tab-btn" id="new-way-tab">With 1 Contractor</button>
                        </div>
                        
                        <div class="p-6 border border-gray-200 rounded-lg bg-white shadow-sm">
                            <div id="old-way-content">
                                <h4 class="text-[#E31B23] text-xl font-bold mb-3">Back and Forth to Gather Requirements</h4>
                                <p class="text-gray-600">Call, email, and meet on-site with building departments and/or external consultants to piece together permit requirements.</p>
                            </div>
                            <div id="new-way-content" class="hidden">
                                <h4 class="text-[#0A2240] text-xl font-bold mb-3">Permit Requirements At Your Fingertips</h4>
                                <p class="text-gray-600">Comprehensive, up-to-date permit requirements put together, vetted, and updated by our team of local experts.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2" data-aos="fade-left">
                    <div class="rounded-lg shadow-xl overflow-hidden h-full">
                        <img src="https://cdn.prod.website-files.com/6388a088c0a35a9c812b566a/67e2eac486f97c3a7443d5bd_Arch-small%20-%20Tenant%20Improvements.jpg" alt="Permit Dashboard" class="w-full h-full object-cover object-center">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Key Benefits</h2>
                <div class="h-1 w-20 bg-[#E31B23] mx-auto mb-8"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md p-8 transition-transform duration-300 hover:transform hover:scale-105 benefit-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-speedometer2 text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Faster Approvals</h4>
                    <p class="text-gray-600">Reduce permit approval times by up to 60% with our streamlined processes and agency relationships.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-8 transition-transform duration-300 hover:transform hover:scale-105 benefit-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-shield-check text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Reduced Compliance Risks</h4>
                    <p class="text-gray-600">Our expertise ensures your projects meet all local building codes and regulatory requirements.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-8 transition-transform duration-300 hover:transform hover:scale-105 benefit-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-graph-up-arrow text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold mb-4">Cost Savings</h4>
                    <p class="text-gray-600">Avoid expensive delays and rework by getting permits right the first time with our comprehensive approach.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">How It Works</h2>
                <div class="h-1 w-20 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">Our simple process gets your permits approved faster</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-lg shadow-lg p-6 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-lg font-bold">1</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-clipboard-check text-3xl"></i>
                        </div>
                        <h4 class="text-lg md:text-xl font-bold mb-4 text-[#0A2240]">Submit Project Details</h4>
                        <p class="text-gray-600 text-sm md:text-base">Upload your project scope, plans, and location information through our secure portal.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-lg shadow-lg p-6 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-lg font-bold">2</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-search text-3xl"></i>
                        </div>
                        <h4 class="text-lg md:text-xl font-bold mb-4 text-[#0A2240]">Receive Permit Analysis</h4>
                        <p class="text-gray-600 text-sm md:text-base">Our experts analyze your project and provide a comprehensive list of required permits.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white rounded-lg shadow-lg p-6 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-lg font-bold">3</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-file-earmark-text text-3xl"></i>
                        </div>
                        <h4 class="text-lg md:text-xl font-bold mb-4 text-[#0A2240]">Approve Submission</h4>
                        <p class="text-gray-600 text-sm md:text-base">Review and approve the prepared permit applications before we submit them to the relevant authorities.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-white rounded-lg shadow-lg p-6 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-lg font-bold">4</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-check-circle text-3xl"></i>
                        </div>
                        <h4 class="text-lg md:text-xl font-bold mb-4 text-[#0A2240]">Track Progress</h4>
                        <p class="text-gray-600 text-sm md:text-base">Monitor real-time status updates through our dashboard until final approval is granted.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.permitFor')
    {{-- Testimonials Section --}}
    @include('components.testimonial')

    {{-- FAQ Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Frequently Asked Questions</h2>
                <div class="h-1 w-20 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">Get answers to common questions about our permitting solution</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="mb-6 border border-gray-200 rounded-lg bg-white shadow-md" data-aos="fade-up">
                    <button class="flex justify-between items-center w-full p-6 text-left font-bold text-lg text-[#0A2240] hover:text-[#E31B23] transition-colors faq-btn">
                        <span>What types of permits can you help with?</span>
                        <i class="bi bi-plus-lg text-[#E31B23]"></i>
                    </button>
                    <div class="hidden px-6 pb-6 text-gray-600 faq-content">
                        <p>We assist with all types of construction permits including building permits, electrical permits, plumbing permits, mechanical permits, zoning permits, signage permits, demolition permits, and more. Our expertise covers residential, commercial, and industrial projects across multiple jurisdictions.</p>
                    </div>
                </div>
                
                <div class="mb-6 border border-gray-200 rounded-lg bg-white shadow-md" data-aos="fade-up" data-aos-delay="100">
                    <button class="flex justify-between items-center w-full p-6 text-left font-bold text-lg text-[#0A2240] hover:text-[#E31B23] transition-colors faq-btn">
                        <span>How long does the permit process typically take?</span>
                        <i class="bi bi-plus-lg text-[#E31B23]"></i>
                    </button>
                    <div class="hidden px-6 pb-6 text-gray-600 faq-content">
                        <p>Permit timelines vary by jurisdiction and project complexity. Traditional methods can take 4-12 weeks, but our streamlined process typically reduces approval times by up to 60%. We provide estimated timelines based on your specific project and location during our initial consultation.</p>
                    </div>
                </div>
                
                <div class="mb-6 border border-gray-200 rounded-lg bg-white shadow-md" data-aos="fade-up" data-aos-delay="200">
                    <button class="flex justify-between items-center w-full p-6 text-left font-bold text-lg text-[#0A2240] hover:text-[#E31B23] transition-colors faq-btn">
                        <span>What information do I need to provide to get started?</span>
                        <i class="bi bi-plus-lg text-[#E31B23]"></i>
                    </button>
                    <div class="hidden px-6 pb-6 text-gray-600 faq-content">
                        <p>To get started, we need your project's location, basic scope of work, and any existing plans or drawings. Our user-friendly platform makes it easy to upload these documents. After initial review, our team will guide you through any additional information needed for your specific permits.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    @include('components.cta')

    {{-- Include Footer --}}
    @include('components.footer')

    <!-- Scripts -->
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/resources/js/app.js"></script>
    <script>
        // Initialize AOS animations
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                disable: 'mobile' // Optional: disable on mobile for better performance
            });
            
            // Tab functionality
            const oldWayTab = document.getElementById('old-way-tab');
            const newWayTab = document.getElementById('new-way-tab');
            const oldWayContent = document.getElementById('old-way-content');
            const newWayContent = document.getElementById('new-way-content');
            
            if(oldWayTab && newWayTab && oldWayContent && newWayContent) {
                oldWayTab.addEventListener('click', function() {
                    oldWayTab.classList.add('active');
                    newWayTab.classList.remove('active');
                    oldWayContent.classList.remove('hidden');
                    newWayContent.classList.add('hidden');
                });
                
                newWayTab.addEventListener('click', function() {
                    newWayTab.classList.add('active');
                    oldWayTab.classList.remove('active');
                    newWayContent.classList.remove('hidden');
                    oldWayContent.classList.add('hidden');
                });
            }
            
            // Counter animation
            function animateCounter(elementId, targetValue, duration) {
                const element = document.getElementById(elementId);
                if(!element) return;
                
                const increment = targetValue / (duration / 50);
                let current = 0;
                
                const timer = setInterval(function() {
                    current += increment;
                    element.textContent = Math.floor(current);
                    
                    if (current >= targetValue) {
                        element.textContent = targetValue;
                        clearInterval(timer);
                    }
                }, 50);
            }
            
            // Start counter animations
            animateCounter('projectsCounter', 1500, 2000);
            animateCounter('clientsCounter', 500, 2000);
            animateCounter('timeCounter', 60, 2000);
            animateCounter('citiesCounter', 120, 2000);
            
            // FAQ functionality
            const faqBtns = document.querySelectorAll('.faq-btn');
            
            faqBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    
                    if (content.classList.contains('hidden')) {
                        content.classList.remove('hidden');
                        icon.classList.remove('bi-plus-lg');
                        icon.classList.add('bi-dash-lg');
                    } else {
                        content.classList.add('hidden');
                        icon.classList.remove('bi-dash-lg');
                        icon.classList.add('bi-plus-lg');
                    }
                });
            });
        });
    </script>
</body>
</html>