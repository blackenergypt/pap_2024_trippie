<?php
session_start(); // Iniciar a sessão para armazenar os dados do carrinho

// Include core files
include 'includes/core.php';
?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?php echo $lang['index-title'];?></title>
    <?php include 'includes/head.php'; ?>
</head>
<style>


    .hero_area {
    background-image: url(assets/images/bg.jpeg) !important;
    background-position: center!important;
    background-repeat: no-repeat!important;
    background-size: cover!important;
    background-color: transparent!important;
    position: relative!important;
    left: 0px!important;
    top: 0px!important;
    width: 100%!important;
    height: 100%!important;
    z-index: 999!important;

    min-height: 100vh!important;
    display: -webkit-box!important;
    display: -ms-flexbox!important;
    display: flex!important;
    -webkit-box-orient: vertical!important;
    -webkit-box-direction: normal!important;
    -ms-flex-direction: column!important;
    flex-direction: column!important;
}
.slider_section .carousel_btn-box {
    display: none !important;
}
</style>
<body>
    <div class="hero_area">
        <?php include 'includes/header.php'; ?>
        <section class="slider_section ">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box text-center">
                                        <h1><?=$lang['index-text-1'];?></h1>
                                        <p style="font-style: italic; color: #999;"><?=$lang['index-text-2'];?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class=" col-lg-10 mx-auto">
                                            <div class="img-box">
                                                <img src="assets/images/secure-security.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box text-center">
                                        <h1><?=$lang['index-text-3'];?></h1>
                                        <p style="font-style: italic; color: #999;"><?=$lang['index-text-4'];?></p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class=" col-lg-10 mx-auto">
                                            <div class="img-box">
                                                <img src="assets/images/secure-security.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="container ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-box text-center">
                                        <h1><?=$lang['index-text-5'];?></h1>
                                        <p style="font-style: italic; color: #999;"><?=$lang['index-text-6'];?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class=" col-lg-10 mx-auto">
                                            <div class="img-box">
                                                <img src="assets/images/secure-security.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="carousel_btn-box">
                    <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only"><?=$lang['index-text-7'];?></span>
                    </a>
                    <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                        <span class="sr-only"><?=$lang['index-text-8'];?></span>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <section class="service_section layout_padding" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="text-white"><?=$lang['index-text-9'];?></h2>
            </div>
        </div>
        <div class="container ">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-cube"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-10'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-11'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-database"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-12'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-13'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 ">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-14'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-15'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-fingerprint"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-16'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-17'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-robot"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-18'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-19'];?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="box ">
                        <div class="img-box">
                        <i class="fa-solid fa-hat-cowboy"></i>
                        </div>
                        <div class="detail-box">
                            <h4><?=$lang['index-text-20'];?></h4>
                            <p style="font-style: italic; color: #999;"><?=$lang['index-text-21'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>