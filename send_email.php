<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Certifique-se de que o caminho está correto para o autoload do PHPMailer

// Função para enviar e-mail de recuperação de senha
function sendRecoveryEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.devcode.pt'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'auth@devcode.pt'; // Substitua pelo seu e-mail SMTP
        $mail->Password = 'y6f1iazug7ulcHOt'; // Substitua pela sua senha SMTP
        $mail->SMTPSecure = false; // Sem criptografia
        $mail->SMTPAutoTLS = false; // Desativar TLS automático
        $mail->Port = 25; // Ou a porta correta do seu servidor SMTP

        // Configurações do e-mail
        $mail->setFrom('noreply@devcode.pt', 'InnovaWall');
        $mail->addAddress($to);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Erro ao enviar e-mail de recuperação: {$mail->ErrorInfo}";
    }
}

// Função para enviar e-mail de verificação de conta
function sendVerificationEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'mail.devcode.pt'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'auth@devcode.pt'; // Substitua pelo seu e-mail SMTP
        $mail->Password = 'y6f1iazug7ulcHOt'; // Substitua pela sua senha SMTP
        $mail->SMTPSecure = false; // Sem criptografia
        $mail->SMTPAutoTLS = false; // Desativar TLS automático
        $mail->Port = 25; // Ou a porta correta do seu servidor SMTP

        // Configurações do e-mail
        $mail->setFrom('noreply@devcode.pt', 'InnovaWall');
        $mail->addAddress($to);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Erro ao enviar e-mail de verificação: {$mail->ErrorInfo}";
    }
}
?>
