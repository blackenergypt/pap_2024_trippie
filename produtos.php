<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

require 'config.php'; // Incluir o arquivo de configuração com as credenciais do banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Meus Produtos - InnovaWall</title>
    <link href="admin/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

    <?php include 'includes/sidebar.php'; ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include 'includes/sidenav.php'; ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Meus Produtos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Meus Produtos</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Meus Produtos
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="productsTable">
                                    <thead>
                                        <tr>
                                            <th>ID Produto</th>
                                            <th>Nome do Produto</th>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                            <th>Data da Compra</th>
                                            <th>Estado do Produto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
           

                                        // Obter o ID do usuário logado
                                        $username = $_SESSION['username'];
                                        $sql_user = "SELECT id FROM users WHERE username = '$username'";
                                        $result_user = $conn->query($sql_user);

                                        if ($result_user->num_rows > 0) {
                                            $user = $result_user->fetch_assoc();
                                            $user_id = $user['id'];

                                            // Consultar os pedidos (orders) do cliente com user_id = $user_id
                                            $sql_orders = "SELECT * FROM orders WHERE user_id = $user_id";
                                            $result_orders = $conn->query($sql_orders);

                                            if ($result_orders->num_rows > 0) {
                                                while ($order = $result_orders->fetch_assoc()) {
                                                    $order_id = $order['id'];
                                                    $total_amount = $order['total_amount'];
                                                    $created_at = $order['created_at'];
                                                    $status = $order['status'];

                                                    // Consultar os itens do pedido (order_items)
                                                    $sql_items = "SELECT oi.*, p.name AS product_name, p.description AS product_description, p.price AS product_price
                                                                  FROM order_items oi
                                                                  INNER JOIN products p ON oi.product_id = p.id
                                                                  WHERE oi.order_id = $order_id";
                                                    $result_items = $conn->query($sql_items);

                                                    if ($result_items->num_rows > 0) {
                                                        while ($item = $result_items->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>{$item['product_id']}</td>";
                                                            echo "<td>{$item['product_name']}</td>";
                                                            echo "<td>{$item['product_description']}</td>";
                                                            echo "<td>{$item['product_price']}</td>";
                                                            echo "<td>{$created_at}</td>"; // Data da compra do pedido
                                                            echo "<td>{$status}</td>"; // Estado do produto
                                                            echo "</tr>";
                                                        }
                                                    }
                                                }
                                            } else {
                                                echo "<tr><td colspan='6'>Nenhum pedido encontrado.</td></tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6'>Nenhum usuário encontrado.</td></tr>";
                                        }

                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; InnovaWall 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="admin/js/scripts.js"></script>
</body>
</html>
