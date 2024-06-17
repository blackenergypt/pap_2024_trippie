<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}

require '../config.php';

// Verificar se o parâmetro ID foi fornecido na URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de contato inválido.";
    exit();
}

$contact_id = $_GET['id'];

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para obter os detalhes do contato
$sql = "SELECT id, name, last_name, email, phone, message, created_at FROM contacts WHERE id = $contact_id";
$result = $conn->query($sql);

// Verificar se o contato existe
if ($result->num_rows > 0) {
    // Obter os dados do contato
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $message = $row['message'];
    $created_at = $row['created_at'];
} else {
    echo "Contato não encontrado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Visualizar Contato - InnovaWall</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php include 'includes/navbar.php';?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include 'includes/sidebar.php';?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Visualizar Contato</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Visualizar Contato</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-user me-1"></i>
                            Detalhes do Contato
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Nome:</label>
                                <input type="text" class="form-control" value="<?php echo $name . ' ' . $last_name; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control" value="<?php echo $email; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefone:</label>
                                <input type="text" class="form-control" value="<?php echo $phone; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mensagem:</label>
                                <textarea class="form-control" rows="5" readonly><?php echo $message; ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data de Criação:</label>
                                <input type="text" class="form-control" value="<?php echo $created_at; ?>" readonly>
                            </div>
                            <a href="dashboard.php" class="btn btn-secondary">Voltar</a>
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
    <script src="js/scripts.js"></script>
</body>
</html>
