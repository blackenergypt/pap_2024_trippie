<?php
session_start();

require '../config.php';
// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coletar dados do formulário
$username = $_POST['username'];
$password = $_POST['password'];

// Verificar credenciais do administrador
$admin_username = "admin";
$admin_password = "admin";

if ($username === $admin_username && $password === $admin_password) {
    $_SESSION['admin_username'] = $username;
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Credenciais de administrador incorretas.";
}

$conn->close();
?>
