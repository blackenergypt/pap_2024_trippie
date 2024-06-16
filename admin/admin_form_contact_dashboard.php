<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php");
    exit();
}

require '../config.php';

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter todos os usuários
$sql = "SELECT id, first_name, last_name, username, email, email_verified, created_at FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Primeiro Nome</th><th>Último Nome</th><th>Nome de Usuário</th><th>Email</th><th>Email Verificado</th><th>Criado em</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>" . ($row['email_verified'] ? 'Sim' : 'Não') . "</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

$conn->close();
?>
