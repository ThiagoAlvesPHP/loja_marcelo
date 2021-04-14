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
				      	<div>Produtos!</div>
				      	<a class="btn btn-warning" href="<?=BASE.'admin/produtos'; ?>">Visualizar</a>
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
</section>