<?php
// Configurar a exibição de erros para desenvolvimento (remover ou comentar em produção)

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Iniciar a sessão, se necessário (descomentar a linha abaixo)
session_start();
// Include core files
include 'includes/core.php';
// Incluir o ficheiro de conexão com a base de dados
require_once('db_connect.php');

// Consulta SQL para buscar todos os produtos da tabela 'products'
$query = "SELECT * FROM products";

// Executar a consulta
$result = mysqli_query($conn, $query);

// Verificar se a consulta foi executada com sucesso
if (!$result) {
    die("Erro ao recuperar produtos: " . mysqli_error($conn));
}
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

    <style>
    .price_section .price_container .box .btn-box button {
        display: inline-block;
        padding: 10px 35px;
  
        color: #ffffff;

        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        transition: all .3s;
        border: none;
    border-radius: 10px !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
    }
    .price_section .price_container .box .btn-box button:hover {
        background-color: transparente;
        color: #ffffff;
    }
    .price_section .price_container .box .btn-box button:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff;
    }
    .price_features p img {
        width: 20px;
        height: auto;
    }
    .price_features p a {
        color: #FAF9F6;
    font-weight: 800;
    font-size: 18px;
    }

    table {
            width: 80%;
            margin: 50px auto;
            border-collapse: collapse;
            padding: 40px 20px 15px 20px;
    border-radius: 10px !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
        }
        th, td {
            padding: 20px;
            text-align: center;
            font-style: italic;
    color: #999;
        }

        .check {
            color: #4CAF50;
        }
        .cross {
            color: #f44336;
        }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>

    <section class="price_section layout_padding" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="text-white"><?=$lang['price-text-1'];?></h2>
            </div>
            <div class="price_container">
                <!-- Loop para exibir todos os produtos -->
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="box">
                    <div class="detail-box">
                        <img src="assets/images/produtos.png" width="145" height="145" alt="">
                        <h2 style="color: #F8F8FF;">€ <span><?php echo number_format($row['price'], 2, ',', '.'); ?></span></h2>
                        <h6 class="text-white"><?php echo $row['name']; ?></h6>
                        <ul class="price_features">
                            <?php echo $row['description']; ?>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <form action="add_to_cart.php" method="post" class="add-to-cart-form">
                            <input type="hidden" name="produto_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="add-to-cart-btn"><?=$lang['price-text-2'];?></button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="row" style="margin: 100px auto;">
                <div class="col-md-12 text-center">
            <h2 class="text-white"><?=$lang['price-text-3'];?></h2>
    <p style="font-style: italic;
    color: #999;"><?=$lang['price-text-4'];?></p>

    <table>
        <thead>
            <tr>
                <th><?=$lang['price-text-5'];?></th>
                <th><?=$lang['price-text-6'];?></th>
                <th><?=$lang['price-text-7'];?></th>
                <th><?=$lang['price-text-8'];?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?=$lang['price-text-9'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-10'];?></td>
                <td class="cross">✗</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-11'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-12'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-13'];?></td>
                <td class="cross">✗</td>
                <td class="cross">✗</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-14'];?></td>
                <td class="cross">✗</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-15'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-16'];?></td>
                <td class="cross">✗</td>
                <td class="cross">✗</td>
                <td class="cross">✗</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-17'];?></td>
                <td class="cross">✗</td>
                <td class="cross">✗</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-18'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
            <tr>
                <td><?=$lang['price-text-19'];?></td>
                <td class="check">✓</td>
                <td class="check">✓</td>
                <td class="check">✓</td>
            </tr>
        </tbody>
    </table>
</div></div>

        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartForms = document.querySelectorAll('.add-to-cart-form');
        var errorMessage = '<?=$lang['price-text-20'];?>'; // Variável PHP injetada no JavaScript

        addToCartForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita o envio padrão do formulário

                var formData = new FormData(form);

                fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Processar a resposta do backend (add_to_cart.php)
                    console.log(data); // Exemplo: {"success": true, "message": "Produto adicionado ao carrinho"}
                    
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        close: true,
                        gravity: "top", // "top" ou "bottom"
                        position: "right", // "left", "center" ou "right"
                        backgroundColor: data.success ? "green" : "red",
                        stopOnFocus: true // Impede que o toast desapareça ao passar o mouse
                    }).showToast();
                })
                .catch(error => {
                    console.error('Erro ao enviar requisição AJAX:', error);
                    Toastify({
                        text: errorMessage,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "red",
                        stopOnFocus: true
                    }).showToast();
                });
            });
        });
    });
    </script>
</body>
</html>

<?php
// Redefinir o ponteiro de dados do resultado
mysqli_data_seek($result, 0);

// Liberar a memória associada ao resultado
mysqli_free_result($result);

// Fechar a conexão com a base de dados
mysqli_close($conn);
?>
