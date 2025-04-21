<!-- Updated Navbar HTML -->
<header id="main-navbar" class="header relative w-full z-50">
    <nav class="navbar navbar-dark bg-primary py-4">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <div class="flex items-center">
                        <span class="font-bold text-3xl mr-1 text-white logo-text-num">1</span>
                        <div class="flex flex-col">
                            <span class="font-bold text-sm leading-none logo-text">CONTRACTOR</span>
                            <span class="font-bold text-sm leading-none logo-text">SOLUTIONS</span>
                        </div>
                    </div>
                </a>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button id="mobile-menu-button" class="mobile-menu-button focus:outline-none hover:text-[#E31B23]">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex lg:items-center lg:justify-between flex-1 ml-16">
                    <div class="flex items-center space-x-8">
                        <a href="/product" class="font-medium text-nav-default hover:text-[#E31B23] transition duration-300 text-sm">Product</a>
                        <a href="/solutions" class="font-medium text-nav-default hover:text-[#E31B23] transition duration-300 text-sm">Solutions</a>
                        <a href="/resources" class="font-medium text-nav-default hover:text-[#E31B23] transition duration-300 text-sm">Resources</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/login" class="px-5 py-2 border border-navy font-medium rounded-full hover:bg-white hover:text-[#0A2240] transition duration-300 text-sm">
                            Login
                        </a>
                        <a href="/contact" class="px-5 py-2.5 bg-[#E31B23] text-white font-medium rounded-full hover:bg-[#c8171f] transition duration-300 text-sm shadow-md">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Menu Dropdown (hidden by default) -->
    <div id="mobile-menu" class="lg:hidden bg-primary shadow-lg absolute w-full">
        <div class="container mx-auto px-6 py-3">
            <div class="flex flex-col space-y-3">
                <a href="/product" class="py-2 font-medium text-nav-default hover:text-[#E31B23] transition duration-300">Product</a>
                <a href="/solutions" class="py-2 font-medium text-nav-default hover:text-[#E31B23] transition duration-300">Solutions</a>
                <a href="/resources" class="py-2 font-medium text-nav-default hover:text-[#E31B23] transition duration-300">Resources</a>
                <div class="pt-3 flex flex-col space-y-3">
                    <a href="/login" class="px-5 py-2 border border-navy font-medium rounded-full hover:bg-white hover:text-[#0A2240] transition duration-300 text-center">
                        Login
                    </a>
                    <a href="/contact" class="px-5 py-2.5 bg-[#E31B23] text-white font-medium rounded-full hover:bg-[#c8171f] transition duration-300 text-center shadow-md">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Updated CSS -->
<style>
/* Custom CSS for our Tailwind-based site */

/* Hero section specific styles */
.hero-section-navy {
    background-color: #0A2240 !important;
    color: white !important;
    display: flex;
    align-items: center;
}

/* Basic utility styles */
.hide-menu {
    display: none !important;
}

body {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    margin-top: 0 !important; /* Prevent gaps */
}

/* Animation utilities */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in {
    opacity: 1;
    transform: translateY(0);
}

/* Header and navbar styles */
.header {
    width: 100%;
    transition: all 0.5s ease;
    z-index: 100;
}

.navbar {
    transition: all 0.5s ease;
}

.bg-primary,
.navbar-dark.bg-primary {
    background-color: #0A2240 !important; /* Dark Navy */
    transition: background-color 0.5s ease;
}

.text-nav-default {
    color: white !important;
}

.border-navy {
    border-color: white !important;
    color: white !important;
}

.logo-text, .logo-text-num {
    color: white !important;
}

/* Mobile hamburger button */
.mobile-menu-button {
    color: white !important;
}

/* Mobile menu styling - FIXED */
#mobile-menu {
    transition: all 0.4s ease;
    transform-origin: top;
    opacity: 0;
    max-height: 0;
    overflow: hidden;
    visibility: hidden;
    display: block !important;
    top: 100%;
    left: 0;
    right: 0;
}

#mobile-menu.show {
    transform: translateY(0);
    opacity: 1;
    max-height: 500px; /* Adjust based on your content */
    visibility: visible;
}

/* Sticky header (white when scrolled) - FIXED */
.sticky-header {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    animation: slideDown 0.3s ease-in-out !important;
    z-index: 9999 !important;
}

.sticky-header nav,
.sticky-header .navbar {
    background-color: white !important;
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
    transition: all 0.5s ease;
}

/* Override the bg-primary class when sticky */
.sticky-header .bg-primary {
    background-color: white !important;
}

.sticky-header .text-nav-default {
    color: #0A2240 !important; /* Dark Navy */
    transition: color 0.5s ease;
}

