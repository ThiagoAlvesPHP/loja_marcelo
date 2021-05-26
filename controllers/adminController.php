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
		$compras = new Compras();
		$dados['countCliente'] = $d->countCliente();
		$dados['countCompras'] = $d->countCompras();
		$dados['countProdutos'] = $d->countProdutos();
		$dados['countUsuarios'] = $d->countUsuarios();

		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		if (!empty($get['mes']) && !empty($get['ano'])) {
			$dados['search'] = $compras->getSearch($get['mes'], $get['ano']);
		}

		$this->loadTemplateAdmin('admin_dashboard', $dados);
	}
	//configurações
	public function config(){
		$dados = array();
		$c = new Config();
		$dados['config'] = $c->get();
		$dados['estados'] = $c->getEstados();
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
		//atualizar status de estados
		if (!empty($post['status'])) {
			$array = array();
			foreach ($post as $id) {
				$array = $id;
			}
			$c->upEstados($array);
			header('Location: '.BASE.'admin/config');
		}


		$this->loadTemplateAdmin('admin_config', $dados);
	}
	//clientes
	public function clientes(){
		$dados = array();
		$this->loadTemplateAdmin('admin_clientes', $dados);
	}
	//cliente
	public function cliente($id){
		if (!empty($id)) {
			$dados = array();
			$cliente = new Clientes();
			$dados['cliente'] = $cliente->get(base64_decode($id));

			$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			//enviar link de rastreamento
			if (!empty($post)) {
				$post['id'] = base64_decode($id);
				$cliente->up($post);
				header('Location: '.BASE.'admin/cliente/'.$id);
			}
			
			$this->loadTemplateAdmin('admin_cliente', $dados);	
		} else {
			header('Location: '.BASE.'admin');
		}
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
			//enviar link de rastreamento
			if (!empty($post)) {
				$post['id'] = base64_decode($id);
				$compras->up($post);
				header('Location: '.BASE.'admin/compra/'.$id);
			}
			
			$this->loadTemplateAdmin('admin_compra', $dados);	
		} else {
			header('Location: '.BASE.'admin');
		}
	}
	//produtos
	public function produto(){
		$dados = array();
		$produto = new Produtos();
		$dados['produto'] = $produto->get();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		//enviar link de rastreamento
		if (!empty($post)) {
			$produto->up($post);
			header('Location: '.BASE.'admin/produto/');
		}
		//alterar favicon
		if (!empty($_FILES['imagem'])) {
			if ($_FILES['imagem']['type'] == 'image/webp') {
				//caso imagem exista em pasta excluir imagem
				if (file_exists("assets/img/produtos/".$dados['produto']['imagem']['imagem'])) {
					unlink("assets/img/produtos/".$dados['produto']['imagem']['imagem']);
				}
				$post['imagem'] = md5($_FILES['imagem']['tmp_name'].time().rand(0,999)).'.webp';
				$produto->upImgProduto($post);
				move_uploaded_file($_FILES['imagem']['tmp_name'], 'assets/img/produtos/'.$post['imagem']);
				header('Location: '.BASE.'admin/produto');
			} else {
				$dados['errorImg'] = true;
			}
		}

		$this->loadTemplateAdmin('admin_produto', $dados);
	}
	//usuarios
	public function usuarios(){
		$dados = array();
		$usuario = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if (!empty($post)) {
			if ($usuario->verificarLoginEmail($post)) {
				$post['senha'] = md5($post['senha']);
				$usuario->set($post);
				header('Location: '.BASE.'admin/usuarios/');
			} else {
				$dados['errorUsuario'] = true;
			}
		}
		
		$this->loadTemplateAdmin('admin_usuarios', $dados);
	}
	//editar usuario
	public function usuario($id){
		if (!empty($id)) {
			$dados = array();
			$usuario = new Usuarios();
			$dados['usuario'] = $usuario->get(base64_decode($id));

			$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			//enviar link de rastreamento
			if (!empty($post)) {
				$post['id'] = base64_decode($id);
				if ($usuario->verificarLoginEmail($post, base64_decode($id))) {
					if (!empty($post['senha'])) {
						$post['senha'] = md5($post['senha']);
					} else {
						unset($post['senha']);
					}
					$usuario->up($post);
					header('Location: '.BASE.'admin/usuario/'.$id);
				} else {
					$dados['errorUsuario'] = true;
				}
			}
			
			$this->loadTemplateAdmin('admin_usuario', $dados);	
		} else {
			header('Location: '.BASE.'admin');
		}
	}

	//requisições ajax / datatable
	public function ajax(){
		$compras = new Compras();
		$dashboard = new Dashboard();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//compras
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
				$dado[] = 'R$'.number_format($value["total"], 2, ',', '.');
				$dado[] = ($value['status'] == 1)?'<b style="color: green;">Aprovado</b>':'<b style="color: red;">Reprovado</b>';
				$dado[] = date('d/m/Y', strtotime($value["dt_registro"]));

				$dados[] = $dado;
			}
		}
		//clientes
		if (!empty($post['clientes'])) {
			$requestData = $_REQUEST;
			$columns = array(
			    array(0 => 'id'),
			    array(1 => 'nome'),
			    array(2 => 'email'),
			    array(3 => 'numero_doc'),
			    array(4 => 'status'),
			    array(5 => 'dt_registro')
			);
			$count = $dashboard->countCliente();
			$qnt_linhas = $count['c'];

			$sql = "SELECT * FROM cad_clientes WHERE 1=1";

			if( !empty($requestData['search']['value']) ) {   
				$sql.=" AND (id LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR nome LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR email LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR numero_doc LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR status LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR dt_registro LIKE '%".$requestData['search']['value']."%' )";
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
				$dado[] = '<a href="'.BASE.'admin/cliente/'.base64_encode($value['id']).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
				$dado[] = $value["nome"];
				$dado[] = $value["email"];
				$dado[] = $value["numero_doc"];
				$dado[] = ($value['status'] == 1)?'<b style="color: green;">Ativo</b>':'<b style="color: red;">Inativo</b>';
				$dado[] = date('d/m/Y', strtotime($value["dt_registro"]));
				$dados[] = $dado;
			}
		}
		//usuarios
		if (!empty($post['usuarios'])) {
			$requestData = $_REQUEST;
			$columns = array(
			    array(0 => 'id'),
			    array(1 => 'nome'),
			    array(2 => 'email'),
			    array(3 => 'login'),
			    array(4 => 'status')
			);
			$count = $dashboard->countCliente();
			$qnt_linhas = $count['c'];

			$sql = "SELECT * FROM cad_usuarios WHERE 1=1";

			if( !empty($requestData['search']['value']) ) {   
				$sql.=" AND (id LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR nome LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR email LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR login LIKE '%".$requestData['search']['value']."%' ";
				$sql.=" OR status LIKE '%".$requestData['search']['value']."%' )";
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
				$dado[] = '<a href="'.BASE.'admin/usuario/'.base64_encode($value['id']).'" class="btn btn-primary"><i class="fas fa-edit"></i></a>';
				$dado[] = $value["nome"];
				$dado[] = $value["email"];
				$dado[] = $value["login"];
				$dado[] = ($value['status'] == 1)?'<b style="color: green;">Ativo</b>':'<b style="color: red;">Inativo</b>';
				$dados[] = $dado;
			}
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
	//sair
	public function sair(){
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: '.BASE.'login');
	}
}