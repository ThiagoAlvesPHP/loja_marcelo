<br>
<section>
  <h1>Login</h1>
  <hr>
  <?php if(!empty($error_login)): ?>
    <div class="alert alert-danger">
      E-mail e/ou senha incorretos! 
    </div>
  <?php endif; ?>
  <form method="POST">
  	<label for="email">E-mail</label>
    <input name="email" type="email" class="form-control" required="" autofocus="">
    <label for="senha">Senha</label>
    <input name="senha" type="password" class="form-control" required="">
    <br>
    <button class="btn btn-success btn-block">Logar</button>
  </form>
  <br>
</section>