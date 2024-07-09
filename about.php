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
    <meta name="keywords" content="InnovaWall, cibersegurança, rede de distribuição, mitigação de ataques" />
    <meta name="description" content="A InnovaWall é uma rede de distribuição de informação que fornece conteúdo web seguro e protegido contra ataques cibernéticos." />
    <meta name="author" content="InnovaWall" />

    <title>InnovaWall</title>
    <?php include 'includes/head.php'; ?>

    <style>

        .about_section .container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }
        .about_section .img-box {
            flex: 1;
            padding: 20px;
        }
        .about_section .img-box img {
            max-width: 100%;
            border-radius: 10px; /* Borda arredondada para a imagem */
        }
        .about_section .detail-box {
            flex: 1;
            padding: 20px;
            color: #fff; /* Cor do texto */
        }
        .about_section .detail-box .heading_container h2 {
            font-size: 36px;
            color: #00a8e8; /* Cor do título */
        }
        .about_section .detail-box p {
  
            font-style: italic;
            color: #999;
        }
        .about_section .detail-box a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #00a8e8;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .about_section .detail-box a:hover {
            background-color: #007ea7;
        }
        .icon-box {
            text-align: center;
            margin-top: 20px;
        }
        .icon-box img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>

    <section class="about_section layout_padding" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="img-box">
                <img src="assets/images/about-img.png" alt="Imagem ilustrativa sobre a InnovaWall">
            </div>
            <div class="detail-box">
                <div class="heading_container">
                    <h2 class="text-white"><?=$lang['about-text-1'];?></h2>
                </div>
                <p><?=$lang['about-text-2'];?></p>
                <p><?=$lang['about-text-3'];?></p>
                <p><?=$lang['about-text-4'];?></p>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>