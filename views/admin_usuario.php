<section>
	<h3><i class="fas fa-user-friends"></i> Admin/Usuário</h3>
	<hr>
	<?php if(!empty($errorUsuario)): ?>
	<div class="alert alert-danger">
		<strong>Error</strong>
		Login e/ou E-mail já existem!
	</div>
	<?php endif; ?>
	<form method="POST">
		<label>Nome</label>
		<input type="text" value="<?=$usuario['nome']; ?>" name="nome" class="form-control" required="">
		<label>E-mail</label>
		<input type="email" value="<?=$usuario['email']; ?>" name="email" class="form-control" required="">
		<label>Login</label>
		<input type="text" value="<?=$usuario['login']; ?>" name="login" class="form-control" required="">
		<label>Senha</label>
		<input type="password" name="senha" class="form-control">
		<label>Status</label><br>
      	<input id="ativo" <?=($usuario['status'] == 1)?'checked=""':''; ?> type="radio" name="status" value="1"> <label for="ativo">Ativo</label> | 
      	<input id="inativo" <?=($usuario['status'] == 2)?'checked=""':''; ?> type="radio" name="status" value="2"> <label for="inativo">Inativo</label>
		<br>
		<button class="btn btn-success">Salvar</button>
	</form>
</section>