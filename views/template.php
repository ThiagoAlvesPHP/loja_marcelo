<?php $c = (new Home())->getConfig(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta property="og:title" content="<?=$c['title']; ?>">
  <meta property="og:description" content="<?=$c['titulo']; ?>">
  <meta name="author" content="Albicod">
  <title><?=$c['title']; ?></title>
  <meta property="og:image" content="<?=BASE; ?>assets/img/<?=$c['logo']; ?>">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="800">
  <meta property="og:image:height" content="600">
  <link rel="icon" href="<?=BASE; ?>assets/img/<?=$c['favicon']; ?>" type="image/x-icon"/>
  
  <link href="<?=BASE; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=BASE; ?>assets/css/heroic-features.css" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img width="100" src="<?=BASE; ?>assets/img/<?=$c['logo']; ?>">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
  </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">
        Copyright &copy; Your Website <?=date('Y'); ?> - <?=$c['loja']; ?><br>
        <?=$c['endereco']; ?><br>
        <?=$c['cidade']; ?>/<?=$c['estado']; ?>
      </p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?=BASE; ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?=BASE; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>