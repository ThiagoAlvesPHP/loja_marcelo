<section>
	<h3><i class="fas fa-tachometer-alt"></i> Admin/Dashboard</h3>
	<hr>
	<div class="row">
	  	<div class="col-sm-3">
	      <div class="alert alert-success">
			<div class="row">
			  	<div class="col-sm-3">
			    	<i class="fas fa-users fa-5x"></i>
			  	</div>
			  	<div class="col-sm-9 text-right">
			      	<div style="font-size: 30px;">
			        	<?=$countCliente['c']; ?>                
			      	</div>
			      	<div>Clientes!</div>
			      	<a class="btn btn-success" href="<?=BASE.'admin/clientes'; ?>">Visualizar</a>
			  	</div>
			</div>
	      </div>
	    </div>
	    <div class="col-sm-3">
	      	<div class="alert alert-primary">
	          	<div class="row">
				  	<div class="col-sm-3">
				  		<i class="fas fa-shopping-cart fa-5x"></i>
				  	</div>
				  	<div class="col-sm-9 text-right">
				      	<div style="font-size: 30px;">
				        	<?=$countCompras['c']; ?>               
				      	</div>
				      	<div>Compras!</div>
				      	<a class="btn btn-primary" href="<?=BASE.'admin/compras'; ?>">Visualizar</a>
				  	</div>
				</div>
	      	</div>
	    </div>
	    <div class="col-sm-3">
	      	<div class="alert alert-warning">
	         	<div class="row">
				  	<div class="col-sm-3">
				  		<i class="fab fa-product-hunt fa-5x"></i>
				  	</div>
				  	<div class="col-sm-9 text-right">
				      	<div style="font-size: 30px;">
				        	<?=$countProdutos['c']; ?>           
				      	</div>
				      	<div>Produto!</div>
				      	<a class="btn btn-warning" href="<?=BASE.'admin/produto'; ?>">Visualizar</a>
				  	</div>
				</div>
	      	</div>
	    </div>
	    <div class="col-sm-3">
	      	<div class="alert alert-danger">
	          	<div class="row">
				  	<div class="col-sm-3">
				    	<i class="fas fa-user-friends fa-5x"></i>
				  	</div>
				  	<div class="col-sm-9 text-right">
				      	<div style="font-size: 30px;">
				        	<?=$countUsuarios['c']; ?>               
				      	</div>
				      	<div>Usuários!</div>
				      	<a class="btn btn-danger" href="<?=BASE.'admin/usuarios'; ?>">Visualizar</a>
				  	</div>
				</div>
	      	</div>
	    </div>
	</div>
	<hr>
	<h3>Consultar Entradas</h3>
	<form method="GET">
		<div class="row">
			<div class="col-sm-5">
				<label>Mês</label>
				<select name="mes" class="form-control">
					<?php 
					for ($i=1; $i < 13; $i++): 
					$i = (strlen($i) == 1)?'0'.$i:$i;
					?>
						<option><?=$i; ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="col-sm-5">
				<label>Ano</label>
				<select name="ano" class="form-control">
					<?php for ($i=2021; $i < 2031; $i++): ?>
						<option><?=$i; ?></option>
					<?php endfor; ?>
				</select>
			</div>
			<div class="col-sm-2">
				<label>Ação</label>
				<button class="btn btn-info btn-block">Consultar</button>
			</div>
		</div>
	</form>
	<hr>
	<?php if(!empty($search)): ?>
		<div class="table table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Ação</th>
						<th>Cliente</th>
						<th>Codigo</th>
						<th>Total</th>
						<th>Registrado em</th>
					</tr>
				</thead>
				<?php $total = 0; foreach ($search as $s): $total += $s['total']; ?>
				<tbody>
					<tr>
						<td>
							<a href="<?=BASE.'admin/compra/'.base64_encode($s['id']); ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
						</td>
						<td><?=$s['nome']; ?></td>
						<td><?=$s['codigo']; ?></td>
						<td><?='R$'.number_format($s["total"], 2, ',', '.'); ?></td>
						<td><?=date('d/m/Y', strtotime($s["dt_registro"])); ?></td>
					</tr>
				</tbody>
				<?php endforeach; ?>
			</table>
		</div>
		<i>Total:</i> R$<span style="color: green; font-size: 30px; font-weight: bold;"><?=number_format($total, 2, ',', '.'); ?></span>
	<?php endif; ?>
</section>