<section>
  <h1>Confirmação de Compra</h1>
  <hr>
  <?php if($alert == 1): ?>
    <div class="alert alert-success">
      <h3><strong>Parabéns!</strong></h3>
      Compra realizada com sucesso<br>
      Click em MEUS DADOS e veja todas as suas informações
    </div>
  <?php else: ?>
    <div class="alert alert-danger">
      <h3><strong>Sinto muito!</strong></h3>
      A compra não foi aprovada
    </div>
  <?php endif; ?>
</section>