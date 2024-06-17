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
            <p>O seu pedido número <?php echo $order['id']; ?> foi realizado com sucesso.</p>
            <h3>Detalhes do Pedido:</h3>
            <p><strong>Total do Pedido:</strong> <?php echo number_format($order['total_amount'], 2, ',', '.'); ?> €</p>
            <h3>Itens do Pedido:</h3>
            <ul>
                <?php while ($item = $result_items->fetch_assoc()): ?>
                    <li><?php echo $item['name']; ?> - <?php echo $item['quantity']; ?> x € <?php echo number_format($item['price'], 2, ',', '.'); ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
