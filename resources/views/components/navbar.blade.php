<div class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="/" class="navbar-logo">
                <div style="display: flex; align-items: center;">
                    <span class="logo-number">1</span>
                    <div style="display: flex; flex-direction: column;">
                        <span class="logo-text">CONTRACTOR</span>
                        <span class="logo-text">SOLUTIONS</span>
                    </div>
                </div>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler d-lg-none" type="button" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Main Navigation - Desktop -->
            <div class="d-none d-lg-flex align-items-center">
                <nav>
                    <ul class="d-flex list-unstyled mb-0 me-4">
                        <li class="nav-item">
                            <a href="/product" class="nav-link">Product</a>
                        </li>
                        <li class="nav-item">
                            <a href="/solutions" class="nav-link">Solutions</a>
                        </li>
                        <li class="nav-item">
                            <a href="/resources" class="nav-link">Resources</a>
                        </li>
                    </ul>
                </nav>

                <!-- Right Side Navigation - Desktop -->
                <div class="d-flex align-items-center">
                    <a href="/contact" class="get-started-btn">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div class="mobile-dropdown">
        <div class="container">
            <nav>
                <ul class="list-unstyled mb-3">
                    <li class="mobile-nav-item">
                        <a href="/product" class="mobile-nav-link">Product</a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="/solutions" class="mobile-nav-link">Solutions</a>
                    </li>
                    <li class="mobile-nav-item">
                        <a href="/resources" class="mobile-nav-link">Resources</a>
                    </li>
                </ul>
                <div class="text-center pb-2">
                    <a href="/contact" class="get-started-btn">
                        Get Started
                    </a>
                </div>
            </nav>
        </div>
    </div>
</div>

<style>
.header.scrolled {
    background-color: white !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.header.scrolled .nav-link {
    color: #0A2240 !important;
}

.header.scrolled .logo-text {
    color: #0A2240 !important;
}

/* Logo number always stays red */
.logo-number {
    color: #E31B23 !important;
}

/* Add padding to body to prevent content from hiding behind fixed navbar */
body {
    padding-top: 80px;
    margin: 0;
}

/* Remove any potential gaps */
html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

body > .header {
    margin-bottom: 0;
}
</style>


