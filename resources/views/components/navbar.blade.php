<!-- resources/views/includes/navbar.blade.php -->

<div class="navbar-container-wrapper">
    <div class="container tp-18 w-container">
        <div class="header-row">
            <a href="" aria-current="page" class="logo w-nav-brand w--current">
                <img loading="eager" src="{{ asset('images/logo.png') }}" alt="1 Construction" class="logoimg"/>
                <img loading="eager" src="{{ asset('images/logo.png') }}" alt="1 Construction" class="logowhiteimg"/>
                <img loading="eager" src="{{ asset('images/logo.png') }}" alt="1 Construction" class="logoblueimg"/>
            </a>

            <nav role="navigation" class="nav-menu w-nav-menu">
                <div class="navmenu-list">
                    <!-- Product Dropdown -->
                    <div data-delay="100" data-hover="true" class="navsubmenu hdn w-dropdown">
                        <div class="navsubmenu-toggle w-dropdown-toggle">
                            <a href="" class="submenulink">Product</a>
                            <img loading="eager" src="{{ asset('images/submenu-arrow.svg') }}" alt="Submenu" class="submenuicon"/>
                        </div>
                        <nav class="navsubmenu-list w-dropdown-list">
                            <div class="submenu-main">
                                <div class="navsubmenu-container">
                                    <div class="submenubox">
                                        <a href="" class="navsubmenu-item full-item w-inline-block">
                                            <div class="navsubmenu-icon">
                                                <img loading="eager" src="{{ asset('images/permit-research-menu.svg') }}" alt="Permit Research"/>
                                            </div>
                                            <div class="navsubmenu-detail">
                                                <div class="navsubmenutext">Permit Research</div>
                                                <p class="navsubmenu-p">Permit research for any project in any municipality.</p>
                                                <div class="submenu-btn">
                                                    <div class="learnmoremenu">Learn more</div>
                                                    <img loading="eager" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow" class="bluearrow"/>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="{" class="navsubmenu-item w-inline-block">
                                            <div class="navsubmenu-icon">
                                                <img loading="eager" src="{{ asset('images/permit-preparation.svg') }}" alt="Permit Preparation"/>
                                            </div>
                                            <div class="navsubmenutext">Permit Preparation &amp; Submittals</div>
                                        </a>

                                        <a href="" class="navsubmenu-item w-inline-block">
                                            <div class="navsubmenu-icon">
                                                <img loading="eager" src="{{ asset('images/management-menu.svg') }}" alt="Management"/>
                                            </div>
                                            <div class="navsubmenutext">Permit Management &amp; Monitoring</div>
                                        </a>

                                        <a href="{" class="navsubmenu-item w-inline-block">
                                            <div class="navsubmenu-icon">
                                                <img loading="eager" src="{{ asset('images/permitdata-menu.svg') }}" alt="Permit Data"/>
                                            </div>
                                            <div class="navsubmenutext">Permit Data</div>
                                        </a>

                                        <a href="" class="navsubmenu-item w-inline-block">
                                            <div class="navsubmenu-icon">
                                                <img loading="eager" src="{{ asset('images/expediting.svg') }}" alt="Expediting"/>
                                            </div>
                                            <div class="navsubmenutext">Expediting</div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <a href="" class="nav-link w-nav-link">Product</a>

                    <!-- Solutions Dropdown -->
                    <div data-delay="0" data-hover="true" class="navsubmenu rel w-dropdown">
                        <div class="navsubmenu-toggle w-dropdown-toggle">
                            <div class="submenulink">Solutions</div>
                            <img loading="lazy" src="{{ asset('images/navbar-arrow-icon.svg') }}" alt="" class="navbar-arrow-icon hdn"/>
                        </div>
                        <nav class="navigation-dropdown resources w-dropdown-list">
                            <div class="_14-150">Who we serve</div>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>Home Builders</div>
                            </a>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>Developers</div>
                            </a>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>General Contractors</div>
                            </a>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>Subcontractors</div>
                            </a>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>Solar &amp; EV</div>
                            </a>
                            <a href="" class="dropdown-link-2 w-inline-block">
                                <div>Architects</div>
                            </a>
                        </nav>
                    </div>

                    <!-- Resources Dropdown -->
                    <div data-delay="100" data-hover="true" class="navsubmenu w-dropdown">
                        <div class="navsubmenu-toggle w-dropdown-toggle">
                            <a href="" class="submenulink">Resources</a>
                            <img loading="eager" src="{{ asset('images/submenu-arrow.svg') }}" alt="Submenu" class="submenuicon hide"/>
                        </div>
                        <nav class="navsubmenu-list w-dropdown-list">
                            <div class="submenu-main nav-top-border">
                                <div class="navsubmenu-container">
                                    <div class="resources-menu-wrapper">
                                        <div class="resources-menu-first">
                                            <div class="resources-menu-title">Resource Center</div>
                                            <div class="resources-menu-items">
                                                <div class="resources-menu-item local-permitting">
                                                    <div class="resources-menu-item-bar"></div>
                                                    <img loading="eager" src="{{ asset('images/municipalities-icon.svg') }}" alt="Municipal Guides" class="resources-menu-item-mobile-icon"/>
                                                    <div class="resources-menu-item-text">Municipal Guides</div>
                                                    <div class="resources-menu-item-trigger">
                                                        <img loading="lazy" src="{{ asset('images/plus-bold.svg') }}" alt="Plus Icon Bold" class="resources-menu-item-plus-icon"/>
                                                        <img loading="lazy" src="{{ asset('images/minus-bold.svg') }}" alt="Minus Bold" class="resources-menu-item-minus-icon"/>
                                                    </div>
                                                    <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow" class="resources-menu-item-arrow"/>
                                                    <div class="mobile-cards"></div>
                                                    <a href="" class="resources-menu-item-mobile-button w-inline-block">
                                                        <div class="button-text">See all guides</div>
                                                        <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow"/>
                                                    </a>
                                                </div>

                                                <div class="resources-menu-item permit-basics">
                                                    <div class="resources-menu-item-bar"></div>
                                                    <img loading="eager" src="{{ asset('images/permits-icon.svg') }}" alt="Permit Basics" class="resources-menu-item-mobile-icon"/>
                                                    <div class="resources-menu-item-text">Permit Basics</div>
                                                    <div class="resources-menu-item-trigger">
                                                        <img loading="lazy" src="{{ asset('images/plus-bold.svg') }}" alt="Plus Icon Bold" class="resources-menu-item-plus-icon"/>
                                                        <img loading="lazy" src="{{ asset('images/minus-bold.svg') }}" alt="Minus Bold" class="resources-menu-item-minus-icon"/>
                                                    </div>
                                                    <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow" class="resources-menu-item-arrow"/>
                                                    <a href="" class="resources-menu-item-mobile-button w-inline-block">
                                                        <div class="button-text">See all basics</div>
                                                        <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow"/>
                                                    </a>
                                                </div>

                                                <div class="resources-menu-item news">
                                                    <div class="resources-menu-item-bar"></div>
                                                    <img loading="eager" src="{{ asset('images/news-icon.svg') }}" alt="News" class="resources-menu-item-mobile-icon"/>
                                                    <div class="resources-menu-item-text">News</div>
                                                    <div class="resources-menu-item-trigger">
                                                        <img loading="lazy" src="{{ asset('images/plus-bold.svg') }}" alt="Plus Icon Bold" class="resources-menu-item-plus-icon"/>
                                                        <img loading="lazy" src="{{ asset('images/minus-bold.svg') }}" alt="Minus Bold" class="resources-menu-item-minus-icon"/>
                                                    </div>
                                                    <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow" class="resources-menu-item-arrow"/>
                                                    <a href="" class="resources-menu-item-mobile-button w-inline-block">
                                                        <div class="button-text">See all news</div>
                                                        <img loading="lazy" src="{{ asset('images/blue-arrow.svg') }}" alt="Blue Arrow"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </nav>

            <div class="headerrightbox">
                <a href="" class="headbtn-outline w-button">Sign In</a>
                <a href="" class="headbtn-fill ml20 lp-pe w-button">Talk to an Expert</a>
            </div>


            <div class="menuiconbox w-nav-button">
                <img loading="eager" src="" alt="Mobile Icon" class="menuicon"/>
                <img loading="eager" src="" alt="Close" class="menucloseicon"/>
            </div>
        </div>
    </div>
</div>
