<?php
// Remover session_start() do header.php
// session_start(); // Inicia a sessão, se ainda não estiver iniciada

// Contar o número de produtos no carrinho
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    // Somar a quantidade de cada produto no carrinho
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}
?>

<header class="header_section d-flex flex-wrap justify-content-center">
  <div class="container">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="index.php">
        <img src="../assets/images/logo.png" alt="" style="width: 180px; height: auto;">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse flex-wrap justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="service.php">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="price.php">Preços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contactos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <!-- Mostrar o número de produtos no carrinho -->
              <?php if ($cart_count > 0) : ?>
                <span class="badge badge-pill badge-danger"><?php echo $cart_count; ?></span>
              <?php endif; ?>
              Carrinho
            </a>
          </li>
        </ul>
        <div class="quote_btn-container">
          <!-- Mostra o link de login ou o nome de usuário dependendo do estado da sessão -->
          <?php if (!isset($_SESSION['username'])) : ?>
            <a href="sign-in.php">
              <i class="fas fa-user"></i>
              <span>Área De Cliente</span>
            </a>
          <?php else : ?>
            <a href="dashboard.php">
              <i class="fas fa-user"></i>
              <span style="color:white;">Olá, <?php echo $_SESSION['username']; ?></span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </div>
</header>
