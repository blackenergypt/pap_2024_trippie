<?php
session_start(); // Inicia a sessão

// Verifica se a sessão do usuário está ativa
if (isset($_SESSION['username'])) {
    // Destrói todas as variáveis de sessão
    $_SESSION = array();

    // Se estiver usando cookies de sessão, removê-los
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destrói a sessão
    session_destroy();

    // Redireciona para a página de login
    header("Location: sign-in.php");
    exit();
} else {
    // Se a sessão do usuário não estiver ativa, redireciona para a página de login
    header("Location: sign-in.php");
    exit();
}
?>
