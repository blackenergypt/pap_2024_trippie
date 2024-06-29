<?php
// Configurar a exibição de erros para desenvolvimento (remover ou comentar em produção)
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar a sessão, se necessário (descomentar a linha abaixo)
// session_start();

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
        background-color: #ff4646;
        color: #ffffff;
        border-radius: 5px;
        border: 1px solid #ff4646;
        transition: all .3s;
        border: none;
    }
    .price_section .price_container .box .btn-box button:hover {
        background-color: transparente;
        color: #ff4646;
    }
    .price_section .price_container .box .btn-box button:hover {
        background-color: #03a7d3;
        color: #ffffff;
    }
    .price_features p img {
        width: 20px;
        height: auto;
    }
    </style>
</head>

<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>

    <section class="price_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Oferecemos os melhores preços</h2>
            </div>
            <div class="price_container">
                <!-- Loop para exibir todos os produtos -->
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="box">
                    <div class="detail-box">
                        <img src="assets/images/produtos.png" width="145" height="145" alt="">
                        <h2>€ <span><?php echo number_format($row['price'], 2, ',', '.'); ?></span></h2>
                        <h6><?php echo $row['name']; ?></h6>
                        <ul class="price_features">
                            <?php echo $row['description']; ?>
                        </ul>
                    </div>
                    <div class="btn-box">
                        <form action="add_to_cart.php" method="post" class="add-to-cart-form">
                            <input type="hidden" name="produto_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="add-to-cart-btn">Adicionar ao Carrinho</button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartForms = document.querySelectorAll('.add-to-cart-form');

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
                        text: 'Ocorreu um erro ao adicionar o produto ao carrinho.',
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
