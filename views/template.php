<?php $c = (new Home())->getConfig(); ?>
<?php $estados = (new Home())->getUf(); ?>
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
  <link rel="stylesheet" href="<?=BASE; ?>assets/dataTable/dataTable.css">
  <link rel="stylesheet" href="<?=BASE; ?>assets/css/glassstyle.css">
  <script src="<?=BASE; ?>assets/vendor/jquery/jquery.min.js"></script>
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
            <a class="nav-link" href="<?=BASE; ?>">HOME
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <?php if(!empty($_SESSION['lg'])): ?>
              <a class="nav-link" href="<?=BASE; ?>home/meus_dados">MEUS DADOS</a>
            <?php else: ?>
              <a class="nav-link" href="<?=BASE; ?>home/login">LOGIN</a>
            <?php endif; ?>
          </li>
          <?php if(empty($_SESSION['lg'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?=BASE; ?>home/cadastro"> 
                CADASTRO
              </a>
            </li>
          <?php endif; ?>
          
          <li class="nav-item">
            <a class="nav-link" href="<?=$c['facebook']; ?>" title="Facebook" target="_blank"> 
              <i class="fab fa-facebook"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$c['instagram']; ?>" title="Instagram" target="_blank">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=$c['google_maps']; ?>" title="Google Maps" target="_blank">
              <i class="fas fa-map-marker-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=BASE; ?>home/carrinho" class="nav-link" title="Carrinho">
              <i class="fas fa-cart-plus <?=(!empty($_SESSION['cart']))?'carrinho-true':'carrinho-false' ?>">
                <?=(!empty($_SESSION['cart']))?count($_SESSION['cart']):'0'; ?>
              </i> 
            </a>
          </li>
          <!-- deslogar -->
          <?php if(!empty($_SESSION['lg'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?=BASE; ?>home/sair" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
              </a>
            </li>
          <?php endif; ?>
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
      <div class="row">
        <div class="col-sm-6">
          <p class="m-0 text-center text-white">
            Copyright &copy; Your Website <?=date('Y'); ?> - <?=$c['loja']; ?><br>
            <?=$c['endereco']; ?><br>
            <?=$c['cidade']; ?>/<?=$c['estado']; ?><br>
            Construído por <a href="https://www.albicod.com/" style="color: #fff;">Albicod</a>
          </p>
        </div>
        <div class="col-sm-6">
          <p class="m-0 text-center text-white">
            Estados que Vendemos<br>
            <?php foreach($estados as $e): ?>
              <?=$e['nome']; ?><br>
            <?php endforeach; ?>
          </p>
        </div>
      </div>
      
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?=BASE; ?>assets/dataTable/dataTable.js"></script>
  <script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
  <script src="<?=BASE; ?>assets/js/lightzoom.js"></script>
  <script src="<?=BASE; ?>assets/js/config.js"></script>
  <script src="<?=BASE; ?>assets/js/scripts.js"></script>
  <script src="<?=BASE; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>