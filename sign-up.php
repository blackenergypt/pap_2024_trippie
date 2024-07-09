<?php
include 'includes/core.php';
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Registo - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="user-page">
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/lock.png" alt="InnovaWall Logo">
            </div>
            <h2><?=$lang['register-text-1'];?></h2>
            <form action="process_register.php" method="post">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="first_name" placeholder="<?=$lang['register-text-2'];?>" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="last_name" placeholder="<?=$lang['register-text-3'];?>" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="<?=$lang['register-text-4'];?>" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="<?=$lang['register-text-5'];?>" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="<?=$lang['register-text-6'];?>" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="<?=$lang['register-text-7'];?>" required><br>
                </div>
                <button type="submit" class="btn"><?=$lang['register-text-8'];?></button>
                <div class="links">
                    <a href="sign-up.php"><?=$lang['register-text-9'];?></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
