// Update your initMobileMenu function in app.js
function initMobileMenu() {
    // Mobile menu toggle functionality
    const mobileMenuButton = $('#mobile-menu-button');
    const mobileMenu = $('#mobile-menu');
    
    if (mobileMenuButton.length && mobileMenu.length) {
        console.log('Mobile menu elements found');
        
        // Remove any initial classes that might interfere
        mobileMenu.removeClass('hidden');
        
        mobileMenuButton.on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle the 'show' class for dropdown effect
            mobileMenu.toggleClass('show');
            console.log('Mobile menu toggled, has show class:', mobileMenu.hasClass('show'));
        });
        
        // Close mobile menu when clicking outside
        $(document).on('click', function(event) {
            if (!mobileMenuButton.is(event.target) && 
                !mobileMenuButton.has(event.target).length && 
                !mobileMenu.is(event.target) && 
                !mobileMenu.has(event.target).length && 
                mobileMenu.hasClass('show')) {
                mobileMenu.removeClass('show');
            }
        });
        
        // Add ESC key support to close menu
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.hasClass('show')) {
                mobileMenu.removeClass('show');
            }
        });
    } else {
        console.error('Mobile menu elements not found');
    }
}

// Update your initStickyHeader function in app.js
function initStickyHeader() {
    // Sticky header functionality
    const header = $('#main-navbar');
    
    if (header.length) {
        console.log('Header found:', header);
        const headerHeight = header.outerHeight();
        
        function handleSticky() {
            const scrollPosition = $(window).scrollTop();
            console.log('Scroll position:', scrollPosition);
            
            if (scrollPosition > 10) {
                if (!header.hasClass('sticky-header')) {
                    header.addClass('sticky-header');
                    $('body').css('padding-top', headerHeight + 'px');
                    console.log('Added sticky-header class');
                    
                    // Force the navbar background color to change
                    header.find('nav').css('background-color', 'white');
                    header.find('.navbar').css('background-color', 'white');
                }
            } else {
                if (header.hasClass('sticky-header')) {
                    header.removeClass('sticky-header');
                    $('body').css('padding-top', '0');
                    console.log('Removed sticky-header class');
                    
                    // Reset navbar background color
                    header.find('nav').css('background-color', '#0A2240');
                    header.find('.navbar').css('background-color', '#0A2240');
                }
            }
        }
        
        // Run on page load
        handleSticky();
        
        // Run on scroll
        $(window).on('scroll', handleSticky);
        
        // Update on window resize
        $(window).on('resize', function() {
            if (header.hasClass('sticky-header')) {
                $('body').css('padding-top', header.outerHeight() + 'px');
            }
        });
    } else {
        console.error('Header element not found!');
    }
}