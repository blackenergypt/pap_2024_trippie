<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

include_once 'db_connect.php';
include 'includes/core.php';
// Verificar se o parâmetro order_id está presente na URL
if (!isset($_GET['order_id'])) {
    echo "Erro: ID do pedido não fornecido.";
    exit();
}

$order_id = $_GET['order_id'];

// Buscar detalhes do pedido
$sql_order = "SELECT id, total_amount FROM orders WHERE id = ?";
$stmt_order = $conn->prepare($sql_order);
$stmt_order->bind_param("i", $order_id);
$stmt_order->execute();
$result_order = $stmt_order->get_result();

if ($result_order->num_rows === 0) {
    echo "Erro: Pedido não encontrado.";
    exit();
}

$order = $result_order->fetch_assoc();
$stmt_order->close();

// Buscar itens do pedido
$sql_items = "
    SELECT p.name, oi.quantity, oi.price
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
";
$stmt_items = $conn->prepare($sql_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$result_items = $stmt_items->get_result();
$stmt_items->close();
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
    <title>Confirmação de Pedido - InnovaWall</title>

    <?php include 'includes/head.php'; ?>
    <style>
.confirmation_section {
    padding: 40px 0;
    color: white;
    text-align: center;
    background-image: url('assets/images/bg.jpeg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.confirmation_section .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 30px;
    border-radius: 10px;


    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 10px !important;
    background-color: rgba(255, 255, 255, 0.1) !important;
}


.confirmation_section h2,
.confirmation_section h3 {
    font-family: 'Arial', sans-serif;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.confirmation_section h2 {
    font-size: 2em;
    font-weight: bold;
    margin-top: 0;
}

.confirmation_section h3 {
    font-size: 1.5em;
    font-weight: normal;
}

.confirmation_section p {
    font-family: 'Arial', sans-serif;
    font-size: 1.2em;
    margin-bottom: 20px;
}

.confirmation_section ul {
    list-style: none;
    padding: 0;
    margin: 20px 0;
    text-align: left;
}

.confirmation_section ul li {
    font-size: 1.1em;
    margin-bottom: 10px;
    padding: 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 5px;
}
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php'; ?>
    </div>

    <section class="confirmation_section layout_padding" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <h2><?=$lang['confirmation-text-1'];?></h2>
            <p><?=$lang['confirmation-text-2'];?> <?php echo htmlspecialchars($order['id']); ?> <?=$lang['confirmation-text-3'];?></p>
            <h3><?=$lang['confirmation-text-4'];?></h3>
            <p><strong><?=$lang['confirmation-text-5'];?>:</strong> <?php echo number_format($order['total_amount'], 2, ',', '.'); ?> €</p>
            <h3><?=$lang['confirmation-text-6'];?></h3>
            <ul>
                <?php while ($item = $result_items->fetch_assoc()): ?>
                    <li><?php echo htmlspecialchars($item['name']); ?> - <?php echo htmlspecialchars($item['quantity']); ?> x € <?php echo number_format($item['price'], 2, ',', '.'); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
