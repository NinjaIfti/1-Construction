<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Product | 1 Contractor Solutions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/resources/css/app.css">
</head>
<body class="body">
    {{-- Include Navbar --}}
    @include('components.navbar')

    {{-- Hero Section --}}
    <section class="product-hero bg-primary-navy text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div style="width: 60px; height: 6px; background-color: #E31B23; margin-bottom: 25px;"></div>
                    <h1 class="display-4 fw-bold mb-4">Streamline Your <span class="text-primary-red">Permitting</span> Process</h1>
                    <p class="lead mb-4">Our comprehensive permit management solution helps you navigate complex regulations so you can focus on your construction project.</p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="#contact" class="btn btn-lg px-4 py-3 get-started-btn">
                            Get Started Today
                        </a>
                        <a href="#features" class="btn btn-lg px-4 py-3 btn-outline-light">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="position-relative">
                        <div class="bg-primary-red rounded-3 position-absolute" style="width: 80%; height: 80%; right: 0; top: 0; z-index: 1;"></div>
                        <div class="position-relative rounded-3 shadow-lg overflow-hidden" style="z-index: 2; margin-top: 20px; margin-left: 20px;">
                            <img src="/images/blueprint.jpg" alt="Permit Dashboard" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trusted By Section --}}
    @include('components.slider')

    {{-- Features Section --}}
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Our Permit Management Solution</h2>
                <div style="height: 4px; width: 80px; background-color: #E31B23; margin: 0 auto 30px;"></div>
                <p class="lead text-muted mb-5">Experience a faster, more efficient permitting process</p>
            </div>

            <div class="row mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h3 class="mb-4">Your projects, our expertise</h3>
                    <p class="mb-4">Give your team back valuable time by utilizing our pre-vetted research and submission processes. Our team will review your scope of work and project plans to create a comprehensive list of permits needed to complete it.</p>
                    
                    <div class="comparison-tabs mb-4">
                        <div class="d-flex mb-3">
                            <button class="btn btn-outline-secondary me-2 active" id="old-way-tab">Old Way</button>
                            <button class="btn btn-outline-secondary" id="new-way-tab">With 1 Contractor</button>
                        </div>
                        
                        <div class="comparison-content p-4 border rounded-3">
                            <div id="old-way-content">
                                <h4 class="text-danger mb-3">Back and Forth to Gather Requirements</h4>
                                <p>Call, email, and meet on-site with building departments and/or external consultants to piece together permit requirements.</p>
                            </div>
                            <div id="new-way-content" style="display: none;">
                                <h4 class="text-primary mb-3">Permit Requirements At Your Fingertips</h4>
                                <p>Comprehensive, up-to-date permit requirements put together, vetted, and updated by our team of local experts.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="rounded-3 shadow-lg overflow-hidden">
                        <img src="/images/blueprint.jpg" alt="Permit Process" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Benefits Section --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Key Benefits</h2>
                <div style="height: 4px; width: 80px; background-color: #E31B23; margin: 0 auto 30px;"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon mb-3 text-primary-red">
                                <i class="bi bi-speedometer2 fs-1"></i>
                            </div>
                            <h4 class="card-title">Faster Approvals</h4>
                            <p class="card-text text-muted">Reduce permit approval times by up to 60% with our streamlined processes and agency relationships.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon mb-3 text-primary-red">
                                <i class="bi bi-shield-check fs-1"></i>
                            </div>
                            <h4 class="card-title">Reduced Compliance Risks</h4>
                            <p class="card-text text-muted">Our expertise ensures your projects meet all local building codes and regulatory requirements.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="feature-icon mb-3 text-primary-red">
                                <i class="bi bi-graph-up-arrow fs-1"></i>
                            </div>
                            <h4 class="card-title">Cost Savings</h4>
                            <p class="card-text text-muted">Avoid expensive delays and rework by getting permits right the first time with our comprehensive approach.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">What Our Clients Say</h2>
                <div style="height: 4px; width: 80px; background-color: #E31B23; margin: 0 auto 30px;"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="testimonial-card p-4 bg-white shadow-sm rounded-3 mb-4">
                        <div class="d-flex mb-3">
                            <div class="text-warning me-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                        <p class="testimonial-text mb-4">"It used to take us 2-3 months to get a permit. Your service cut that time in half, and your platform makes the entire permitting paperwork process so much easier. This has transformed how we operate."</p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary-navy text-white d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <span>PM</span>
                            </div>
                            <div>
                                <h5 class="mb-0">Project Manager</h5>
                                <p class="text-muted mb-0">Commercial Construction</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-5 bg-primary-navy text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-3">Ready to Streamline Your Permitting Process?</h2>
                    <p class="lead mb-0">Let our experts handle the regulatory maze while you focus on your construction project.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="#contact" class="btn btn-lg px-4 py-3 get-started-btn">
                        Get Started Today
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <section id="contact" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-3">Contact Us</h2>
                        <div style="height: 4px; width: 80px; background-color: #E31B23; margin: 0 auto 30px;"></div>
                        <p class="text-muted mb-0">Fill out the form below to learn more about our services</p>
                    </div>

                    <form class="contact-form p-4 bg-light rounded-3 shadow-sm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" placeholder="Your Company">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Your Phone">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="Tell us about your project" required></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-lg px-5 get-started-btn">Submit Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- Include Footer --}}
    @include('components.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/resources/js/app.js"></script>
    <script>
        // Simple tab functionality for comparison section
        document.addEventListener('DOMContentLoaded', function() {
            const oldWayTab = document.getElementById('old-way-tab');
            const newWayTab = document.getElementById('new-way-tab');
            const oldWayContent = document.getElementById('old-way-content');
            const newWayContent = document.getElementById('new-way-content');

            if (oldWayTab && newWayTab && oldWayContent && newWayContent) {
                oldWayTab.addEventListener('click', function() {
                    oldWayTab.classList.add('active');
                    newWayTab.classList.remove('active');
                    oldWayContent.style.display = 'block';
                    newWayContent.style.display = 'none';
                });

                newWayTab.addEventListener('click', function() {
                    newWayTab.classList.add('active');
                    oldWayTab.classList.remove('active');
                    newWayContent.style.display = 'block';
                    oldWayContent.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html> 