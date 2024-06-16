<?php

require 'config.php';
// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query para buscar todos os contatos ordenados pela data de criação
$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Inicia a tabela HTML
    echo "<table class='table table-bordered'>";
    echo "<thead><tr><th>Nome</th><th>Apelido</th><th>Email</th><th>Telefone</th><th>Mensagem</th><th>Data de Criação</th></tr></thead><tbody>";
    
    // Loop através dos resultados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
        echo "</tr>";
    }
    
    echo "</tbody></table>";
} else {
    echo "<p>Nenhum contato encontrado.</p>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>