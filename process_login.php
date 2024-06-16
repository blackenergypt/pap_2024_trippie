<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

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
$email = $_POST['email'];
$password = $_POST['password'];

// Verificar credenciais
$sql = "SELECT * FROM users WHERE email = '$email' AND email_verified = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Senha incorreta.";
    }
} else {
    $message = "Usuário não encontrado ou e-mail não verificado.";
}

$conn->close();
?>
!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Email - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    
    <!-- Script para redirecionamento após 5 segundos -->
    <script>
        setTimeout(function() {
            window.location.href = "dashboard.php";
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
            <p>Redirecionando em 5 segundos...</p>
        </div>
    </div>
</body>
</html>
