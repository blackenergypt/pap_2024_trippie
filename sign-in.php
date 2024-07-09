<?php
include 'includes/core.php';
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="user-page">
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/lock.png" alt="InnovaWall Logo">
            </div>
            <h2><?=$lang['login-text-1'];?></h2>
            <form action="process_login.php" method="post">    
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="<?=$lang['login-text-2'];?>" name="email" required>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="<?=$lang['login-text-3'];?>" name="password" required>
                </div>
                <button type="submit" class="btn"><?=$lang['login-text-4'];?></button>
                <div class="links">
                    <a href="forgot_password.php"><?=$lang['login-text-5'];?></a>
                    <a href="sign-up.php"><?=$lang['login-text-6'];?></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>