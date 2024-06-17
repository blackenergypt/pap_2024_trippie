<?php
// Iniciar a sessão para armazenar os dados do carrinho
session_start();

// Incluir o ficheiro de conexão com a base de dados
require_once('db_connect.php');

// Definir o cabeçalho do conteúdo como JSON
header('Content-Type: application/json');

// Verificar se o ID do produto foi enviado via POST
if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = 1; // Quantidade fixa, neste caso será sempre 1

    // Verificar se o produto existe na base de dados
    $query = "SELECT * FROM products WHERE id = $produto_id";
    $result = mysqli_query($conn, $query);

    // Verificar se a consulta retornou algum resultado
    if (mysqli_num_rows($result) > 0) {
        $produto = mysqli_fetch_assoc($result);

        // Adicionar o item ao carrinho (geralmente seria melhor validar antes de inserir)
        if (!isset($_SESSION['cart'])) {
            // Se o carrinho ainda não existe na sessão, criar um novo
            $_SESSION['cart'] = array();
        }

        // Verificar se o produto já existe no carrinho
        $key = array_search($produto_id, array_column($_SESSION['cart'], 'produto_id'));
        
        if ($key !== false) {
            // Se já existe, apenas atualizar a quantidade
            $_SESSION['cart'][$key]['quantity'] += $quantidade;
        } else {
            // Se não existe, adicionar como um novo item no carrinho
            $_SESSION['cart'][] = array(
                'produto_id' => $produto_id,
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
    mysqli_free_result($result);

    // Fechar a conexão com a base de dados
    mysqli_close($conn);
} else {
    // Se o ID do produto não for enviado, retornar uma resposta de erro
    echo json_encode(array('success' => false, 'message' => 'Parâmetros inválidos para adicionar ao carrinho.'));
}
?>
