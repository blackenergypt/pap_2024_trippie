<?php
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

include_once 'db_connect.php';

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
            padding: 20px;
        }
        .confirmation_section h2, .confirmation_section h3 {
            text-align: center;
            color: #333;
        }
        .confirmation_section p {
            text-align: center;
            color: #666;
        }
        .confirmation_section strong {
            color: #333;
        }
        .confirmation_section ul {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }
        .confirmation_section li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php'; ?>
    </div>

    <section class="confirmation_section layout_padding">
        <div class="container">
            <h2>Confirmação de Pedido</h2>
            <p>O seu pedido número <?php echo htmlspecialchars($order['id']); ?> foi realizado com sucesso.</p>
            <h3>Detalhes do Pedido:</h3>
            <p><strong>Total do Pedido:</strong> <?php echo number_format($order['total_amount'], 2, ',', '.'); ?> €</p>
            <h3>Itens do Pedido:</h3>
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
