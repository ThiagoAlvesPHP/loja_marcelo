<section>
	<h3><i class="fas fa-cogs"></i> Admin/Configurações</h3>
	<hr>

	<!-- Nav pills -->
	<ul class="nav nav-pills">
	  <li class="nav-item">
	    <a class="nav-link active" data-toggle="pill" href="#home">Principal</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" data-toggle="pill" href="#menu1">Imagens</a>
	  </li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
	  	<div class="tab-pane container active" id="home">
	  		<hr>
	  		<form method="POST">
				<label>Loja</label>
				<input type="text" value="<?=$config['loja']; ?>" name="loja" class="form-control" required="">
				<div class="row">
					<div class="col-sm-6">
						<label>Endereço</label>
						<input type="text" value="<?=$config['endereco']; ?>" name="endereco" class="form-control" required="">
					</div>
					<div class="col-sm-6">
						<label>Bairro</label>
						<input type="text" value="<?=$config['bairro']; ?>" name="bairro" class="form-control" required="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>CEP</label>
						<input type="text" value="<?=$config['cep']; ?>" name="cep" class="form-control cep" required="">
					</div>
					<div class="col-sm-4">
						<label>Cidade</label>
						<input type="text" value="<?=$config['cidade']; ?>" name="cidade" class="form-control cidade" required="">
					</div>
					<div class="col-sm-4">
						<label>Estado</label>
						<input type="text" value="<?=$config['estado']; ?>" name="estado" class="form-control estado" required="">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						<label>Title</label>
						<input type="text" value="<?=$config['title']; ?>" name="title" class="form-control" required="">
					</div>
					<div class="col-sm-6">
						<label>Titulo</label>
						<input type="text" value="<?=$config['titulo']; ?>" name="titulo" class="form-control" required="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label>Instagram</label>
						<input type="text" value="<?=$config['instagram']; ?>" name="instagram" class="form-control" required="">
					</div>
					<div class="col-sm-4">
						<label>Facebook</label>
						<input type="text" value="<?=$config['facebook']; ?>" name="facebook" class="form-control" required="">
					</div>
					<div class="col-sm-4">
						<label>Whatsapp</label>
						<input type="text" value="<?=$config['whatsapp']; ?>" name="whatsapp" class="form-control" required="">
					</div>
				</div>
				<label>Google Maps</label>
				<input type="text" value="<?=$config['google_maps']; ?>" class="form-control" name="google_maps" required="">
				<div class="row">
					<div class="col-sm-6">
						<label>E-mail</label>
						<input type="email" value="<?=$config['email']; ?>" name="email" class="form-control" required="">
					</div>
					<div class="col-sm-6">
						<label>Frete</label>
						<input type="text" value="<?=number_format($config['frete'], 2, '.', ''); ?>" name="frete" class="form-control price" required="">
					</div>
				</div>
				<br>
				<button class="btn btn-primary">Atualizar</button>
			</form>
	  	</div>
	  <div class="tab-pane container fade" id="menu1">
	  	<hr>
	  	<div class="row">
	  		<div class="col-sm-4">
	  			<label>Favicon <small>200 x 140 WEBP</small></label>
	  			<img class="img-thumbnail" src="<?=BASE; ?>assets/img/<?=$config['favicon']; ?>">
	  			<br><br>
	  			<form method="POST" enctype="multipart/form-data">
	  				<input type="file" name="favicon">
	  				<br><br>
	  				<button class="btn btn-primary">Atualizar</button>
	  			</form>
	  		</div>
	  		<div class="col-sm-4">
	  			<label>Logo <small>400 x 150 WEBP</small></label>
	  			<img class="img-thumbnail" src="<?=BASE; ?>assets/img/<?=$config['logo']; ?>">
	  			<br><br>
	  			<form method="POST" enctype="multipart/form-data">
	  				<input type="file" name="logo">
	  				<br><br>
	  				<button class="btn btn-primary">Atualizar</button>
	  			</form>
	  		</div>
	  		<div class="col-sm-4">
	  			<label>Imagem Topo <small>1280 x 300 WEBP</small></label>
	  			<img class="img-thumbnail" src="<?=BASE; ?>assets/img/<?=$config['imagem']; ?>">
	  			<br><br>
	  			<form method="POST" enctype="multipart/form-data">
	  				<input type="file" name="imagem">
	  				<br><br>
	  				<button class="btn btn-primary">Atualizar</button>
	  			</form>
	  		</div>
	  	</div>
	  	<form method="POST">
	  		
	  	</form>
	  </div>
	</div>
	<br>
</section>