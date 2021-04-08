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
  <h1 class="display-1 text-center"><?=$c['titulo']; ?></h1>
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
          <a href="#" class="btn btn-primary">Comprar Agora</a>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-6 mb-3">
      
    </div>
  </div>
</section>