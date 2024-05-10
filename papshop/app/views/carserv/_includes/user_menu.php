<?php $this->view( "_includes/user_header", $data); ?>

<body>

    <div class="main-wrapper">

        <!-- Header Section Start -->
        <div class="section header-section">

            <!-- Header top Start -->
            <div class="header-top d-none d-lg-block">
                <div class="container">

                    <!-- Header top Wrapper Start -->
                    <div class="header-top-wrapper">

                        <!-- Header top Wrapper Start -->
                        <div class="header-top-info">
                            <p>328D, Marid Drive, Ackloand</p>
                            <p>Call us: <a href="+12025256214">+12(025) 256 214</a></p>
                        </div>
                        <!-- Header top Wrapper End -->

                        <!-- Header top Wrapper Start -->
                        <!-- Validation paramenters to check if the user is loggedin -->
                        <!-- Header top Info End -->
                        <?php if(isset($data['user_data'])): ?>                        
                        <!-- Header top Button Start -->
                        <div class="header-top-btn">
                            <a href="logout">Logout</a>
                            <!-- <a href="register">Register</a> -->
                        </div>
                        <!-- Header top Button End -->
                        <?php else: ?>
                            <div class="header-top-btn">
                            <a href="login">Entrar</a>
                            <a href="register">Register</a>
                        </div>
                        <?php endif?>
                        <!-- END  Validation paramenters to check if the user is loggedin --> 
                        <!-- Header top Wrapper End -->

                    </div>
                    <!-- Header top Wrapper End -->

                </div>
            </div>
            <!-- Header top End -->

            <!-- Header Main Start -->
            <div class="header-main">
                <div class="container">

                    <!-- Header Main Start -->
                    <div class="header-main-wrapper">

                        <!-- Header Logo Start -->
                        <div class="header-logo">
                            <a href="index.html"><img src="<?= ASSETS . THEME ?>/images/logo.png" alt="Logo"></a>
                           <?php //show(ASSETS . THEME . "/images/logo.png") ?>
                        </div>
                        <!-- Header Logo End -->

                        <!-- Header Menu Start -->
                        <div class="primary-menu d-none d-lg-block">
                            <ul class="nav-menu">
                                <li><a href="index.html">Home</a></li>
                                <li>
                                    <a href="#">Services</a>
                                    <ul class="sub-menu">
                                        <li><a href="service.html">Services</a></li>
                                        <li><a href="service-details.html">Services Details</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="shop-grid.html">Shop Grid</a></li>
                                        <li><a href="shop-left-sidebar.html">Shop left Sidebar</a></li>
                                        <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                        <li><a href="product-details-left-sidebar.html">Product Details Left Sidebar</a></li>
                                        <li><a href="product-details-right-sidebar.html">Product Details Right Sidebar</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Pages </a>
                                    <ul class="sub-menu">
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="compare.html">Compare</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="empty-cart.html">Empty Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="my-account.html">My Account</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="project-gallery.html">Project Gallery</a></li>
                                        <li><a href="project-details.html">Project Details</a></li>
                                        <li><a href="our-team.html">Team</a></li>
                                        <li><a href="team-profile.html">Team Profile</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="404-error.html">404 Error</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-grid.html">Blog Grid</a></li>
                                        <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                        <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                        <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                                        <li><a href="blog-details-right-sidebar.html">Blog Details Right Sidebar</a></li>
                                    </ul>
                                </li>
                               
                                
                                <li><a href="contact.html">Contact</a></li>

                                <li>
                                    <?php if(isset($data['user_data'])): ?>
                                    <a href="#">Profile</a>
                                    <ul class="sub-menu">
                                        <li><a href="profile">My Account</a></li>
                                        <li><a href= "admin">Admin Section</a></li>
                                        <li><a href="logout">Logout</a></li>
                                    </ul>
                                    <?php endif ?>
                                </li>

                            </ul>

                        </div>
                        <!-- Header Menu End -->

                        <!-- Header Meta Start -->
                        <div class="header-meta">

                            <div class="meta-dropdown dropdown">
                                <button class="toggle" data-bs-toggle="dropdown">
                                    <i class="icofont-shopping-cart"></i>
                                    <span class="count">3</span>
                                </button>
                                <div class="dropdown-menu dropdown-cart">
                                    <!-- Cart Content Start -->
                                    <div class="cart-content">
                                        <ul>
                                            <li>
                                                <!-- Single Cart Item Start -->
                                                <div class="single-cart-item">
                                                    <div class="cart-thumb">
                                                        <img src="<?= ASSETS . THEME ?>/images/mini-cart/cart-1.jpg" alt="Cart">
                                                        <span class="product-quantity">1x</span>
                                                    </div>
                                                    <div class="cart-item-content">
                                                        <h6 class="product-name"><a href="product-details-left-sidebar.html">Madden by Steve Madden Cale 6</a></h6>
                                                        <span class="product-price">$19.12</span>
                                                        <div class="attributes-content">
                                                            <span><strong>Color:</strong> White </span>
                                                        </div>
                                                        <button class="cart-remove"><i class="icofont-close-line"></i></button>
                                                    </div>
                                                </div>
                                                <!-- Single Cart Item End -->
                                            </li>
                                            <li>
                                                <!-- Single Cart Item Start -->
                                                <div class="single-cart-item">
                                                    <div class="cart-thumb">
                                                        <img src="<?= ASSETS . THEME ?>/images/mini-cart/cart-2.jpg" alt="Cart">
                                                        <span class="product-quantity">1x</span>
                                                    </div>
                                                    <div class="cart-item-content">
                                                        <h6 class="product-name"><a href="product-details-left-sidebar.html">New Balance Fresh Foam LAZR v1 Sport</a> </h6>
                                                        <span class="product-price">$19.12</span>
                                                        <div class="attributes-content">
                                                            <span><strong>Color:</strong> White </span>
                                                        </div>
                                                        <button class="cart-remove"><i class="icofont-close-line"></i></button>
                                                    </div>
                                                </div>
                                                <!-- Single Cart Item End -->
                                            </li>
                                            <li>
                                                <!-- Single Cart Item Start -->
                                                <div class="single-cart-item">
                                                    <div class="cart-thumb">
                                                        <img src="<?= ASSETS . THEME ?>/images/mini-cart/cart-3.jpg" alt="Cart">
                                                        <span class="product-quantity">1x</span>
                                                    </div>
                                                    <div class="cart-item-content">
                                                        <h6 class="product-name"><a href="product-details-left-sidebar.html">Water and Wind Resistant Insulated Jacket</a></h6>
                                                        <span class="product-price">$19.12</span>
                                                        <div class="attributes-content">
                                                            <span><strong>Color:</strong> White </span>
                                                        </div>
                                                        <button class="cart-remove"><i class="icofont-close-line"></i></button>
                                                    </div>
                                                </div>
                                                <!-- Single Cart Item End -->
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Cart Content End -->

                                    <!-- Cart Price Start -->
                                    <div class="cart-price">
                                        <div class="cart-subtotals">
                                            <div class="price-inline">
                                                <span class="label">Subtotal</span>
                                                <span class="value">$42.70</span>
                                            </div>
                                            <div class="price-inline">
                                                <span class="label">Shipping</span>
                                                <span class="value">$7.00</span>
                                            </div>
                                            <div class="price-inline">
                                                <span class="label">Taxes</span>
                                                <span class="value">$0.00</span>
                                            </div>
                                        </div>
                                        <div class="cart-total">
                                            <div class="price-inline">
                                                <span class="label">Total</span>
                                                <span class="value">$49.70</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cart Price Start -->

                                    <div class="checkout-btn">
                                        <a href="checkout.html" class="btn btn-outline-dark btn-hover-primary d-block">Checkout</a>
                                    </div>
                                </div>
                            </div>

                            <div class="header-search d-none d-lg-block">
                                <form action="#">
                                    <input type="text" placeholder="Search">
                                    <button><i class="icofont-search-2"></i></button>
                                </form>
                            </div>

                            <div class="header-toggle d-lg-none">
                                <button class="menu-toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>

                        </div>
                        <!-- Header Meta End -->

                    </div>
                    <!-- Header Main End -->

                </div>
            </div>
            <!-- Header Main End -->

        </div>
        <!-- Header Section End -->

        <!-- Mobile Menu Start -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample">

            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">

                <!-- Header top Info Start -->
                <div class="header-top-info">
                    <p>328D, Marid Drive, Ackloand</p>
                    <p>Call us: <a href="+12025256214">+12(025) 256 214</a></p>
                </div>
                
                <!-- Validation paramenters to check if the user is loggedin -->
                <!-- Header top Info End -->
                <?php if(isset($data['user_data'])): ?>                        
                <!-- Header top Button Start -->
                <div class="header-top-btn">
                    <a href="logout">Logout</a>
                    <!-- <a href="register">Register</a> -->
                </div>
                <!-- Header top Button End -->
                <?php else: ?>
                    <div class="header-top-btn">
                    <a href="login">Entrar</a>
                    <a href="register">Register</a>
                </div>
                <?php endif?>
                <!-- END  Validation paramenters to check if the user is loggedin --> 
                    

                <!-- Header Search Start -->
                <div class="header-search">
                    <form action="#">
                        <input type="text" placeholder="Search">
                        <button><i class="icofont-search-2"></i></button>
                    </form>
                </div>
                <!-- Header Search End -->

                <!-- Mobile Menu Start -->
                <div class="mobile-menu-items">
                    <ul class="nav-menu">
                        <li><a href="index.html">Home</a></li>
                        <li>
                            <a href="#">Services</a>
                            <ul class="sub-menu">
                                <li><a href="service.html">Services</a></li>
                                <li><a href="service-details.html">Services Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Shop</a>
                            <ul class="sub-menu">
                                <li><a href="shop-grid.html">Shop Grid</a></li>
                                <li><a href="shop-left-sidebar.html">Shop left Sidebar</a></li>
                                <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                <li><a href="product-details-left-sidebar.html">Product Details Left Sidebar</a></li>
                                <li><a href="product-details-right-sidebar.html">Product Details Right Sidebar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Pages </a>
                            <ul class="sub-menu">
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="cart.html">Cart</a></li>
                                <li><a href="compare.html">Compare</a></li>
                                <li><a href="wishlist.html">Wishlist</a></li>
                                <li><a href="empty-cart.html">Empty Cart</a></li>
                                <li><a href="checkout.html">Checkout</a></li>
                                <li><a href="my-account.html">My Account</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="project-gallery.html">Project Gallery</a></li>
                                <li><a href="project-details.html">Project Details</a></li>
                                <li><a href="our-team.html">Team</a></li>
                                <li><a href="team-profile.html">Team Profile</a></li>
                                <li><a href="faq.html">FAQ</a></li>
                                <li><a href="404-error.html">404 Error</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Blog</a>
                            <ul class="sub-menu">
                                <li><a href="blog-grid.html">Blog Grid</a></li>
                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                                <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                                <li><a href="blog-details-right-sidebar.html">Blog Details Right Sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>

                </div>
                <!-- Mobile Menu End -->

            </div>
        </div>
        <!-- Mobile Menu End -->
