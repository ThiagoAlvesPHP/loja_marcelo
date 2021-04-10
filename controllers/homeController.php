<?php
class homeController extends controller {

	public function index() {
		$dados = array();
		$sql = new Home();
		$dados['c'] = $sql->getConfig();
		$dados['produto'] = $sql->getProduto();
		$img = $sql->getProdutoImg($dados['produto']['id']);
		$dados['produto']['img'] = $img['imagem'];

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		$dados['errocep'] = '';

		if (!empty($get['errocep'])) {
			$dados['errocep'] = $get['errocep'];
		}

		$this->loadTemplate('home', $dados);
	}

	public function confirmacao(){
		$dados = array();
		$sql = new Home();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$post['cep'] = str_replace("-", "", $post['cep']);

		$url = "http://viacep.com.br/ws/".$post['cep']."/json/";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$consulta = json_decode(curl_exec($ch));

		if ($sql->validarUF($consulta->uf)) {
			//adicionando produto ao carrinho
			if (!empty($post['id_produto'])) {
				if(!isset($_SESSION['cart'])) {
	                $_SESSION['cart'] = array();
	            }
	            if(isset($_SESSION['cart'][$post['id_produto']])) {
	                $_SESSION['cart'][$post['id_produto']] += $post['quantidade'];
	            } else {
	                $_SESSION['cart'][$post['id_produto']] += $post['quantidade'];
	            }
	            $_SESSION['cep'] = $post['cep'];
	            header('Location: '.BASE.'home/carrinho');
			}
			//caso carrinho não esteja preenchido redireciona para pagina principal
			if (empty($_SESSION['cart'])) {
				header('Location: '.BASE);
			}
			
		} else {
			header('Location: '.BASE.'?errocep='.$post['cep']);
		}

		$this->loadTemplate('confirmacao', $dados);
	}
	//carrinho
	public function carrinho(){
		$dados = array();
		$sql = new Home();
		$config = $sql->getConfig();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		//caso carrinho não esteja preenchido redireciona para pagina principal
		if (empty($_SESSION['cart'])) {
			header('Location: '.BASE);
		}

		foreach ($_SESSION['cart'] as $id_produto => $quantidade) {
			$dados['produto'] = $sql->getProdutoId($id_produto);
			$dados['produto']['qt'] = $quantidade;
			$img = $sql->getProdutoImg($dados['produto']['id']);
			$dados['produto']['img'] = $img['imagem'];
		}

		$dados['viaCep'] = $sql->cepConsultar($_SESSION['cep']);

		$dados['produto']['frete'] = $config['frete'];
		$dados['config'] = $config;
		//$dados['produto']['frete'] = $sql->freteCorreios($_SESSION['cep'], $dados['produto']);

		$this->loadTemplate('carrinho', $dados);
	}
	//comprar
	public function comprar(){
		$dados = array();
		$sql = new Home();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		$dadosCliente = array(
			'nome'=>$post['nome'],
			'email'=>$post['email'],
			'senha'=>md5($post['senha']),
			'tipo_doc'=>$post['docType'],
			'numero_doc'=>$post['docNumber'],
			'cep'=>$post['cep'],
			'endereco'=>$post['endereco'],
			'numero'=>$post['numero'],
			'complemento'=>$post['complemento'],
			'bairro'=>$post['bairro'],
			'cidade'=>$post['cidade'],
			'estado'=>$post['estado']
		);

		//$transacao = $sql->transacaoMP($post);

		echo "<pre>";
		print_r($post);
		print_r($dadosCliente);
	}
	public function ajax(){
		$dados = array();
		$h = new Home();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if (!empty($post['emails'])) {
			if ($h->setNewslleter($post)) {
				echo json_encode(1);
			} else {
				echo json_encode(2);
			}
		}
	}
}