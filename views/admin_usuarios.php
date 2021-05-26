<section>
	<h3><i class="fas fa-user-friends"></i> Admin/Usuários</h3>
	<hr>
	<div class="row">
		<div class="col-sm-4">
			<?php if(!empty($errorUsuario)): ?>
			<div class="alert alert-danger">
				<strong>Error</strong>
				Login e/ou E-mail já existem!
			</div>
			<?php endif; ?>
			<form method="POST">
				<label>Nome</label>
				<input type="text" name="nome" class="form-control" required="">
				<label>E-mail</label>
				<input type="email" name="email" class="form-control" required="">
				<label>Login</label>
				<input type="text" name="login" class="form-control" required="">
				<label>Senha</label>
				<input type="password" name="senha" class="form-control" required="">
				<br>
				<button class="btn btn-success">Salvar</button>
			</form>
		</div>
		<div class="col-sm-8">
			<!-- lista de clientes -->
			<div class="table table-responsive">
				<table class="table table-hover" id="usuarios_list">
					<thead>
						<tr>
							<th>Ação</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Login</th>
							<th>Status</th>
							<!-- <th>Registrado em</th> -->
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</section>