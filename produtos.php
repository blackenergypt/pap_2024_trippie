<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

require 'config.php'; // Incluir o arquivo de configuração com as credenciais do banco de dados
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
                                            <th>ID Pedido</th>
                                            <th>Data</th>
                                            <th>Status</th>
                                            <th>ID Produto</th>
                                            <th>Nome do Produto</th>
                                            <th>Preço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Conectar ao banco de dados
                                        $conn = new mysqli($servername, $username, $password, $dbname);

                                        // Verificar conexão
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        // Obter o ID do usuário logado
                                        $username = $_SESSION['username'];
                                        $sql_user = "SELECT id FROM users WHERE username = '$username'";
                                        $result_user = $conn->query($sql_user);

                                        if ($result_user->num_rows > 0) {
                                            $user = $result_user->fetch_assoc();
                                            $user_id = $user['id'];

                                            // Consulta SQL para buscar todos os pedidos e produtos do usuário com user_id especificado
                                            $sql = "SELECT o.id AS order_id, u.username AS user, o.total_amount, o.created_at, o.status, 
                                                           p.id AS product_id, p.name AS product_name, p.description AS product_description, p.price AS product_price
                                                    FROM orders o
                                                    INNER JOIN users u ON o.user_id = u.id
                                                    INNER JOIN order_items oi ON o.id = oi.order_id
                                                    INNER JOIN products p ON oi.product_id = p.id
                                                    WHERE o.user_id = $user_id";
                                            $result = $conn->query($sql);

                                            // Verificar se há resultados
                                            if ($result->num_rows > 0) {
                                                // Loop through rows to display each order and its products
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['order_id']}</td>";
                                                    echo "<td>{$row['created_at']}</td>";
                                                    echo "<td>{$row['status']}</td>";
                                                    echo "<td>{$row['product_id']}</td>";
                                                    echo "<td>{$row['product_name']}</td>";
                                                    echo "<td>{$row['product_price']}</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                // Caso não haja pedidos encontrados
                                                echo "<tr><td colspan='9'>Nenhum pedido encontrado.</td></tr>";
                                            }
                                        } else {
                                            // Caso o usuário não seja encontrado
                                            echo "<tr><td colspan='9'>Usuário não encontrado.</td></tr>";
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
