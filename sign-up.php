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
            <h2>Registo</h2>
            <form action="process_register.php" method="post">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="first_name" placeholder="Primeiro Nome" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="last_name" placeholder="Último Nome" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Nome de Usuário" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Introduza o seu email" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Introduza a sua senha" required><br>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" placeholder="Confirme a sua senha" required><br>
                </div>
                <button type="submit" class="btn">Registrar</button>
                <div class="links">
                    <a href="sign-up.php">Ainda não fazer o login? Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
