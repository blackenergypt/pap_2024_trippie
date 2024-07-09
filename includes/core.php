<?php

// Capturar o parâmetro de linguagem da URL
if (isset($_GET['la'])) {
    $lang = $_GET['la'];
    $_SESSION['lang'] = $lang;
} else {
    $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'pt';
}

// Incluir o arquivo de linguagem correto
switch ($lang) {
    case 'en':
        include 'lang/en.php';
        break;
    default:
        include 'lang/pt.php';
        break;
}

?>