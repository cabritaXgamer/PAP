<?php $this->view("_includes/user_menu"); ?>

<!-- Page Banner Section Start -->
<div class="section page-banner-section" style="background-image: url(<?= ASSETS . THEME ?>/images/page-banner-bg.png);">
    <!-- <div class="container"> -->
        <!-- Page Banner Wrapper Start -->
        <!-- <div class="page-banner-wrapper"> -->

            <!-- Page Banner Content Start -->
            <!-- <div class="page-banner-content"> -->

                <!-- Section Title Start -->
                <!-- <div class="section-title">
                    <h5 class="sub-title">Error</h5>
                    <h2 class="main-title">Page Not <br> Found</h2>
                </div> -->
                <!-- Section Title End -->

                <!-- <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Error</li>
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

<!-- Error Section Start -->
<div class="section section-padding">
    <div class="container">

        <!-- Error Wrapper Start -->
        <div class="error-wrapper">
            <div class="error-images">
                <img src="<?= ASSETS . THEME ?>/images/404/404.jpeg" alt="Error" style="width: 270px; height: 270px;">
            </div>
            <div class="error-content">
                <h1 class="title">Lamento,</h1>
                <h4 class="sub-title">Algo está errado....</h4>
                <p>Por favor volte à página principal!</p>
                <a href="index.html" class=" btn btn-custom-01">Voltar à página principal</a>
            </div>
        </div>
        <!-- Error Wrapper End -->

    </div>
</div>
<!-- Error Section End -->


<?php $this->view("_includes/user_footer"); ?>