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