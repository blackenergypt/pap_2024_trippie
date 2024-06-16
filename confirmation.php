<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

// Verifica se há um ID de pedido válido na URL
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    header("Location: cart.php");
    exit();
}

$order_id = $_GET['order_id'];

// Incluir conexão com o banco de dados
include_once 'db_connect.php';

// Buscar informações do pedido
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
} else {
    header("Location: cart.php");
    exit();
}

// Buscar itens do pedido na tabela `order_items`
$sql_items = "SELECT oi.quantity, oi.price, p.name FROM order_items oi
              JOIN products p ON oi.product_id = p.id
              WHERE oi.order_id = $order_id";
$result_items = $conn->query($sql_items);

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

  <title>Confirmação de Pedido - InnovaWall</title>

  <?php include 'includes/head.php';?>
</head>

<body class="sub_page">

  <div class="hero_area">
  <?php include 'includes/header.php';?>

  </div>


    <section class="confirmation_section layout_padding">
        <div class="container">
            <h2>Confirmação de Pedido</h2>
            <p>Seu pedido número <?php echo $order['id']; ?> foi realizado com sucesso.</p>
            <h3>Detalhes do Pedido:</h3>
            <p><strong>Total do Pedido:</strong> R$ <?php echo number_format($order['total_amount'], 2, ',', '.'); ?></p>
            <h3>Itens do Pedido:</h3>
            <ul>
                <?php while ($item = $result_items->fetch_assoc()): ?>
                    <li><?php echo $item['name']; ?> - <?php echo $item['quantity']; ?> x R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
  <?php include 'includes/scripts.php';?>
    </body>

</html>
