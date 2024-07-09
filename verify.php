<?php
require 'config.php';

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter código de verificação
$verification_code = $_GET['code'];

// Atualizar status do e-mail
$sql = "UPDATE users SET email_verified = TRUE WHERE verification_code = '$verification_code'";

if ($conn->query($sql) === TRUE) {
    $message = "Email verificado com sucesso.";
} else {
    $message = "Erro ao verificar o email: " . $conn->error;
}

$conn->close();

include 'includes/core.php';
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
            window.location.href = "sign-in.php";
        }, 5000); 
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/user.png" alt="InnovaWall Logo">
            </div>
            <p><?php echo $message; ?></p>
            
            <p><?=$lang['verify-text-1'];?>...</p>
        </div>
    </div>
</body>
</html>
