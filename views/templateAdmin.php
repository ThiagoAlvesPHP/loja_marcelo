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
  <link href="<?=BASE; ?>assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?=BASE; ?>assets/css/fontawesome/css/all.min.css">
  <script src="<?=BASE; ?>assets/vendor/jquery/jquery.min.js"></script>]
  <style type="text/css">
    section{
      margin-top: 10px;
    }
  </style>
</head>

<body>

  <!-- Navigation bg-light -->
  <nav class="navbar navbar-expand-lg bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?=BASE; ?>">
        <img width="100" src="<?=BASE; ?>assets/img/<?=$c['logo']; ?>">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">|||</span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?=BASE.'admin'; ?>">
              <i class="fas fa-tachometer-alt"></i> 
              DASHBOARD
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?=$c['facebook']; ?>" title="Facebook" target="_blank"> 
              <i class="fab fa-facebook"></i>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
  <script src="<?=BASE; ?>assets/js/scripts.js"></script>
  <script src="<?=BASE; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>