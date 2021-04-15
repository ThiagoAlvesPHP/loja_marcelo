<section>
	<h3><i class="fas fa-shopping-cart"></i> Admin/Compra</h3>
	<hr>
	<div class="row">
		<div class="col-sm-4">
			<label>Cliente</label>
			<input type="text" disabled="" value="<?=$compra['nome']; ?>" class="form-control">
		</div>
		<div class="col-sm-1">
			<label>ID</label>
			<input type="text" disabled="" value="<?=$compra['id']; ?>" class="form-control">
		</div>
		<div class="col-sm-3">
			<label>Codigo</label>
			<input type="text" disabled="" value="<?=$compra['codigo']; ?>" class="form-control">
		</div>
		<div class="col-sm-2">
			<label>Status</label>
			<input type="text" disabled="" value="<?=($compra['status'] == 1)?'Aprovado':'Reprovado'; ?>" class="form-control">
		</div>
		<div class="col-sm-2">
			<label>Data</label>
			<input type="text" disabled="" value="<?=date('d/m/Y H:i', strtotime($compra['dt_registro'])); ?>" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10">
			<label>Produto</label>
			<input type="text" disabled="" value="<?=$compra['produtos']['nome']; ?>" class="form-control">
		</div>
		<div class="col-sm-2">
			<label>Quantidade</label>
			<input type="text" disabled="" value="<?=$compra['produtos']['quantidade']; ?>" class="form-control">
		</div>
	</div>
	<br>
	<i>Total: </i>R$<span style="color: green;"><?=$compra['total']; ?></span>
</section>
<br>