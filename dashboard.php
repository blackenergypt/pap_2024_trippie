<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

echo "Bem-vindo ao painel de controle, " . $_SESSION['username'] . "!";
?>
<a href="index.php">Voltar para a página inicial</a>
<form action="logout.php" method="post">
    <input type="submit" value="Sair">
</form>
