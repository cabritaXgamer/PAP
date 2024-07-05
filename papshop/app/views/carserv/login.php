<?php $this->view("_includes/user_menu", $data); ?>


<!-- Page Banner Section Start -->
<div class="section page-banner-section" style="background-image: url(<?= ASSETS . THEME ?>/images/page-banner-bg.png);">
    <!-- <div class="container"> -->
        <!-- Page Banner Wrapper Start -->
        <!-- <div class="page-banner-wrapper"> -->

            <!-- Page Banner Content Start -->
            <!-- <div class="page-banner-content"> -->

                <!-- Section Title Start -->
                <!-- <div class="section-title">
                    <h5 class="sub-title">Login</h5>
                    <h2 class="main-title">Login</h2>
                </div> -->
                <!-- Section Title End -->

                <!-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Inicio</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ul>
            </div> -->
            <!-- Page Banner Content End -->

            <!-- Page Banner Images Start -->
            <!-- <div class="page-banner-images">
                <img src="<?= ASSETS . THEME ?>/images/page-banner-3.png" alt="Page Banner">
            </div> -->
            <!-- Page Banner Images End -->

        <!-- </div> -->
        <!-- Page Banner Wrapper End -->
    <!-- </div> -->
</div>
<!-- Page Banner Section End -->

<!-- Login & Register Section Start -->
<div class="section section-padding">
    <div class="container">

        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-5">

                    <!-- Register & Login Form Start -->
                    <div class="register-login-form">
                        <h3 class="title">Entrar</h3>

                        <div class="form-wrapper">
                            <form method="post">
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="email" name="email" class="form-control" required placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <input type="password" name="password" placeholder="Palavra-passe">
                                </div>
                                <!-- Single Form End -->
                                <!-- Single Form Start -->
                                <div class="single-form">
                                    <button type="submit" class="btn btn-custom-01 w-100">Entrar</button>
                                    <!-- <a class="btn btn-custom-02 w-100" href="#">Login com Google</a> -->
                                </div>
                                <!-- Single Form End -->
                                <p><a href="#">esqueceste da palavra-passe?</a></p>
                                <p>Não tens conta? <a href="register">Registra-te agora!</a></p>
                            </form>
                        </div>
                    </div>
                    <!-- Register & Login Form End -->

                </div>
            </div>
        </div>
        <!-- Register & Login Wrapper End -->

    </div>
</div>
<!-- Login & Register Section End -->

<?php $this->view("_includes/user_footer", $data); ?>