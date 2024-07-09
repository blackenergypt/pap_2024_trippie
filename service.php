
<?php
// Iniciar a sessão para armazenar os dados do carrinho
session_start();
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

    <title>InnovaWall</title>

    <?php include 'includes/head.php';?>

</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php';?>
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

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>

</body>

</html>