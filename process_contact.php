<?php
require 'config.php';

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recebe os dados do formulário via POST
$nome = $_POST['nome'];
$apelido = $_POST['apelido'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Verifica se os campos obrigatórios estão preenchidos
if (empty($nome) || empty($apelido) || empty($email) || empty($telefone) || empty($mensagem)) {
    $response = array('success' => false, 'message' => 'Todos os campos são obrigatórios.');
    echo json_encode($response);
    exit;
}

// Prepara os dados para inserção no banco de dados (proteção contra SQL injection)
$nome = mysqli_real_escape_string($conn, $nome);
$apelido = mysqli_real_escape_string($conn, $apelido);
$email = mysqli_real_escape_string($conn, $email);
$telefone = mysqli_real_escape_string($conn, $telefone);
$mensagem = mysqli_real_escape_string($conn, $mensagem);

// Prepara a query SQL para inserir os dados
$sql = "INSERT INTO contacts (name, last_name, email, phone, message, created_at) VALUES ('$nome', '$apelido', '$email', '$telefone', '$mensagem', NOW())";

// Executa a query e verifica se foi bem sucedida
if ($conn->query($sql) === TRUE) {
    // Retorna uma resposta em JSON indicando sucesso
    $response = array('success' => true, 'message' => 'Mensagem enviada com sucesso!');
    echo json_encode($response);
} else {
    // Retorna uma resposta em JSON indicando falha
    $response = array('success' => false, 'message' => 'Erro ao enviar mensagem. Tente novamente mais tarde.');
    echo json_encode($response);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
