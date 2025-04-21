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
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    {{-- Include Navbar --}}
    @include('components.navbar')

    {{-- Hero Section --}}
    <section class="gradient-bg text-white py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-1/2 mb-10 lg:mb-0" data-aos="fade-right" data-aos-duration="1000">
                    <div class="w-20 h-2 bg-[#E31B23] mb-8"></div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">Streamline Your <span class="text-[#E31B23]">Permitting</span> Process</h1>
                    <p class="text-xl mb-8 opacity-90 leading-relaxed">Our comprehensive permit management solution helps contractors navigate complex regulations, reduce approval times, and minimize compliance risks.</p>
                    <div class="flex flex-wrap gap-4 mt-10">
                        <a href="#contact" class="px-8 py-4 bg-[#E31B23] text-white font-medium rounded-lg hover:bg-[#c8171f] transition-colors duration-300 shadow-lg transform hover:scale-105">
                            Get Started Today
                        </a>
                        <a href="#features" class="px-8 py-4 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-[#0A2240] transition-colors duration-300">
                            See How It Works
                        </a>
                    </div>
                    <div class="mt-10 flex items-center gap-6">
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
                    <div class="relative">
                        <div class="absolute bg-[#E31B23] rounded-lg w-4/5 h-4/5 right-0 top-0 z-0 opacity-90"></div>
                        <div class="relative rounded-lg shadow-2xl overflow-hidden z-10 mt-6 ml-6 transform hover:scale-105 transition-all duration-500">
                            <img src="/images/blueprint.jpg" alt="Permit Dashboard" class="w-full">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A2240] to-transparent opacity-60"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <p class="text-xl font-semibold">Permit Management Dashboard</p>
                                <p class="opacity-80">Real-time tracking and updates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section (New) --}}
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-counter" id="projectsCounter">0</div>
                    <p class="text-gray-600 font-medium">Projects Completed</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-counter" id="clientsCounter">0</div>
                    <p class="text-gray-600 font-medium">Satisfied Clients</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-counter" id="timeCounter">0</div>
                    <p class="text-gray-600 font-medium">Time Saved (%)</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-counter" id="citiesCounter">0</div>
                    <p class="text-gray-600 font-medium">Cities Covered</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Trusted By Section --}}
    @include('components.slider')

    {{-- Features Section --}}
    <section id="features" class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Our Permit Management Solution</h2>
                <div class="h-1.5 w-24 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Experience a faster, more efficient permitting process with our industry-leading platform</p>
            </div>

            <div class="flex flex-wrap mb-20">
                <div class="w-full lg:w-1/2 mb-10 lg:mb-0 lg:pr-12" data-aos="fade-right">
                    <h3 class="text-3xl font-bold mb-6 text-[#0A2240]">Your projects, our expertise</h3>
                    <p class="mb-8 text-gray-600 text-lg leading-relaxed">Give your team back valuable time by utilizing our pre-vetted research and submission processes. Our team will review your scope of work and project plans to create a comprehensive list of permits needed to complete it.</p>
                    
                    <div class="mb-8">
                        <div class="flex mb-4">
                            <button class="px-6 py-3 border-2 border-[#0A2240] rounded-lg mr-4 tab-btn active font-medium text-[#0A2240]" id="old-way-tab">Old Way</button>
                            <button class="px-6 py-3 border-2 border-[#E31B23] rounded-lg tab-btn font-medium text-[#E31B23]" id="new-way-tab">With 1 Contractor</button>
                        </div>
                        
                        <div class="p-8 border border-gray-200 rounded-lg bg-white shadow-lg">
                            <div id="old-way-content">
                                <h4 class="text-[#E31B23] text-2xl font-bold mb-4">Back and Forth to Gather Requirements</h4>
                                <p class="text-gray-600 text-lg leading-relaxed">Call, email, and meet on-site with building departments and/or external consultants to piece together permit requirements. Waste valuable time with inconsistent information and multiple points of contact.</p>
                                <div class="mt-6 flex items-center">
                                    <i class="bi bi-clock-history text-[#E31B23] text-3xl mr-3"></i>
                                    <p class="text-gray-700 font-medium">Average time: 3-6 weeks</p>
                                </div>
                            </div>
                            <div id="new-way-content" class="hidden">
                                <h4 class="text-[#0A2240] text-2xl font-bold mb-4">Permit Requirements At Your Fingertips</h4>
                                <p class="text-gray-600 text-lg leading-relaxed">Comprehensive, up-to-date permit requirements put together, vetted, and updated by our team of local experts. Access everything you need in one centralized platform.</p>
                                <div class="mt-6 flex items-center">
                                    <i class="bi bi-lightning-charge-fill text-[#E31B23] text-3xl mr-3"></i>
                                    <p class="text-gray-700 font-medium">Average time: 5-10 days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="#contact" class="inline-flex items-center text-[#E31B23] font-medium hover:underline">
                            Learn more about our process
                            <i class="bi bi-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                <div class="w-full lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="rounded-lg shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                        <img src="/images/blueprint.jpg" alt="Permit Process" class="w-full">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-[#0A2240] p-6">
                            <p class="text-white text-lg font-medium">Watch our demo</p>
                            <div class="h-12 w-12 rounded-full bg-[#E31B23] flex items-center justify-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer hover:bg-[#c8171f] transition-colors">
                                <i class="bi bi-play-fill text-white text-2xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works Section (New) --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">How It Works</h2>
                <div class="h-1.5 w-24 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Our simple 4-step process gets your permits approved faster</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-lg shadow-lg p-8 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-12 h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-xl font-bold">1</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-clipboard-check text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-[#0A2240]">Submit Project Details</h4>
                        <p class="text-gray-600">Upload your project scope, plans, and location information through our secure portal.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-lg shadow-lg p-8 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-12 h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-xl font-bold">2</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-search text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-[#0A2240]">Receive Permit Analysis</h4>
                        <p class="text-gray-600">Our experts analyze your project and provide a comprehensive list of required permits.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white rounded-lg shadow-lg p-8 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-12 h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-xl font-bold">3</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-file-earmark-text text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-[#0A2240]">Approve Submission</h4>
                        <p class="text-gray-600">Review and approve the prepared permit applications before we submit them to the relevant authorities.</p>
                    </div>
                </div>
                <div class="relative" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-white rounded-lg shadow-lg p-8 h-full feature-card border-t-4 border-[#E31B23]">
                        <div class="absolute -top-5 -left-5 w-12 h-12 rounded-full bg-[#0A2240] text-white flex items-center justify-center text-xl font-bold">4</div>
                        <div class="text-[#0A2240] mb-6">
                            <i class="bi bi-check-circle text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-bold mb-4 text-[#0A2240]">Track Progress</h4>
                        <p class="text-gray-600">Monitor real-time status updates through our dashboard until final approval is granted.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Key Benefits</h2>
                <div class="h-1.5 w-24 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Why contractors choose our permitting solution</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white rounded-lg shadow-xl p-10 transition-transform duration-300 hover:transform hover:scale-105 border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-speedometer2 text-5xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0A2240]">Faster Approvals</h4>
                    <p class="text-gray-600 text-lg leading-relaxed">Reduce permit approval times by up to 60% with our streamlined processes and agency relationships.</p>
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-[#E31B23] bg-opacity-10 flex items-center justify-center mr-4">
                                <i class="bi bi-clock text-[#E31B23]"></i>
                            </div>
                            <p class="text-gray-700">Save weeks on project timelines</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-xl p-10 transition-transform duration-300 hover:transform hover:scale-105 border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-shield-check text-5xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0A2240]">Reduced Compliance Risks</h4>
                    <p class="text-gray-600 text-lg leading-relaxed">Our expertise ensures your projects meet all local building codes and regulatory requirements.</p>
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-[#E31B23] bg-opacity-10 flex items-center justify-center mr-4">
                                <i class="bi bi-check-circle text-[#E31B23]"></i>
                            </div>
                            <p class="text-gray-700">Avoid costly violations and fines</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-xl p-10 transition-transform duration-300 hover:transform hover:scale-105 border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-[#E31B23] mb-6">
                        <i class="bi bi-graph-up-arrow text-5xl"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-[#0A2240]">Cost Savings</h4>
                    <p class="text-gray-600 text-lg leading-relaxed">Avoid expensive delays and rework by getting permits right the first time with our comprehensive approach.</p>
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-[#E31B23] bg-opacity-10 flex items-center justify-center mr-4">
                                <i class="bi bi-cash-coin text-[#E31B23]"></i>
                            </div>
                            <p class="text-gray-700">Average savings of $10,000+ per project</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.permitFor')
    {{-- Testimonials Section --}}
    @include('components.testimonial')

    {{-- FAQ Section (New) --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4">Frequently Asked Questions</h2>
                <div class="h-1.5 w-24 bg-[#E31B23] mx-auto mb-8"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Get answers to common questions about our permitting solution</p>
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
                
                <div class="mb-6 border border-gray-200 rounded-lg bg-white shadow-md" data-aos="fade-up" data-aos-delay="300">
                    <button class="flex justify-between items-center w-full p-6 text-left font-bold text-lg text-[#0A2240] hover:text-[#E31B23] transition-colors faq-btn">
                        <span>Do you handle permit fees?</span>
                        <i class="bi bi-plus-lg text-[#E31B23]"></i>
                    </button>
                    <div class="hidden px-6 pb-6 text-gray-600 faq-content">
                        <p>Yes, we can handle permit fee payments on your behalf. These regulatory fees are passed through without markup and clearly itemized on your invoice. We'll provide fee estimates before submission so you can budget accordingly for your project.</p>
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
                once: true
            });
            
            // Tab functionality
            const oldWayTab = document.getElementById('old-way-tab');
            const newWayTab = document.getElementById('new-way-tab');
            const oldWayContent = document.getElementById('old-way-content');
            const newWayContent = document.getElementById('new-way-content');
            
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
            
            // Counter animation
            function animateCounter(elementId, targetValue, duration) {
                const element = document.getElementById(elementId);
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