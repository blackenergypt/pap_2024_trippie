<?php


// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

// Verifica se há itens no carrinho
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Incluir conexão com o banco de dados
include_once 'db_connect.php';

// Processar dados do formulário de checkout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar e salvar informações do pedido na tabela `orders`

    // Exemplo simples: inserção de um pedido de teste
    $user_id = $_SESSION['user_id']; // Supondo que você tenha o ID do usuário na sessão
    $total_amount = $_SESSION['total_amount']; // Supondo que você tenha o total do carrinho na sessão

    $sql = "INSERT INTO orders (user_id, total_amount, status) VALUES ($user_id, $total_amount, 'pending')";
    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Inserir itens do pedido na tabela `order_items`
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $quantity = $item['quantity'];
            $price = $item['price'];

            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity, $price)";
            $conn->query($sql);
        }

        // Limpar carrinho após finalizar o pedido
        unset($_SESSION['cart']);

        // Redirecionar para a página de confirmação
        header("Location: confirmation.php?order_id=$order_id");
        exit();
    } else {
        echo "Erro ao processar o pedido: " . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Checkout - InnovaWall</title>

  <?php include 'includes/head.php';?>
</head>

<body class="sub_page">

  <div class="hero_area">
  <?php include 'includes/header.php';?>

  </div>
    <section class="checkout_section layout_padding">
        <div class="container">
            <h2>Checkout</h2>
            <form method="post">
                <label for="fname">Nome:</label>
                <input type="text" id="fname" name="fname" required><br><br>
                <label for="lname">Sobrenome:</label>
                <input type="text" id="lname" name="lname" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="address">Endereço:</label>
                <input type="text" id="address" name="address" required><br><br>
                <label for="city">Cidade:</label>
                <input type="text" id="city" name="city" required><br><br>
                <label for="zip">Código Postal:</label>
                <input type="text" id="zip" name="zip" required><br><br>
                <button type="submit">Finalizar Pedido</button>
            </form>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
  <?php include 'includes/scripts.php';?>
    </body>

</html>