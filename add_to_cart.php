<?php
// Iniciar a sessão para armazenar os dados do carrinho
session_start();
include 'includes/core.php';
// Incluir o ficheiro de conexão com a base de dados
require_once('db_connect.php');

// Definir o cabeçalho do conteúdo como JSON
header('Content-Type: application/json');

// Verificar se o ID do produto foi enviado via POST
if (isset($_POST['produto_id'])) {
    $produto_id = intval($_POST['produto_id']);
    $quantidade = 1; // Quantidade fixa, neste caso será sempre 1

    // Verificar se o produto existe na base de dados
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $produto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        $produto = $result->fetch_assoc();

        // Adicionar o item ao carrinho (geralmente seria melhor validar antes de inserir)
        if (!isset($_SESSION['cart'])) {
            // Se o carrinho ainda não existe na sessão, criar um novo
            $_SESSION['cart'] = array();
        }

        // Verificar se o produto já existe no carrinho
        if (isset($_SESSION['cart'][$produto_id])) {
            // Se já existe, apenas atualizar a quantidade
            $_SESSION['cart'][$produto_id]['quantity'] += $quantidade;
        } else {
            // Se não existe, adicionar como um novo item no carrinho
            $_SESSION['cart'][$produto_id] = array(
                'name' => $produto['name'], 
                'price' => $produto['price'], 
                'quantity' => $quantidade
            );
        }

        // Retornar uma resposta de sucesso em formato JSON
        echo json_encode(array('success' => true, 'message' => 'Produto adicionado ao carrinho com sucesso!'));
    } else {
        // Se o produto não for encontrado, retornar uma resposta de erro
        echo json_encode(array('success' => false, 'message' => 'Produto não encontrado.'));
    }

    // Liberar a memória associada ao resultado
    $stmt->close();

    // Fechar a conexão com a base de dados
    $conn->close();
} else {
    // Se o ID do produto não for enviado, retornar uma resposta de erro
    echo json_encode(array('success' => false, 'message' => 'Parâmetros inválidos para adicionar ao carrinho.'));
}
?>
