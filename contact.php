
<?php
// Configurar a exibição de erros para desenvolvimento (remover ou comentar em produção)

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Iniciar a sessão, se necessário (descomentar a linha abaixo)
session_start();
// Include core files
include 'includes/core.php';
?>
<!DOCTYPE html>
<html lang="pt-pt">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>InnovaWall</title>

    <?php include 'includes/head.php';?>
    
    <style>
    .contact_section .form_container input {
        color: #ffffff  !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 10px !important;
        background-color: rgba(255, 255, 255, 0.1) !important;

    }
    .input_container {
        display: flex;
        align-items: center;
    }

    .input_container i {
        color: #ffffff;
        margin-top: -2%;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    .input_container svg {
        color: #ffffff;
        margin-top: -2%;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    .btn_box button {
        display: inline-block;
        padding: 10px 35px;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        transition: all .3s;
        border-radius: 10px !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    .btn_box button:hover {
        background-color: transparente;
        color: #ffffff;
    }
    .btn_box button:hover {
        background-color: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff;
    }
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>

    <section class="contact_section layout_padding" style="background-image: url(assets/images/bg.jpeg); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="text-white"><?=$lang['contact-text-1'];?></h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form id="contactForm" method="post">
                            <div class="input_container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="nome" placeholder="<?=$lang['contact-text-2'];?>" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="apelido" placeholder="<?=$lang['contact-text-3'];?>" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="<?=$lang['contact-text-4'];?>" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="telefone" placeholder="<?=$lang['contact-text-5'];?>" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-comment"></i>
                                <input name="mensagem" class="message-box" placeholder="<?=$lang['contact-text-6'];?>" required>
                            </div>
                            <div class="btn_box">
                                <button type="submit"><?=$lang['contact-text-7'];?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php';?>
    <?php include 'includes/scripts.php';?>

    <script>
$(document).ready(function() {
    // Variáveis PHP injetadas no JavaScript
    var errorMessage = '<?=$lang['contact-text-8'];?>'; // Mensagem de erro
    var successMessage = '<?=$lang['contact-text-9'];?>'; // Mensagem de sucesso

    // Manipula o envio do formulário de contato
    $('#contactForm').submit(function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        // Obtém os dados do formulário
        var formData = $(this).serialize();

        // Envia os dados via AJAX para processamento
        $.ajax({
            type: 'POST',
            url: 'process_contact.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Exibe uma mensagem de sucesso com Toastify
                    Toastify({
                        text: successMessage,
                        duration: 3000,
                        close: true,
                        gravity: "top", // "top" ou "bottom"
                        position: "right", // "left", "center" ou "right"
                        backgroundColor: "green",
                        stopOnFocus: true // Impede que o toast desapareça ao passar o mouse
                    }).showToast();

                    $('#contactForm')[0].reset(); // Limpa o formulário após o envio
                    fetchContacts(); // Atualiza a tabela de contatos
                } else {
                    // Exibe uma mensagem de erro com Toastify
                    Toastify({
                        text: response.message || errorMessage,
                        duration: 3000,
                        close: true,
                        gravity: "top", // "top" ou "bottom"
                        position: "right", // "left", "center" ou "right"
                        backgroundColor: "red",
                        stopOnFocus: true // Impede que o toast desapareça ao passar o mouse
                    }).showToast();
                }
            },
            error: function() {
                // Exibe uma mensagem de erro com Toastify
                Toastify({
                    text: errorMessage,
                    duration: 3000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "red",
                    stopOnFocus: true
                }).showToast();
            }
        });
    });

    // Função para buscar e atualizar a tabela de contatos
    function fetchContacts() {
        $.ajax({
            url: 'fetch_contacts.php',
            success: function(data) {
                $('#contactsTable').html(data); // Atualiza a tabela de contatos
            }
        });
    }

    // Chama a função para buscar contatos ao carregar a página
    fetchContacts();
});
</script>


</body>

</html>