<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'send_email.php'; // Verifique o caminho correto para este arquivo

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
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Verificar se as senhas coincidem
if ($password !== $confirm_password) {
    die("As senhas não coincidem.");
}

// Hash da senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Gerar código de verificação
$verification_code = md5(rand());

// Inserir dados na tabela usando prepared statements
$sql = "INSERT INTO users (first_name, last_name, username, password, email, verification_code) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $first_name, $last_name, $username, $hashed_password, $email, $verification_code);

if ($stmt->execute()) {
    // Enviar e-mail de verificação
    $subject = "Verificação de Email";
    $message = "Clique no link para verificar seu e-mail: https://dev.devcode.pt/verify.php?code=$verification_code";

    // Debug: Verifique os dados antes do envio do e-mail
   // echo "Dados do e-mail:<br>";
    //echo "Para: $email<br>";
  //  echo "Assunto: $subject<br>";
   // echo "Mensagem: $message<br>";

    if (sendVerificationEmail($email, $subject, $message)) {
        echo "Registro bem-sucedido. Verifique seu e-mail para a verificação.";
    } else {
        echo "Erro ao enviar e-mail de verificação. Verifique os logs para mais detalhes.";
    }    
} else {
    echo "Erro ao registrar usuário: " . $stmt->error;
}

$stmt->close();
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
            <h2>Registro bem-sucedido. Verifique seu e-mail para a verificação.</h2>
            <p>Redirecionando em 5 segundos...</p>

        </div>
    </div>
</body>
</html>
