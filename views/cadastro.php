<br>
<section>
  <h1>Cadastro</h1>
  <hr>
  <?php if(!empty($_GET['errorEmail'])): ?>
    <div class="alert alert-danger">
      <strong>Atenção,</strong>
      Este E-mail já está cadastrado!<br>
    </div>
  <?php endif; ?>
  <?php if(!empty($_GET['errorCpf'])): ?>
    <div class="alert alert-danger">
      <strong>Atenção,</strong>
      Este CPF já está cadastrado!<br>
    </div>
  <?php endif; ?>
  <?php if(!empty($_GET['errorUf'])): ?>
    <div class="alert alert-danger">
      <strong>Atenção,</strong>
      Não vendemos para este estado!
    </div>
  <?php endif; ?>
  <form method="POST">
    <div class="row">
      <div class="col-sm-4">
        <label for="name">Nome</label>
        <input name="nome" type="text" class="form-control" required="">
      </div>
      <div class="col-sm-4">
        <label for="email">E-mail</label>
        <input name="email" type="email" class="form-control" required="">
      </div>
      <div class="col-sm-4">
        <label for="password">Senha</label>
        <input name="senha" type="password" class="form-control" required="">
      </div>
    </div>
  	
    <div class="row">
      <div class="col-sm-6">
        <label for="docType">Tipo de documento</label>
        <select id="docType" name="docType" data-checkout="docType" type="text" class="form-control">
          <option>CPF</option>
        </select>
      </div>
      <div class="col-sm-6">
        <label for="docNumber">Número do documento <small <?=(!empty($_GET['cpf']))?'style="color: red;"':''; ?> id="error_doc"><?=(!empty($_GET['cpf']))?'CPF Invalido':''; ?></small></label></label>
        <input id="docNumber" name="docNumber" type="number" class="form-control" minlength="11">
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <label for="cep">CEP</label>
        <input id="cep" name="cep" type="text" class="form-control cep">
      </div>
      <div class="col-sm-6">
        <label for="endereco">Endereço</label>
        <input id="endereco" name="endereco" type="text" class="form-control" required="">
      </div>
      <div class="col-sm-2">
        <label for="numero">Número</label>
        <input id="numero" name="numero" type="number" class="form-control" required="">
      </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
          <label for="complemento">Complemento</label>
          <input id="complemento" name="complemento" type="text" class="form-control">
        </div>
        <div class="col-sm-3">
          <label for="bairro">Bairro</label>
          <input id="bairro" name="bairro" type="text" class="form-control" required="">
        </div>
        <div class="col-sm-3">
          <label for="cidade">Cidade</label>
          <input id="cidade" name="cidade" type="text" class="form-control cidade" required="" readonly="">
        </div>
        <div class="col-sm-3">
          <label for="cidade">Estado</label>
          <input id="cidade" name="estado" type="text" class="form-control estado" required="" readonly="">
        </div>
      </div>

    <br>
    <button class="btn btn-success btn-block">Cadastrar</button>
  </form>
  <br>
</section>