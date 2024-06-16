<?php
session_start();
require_once('db_connect.php'); // Conexão com o banco de dados

header('Content-Type: application/json');

if (isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = 1; // Quantidade fixa, neste caso será sempre 1

    // Verifique se o produto existe no banco de dados
    $query = "SELECT * FROM products WHERE id = $produto_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $produto = mysqli_fetch_assoc($result);

        // Adicione o item ao carrinho (geralmente seria melhor validar antes de inserir)
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Verifique se já existe o mesmo produto no carrinho
        $key = array_search($produto_id, array_column($_SESSION['cart'], 'produto_id'));
        
        if ($key !== false) {
            // Se já existe, apenas atualize a quantidade (no caso fixa como 1)
            $_SESSION['cart'][$key]['quantity'] += $quantidade;
        } else {
            // Senão, adicione como um novo item no carrinho
            $_SESSION['cart'][] = array(
                'produto_id' => $produto_id,
                'name' => $produto['name'], // Corrigido para 'name' do banco de dados
                'price' => $produto['price'], // Corrigido para 'price' do banco de dados
                'quantity' => $quantidade
            );
        }

        echo json_encode(array('success' => true, 'message' => 'Produto adicionado ao carrinho com sucesso!'));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Produto não encontrado.'));
    }

    mysqli_free_result($result);
    mysqli_close($conn);
} else {
    echo json_encode(array('success' => false, 'message' => 'Parâmetros inválidos para adicionar ao carrinho.'));
}
?>
