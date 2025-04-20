// public/js/navbar.js

document.addEventListener('DOMContentLoaded', function() {
    // Sticky header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (window.scrollY >= 60) {
            header.classList.add('stickyheader');
        } else {
            header.classList.remove('stickyheader');
        }
    });

    // Mobile menu
    const menuButton = document.querySelector('.menuiconbox');
    const navMenu = document.querySelector('.nav-menu');
    const menuIcon = document.querySelector('.menuicon');
    const closeIcon = document.querySelector('.menucloseicon');

    if (menuButton) {
        menuButton.addEventListener('click', function() {
            navMenu.classList.toggle('w--open');
            if (navMenu.classList.contains('w--open')) {
                menuIcon.style.display = 'none';
                closeIcon.style.display = 'block';
            } else {
                menuIcon.style.display = 'block';
                closeIcon.style.display = 'none';
            }
        });
    }

    // Dropdown functionality
    const dropdowns = document.querySelectorAll('.navsubmenu');

    dropdowns.forEach(dropdown => {
        const toggle = dropdown.querySelector('.navsubmenu-toggle');
        const list = dropdown.querySelector('.navsubmenu-list, .navigation-dropdown');

        if (toggle && list) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();

                // Close other open dropdowns
                dropdowns.forEach(otherDropdown => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.querySelector('.navsubmenu-list, .navigation-dropdown')?.classList.remove('w--open');
                        otherDropdown.querySelector('.navsubmenu-toggle')?.classList.remove('w--open');
                    }
                });

                // Toggle current dropdown
                list.classList.toggle('w--open');
                toggle.classList.toggle('w--open');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdown.contains(e.target)) {
                    list.classList.remove('w--open');
                    toggle.classList.remove('w--open');
                }
            });
        }
    });

    // Resources menu items
    const resourcesMenuItems = document.querySelectorAll('.resources-menu-item');
    const resourcesMenuBlocks = document.querySelectorAll('.resources-menu-second-block');

    resourcesMenuItems.forEach((item, index) => {
        item.addEventListener('click', function() {
            // Mobile version
            if (window.innerWidth < 992) {
                item.classList.toggle('active');
            } else {
                // Desktop version
                resourcesMenuItems.forEach(menuItem => {
                    menuItem.classList.remove('active');
                });

                resourcesMenuBlocks.forEach(block => {
                    block.classList.remove('visible');
                });

                item.classList.add('active');
                if (resourcesMenuBlocks[index]) {
                    resourcesMenuBlocks[index].classList.add('visible');
                }
            }
        });
    });
});
