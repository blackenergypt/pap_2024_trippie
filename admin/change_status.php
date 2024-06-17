<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    http_response_code(401); // Unauthorized
    exit(json_encode(['error' => 'Unauthorized']));
}

require '../config.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $order_id = $_GET['id'];
    $new_status = $_GET['status'];

    // Conectar ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        http_response_code(500); // Internal Server Error
        exit(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Atualizar o status do pedido
    $sql_update = "UPDATE orders SET status = '$new_status' WHERE id = $order_id";
    if ($conn->query($sql_update) === TRUE) {
        http_response_code(200); // OK
        exit(json_encode(['message' => 'Status do pedido atualizado com sucesso.']));
    } else {
        http_response_code(500); // Internal Server Error
        exit(json_encode(['error' => 'Erro ao atualizar o status do pedido: ' . $conn->error]));
    }

    // Fechar conexão
    $conn->close();
} else {
    http_response_code(400); // Bad Request
    exit(json_encode(['error' => 'Parâmetros inválidos.']));
}
?>
