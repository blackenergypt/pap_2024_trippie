<?php
session_start();
include_once 'db_connect.php';

// Verifica se há itens no carrinho
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

$username = $_SESSION['username'];

// Buscar o ID do utilizador baseado no nome de utilizador
$sql_user = "SELECT id FROM users WHERE username = ?";
$stmt_user = $conn->prepare($sql_user);
$stmt_user->bind_param("s", $username);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($result_user->num_rows == 1) {
    $row_user = $result_user->fetch_assoc();
    $user_id = $row_user['id'];
} else {
    echo "Erro: Utilizador não encontrado.";
    exit();
}

// Processar dados do formulário de checkout quando o formulário for submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário de checkout
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    // Calcular o total do pedido
    $total_amount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    // Inserir pedido na tabela `orders`
    $sql_order = "INSERT INTO orders (user_id, total_amount, created_at, status) VALUES (?, ?, current_timestamp(), 'pending')";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->bind_param("id", $user_id, $total_amount);

    if ($stmt_order->execute()) {
        $order_id = $stmt_order->insert_id;

        // Inserir itens do pedido na tabela `order_items`
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $quantity = $item['quantity'];
            $price = $item['price'];

            $sql_items = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt_items = $conn->prepare($sql_items);
            $stmt_items->bind_param("iiid", $order_id, $product_id, $quantity, $price);
            $stmt_items->execute();
        }

        // Limpar carrinho após finalizar o pedido
        unset($_SESSION['cart']);

        // Redirecionar para a página de confirmação com o ID do pedido
        header("Location: confirmation.php?order_id=$order_id");
        exit();
    } else {
        echo "Erro ao processar o pedido: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Checkout - InnovaWall</title>

    <?php include 'includes/head.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .checkout_section {
            padding: 20px;
        }
        .checkout_section h2 {
            text-align: center;
        }
        .checkout_section form {
            max-width: 600px;
            margin: auto;
        }
        .checkout_section label {
            display: block;
            margin-top: 10px;
        }
        .checkout_section input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        .checkout_section button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }
        .checkout_section button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/header.php'; ?>
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

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
