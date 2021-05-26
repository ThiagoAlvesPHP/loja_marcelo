<section>
	<h3><i class="fab fa-product-hunt"></i> Admin/Produto</h3>
	<hr>
	<div class="row">
		<div class="col-sm-3">
			<label>Imagem <small>800 x 600 WEBP</small></label>
  			<img class="img-thumbnail" src="<?=BASE; ?>assets/img/produtos/<?=$produto['imagem']['imagem']; ?>">
  			<br><br>
  			<form method="POST" enctype="multipart/form-data">
  				<input type="file" name="imagem" class="form-control">
  				<br>
  				<button class="btn btn-primary">Atualizar</button>
  			</form>
		</div>
		<div class="col-sm-9">
			<form method="POST">
		    	<label for="nome">Nome</label>
			    <input id="nome" name="nome" type="text" class="form-control" value="<?=$produto['nome']; ?>">
			    <label>Descrição</label>
			    <textarea id="descricao" name="descricao" class="form-control"><?=$produto['descricao']; ?></textarea>
		      	<div class="row">
			        <div class="col-sm-3">
			          	<label>Peso</label>
			          	<input name="peso" type="text" class="form-control" value="<?=$produto['peso']; ?>" required="">         
			        </div>
			        <div class="col-sm-3">
			          	<label>Largura</label>
			          	<input name="largura" type="text" class="form-control" value="<?=$produto['largura']; ?>" required="">          
			        </div>
			        <div class="col-sm-2">
			          	<label>Altura</label>
			          	<input name="altura" type="text" class="form-control" value="<?=$produto['altura']; ?>" required="">         
			        </div>
			        <div class="col-sm-2">
			          	<label>Comprimento</label>
			          	<input name="comprimento" type="text" class="form-control" value="<?=$produto['comprimento']; ?>" required="">         
			        </div>
			        <div class="col-sm-2">
			          	<label>Diametro</label>
			          	<input name="diametro" type="text" class="form-control" value="<?=$produto['comprimento']; ?>" required="">         
			        </div>
		      	</div>
		      	<!-- <label>Status</label><br>
		      	<input id="ativo" <?=($produto['status'] == 1)?'checked=""':''; ?> type="radio" name="status" value="1"> <label for="ativo">Ativo</label> | 
		      	<input id="inativo" <?=($produto['status'] == 2)?'checked=""':''; ?> type="radio" name="status" value="2"> <label for="inativo">Inativo</label> -->
		      	<br>
		      	<button class="btn btn-primary">Atualizar</button>
		  	</form>
		</div>
	</div>
</section>
<script src="<?=BASE; ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  //EDITOR
  CKEDITOR.replace('descricao');
</script>