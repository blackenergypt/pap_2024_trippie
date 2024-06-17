<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login - InnovaWall</title>
    <link rel="icon" href="../assets/images/lock.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="user-page">
    <div class="login-container">
        <div class="login-box">
            <div class="logo">
                <img src="../assets/images/lock.png" alt="InnovaWall Logo">
            </div>
            <h2>Login</h2>
            <form action="process_admin_login.php" method="post">    
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Introduza o nome de Usuário" name="username" required>
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Introduza a sua password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
          
            </form>
        
        </div>
    </div>
</body>
</html>