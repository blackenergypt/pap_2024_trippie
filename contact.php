<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>InnovaWall</title>

  <?php include 'includes/head.php';?>

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
                        <div>
                            <input type="text" name="name" id="name" placeholder="Your Name" required>
                        </div>
                        <div>
                            <input type="email" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div>
                            <input type="text" name="phone" id="phone" placeholder="Your Phone" required>
                        </div>
                        <div>
                            <textarea name="message" id="message" class="message-box" placeholder="Message" required></textarea>
                        </div>
                        <div class="btn_box">
                            <button type="submit">SEND</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
 
  <section class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h4>
              Address
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call +01 1234567890
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  demo@gmail.com
                </span>
              </a>
            </div>
          </div>
          <div class="info_social">
            <a href="">
              <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
              <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_link_box">
            <h4>
              Links
            </h4>
            <div class="info_links">
              <a class="" href="index.html">
                <img src="assets/imagesassets/images/nav-bullet.png" alt="">
                Home
              </a>
              <a class="" href="about.html">
                <img src="assets/imagesassets/images/nav-bullet.png" alt="">
                About
              </a>
              <a class="" href="service.html">
                <img src="assets/imagesassets/images/nav-bullet.png" alt="">
                Services
              </a>
              <a class="" href="price.html">
                <img src="assets/imagesassets/images/nav-bullet.png" alt="">
                Pricing
              </a>
              <a class="active" href="contact.html">
                <img src="assets/imagesassets/images/nav-bullet.png" alt="">
                Contact Us
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_detail">
            <h4>
              Info
            </h4>
            <p>
              necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful
            </p>
          </div>
        </div>
        <div class="col-md-3 mb-0">
          <h4>
            Subscribe
          </h4>
          <form action="#">
            <input type="text" placeholder="Enter email" />
            <button type="submit">
              Subscribe
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php include 'includes/footer.php';?>
  <?php include 'includes/scripts.php';?>
<!-- Script para processar o envio via AJAX -->
<script>
$(document).ready(function() {
    $('#contactForm').submit(function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        // Obtém os dados do formulário
        var formData = $(this).serialize();

        // Envia os dados via AJAX
        $.ajax({
            type: 'POST',
            url: 'process_contact.php', // Arquivo PHP para processamento
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Mensagem enviada com sucesso!');
                    $('#contactForm')[0].reset(); // Limpa o formulário
                    // Atualiza a tabela de contatos
                    fetchContacts();
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
            url: 'fetch_contacts.php', // Arquivo PHP para buscar contatos
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