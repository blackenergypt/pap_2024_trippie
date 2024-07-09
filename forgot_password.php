
<?php
include 'includes/core.php';
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="user-page" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/lock.png" alt="InnovaWall Logo">
            </div>
            <h2><?=$lang['forgot_password-text-1'];?></h2>
            <form action="process_forgot_password.php" method="post">
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="<?=$lang['forgot_password-text-2'];?>" name="email" required><br>
                </div>
                <button type="submit" class="btn"><?=$lang['forgot_password-text-3'];?></button>
            </form>
        </div>
    </div>
</body>

</html>