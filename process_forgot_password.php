<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

require 'send_email.php'; // Certifique-se de que o caminho está correto

$servername = "192.168.100.105";
$username = "dev_root";
$password = "as123as321";
$dbname = "user_registration";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Coletar dados do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Verificar se o e-mail existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Gerar token de recuperação
        $token = md5(rand());
        $sql = "UPDATE users SET verification_code = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        
        if ($stmt->execute()) {
            // Enviar e-mail de recuperação
            $subject = "Recuperação de Senha";
            $message = "Clique no link para redefinir sua senha: https://dev.devcode.pt/reset_password.php?token=$token";

            if (sendRecoveryEmail($email, $subject, $message)) {
                echo "Email de recuperação enviado. Verifique seu e-mail.";
            } else {
                echo "Erro ao enviar e-mail de recuperação.";
            }
        } else {
            echo "Erro ao atualizar token: " . $stmt->error;
        }
    } else {
        echo "Email não encontrado.";
    }

    $stmt->close();
} else {
    echo "Método de requisição inválido.";
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
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/send_mail.png" alt="InnovaWall Logo">
            </div>
            <h2>Email de recuperação enviado. Verifique seu e-mail.</h2>
            <p>Redirecionando em 5 segundos...</p>

        </div>
    </div>
</body>
</html>