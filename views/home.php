<!-- Page Content -->
<section>
  <div id="demo" class="carousel slide my-4" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img width="100%" src="<?=BASE; ?>assets/img/<?=$c['imagem']; ?>" alt="Los Angeles">
      </div>
    </div>
  </div>
  <h1 class="text-center"><?=$c['titulo']; ?></h1>
  <hr>
  <!-- Page Features -->
  <div class="row text-center">

    <div class="col-lg-2 col-md-6 mb-3">
      
    </div>

    <div class="col-lg-8 col-md-6 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?=BASE; ?>assets/img/produtos/<?=$produto['img']; ?>" alt="<?=$produto['nome']; ?>">
        <div class="card-body">
          <h4 class="card-title"><?=$produto['nome']; ?></h4>
          <p class="card-text"><?=$produto['descricao']; ?></p>
        </div>
        <div class="card-footer">
          <form method="POST" class="addtocartform" action="<?=BASE; ?>home/confirmacao">
            <input type="hidden" name="id_produto" value="<?=$produto['id']; ?>" class="id_produto">
            <input type="hidden" value="<?=number_format($produto['valor'], 2, '.', ''); ?>" class="form-control valor" name="valor" disabled>
            <br>

            <h3 class="subtotal">Total: R$<span><?=number_format($produto['valor'], 2, ',', '.'); ?></span></h3>

            <button class="bt-acao" data-action="decrease">-</button>
            <input type="number" min="1" value="1" name="quantidade" class="quantidade" readonly="">
            <button class="bt-acao" data-action="increase">+</button><br><br>
            <?php if (!empty($errocep)): ?>
              <div class="alert alert-danger">
                <strong>Erro!</strong> não vendemos para essa região!
              </div>
            <?php endif; ?>

            <?php if (!empty($cliente)): ?>
              <input type="text" name="cep" value="<?=$cliente['cep']; ?>" class="form-control cep" required="" placeholder="CEP"><br>
            <?php else: ?>
              <input type="text" name="cep" value="<?=(!empty($errocep))?$errocep:''; ?>" class="form-control cep" required="" placeholder="CEP"><br>
            <?php endif; ?>
            

            <button class="btn btn-primary btn-lg">COMPRAR AGORA</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-3">
      
    </div>
  </div>
</section>