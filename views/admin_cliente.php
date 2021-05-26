<section>
	<h3><i class="fas fa-users"></i> Admin/Cliente</h3>
	<hr>
	<form method="POST">
	    <div>
	      	<div class="row">
		        <div class="col-sm-6">
		          <label for="nome">Nome</label>
		          <input id="nome" name="nome" type="text" class="form-control" value="<?=$cliente['nome']; ?>">
		        </div>
		        <div class="col-sm-6">
		          <label for="email">E-mail</label>
		          <input id="email" name="email" type="text" value="<?=$cliente['email']; ?>" class="form-control">
		        </div>
		        <?php if(empty($cliente)): ?>
		        <div class="col-sm-4">
		          <label for="senha">Senha</label>
		          <input id="senha" name="senha" type="password" class="form-control" value="">
		        </div>
		        <?php endif; ?>
		    </div>
	      	<label for="docNumber">Número do documento</label>
		    <input name="numero_doc" type="text" class="form-control" value="<?=$cliente['numero_doc']; ?>">
	      	<div class="row">
		        <div class="col-sm-4">
		          	<label>CEP</label>
		          	<input name="cep" type="text" class="form-control cep" value="<?=$cliente['cep']; ?>" required="">         
		        </div>
		        <div class="col-sm-6">
		          <label>Endereço</label>
		          <input name="endereco" type="text" class="form-control" value="<?=$cliente['endereco']; ?>">
		        </div>
		        <div class="col-sm-2">
		          <label>Número</label>
		          <input name="numero" type="number" class="form-control" value="<?=$cliente['numero']; ?>">
		        </div>
	      	</div>
	      	<div class="row">
		        <div class="col-sm-3">
		          <label>Complemento</label>
		          <input name="complemento" type="text" value="<?=$cliente['complemento']; ?>" class="form-control">
		        </div>
		        <div class="col-sm-3">
		          <label>Bairro</label>
		          <input name="bairro" type="text" class="form-control" value="<?=$cliente['bairro']; ?>">
		        </div>
		        <div class="col-sm-3">
		          <label>Cidade</label>
		          <input name="cidade" type="text" class="form-control cidade" value="<?=$cliente['cidade']; ?>" readonly="">
		        </div>
		        <div class="col-sm-3">
		          <label>Estado</label>
		          <input name="estado" type="text" class="form-control estado" value="<?=$cliente['estado']; ?>" readonly="">
		        </div>
	      	</div>
	      	<label>Status</label><br>
	      	<input id="ativo" <?=($cliente['status'] == 1)?'checked=""':''; ?> type="radio" name="status" value="1"> <label for="ativo">Ativo</label> | 
	      	<input id="inativo" <?=($cliente['status'] == 2)?'checked=""':''; ?> type="radio" name="status" value="2"> <label for="inativo">Inativo</label>
	      	<br><br>
	      	<button class="btn btn-primary">Atualizar</button>
	    </div>
  	</form>
</section>