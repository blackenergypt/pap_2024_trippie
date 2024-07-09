<?php
include 'includes/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <form action="process_reset_password.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
        
        <label for="password"><?=$lang['reset_password-text-1'];?>:</label>
        <input type="password" name="password" required><br>
        
        <label for="confirm_password"><?=$lang['reset_password-text-2'];?>:</label>
        <input type="password" name="confirm_password" required><br>
        
        <input type="submit" value="<?=$lang['reset_password-text-3'];?>">
    </form>
</body>
</html>
