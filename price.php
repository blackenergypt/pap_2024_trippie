<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_start();
require_once('db_connect.php');

// Consulta para buscar todos os produtos da tabela
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro ao recuperar produtos: " . mysqli_error($conn));
}
?>

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
  <style>
    .price_section .price_container .box .btn-box button {
  display: inline-block;
  padding: 10px 35px;
  background-color: #ff4646;
  color: #ffffff;
  border-radius: 5px;
  border: 1px solid #ff4646;
  -webkit-transition: all .3s;
  transition: all .3s;
  border: none;
}

.price_section .price_container .box .btn-box button:hover {
  background-color: transparent;
  color: #ff4646;
}

.price_section .price_container .box .btn-box button:hover {
  background-color: #03a7d3;
  color: #ffffff;
}
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <?php include 'includes/header.php';?>

    <section class="slider_section">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>Fast & Secure <br> Web Hosting</h1>
                    <p>Anything embarrassing hidden in the middle of text. All the Lorem Ipsuanything embarrassing hidden
                      in the middle of text. All the Lorem Ipsumm </p>
                    <div class="btn-box">
                      <a href="" class="btn-1">Read More</a>
                      <a href="" class="btn-2">Contact Us</a>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-lg-10 mx-auto">
                      <div class="img-box">
                        <img src="assets/images/slider-img.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="carousel_btn-box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
  </div>

  <section class="price_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Oferecemos os melhores preços</h2>
      </div>
      <div class="price_container">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="box">
          <div class="detail-box">
            <img src="assets/images/produtos.png" width="145" height="145" alt ="">
            <h2>€ <span><?php echo number_format($row['price'], 2, ',', '.'); ?></span></h2>
            <h6><?php echo $row['name']; ?></h6>
            <ul class="price_features">
              <?php echo $row['description']; ?>
            </ul>
          </div>
          <div class="btn-box">
    <form action="add_to_cart.php" method="post" class="add-to-cart-form">
        <input type="hidden" name="produto_id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="add-to-cart-btn">Adicionar ao Carrinho</button>
    </form>
</div>

        </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>

  <!-- Seção de informações, footer, scripts -->
  <?php include 'includes/footer.php';?>
  <?php include 'includes/scripts.php';?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var addToCartForms = document.querySelectorAll('.add-to-cart-form');

        addToCartForms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita o envio padrão do formulário

                var formData = new FormData(form);

                fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Aqui você pode processar a resposta do backend (add_to_cart.php)
                    console.log(data); // Exemplo: {"success": true, "message": "Produto adicionado ao carrinho"}
                    alert(data.message); // Exibe uma mensagem de sucesso ou erro
                })
                .catch(error => {
                    console.error('Erro ao enviar requisição AJAX:', error);
                    alert('Ocorreu um erro ao adicionar o produto ao carrinho.');
                });
            });
        });
    });
</script>

</body>

</html>

<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
