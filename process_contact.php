<?php
// Configuração do banco de dados
$servername = "192.168.100.105";
$username = "dev_root";
$password = "as123as321";
$dbname = "user_registration";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recebe os dados do formulário via POST
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Verifica se os campos obrigatórios estão preenchidos
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    $response = array('success' => false, 'message' => 'Todos os campos são obrigatórios.');
    echo json_encode($response);
    exit;
}

// Prepara os dados para inserção no banco de dados (proteção contra SQL injection)
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
$phone = mysqli_real_escape_string($conn, $phone);
$message = mysqli_real_escape_string($conn, $message);

// Prepara a query SQL para inserir os dados
$sql = "INSERT INTO contacts (name, email, phone, message, created_at) 
        VALUES ('$name', '$email', '$phone', '$message', NOW())";

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
