<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<!-- Page Content -->
<section>
  <h1>Confirmação</h1>
  <hr>
  <div class="row">

    <div class="col-lg-6 col-md-6 mb-3">
      <div class="card h-100">
        <img class="card-img-top" src="<?=BASE; ?>assets/img/produtos/<?=$produto['img']; ?>" alt="<?=$produto['nome']; ?>">
      </div>
    </div>

    <div class="col-lg-6 col-md-6 mb-3">
      <div class="card h-100">
        <div class="card-body">
          <h4 class="card-title"><?=$produto['nome']; ?></h4>
          <p class="card-text">
            <?=$produto['descricao']; ?><br>
            <strong>Valor:</strong> 
            R$<?=number_format($produto['valor'], 2, ',', '.'); ?><br> 
            <strong>Quantidade: </strong>    
            <?=$produto['qt']; ?><br>
            <strong>Frete: </strong>    
            R$<?=number_format($produto['frete'], 2, ',', '.'); ?><br>
            <!-- <strong>Dias para chegar: </strong>    
            <?=$produto['frete']['date']; ?><br><br> -->

            <strong>Total: </strong>    
            R$<span style="font-size: 40px; color: green; font-weight: bold;"><?=number_format(str_replace(',', '.', $produto['frete']) + ($produto['qt'] * $produto['valor']), 2, ',', '.'); ?></span>
          </p>
        </div>
      </div>
    </div>

  </div>

  <form action="<?=BASE; ?>home/comprar" method="post" id="paymentForm">
    <?php if(!empty($_GET['errorCliente'])): ?>
      <div class="alert alert-danger">
        <strong>Atenção,</strong>
        este cliente já esta cadastrado!<br>
        Faça login e continua sua compra
      </div>
    <?php endif; ?>
    <div>
      <h3>Detalhe do comprador</h3>
      <div class="row">
        <div class="col-sm-<?=(!empty($cliente))?'6':'4' ?>">
          <label for="nome">Nome</label>
          <input id="nome" name="nome" type="text" class="form-control" value="<?=(!empty($cliente))?$cliente['nome']:'' ?>">
        </div>
        <div class="col-sm-<?=(!empty($cliente))?'6':'4' ?>">
          <label for="email">E-mail</label>
          <input id="email" name="email" type="text" value="<?=(!empty($cliente))?$cliente['email']:'' ?>" class="form-control">
        </div>
        <?php if(empty($cliente)): ?>
        <div class="col-sm-4">
          <label for="senha">Senha</label>
          <input id="senha" name="senha" type="password" class="form-control" value="">
        </div>
        <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <label for="docType">Tipo de documento</label>
          <select id="docType" name="docType" data-checkout="docType" type="text" class="form-control"></select>
        </div>
        <div class="col-sm-6">
          <label for="docNumber">Número do documento</label>
          <input id="docNumber" name="docNumber" data-checkout="docNumber" type="text" class="form-control" value="<?=(!empty($cliente))?$cliente['numero_doc']:'' ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <label for="cep">CEP</label>
          <?php if(empty($cliente)): ?>
            <input id="cep" name="cep" type="text" class="form-control cep" value="<?=$cliente['cep']; ?>" readonly="">
          <?php else: ?>
            <input id="cep" name="cep" type="text" class="form-control cep" value="<?=$_SESSION['cep']; ?>" readonly="">
          <?php endif; ?>
          
        </div>
        <div class="col-sm-6">
          <label for="endereco">Endereço</label>
          <input id="endereco" name="endereco" type="text" class="form-control" value="<?=(!empty($cliente))?$cliente['endereco']:'' ?>">
        </div>
        <div class="col-sm-2">
          <label for="numero">Número</label>
          <input id="numero" name="numero" type="number" class="form-control" value="<?=(!empty($cliente))?$cliente['numero']:'' ?>">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <label for="complemento">Complemento</label>
          <input id="complemento" name="complemento" type="text" value="<?=(!empty($cliente))?$cliente['complemento']:'' ?>" class="form-control">
        </div>
        <div class="col-sm-3">
          <label for="bairro">Bairro</label>
          <input id="bairro" name="bairro" type="text" class="form-control" value="<?=(!empty($cliente))?$cliente['bairro']:'' ?>">
        </div>
        <div class="col-sm-3">
          <label for="cidade">Cidade</label>
          <input id="cidade" name="cidade" type="text" class="form-control cidade" value="<?=$viaCep->localidade; ?>" readonly="">
        </div>
        <div class="col-sm-3">
          <label for="cidade">Estado</label>
          <input id="cidade" name="estado" type="text" class="form-control estado" value="<?=$viaCep->uf; ?>" readonly="">
        </div>
      </div>
    </div>
    
    <hr>
    
    <h3>Detalhes do cartão</h3>
    <div>
      <label for="cardholderName">Titular do cartão</label>
      <input id="cardholderName" data-checkout="cardholderName" type="text" class="form-control" name="titular" value="Thiago dos Santos Alves">
      <div class="row">
        <div class="col-sm-4">
            <label for="">Data de vencimento</label>
            <div class="row">
              <div class="col-sm-6">
                <input type="text" name="vencimento_mes" placeholder="MM" id="cardExpirationMonth" data-checkout="cardExpirationMonth" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off class="form-control" maxlength="2" value="01">
              </div>
              <div class="col-sm-6">
                <input type="text" name="vencimento_ano" placeholder="YY" id="cardExpirationYear" data-checkout="cardExpirationYear" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off class="form-control" maxlength="2" value="29">
              </div>
            </div>
        </div>
          <div class="col-sm-4">
            <label for="cardNumber">Número do cartão</label>
            <input type="text" id="cardNumber" name="numero_cartao" data-checkout="cardNumber" onselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off class="form-control" name="cardNumber">
          </div>
          <div class="col-sm-4">
            <label for="securityCode">Código de segurança</label>
            <input id="securityCode" data-checkout="securityCode" type="text" nselectstart="return false" onpaste="return false" oncopy="return false" oncut="return false" ondrag="return false" ondrop="return false" autocomplete=off class="form-control">
          </div>
     </div>
     <br>
     <div class="row">
      <div id="issuerInput" class="col-sm-4">
        <label for="issuer">Banco emissor</label>
        <select id="issuer" name="issuer" data-checkout="issuer"></select>
      </div>
      <div id="bandeira" class="col-sm-4">
        <label>Bandeira</label>
        <input type="hidden" name="bandeira" value="">
        <span></span>
      </div>
          <div class="col-sm-4">
            <label for="installments">Parcelas</label>
            <select type="text" id="installments" name="installments"></select>
          </div>
     </div>
     <div>
       <input type="hidden" name="transactionAmount" id="transactionAmount" value="<?=number_format(str_replace(',', '.', $produto['frete']) + ($produto['qt'] * $produto['valor']), 2, '.', '') ?>" />
       <input type="hidden" name="paymentMethodId" id="paymentMethodId" />
       <input type="hidden" name="description" id="description" value="<?='Produto: '.$produto['nome'].' - Loja: '.$config['loja']; ?>">
       <br>
       <button type="submit" class="btn btn-success btn-lg">Pagar</button>
       <br>
     </div>
    </div>
    
  </form>
</section>
<br>
<script type="text/javascript" src="<?=BASE; ?>assets/js/mp.js"></script>