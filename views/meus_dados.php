<br>
<section>
	<h1>Meus Dados</h1>
	<hr>
	<!-- Nav pills -->
	<ul class="nav nav-pills">
	  <li class="nav-item">
	    <a class="nav-link active" data-toggle="pill" href="#home">Meus Dados</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" data-toggle="pill" href="#menu1">Minhas Compras</a>
	  </li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<!-- meus dados -->
		<div class="tab-pane container active" id="home">
			<hr>
			<?php if(!empty($error_cep)): ?>
				<hr>
				<div class="alert alert-danger">
		    	<strong>Erro!</strong> não vendemos para essa região!
		  	</div>
			<?php endif; ?>
			<form method="POST">
				<label>Nome</label>
				<input type="text" name="nome" class="form-control" required="" value="<?=$cliente['nome']; ?>">
				<div class="row">
					<div class="col-sm-6">
						<label>E-mail</label>
						<input type="email" disabled="" class="form-control" value="<?=$cliente['email']; ?>">
					</div>
					<div class="col-sm-6">
						<label>Senha</label>
						<input type="password" name="senha" class="form-control">
					</div>
				</div>
				<label>CPF</label>
				<input type="text" class="form-control" disabled="" value="<?=$cliente['numero_doc']; ?>">
				<label>CEP</label>
				<input name="cep" type="text" class="form-control cep" required="" value="<?=$cliente['cep']; ?>">
				<div class="row">
					<div class="col-sm-4">
		          <label for="endereco">Endereço</label>
		          <input name="endereco" type="text" class="form-control" value="<?=$cliente['endereco']; ?>">
		        </div>
		        <div class="col-sm-4">
		          <label for="numero">Número</label>
		          <input id="numero" name="numero" type="number" class="form-control" value="<?=$cliente['numero']; ?>">
		        </div>
		        <div class="col-sm-4">
		          <label for="complemento">Complemento</label>
		          <input id="complemento" name="complemento" type="text" value="<?=$cliente['complemento']; ?>" class="form-control">
		        </div>
				</div>
				<div class="row">
					<div class="col-sm-4">
		          <label>Bairro</label>
		          <input name="bairro" type="text" class="form-control" value="<?=$cliente['bairro']; ?>">
		        </div>
		        <div class="col-sm-4">
		          <label>Cidade</label>
		          <input name="cidade" type="text" readonly="" class="form-control cidade" value="<?=$cliente['cidade']; ?>">
		        </div>
		        <div class="col-sm-4">
		          <label>Estado</label>
		          <input name="estado" type="text" readonly="" value="<?=$cliente['estado']; ?>" class="form-control estado">
		        </div>
				</div>
				<br>
				<button class="btn btn-primary btn-block">Atualizar</button>
			</form>
		</div>
		<!-- minhas compras -->
		<div class="tab-pane container fade" id="menu1">
			<hr>
			<div class="row">
				<?php foreach ($compras as $c): ?>
					<div class="col-sm-4">
						<div class="alert alert-<?=($c['status'] == 1)?'success':'danger' ?>">
							<strong>ID: </strong>
							<?=$c['id']; ?><br>
							<strong>Codigo: </strong>
							<?=$c['codigo']; ?><br>
							<strong>Valor: </strong>
							R$<?=number_format($c['total'], 2, ',', '.'); ?><br>
							<strong>Status: </strong>
							<?=($c['status'] == 1)?'Aprovado':'Reprovado'; ?><br>
							<strong>Rastreamento: </strong>
							<?=(!empty($c['link_rastreamento']))?'<a href="'.$c['link_rastreamento'].'" target="_blank">Link</a>':'Aguarde'; ?><br>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<br>
</section>