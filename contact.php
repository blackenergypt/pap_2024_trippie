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
    .input_container {
        display: flex;
        align-items: center;
    }

    .input_container i {
        margin-top: -2%;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    </style>
</head>

<body class="sub_page">

    <div class="hero_area">
        <?php include 'includes/header.php';?>
    </div>

    <section class="contact_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Entre em Contato Connosco</h2>
            </div>
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="form_container">
                        <form id="contactForm" method="post">
                            <div class="input_container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="nome" placeholder="Nome" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-user"></i>
                                <input type="text" name="apelido" placeholder="Apelido" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" placeholder="Email" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-phone"></i>
                                <input type="text" name="telefone" placeholder="Número de Telefone" required />
                            </div>
                            <div class="input_container">
                                <i class="fas fa-comment"></i>
                                <input name="mensagem" class="message-box" placeholder="Mensagem" required>
                            </div>
                            <div class="btn_box">
                                <button type="submit">Enviar mensagem</button>
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
                        alert('Mensagem enviada com sucesso!');
                        $('#contactForm')[0].reset(); // Limpa o formulário após o envio
                        fetchContacts(); // Atualiza a tabela de contatos
                    } else {
                        alert('Erro ao enviar mensagem. Tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro ao enviar mensagem. Tente novamente.');
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