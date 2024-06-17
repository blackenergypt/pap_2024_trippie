<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de Senha - InnovaWall</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="user-page">
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="assets/images/lock.png" alt="InnovaWall Logo">
            </div>
            <h2>Recuperação de Senha</h2>
            <form action="process_forgot_password.php" method="post">
                <div class="textbox">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Introduza o seu email" name="email" required><br>
                </div>
                <button type="submit" class="btn">Recuperar Senha</button>
            </form>
        </div>
    </div>
</body>

</html>