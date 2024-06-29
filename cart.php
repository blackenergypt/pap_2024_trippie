<?php
session_start(); // Inicia a sessão, se ainda não estiver iniciada

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once 'db_connect.php';

// Inicializar o carrinho se ainda não estiver inicializado na sessão
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$response = ['success' => false, 'message' => 'Ação não realizada.'];

// Adicionar produto ao carrinho
if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    // Verificar se o produto é válido antes de adicioná-lo ao carrinho
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'quantity' => 1
            ];
        }
        $response = ['success' => true, 'message' => 'Produto adicionado ao carrinho.'];
    } else {
        $response = ['success' => false, 'message' => 'Produto não encontrado.'];
    }
    $stmt->close();
}

// Remover produto do carrinho
if (isset($_POST['remove_product_id']) && is_numeric($_POST['remove_product_id'])) {
    $remove_product_id = intval($_POST['remove_product_id']);
    if (isset($_SESSION['cart'][$remove_product_id])) {
        unset($_SESSION['cart'][$remove_product_id]);
        $response = ['success' => true, 'message' => 'Produto removido do carrinho.'];
    } else {
        $response = ['success' => false, 'message' => 'Produto não encontrado no carrinho.'];
    }
}

// Função para calcular o total do carrinho
function calculateCartTotal($cart) {
    $total_amount = 0;
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

// Retornar resposta JSON se for uma requisição AJAX
if (!empty($_POST)) {
    header('Content-Type: application/json');
    echo json_encode($response);
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
        <div id="order-standard_cart" class="container">
            <h2>O Seu Carrinho de Compras</h2>
            <h6>Revisão e checkout</h6>
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
                                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                    <td><?php echo number_format($item['price'] * $item['quantity'], 2, ',', '.'); ?></td>
                                    <td class="actions">
                                        <form method="post" class="remove-form">
                                            <input type="hidden" name="remove_product_id" value="<?php echo htmlspecialchars($product_id); ?>">
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.remove-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(form);
                fetch('cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Toastify({
                            text: data.message,
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "green",
                            },
                            stopOnFocus: true
                        }).showToast();

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        Toastify({
                            text: data.message,
                            duration: 3000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            style: {
                                background: "red",
                            },
                            stopOnFocus: true
                        }).showToast();
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar requisição AJAX:', error);
                    Toastify({
                        text: 'Ocorreu um erro ao processar a solicitação.',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "red",
                        },
                        stopOnFocus: true
                    }).showToast();
                });
            });
        });
    });
    </script>
    <style>
    #order-standard_cart .checkout-security-msg {
        margin: 20px 0;
        padding-left: 85px;
        font-size: .8em;
    }

    .alert-warning {
        background-color: #c1801f;
        border: none;
        color: #fff;
    }

    #order-standard_cart .checkout-security-msg svg {
        float: left;
        margin-left: -48px;
        font-size: 1.8em;
        color: #b7ff2e !important;
    }
    </style>
</body>
</html>
