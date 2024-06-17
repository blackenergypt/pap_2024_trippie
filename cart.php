<?php

// Incluir o ficheiro de conexão com a base de dados
include_once 'db_connect.php';

// Inicializar o carrinho se ainda não estiver inicializado na sessão
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adicionar produto ao carrinho
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Verificar se o produto já está no carrinho
    if (isset($_SESSION['cart'][$product_id])) {
        // Se o produto já estiver no carrinho, incrementar a quantidade
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Obter informações do produto do banco de dados
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se o produto foi encontrado no banco de dados
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Adicionar o produto ao carrinho com quantidade inicial de 1
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
    // Remover o produto do carrinho
    unset($_SESSION['cart'][$remove_product_id]);
}

// Função para calcular o total do carrinho
function calculateCartTotal($cart) {
    $total_amount = 0;
    // Percorrer todos os itens do carrinho para calcular o total
    foreach ($cart as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }
    return $total_amount;
}

// Verificar se houve envio do formulário para finalizar a compra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout_submit'])) {
    // Redirecionar para checkout.php
    header("Location: checkout.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Carrinho - InnovaWall</title>
    <?php include 'includes/head.php'; ?>
</head>
<body class="sub_page">
    <div class="hero_area">
        <?php include 'includes/header.php'; ?>
    </div>

    <section class="cart_section layout_padding">
        <div class="container">
            <h2>O Seu Carrinho de Compras</h2>
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
                                        <!-- Formulário para remover o produto do carrinho -->
                                        <form method="post" action="cart.php">
                                            <input type="hidden" name="remove_product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2"><strong>Total:</strong></td>
                                <td colspan="2"><strong><?php echo number_format(calculateCartTotal($_SESSION['cart']), 2, ',', '.'); ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn">
                        <!-- Formulário para finalizar a compra -->
                        <form method="post" action="cart.php">
                            <button type="submit" name="checkout_submit">Finalizar Compra</button>
                        </form>
                    </div>
                <?php else: ?>
                    <p class="empty_cart">O seu carrinho está vazio.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>
