<?php
// Iniciar a sessão
session_start();

// Verificar se o usuário está logado como administrador
if (!isset($_SESSION['admin_username'])) {
    http_response_code(401); // Unauthorized
    exit(json_encode(['error' => 'Unauthorized']));
}

// Incluir arquivo de configuração do banco de dados
require '../config.php';

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    exit(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Consulta SQL para buscar todos os pedidos
$sql = "SELECT o.id, u.username as user, o.total_amount, o.created_at, o.status 
        FROM orders o 
        INNER JOIN users u ON o.user_id = u.id";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Início da tabela
    $output = '<thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Usuário</th>
                    <th>Total</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>';

    // Loop through rows to display each order
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr>";
        $output .= "<td>{$row['id']}</td>";
        $output .= "<td>{$row['user']}</td>";
        $output .= "<td>{$row['total_amount']}</td>";
        $output .= "<td>{$row['created_at']}</td>";
        $output .= "<td>{$row['status']}</td>";
        $output .= "<td>";
        $output .= "<a href='#' class='change-status' data-order-id='{$row['id']}' data-new-status='pending'>Pending</a> | ";
        $output .= "<a href='#' class='change-status' data-order-id='{$row['id']}' data-new-status='completed'>Completed</a> | ";
        $output .= "<a href='#' class='change-status' data-order-id='{$row['id']}' data-new-status='cancelled'>Cancelled</a>";
        $output .= "</td>";
        $output .= "</tr>";
    }

    // Fim da tabela
    $output .= '</tbody>';
} else {
    // Caso não haja pedidos encontrados
    $output = "<tr><td colspan='6'>Nenhum pedido encontrado.</td></tr>";
}

// Fechar conexão
$conn->close();

// Retornar saída como JSON (para AJAX) ou diretamente (para carregar via include)
if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode(['html' => $output]);
} else {
    echo $output;
}
?>
