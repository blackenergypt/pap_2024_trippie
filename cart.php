<?php

// Verifica se o usuário está logado
if (!isset($_SESSION['username'])) {
    // header("Location: sign-in.php");
    // exit();
}

// Incluir conexão com o banco de dados
include_once 'db_connect.php';

// Inicializa o carrinho se ainda não estiver
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adicionar produto ao carrinho
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Verifica se o produto já está no carrinho
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Obtém informações do produto do banco de dados
        $sql = "SELECT * FROM products WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['cart'][$product_id] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => 1
            ];
        }
    }
}

// Remover produto do carrinho
if (isset($_POST['remove_product_id'])) {
    $remove_product_id = $_POST['remove_product_id'];
    unset($_SESSION['cart'][$remove_product_id]);
}

// Atualiza o total do carrinho
$total_amount = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// Debug para verificar conteúdo de $_SESSION['cart']
// echo '<pre>';
// print_r($_SESSION['cart']);
// echo '</pre>';

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
    <title>Carrinho - InnovaWall</title>
    
    <!-- Estilos CSS para melhorar a apresentação -->
    <style>
        .cart_section {
            padding: 50px 0;
        }
        .cart_items {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart_items table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .cart_items table th, .cart_items table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .cart_items table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }
        .cart_items table td {
            background-color: #fff;
            color: #333;
        }
        .cart_items table td strong {
            font-size: 1.2em;
        }
        .cart_items table .actions {
            display: flex;
            justify-content: center;
        }
        .cart_items table .actions button {
            padding: 8px 16px;
            background-color: #ff4646;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .cart_items table .actions button:hover {
            background-color: #333;
        }
        .empty_cart {
            text-align: center;
            margin-top: 20px;
            font-style: italic;
            color: #999;
        }
        .checkout_btn {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .checkout_btn button {
            padding: 12px 24px;
            background-color: #03a7d3;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .checkout_btn button:hover {
            background-color: #1e87a8;
        }
    </style>
    <?php include 'includes/head.php';?>
</head>

<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>
    <section class="cart_section layout_padding">
        <div class="container">
            <h2>Seu Carrinho de Compras</h2>
            <div class="cart_items">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço Total</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                                <tr>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?></td>
                                    <td class="actions">
                                        <form method="post">
                                            <input type="hidden" name="remove_product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"><strong>Total:</strong></td>
                                <td colspan="2"><strong><?php echo number_format($total_amount, 2, ',', '.'); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn">
                        <form action="checkout.php" method="post">
                            <button type="submit">Finalizar Compra</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p class="empty_cart">Seu carrinho está vazio.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>
</body>

</html>
