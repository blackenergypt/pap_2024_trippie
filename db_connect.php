<?php
require 'config.php';


// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Definir o conjunto de caracteres para UTF-8 (opcional)
if (!$conn->set_charset("utf8mb4")) {
    die("Erro ao definir o conjunto de caracteres para UTF-8: " . $conn->error);
}
?>
