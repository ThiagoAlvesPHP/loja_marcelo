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
	//compra
	public function compra($id){
		if (!empty($id)) {
			$dados = array();
			$compras = new Compras();
			$dados['compra'] = $compras->get(base64_decode($id));

			$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			
			$this->loadTemplateAdmin('admin_compra', $dados);	
		} else {
			header('Location: '.BASE.'admin');
		}
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
	//requisições ajax / datatable
	public function ajax(){
		$compras = new Compras();
		$dashboard = new Dashboard();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//produtos
		if (!empty($post['compras'])) {
			$requestData = $_REQUEST;
			$columns = array(
			    array(0 => 'id'),
			    array(1 => 'id_cliente'),
			    array(2 => 'codigo'),
			    array(3 => 'total'),
			    array(4 => 'status'),
			    array(5 => 'dt_registro')
			);
			$count = $dashboard->countCompras();
			$qnt_linhas = $count['c'];

			$sql = "
				SELECT 
				cad_compras.*, 
				cad_clientes.nome
				FROM cad_compras 
				INNER JOIN cad_clientes
				ON cad_compras.id_cliente = cad_clientes.id
				WHERE 1=1
			";

			if( !empty($requestData['search']['value']) ) {   
				$sql.=" AND (cad_compras.id LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR cad_clientes.nome LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR cad_compras.codigo LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR cad_compras.total LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR cad_compras.status LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR cad_compras.dt_registro LIKE '%".$requestData['search']['value']."%' )";
			}

			$array = $compras->datatableAll($sql);
			$totalFiltered = count($array);

			//Ordenar o resultado
			$sql .= " ORDER BY ". implode(' AND ', $columns[$requestData['order'][0]['column']])."   ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
			$array = $compras->datatableAll($sql);

			// Ler e criar o array de dados
			$dados = array();

			foreach ($array as $key => $value) {
				$dado = array(); 	
				
				$dado[] = '<a href="'.BASE.'admin/compra/'.base64_encode($value['id']).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
				$dado[] = $value["nome"];
				$dado[] = $value["codigo"];
				$dado[] = $value["total"];
				$dado[] = ($value['status'] == 1)?'<b style="color: green;">Aprovado</b>':'<b style="color: red;">Reprovado</b>';
				$dado[] = date('d/m/Y', strtotime($value["dt_registro"]));

				$dados[] = $dado;
			}

			//Cria o array de informações a serem retornadas para o Javascript
			$json_data = array(
				"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
				"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
				"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
				"data" => $dados   //Array de dados completo dos dados retornados da tabela 
			);

			echo json_encode($json_data);
		}
	}
	//sair
	public function sair(){
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: '.BASE);
	}
}