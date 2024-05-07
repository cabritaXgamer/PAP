<?php $this->view( "_includes/user_menu", $data); ?>

        <!-- Page Banner Section Start -->
        <div class="section page-banner-section" style="background-image: url(assets/images/page-banner-bg.png);">
            <div class="container">
                <!-- Page Banner Wrapper Start -->
                <div class="page-banner-wrapper">

                    <!-- Page Banner Content Start -->
                    <div class="page-banner-content">

                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h5 class="sub-title">My Account</h5>
                            <h2 class="main-title">My Account</h2>
                        </div>
                        <!-- Section Title End -->

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index">Home</a></li>
                            <li class="breadcrumb-item active">My Account</li>
                        </ul>
                    </div>
                    <!-- Page Banner Content End -->

                    <!-- Page Banner Images Start -->
                    <div class="page-banner-images">
                        <img src="assets/images/page-banner-3.png" alt="Page Banner">
                    </div>
                    <!-- Page Banner Images End -->

                </div>
                <!-- Page Banner Wrapper End -->
            </div>
        </div>
        <!-- Page Banner Section End -->

        <!-- My Account Section Start -->
        <div class="section section-padding">
            <div class="container">

                <!-- My Account Wrapper Start -->
                <div class="my-account-wrapper">

                    <div class="row">
                        <div class="col-xl-3 col-md-4">
                            <!-- My Account Menu Start -->
                            <div class="my-account-menu">
                                <ul class="nav account-menu-list flex-column">
                                    <li>
                                        <a class="active" data-bs-toggle="pill" href="#pills-dashboard"><i class="fa fa-tachometer"></i> Dashboard</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="pill" href="#pills-order"><i class="fa fa-shopping-cart"></i> Order</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="pill" href="#pills-download"><i class="fa fa-cloud-download"></i> Download</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="pill" href="#pills-payment"><i class="fa fa-credit-card"></i> Payment Method</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="pill" href="#pills-address"><i class="fa fa-map-marker"></i> Address</a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="pill" href="#pills-account"><i class="fa fa-user"></i> Account Details</a>
                                    </li>
                                    <li>
                                        <a href="login.html"><i class="fa fa-sign-out"></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- My Account Menu End -->
                        </div>
                        <div class="col-xl-9 col-md-8">
                            <!-- Tab content start -->
                            <div class="tab-content my-account-tab">

                                <div class="tab-pane fade show active" id="pills-dashboard">
                                    <!-- My Account Dashboard start -->
                                    <div class="my-account-dashboard account-wrapper">
                                        <h4 class="account-title">Dashboard</h4>
                                        <div class="welcome-dashboard">
                                            <p>Hello, <strong><?php echo $data['user_data']->name; ?></strong> </p>
                                        </div>
                                        <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                    <!-- My Account Dashboard End -->
                                </div>

                                <div class="tab-pane fade" id="pills-order">
                                    <!-- My Account Order Start -->
                                    <div class="my-account-order account-wrapper">
                                        <h4 class="account-title">Orders</h4>
                                        <div class="account-table text-center table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="no">No</th>
                                                        <th class="name">Name</th>
                                                        <th class="date">Date</th>
                                                        <th class="status">Status</th>
                                                        <th class="total">Total</th>
                                                        <th class="action">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Mostarizing Oil</td>
                                                        <td>Aug 22, 2020</td>
                                                        <td>Pending</td>
                                                        <td>$100</td>
                                                        <td><a href="#">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Katopeno Altuni</td>
                                                        <td>July 22, 2020</td>
                                                        <td>Approved</td>
                                                        <td>$45</td>
                                                        <td><a href="#">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Murikhete Paris</td>
                                                        <td>June 22, 2020</td>
                                                        <td>On Hold</td>
                                                        <td>$99</td>
                                                        <td><a href="#">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- My Account Order End -->
                                </div>

                                <div class="tab-pane fade" id="pills-download">
                                    <!-- My Account Download Start -->
                                    <div class="my-account-download account-wrapper">
                                        <h4 class="account-title">Download</h4>
                                        <div class="account-table text-center mt-30 table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="name">Product</th>
                                                        <th class="date">Date</th>
                                                        <th class="status">Expire</th>
                                                        <th class="action">Download</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Mostarizing Oil</td>
                                                        <td>Aug 22, 2020</td>
                                                        <td>Yes</td>
                                                        <td><a href="#">Download File</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Katopeno Altuni</td>
                                                        <td>July 22, 2020</td>
                                                        <td>Never</td>
                                                        <td><a href="#">Download File</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- My Account Download End -->
                                </div>

                                <div class="tab-pane fade" id="pills-payment">
                                    <!-- My Account payment Start -->
                                    <div class="my-account-payment account-wrapper">
                                        <h4 class="account-title">Payment Method</h4>
                                        <p>You Can't Saved Your Payment Method yet.</p>
                                    </div>
                                    <!-- My Account payment End -->
                                </div>

                                <div class="tab-pane fade" id="pills-address">
                                    <!-- My Account Address End -->
                                    <div class="my-account-address">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="account-wrapper">
                                                    <h4 class="account-title">Billing address</h4>
                                                    <div class="account-address">
                                                        <h6 class="name">Alex Tuntuni</h6>
                                                        <p>1355 Market St, Suite 900 <br> San Francisco, CA 94103</p>
                                                        <p>Mobile: (123) 456-7890</p>
                                                        <a class="btn btn-primary btn-hover-dark" href="#"><i class="fa fa-edit"></i> Edit Address</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="account-wrapper">
                                                    <h4 class="account-title">Shipping address</h4>
                                                    <div class="account-address">
                                                        <h6 class="name">Alex Tuntuni</h6>
                                                        <p>1355 Market St, Suite 900 <br> San Francisco, CA 94103</p>
                                                        <p>Mobile: (123) 456-7890</p>
                                                        <a class="btn btn-primary btn-hover-dark" href="#"><i class="fa fa-edit"></i> Edit Address</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- My Account Address End -->
                                </div>

                                <div class="tab-pane fade" id="pills-account">
                                    <!-- My Account Details End -->
                                    <div class="my-account-details account-wrapper">
                                        <h4 class="account-title">Account Details</h4>

                                        <div class="account-details">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="single-form">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-form">
                                                        <label class="form-label">Display Name</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-form">
                                                        <label class="form-label">Email address</label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-form">
                                                        <h5 class="title">Password change</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="single-form">
                                                        <label class="form-label">Current Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form">
                                                        <label class="form-label">New Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form">
                                                        <label class="form-label">Confirm Password</label>
                                                        <input type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-form">
                                                        <button class="btn btn-primary btn-hover-dark">Save Change</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- My Account Details End -->
                                </div>
                            </div>
                            <!-- Tab content End -->
                        </div>
                    </div>

                </div>
                <!-- My Account Wrapper End -->

            </div>
        </div>
        <!-- My Account Section End -->

        <?php $this->view( "_includes/user_footer", $data); ?>