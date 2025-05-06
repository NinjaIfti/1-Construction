<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Resources | 1 Contractor | Construction Permitting Software</title>
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
        
        .resource-card {
            border-left: 4px solid #E31B23;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <!-- Include Navbar Component -->
    @include('components.navbar')
    
    <!-- Hero Section -->
    <section style="background-color: #0A2240;" class="text-white min-h-[350px] relative pt-16 pb-20">
        <div class="container mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6" data-aos="fade-up">Construction Permitting Resources</h1>
                <p class="text-lg mb-8" data-aos="fade-up" data-aos-delay="100">Explore our collection of guides, templates, case studies, and industry insights to help streamline your construction permitting process.</p>
                
                <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="#guides" class="btn-primary">
                        Guides & Templates
                    </a>
                    <a href="#case-studies" class="bg-white text-black hover:bg-gray-100 px-6 py-2 rounded-full font-medium transition-colors">
                        Case Studies
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Angled cutout effect -->
        <div class="absolute bottom-0 right-0 w-2/3 h-full -z-0" style="background-color: #E31B23; opacity: 0.1; clip-path: polygon(100% 0, 0% 100%, 100% 100%);"></div>
    </section>
    
    <!-- Resource Categories -->
    <section class="py-16">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Find the resources you need</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Browse by category or search for specific topics</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-red-600 mb-4">
                        <i class="bi bi-file-earmark-text text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Permit Guides</h3>
                    <p class="text-gray-600 mb-4">Step-by-step instructions for common permit types</p>
                    <a href="#" class="text-red-600 font-medium hover:text-red-800">View Guides <i class="bi bi-arrow-right"></i></a>
                </div>
                
                <!-- Category 2 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-red-600 mb-4">
                        <i class="bi bi-buildings text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jurisdiction Database</h3>
                    <p class="text-gray-600 mb-4">Requirements for different cities and counties</p>
                    <a href="#" class="text-red-600 font-medium hover:text-red-800">Browse Locations <i class="bi bi-arrow-right"></i></a>
                </div>
                
                <!-- Category 3 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-red-600 mb-4">
                        <i class="bi bi-file-earmark-spreadsheet text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Templates</h3>
                    <p class="text-gray-600 mb-4">Downloadable forms, checklists, and documents</p>
                    <a href="#" class="text-red-600 font-medium hover:text-red-800">Download Templates <i class="bi bi-arrow-right"></i></a>
                </div>
                
                <!-- Category 4 -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-red-600 mb-4">
                        <i class="bi bi-book text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Knowledge Base</h3>
                    <p class="text-gray-600 mb-4">Articles and FAQs about permitting processes</p>
                    <a href="#" class="text-red-600 font-medium hover:text-red-800">Browse Articles <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Featured Resources -->
    <section id="guides" class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Popular Guides & Templates</h2>
                <p class="text-lg text-gray-600">Our most-used resources to help you navigate the permitting process</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Resource 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1331&q=80" alt="Residential Permit Guide" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-red-600 text-white text-xs font-bold px-3 py-1">GUIDE</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Residential Building Permit Guide</h3>
                        <p class="text-gray-600 mb-4">Complete guide to residential building permits including requirements, common pitfalls, and submission tips.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">15 min read</span>
                            <a href="#" class="text-red-600 font-medium hover:text-red-800">Download PDF <i class="bi bi-download"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Resource 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Plan Review Checklist" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-3 py-1">TEMPLATE</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Plan Review Checklist Template</h3>
                        <p class="text-gray-600 mb-4">Comprehensive checklist for ensuring your plans meet local requirements before submission.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Editable Excel</span>
                            <a href="#" class="text-red-600 font-medium hover:text-red-800">Download <i class="bi bi-download"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Resource 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="https://images.unsplash.com/photo-1565043589221-1a6fd9ae45c7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1074&q=80" alt="Permit Timeline Guide" class="w-full h-full object-cover">
                        <div class="absolute top-0 right-0 bg-green-600 text-white text-xs font-bold px-3 py-1">INFOGRAPHIC</div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Permit Timeline Infographic</h3>
                        <p class="text-gray-600 mb-4">Visual guide to understanding typical permitting timelines and how to expedite the process.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">High-res image</span>
                            <a href="#" class="text-red-600 font-medium hover:text-red-800">View <i class="bi bi-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="/resources/guides" class="btn-primary">
                    View All Guides & Templates
                </a>
            </div>
        </div>
    </section>
    
    <!-- Case Studies -->
    <section id="case-studies" class="py-16">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Case Studies</h2>
                <p class="text-lg text-gray-600">Real-world examples of how our clients have streamlined their permitting processes</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Case Study 1 -->
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="md:w-2/5 h-64 md:h-auto">
                        <img src="https://images.unsplash.com/photo-1590381105924-c72589b9ef3f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80" alt="Commercial Project" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-3/5 p-6">
                        <div class="mb-3">
                            <span class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">Commercial</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">How XYZ Construction Reduced Permit Times by 40%</h3>
                        <p class="text-gray-600 mb-4">Learn how a major commercial builder transformed their permitting workflow using digital tools and strategic planning.</p>
                        <a href="#" class="text-red-600 font-medium hover:text-red-800">Read Case Study <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Case Study 2 -->
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="md:w-2/5 h-64 md:h-auto">
                        <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" alt="Residential Development" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-3/5 p-6">
                        <div class="mb-3">
                            <span class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">Residential</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Streamlining 200+ Permits for Greenview Estates</h3>
                        <p class="text-gray-600 mb-4">How a residential developer managed permits for an entire subdivision development with automated workflows.</p>
                        <a href="#" class="text-red-600 font-medium hover:text-red-800">Read Case Study <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="/resources/case-studies" class="btn-primary">
                    View All Case Studies
                </a>
            </div>
        </div>
    </section>
    
    <!-- Latest Articles -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-bold mb-4">Latest Articles</h2>
                <p class="text-lg text-gray-600">Stay up-to-date with industry insights and permitting best practices</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Article 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden resource-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                                <i class="bi bi-newspaper text-red-600"></i>
                            </div>
                            <span class="text-sm text-gray-500">May 15, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">5 Common Mistakes That Delay Building Permits</h3>
                        <p class="text-gray-600 mb-4">Learn the most frequent issues that cause permit applications to be rejected and how to avoid them.</p>
                        <a href="#" class="text-red-600 font-medium hover:text-red-800">Read Article <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Article 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden resource-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                                <i class="bi bi-newspaper text-red-600"></i>
                            </div>
                            <span class="text-sm text-gray-500">April 28, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">2023 Building Code Updates: What You Need to Know</h3>
                        <p class="text-gray-600 mb-4">A comprehensive overview of the latest building code changes and how they impact your projects.</p>
                        <a href="#" class="text-red-600 font-medium hover:text-red-800">Read Article <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                
                <!-- Article 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden resource-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                                <i class="bi bi-newspaper text-red-600"></i>
                            </div>
                            <span class="text-sm text-gray-500">April 10, 2023</span>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Digital Permitting: The Future of Construction Approvals</h3>
                        <p class="text-gray-600 mb-4">Explore how digital permitting solutions are transforming the construction industry.</p>
                        <a href="#" class="text-red-600 font-medium hover:text-red-800">Read Article <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10" data-aos="fade-up">
                <a href="/resources/articles" class="btn-primary">
                    View All Articles
                </a>
            </div>
        </div>
    </section>
    
    <!-- Subscribe Section -->
    <section class="py-16">
        <div class="container mx-auto px-6 lg:px-8 max-w-4xl">
            <div class="bg-white rounded-lg shadow-xl p-8 border-t-4" style="border-color: #E31B23;" data-aos="fade-up">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
                    <p class="text-gray-600">Subscribe to get the latest resources, articles, and updates delivered to your inbox</p>
                </div>
                
                <form class="flex flex-col md:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <button type="submit" style="background-color: #E31B23;" class="px-6 py-3 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">Subscribe</button>
                </form>
                
                <p class="text-sm text-gray-500 mt-4 text-center">We respect your privacy. Unsubscribe at any time.</p>
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