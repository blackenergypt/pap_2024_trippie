<?php
// Iniciar a sessão para armazenar os dados do carrinho
session_start();

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
        .about_section {
            padding: 50px 0;
            background-color: #011627; /* Cor de fundo da seção */
        }
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
            font-size: 18px;
            line-height: 1.6;
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

    <section class="about_section layout_padding">
        <div class="container">
            <div class="img-box">
                <img src="assets/images/about-img.png" alt="Imagem ilustrativa sobre a InnovaWall">
            </div>
            <div class="detail-box">
                <div class="heading_container">
                    <h2>Quem somos?</h2>
                </div>
                <p>
                    Somos uma equipa que quer ajudar a construir uma Internet melhor, mais rápida e mais segura. 
                    Acreditamos que, com as nossas ações, conhecimento e tecnologia, conseguimos evitar que alguns dos 
                    maiores problemas da Internet aconteçam, como ataques cibernéticos.
                </p>
                <p>
                    A InnovaWall é uma empresa de rede de fornecimento de conteúdo voltada para a segurança online, 
                    com foco na proteção de DDoS e WAF (Web Application Firewall).
                </p>
                <p>
                    Na InnovaWall, fazemos de tudo para tornar o mundo online mais seguro para quem o navega 
                    impedindo qualquer tipo de ataques maliciosos, podemos dizer que somos inovadores, damos máxima 
                    atenção a cada detalhe, e extremamente apaixonados pelo nosso trabalho e missão.
                </p>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>