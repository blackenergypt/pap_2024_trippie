<?php

// Contar o número de produtos no carrinho
$cart_count = 0;
if (isset($_SESSION['cart'])) {
    // Somar a quantidade de cada produto no carrinho
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
    }
}

?>

<style>
      .navbar-expand-lg .navbar-nav .dropdown-menu {
        align-items: center;
        width: 180px;
        height: auto;
        flex-direction: column;
    }
    .quote_btn-container {
      border: 1px solid rgba(255, 255, 255, 0.1) !important;
      border-radius: 100px !important;
      width: 200px;
      height: 50px;
      padding-left: 25px;
      background-color: rgba(255, 255, 255, 0.1) !important;
    }
  </style>

<header class="header_section d-flex flex-wrap justify-content-center" style="    background-image: url(assets/images/bg.jpeg) !important;
    background-position: center!important;
    background-repeat: no-repeat!important;
    background-size: cover!important;
    background-color: transparent!important;">
  <div class="container-full">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="index.php">
        <img src="../assets/images/logo.png" alt="" style="width: 180px; height: auto;">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""> </span>
      </button>

      <div class="collapse navbar-collapse flex-wrap justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php"><?=$lang['nav-text-1'];?> <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php"><?=$lang['nav-text-2'];?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="service.php"><?=$lang['nav-text-3'];?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="price.php"><?=$lang['nav-text-4'];?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php"><?=$lang['nav-text-5'];?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php">
              <!-- Mostrar o número de produtos no carrinho -->
              <?php if ($cart_count > 0) : ?>
                <span class="badge badge-pill badge-danger"><?php echo $cart_count; ?></span>
              <?php endif; ?>
              <?=$lang['nav-text-6'];?>
            </a>
          </li>
        </ul>
        <div class="quote_btn-container">
          <!-- Mostra o link de login ou o nome de usuário dependendo do estado da sessão -->
          <?php if (!isset($_SESSION['username'])) : ?>
            <a href="sign-in.php">
              <i class="fas fa-user"></i>
              <span><?=$lang['nav-text-7'];?></span>
            </a>
          <?php else : ?>
            <a href="dashboard.php">
              <i class="fas fa-user"></i>
              <span style="color:white;"><?=$lang['nav-text-8'];?>, <?php echo $_SESSION['username']; ?></span>
            </a>
          <?php endif; ?>
        </div>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none; color: white;">
                <img style="width: 20px; height: auto; margin-right: 5px;" src="assets/images/flags/pt.svg" alt="<?=$lang['lang-pt'];?>"><?=$lang['lang-pt'];?></a>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="nav-link" href="index.php?la=pt"><img style="width: 20px; height: auto; margin-right: 5px;" src="assets/images/flags/pt.svg" alt="<?=$lang['lang-pt'];?>"><?=$lang['lang-pt'];?></a></li>
                  <li><a class="nav-link" href="index.php?la=en"><img style="width: 20px; height: auto; margin-right: 5px;" src="assets/images/flags/en.svg" alt="<?=$lang['lang-en'];?>"><?=$lang['lang-en'];?></a></li>
                </ul>
              </li>
            </ul>
          </div>
      </div>
    </nav>
  </div>
</header>
