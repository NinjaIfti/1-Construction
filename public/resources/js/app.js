// Navbar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Scroll detection for header styling
    window.addEventListener('scroll', function() {
        const scroll = window.scrollY || document.documentElement.scrollTop;
        const header = document.querySelector('.header');
        
        if (scroll >= 60) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    const mobileToggle = document.querySelector('.navbar-toggler');
    const mobileDropdown = document.querySelector('.mobile-dropdown');
    
    if (mobileToggle && mobileDropdown) {
        mobileToggle.addEventListener('click', function() {
            mobileDropdown.classList.toggle('active');
            mobileToggle.classList.toggle('active');
        });
        
        // Close mobile menu when clicking on a link
        const mobileLinks = document.querySelectorAll('.mobile-nav-link, .mobile-dropdown .get-started-btn');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileDropdown.classList.remove('active');
                mobileToggle.classList.remove('active');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = mobileDropdown.contains(event.target) || mobileToggle.contains(event.target);
            
            if (!isClickInside && mobileDropdown.classList.contains('active')) {
                mobileDropdown.classList.remove('active');
                mobileToggle.classList.remove('active');
            }
        });
    }
}); 