<?php
class adminController extends controller {
	public function __construct(){
        if (empty($_SESSION['cLogin'])) {
            header('Location: '.BASE.'login');
        }
    }

	public function index() {
		$dados = array();
		$d = new Dashboard();
		$dados['countCliente'] = $d->countCliente();
		$dados['countCompras'] = $d->countCompras();
		$dados['countProdutos'] = $d->countProdutos();
		$dados['countUsuarios'] = $d->countUsuarios();

		$this->loadTemplateAdmin('admin_dashboard', $dados);
	}
	//configurações
	public function config(){
		$dados = array();
		$c = new Config();
		$dados['config'] = $c->get();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//atualizar config
		if (!empty($post['loja'])) {
			$c->up($post);
			header('Location: '.BASE.'admin/config');
		}
		//alterar favicon
		if (!empty($_FILES['favicon'])) {
			if ($_FILES['favicon']['type'] == 'image/webp') {
				//caso imagem exista em pasta excluir imagem
				if (file_exists("assets/img/".$dados['config']['favicon'])) {
					unlink("assets/img/".$dados['config']['favicon']);
				}
				$post['favicon'] = md5($_FILES['favicon']['tmp_name'].time().rand(0,999)).'.webp';
				$c->up($post);
				move_uploaded_file($_FILES['favicon']['tmp_name'], 'assets/img/'.$post['favicon']);
				header('Location: '.BASE.'admin/config');
			} else {
				$dados['errorImg'] = true;
			}
		}
		//alterar logo
		if (!empty($_FILES['logo'])) {
			if ($_FILES['logo']['type'] == 'image/webp') {
				//caso imagem exista em pasta excluir imagem
				if (file_exists("assets/img/".$dados['config']['logo'])) {
					unlink("assets/img/".$dados['config']['logo']);
				}
				$post['logo'] = md5($_FILES['logo']['tmp_name'].time().rand(0,999)).'.webp';
				$c->up($post);
				move_uploaded_file($_FILES['logo']['tmp_name'], 'assets/img/'.$post['logo']);
				header('Location: '.BASE.'admin/config');
			} else {
				$dados['errorImg'] = true;
			}
		}
		//alterar imagem topo
		if (!empty($_FILES['imagem'])) {
			if ($_FILES['imagem']['type'] == 'image/webp') {
				//caso imagem exista em pasta excluir imagem
				if (file_exists("assets/img/".$dados['config']['imagem'])) {
					unlink("assets/img/".$dados['config']['imagem']);
				}
				$post['imagem'] = md5($_FILES['imagem']['tmp_name'].time().rand(0,999)).'.webp';
				$c->up($post);
				move_uploaded_file($_FILES['imagem']['tmp_name'], 'assets/img/'.$post['imagem']);
				header('Location: '.BASE.'admin/config');
			} else {
				$dados['errorImg'] = true;
			}
		}


		$this->loadTemplateAdmin('admin_config', $dados);
	}
	//clientes
	public function clientes(){
		$dados = array();
		
		$this->loadTemplateAdmin('admin_clientes', $dados);
	}
	//compras
	public function compras(){
		$dados = array();
		
		$this->loadTemplateAdmin('admin_compras', $dados);
	}
	//produtos
	public function produtos(){
		$dados = array();
		
		$this->loadTemplateAdmin('admin_produtos', $dados);
	}
	//produtos
	public function usuarios(){
		$dados = array();
		
		$this->loadTemplateAdmin('admin_usuarios', $dados);
	}
	//sair
	public function sair(){
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: '.BASE);
	}
}