.sticky-header .text-nav-default:hover {
    color: #E31B23 !important; /* Red on hover */
}

.sticky-header .border-navy {
    border-color: #0A2240 !important;
    color: #0A2240 !important;
    transition: all 0.5s ease;
}

.sticky-header .logo-text, 
.sticky-header .logo-text-num {
    color: #0A2240 !important;
    transition: color 0.5s ease;
}

.sticky-header .mobile-menu-button {
    color: #0A2240 !important;
    transition: color 0.5s ease;
}

.sticky-header #mobile-menu {
    background-color: white !important;
}

.sticky-header #mobile-menu .text-nav-default {
    color: #0A2240 !important;
}

/* For desktop, the mobile menu is hidden */
@media (min-width: 1024px) {
    #mobile-menu {
        display: none !important;
    }
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(0);
    }
}

/* Client Logo carousel styles */
.client-carousel .flex {
    transition: transform 0.5s ease-in-out;
}

/* Tab styles for product comparison */
.tab-btn {
    position: relative;
    transition: all 0.3s ease;
}

.tab-btn.active {
    background-color: #E31B23;
    color: white;
    border-color: #E31B23;
}

/* Responsive styles */
@media screen and (max-width: 991px) {
    .menuiconbox.w--open .menuicon {
        display: none;
    }
    
    .header .w-nav-overlay {
        top: 100%;
    }
}

@media screen and (max-width: 767px) {
    .client-carousel {
        padding: 0 1rem;
    }
}

/* Testimonial card ribbon effect */
.ribbon-corner {
    position: absolute;
    top: 0;
    right: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 0 80px 80px 0;
    border-color: transparent #E31B23 transparent transparent;
}

/* Service card styling */
.service-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.service-indicator {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background-color: #E31B23;
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}
</style>

<!-- Updated JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize sticky header
    initStickyHeader();
    
    // Initialize other functionality
    initAnimations();
});

function initMobileMenu() {
    // Mobile menu toggle functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        console.log('Mobile menu elements found');
        
        // Remove any initial classes that might interfere
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenu.classList.remove('hidden');
        }
        
        mobileMenuButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle the 'show' class for dropdown effect
            mobileMenu.classList.toggle('show');
            console.log('Mobile menu toggled, has show class:', mobileMenu.classList.contains('show'));
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideButton = mobileMenuButton.contains(event.target);
            const isClickInsideMenu = mobileMenu.contains(event.target);
            
            if (!isClickInsideButton && !isClickInsideMenu && mobileMenu.classList.contains('show')) {
                mobileMenu.classList.remove('show');
            }
        });
        
        // Add ESC key support to close menu
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('show')) {
                mobileMenu.classList.remove('show');
            }
        });
    } else {
        console.error('Mobile menu elements not found');
    }
}

function initStickyHeader() {
    // Sticky header functionality
    const header = document.getElementById('main-navbar');
    
    if (header) {
        console.log('Header found:', header);
        const headerHeight = header.offsetHeight;
        
        function handleSticky() {
            const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            console.log('Scroll position:', scrollPosition);
            
            if (scrollPosition > 10) {
                if (!header.classList.contains('sticky-header')) {
                    header.classList.add('sticky-header');
                    document.body.style.paddingTop = headerHeight + 'px';
                    console.log('Added sticky-header class');
                }
            } else {
                if (header.classList.contains('sticky-header')) {
                    header.classList.remove('sticky-header');
                    document.body.style.paddingTop = '0';
                    console.log('Removed sticky-header class');
                }
            }
        }
        
        // Run on page load
        handleSticky();
        
        // Run on scroll
        window.addEventListener('scroll', handleSticky);
        
        // Update on window resize
        window.addEventListener('resize', function() {
            if (header.classList.contains('sticky-header')) {
                document.body.style.paddingTop = header.offsetHeight + 'px';
            }
        });
    } else {
        console.error('Header element not found!');
    }
}

function initAnimations() {
    // Animation on scroll functionality
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    
    function checkIfInView() {
        const windowHeight = window.innerHeight;
        const windowTopPosition = window.pageYOffset;
        const windowBottomPosition = windowTopPosition + windowHeight;
        
        animatedElements.forEach(function(element) {
            const elementHeight = element.offsetHeight;
            const elementTopPosition = element.getBoundingClientRect().top + windowTopPosition;
            const elementBottomPosition = elementTopPosition + elementHeight;
            
            // Check if element is in viewport
            if ((elementBottomPosition >= windowTopPosition) && 
                (elementTopPosition <= windowBottomPosition)) {
                element.classList.add('fade-in');
            }
        });
    }
    
    // Run on page load
    checkIfInView();
    
    // Run on scroll
    window.addEventListener('scroll', checkIfInView);
}
</script>