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
  <script src="<?=BASE; ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>
<section style="width: 80%; margin:auto;" class="alert alert-success">
  <h1>Login</h1>
  <hr>
  <?php if(!empty($error_login)): ?>
    <div class="alert alert-danger">
      <strong>Erro</strong>
      Login e/ou senha não conferem!
    </div>
    <hr>
  <?php endif; ?>
  <form method="POST">
  	<label for="login">Login</label>
    <input name="login" type="text" class="form-control" required="" autofocus="">
    <label for="senha">Senha</label>
    <input name="senha" type="password" class="form-control" required="">
    <br>
    <button class="btn btn-success btn-block">Logar</button>
  </form>
  <br>
</section>

  <!-- Bootstrap core JavaScript -->
  <script src="<?=BASE; ?>assets/js/jquery.mask.js"></script>
  <script src="<?=BASE; ?>assets/js/scripts.js"></script>
  <script src="<?=BASE; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>