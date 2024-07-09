<?php 

// Include language file based on the session or default to 'pt'
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
switch ($lang) {
    case 'en':
        include 'lang/en.php';
        break;
    default:
        include 'lang/pt.php';
        break;
}
?>