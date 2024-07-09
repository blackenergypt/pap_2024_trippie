<?php
require 'config.php';

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coletar dados do formulário
$token = $_POST['token'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Verificar se as senhas coincidem
if ($password !== $confirm_password) {
    die("As senhas não coincidem.");
}

// Hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Atualizar a senha
$sql = "UPDATE users SET password = '$hashed_password', verification_code = NULL WHERE verification_code = '$token'";

if ($conn->query($sql) === TRUE) {
    echo "Senha redefinida com sucesso.";
} else {
    echo "Erro ao redefinir a senha: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <!-- Script para redirecionamento após 5 segundos -->
    <script>
        setTimeout(function() {
            window.location.href = "sign-in.php"; // Altere "login.php" para a página desejada
        }, 5000); // 5000 milissegundos = 5 segundos
    </script>
</head>
<body class="user-page" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">

    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/reset_password.png" alt="InnovaWall Logo">
            </div>
            <h2>Senha redefinida com sucesso.</h2>
            <p>Redirecionando em 5 segundos...</p>

        </div>
    </div>
</body>
</html>