<?php
class homeController extends controller {
	//pagina inicial
	public function index() {
		$dados = array();
		$sql = new Home();
		$cli = new Clientes();
		$dados['c'] = $sql->getConfig();
		$dados['produto'] = $sql->getProduto();
		$img = $sql->getProdutoImg($dados['produto']['id']);
		$dados['produto']['img'] = $img['imagem'];

		//se estiver logado pegar os dados do cliente
		if (!empty($_SESSION['lg'])) {
			$dados['cliente'] = $cli->get($_SESSION['lg']);
		}

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$get = filter_input_array(INPUT_GET, FILTER_DEFAULT);

		$dados['errocep'] = '';

		if (!empty($get['errocep'])) {
			$dados['errocep'] = $get['errocep'];
		}

		$this->loadTemplate('home', $dados);
	}
	//cadastro de cliente
	public function cadastro(){
		$dados = array();
		$cli = new Clientes();
		$home = new Home();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		//cadastrar cliente
		if (!empty($post)) {
			$post['cep'] = str_replace("-", "", $post['cep']);

			$url = "http://viacep.com.br/ws/".$post['cep']."/json/";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$consulta = json_decode(curl_exec($ch));

			$post['numero_doc'] = $post['docNumber'];
			$post['tipo_doc'] = $post['docType'];
			unset($post['docNumber']);
			unset($post['docType']);
			
			//validar cep se é de estado
			if ($home->validarUF($consulta->uf)) {
				//verificar se cpf é valido		
				if ($cli->validadorCPF($post['numero_doc'])) {
					//verificar se existe algum email e cpf cadastrados
					if ($cli->verificarEmail($post['email'])) {
						//verificar se cpf esta cadastrado
						if ($cli->verificarCpf($post['numero_doc'])) {
							$post['senha'] = md5($post['senha']);
							$_SESSION['lg'] = $cli->set($post);
							header('Location: '.BASE.'home/meus_dados');
						} else {
							header('Location: '.BASE.'home/cadastro?errorCpf='.true);
						}
					} else {
						header('Location: '.BASE.'home/cadastro?errorEmail='.true);
					}
				} else {
					header('Location: '.BASE.'home/cadastro?cpf=error');
				}
			} else {
				header('Location: '.BASE.'home/cadastro?errorUf=error');
			}
		}

		$this->loadTemplate('cadastro', $dados);
	}
	//login
	public function login(){
		$dados = array();
		$cli = new Clientes();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		//validar login
		if (!empty($post)) {
			if ($cli->login($post)) {
				header('Location: '.BASE.'home/meus_dados');
			} else {
				$dados['error_login'] = true;
			}
		}

		$this->loadTemplate('login', $dados);
	}
	//dados do cliente
	public function meus_dados(){
		$cli = new Clientes();
		$sql = new Home();
		$com = new Compras();
		if ($cli->verificarLogado()) {
			$dados = array();
			$dados['cliente'] = $cli->get($_SESSION['lg']);
			$dados['compras'] = $com->getComprasCliente($_SESSION['lg']);
			$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
			//atualizar dados de cliente
			if (!empty($post['nome'])) {

				$url = "http://viacep.com.br/ws/".$post['cep']."/json/";
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$consulta = json_decode(curl_exec($ch));

				//verificar se estado foi liberado pelo sistema
				if ($sql->validarUF($consulta->uf)) {
					$post['id'] = $_SESSION['lg'];
					if (!empty($post['senha'])) {
						$post['senha'] = md5($post['senha']);
					} else {
						unset($post['senha']);
					}
					$cli->up($post);
					header('Location: '.BASE.'home/meus_dados');
				} else {
					$dados['error_cep'] = true;
				}
			}

			$this->loadTemplate('meus_dados', $dados);
		} else {
			header('Location: '.BASE);
		}
	}
	//verificar se cep é valido - action
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
		//verificar se estado foi liberado pelo sistema
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
		$cli = new Clientes();
		$config = $sql->getConfig();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$dados['cliente'] = '';

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

		//se estiver logado pegar os dados do cliente
		if (!empty($_SESSION['lg'])) {
			$dados['cliente'] = $cli->get($_SESSION['lg']);
			$dados['viaCep'] = $sql->cepConsultar($dados['cliente']['cep']);
		} else {
			$dados['viaCep'] = $sql->cepConsultar($_SESSION['cep']);
		}

		$dados['produto']['frete'] = $config['frete'];
		$dados['config'] = $config;
		//$dados['produto']['frete'] = $sql->freteCorreios($_SESSION['cep'], $dados['produto']);

		$this->loadTemplate('carrinho', $dados);
	}
	//comprar action
	public function comprar(){
		$dados = array();
		$h = new Home();
		$cli =  new Clientes();
		$com = new Compras();

		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		//caso tenha um usuario logado
		if (!empty($_SESSION['lg'])) {
			$dadosCliente = $cli->get($_SESSION['lg']);

			$id_cliente = $dadosCliente['id'];
			//array para gerar compra
			$compra = array(
				'id_cliente'=>$id_cliente,
				'codigo'=>'',
				'total'=>$post['transactionAmount'],
				'status'=>3
			);
			$transacao = $h->transacaoMP($post);
			//caso a transação seja aprovada
			if ($transacao['status'] == 'approved') {
				$compra['codigo'] = $transacao['id'];
				$compra['status'] = 1;
				$mensagem = "
					Compra Realizada com Sucesso\r\n
					Compra Codigo: ".$transacao['id']."\r\n
					Valor: R$".$post['transactionAmount']."\r\n\r\n
					Acesse: ".BASE." e saiba mais!
				";
				//enviar email
				$h->mail($dadosCliente['email'], "Compras - Albicod", $mensagem);
				$com->set($compra, $_SESSION['cart']);
				unset($_SESSION['cart']);
				header('Location: '.BASE.'home/carrinho_aprovado');
			} else {
				$compra['codigo'] = $transacao['id'];
				$compra['status'] = 2;
				$mensagem = "
					Compra não aprovada\r\n
					Compra Codigo: ".$transacao['id']."\r\n
					Valor: R$".$post['transactionAmount']."\r\n\r\n
					Acesse: ".BASE." e saiba mais!
				";
				//enviar email
				$h->mail($dadosCliente['email'], "Compras - Albicod", $mensagem);
				$com->set($compra, $_SESSION['cart']);
				unset($_SESSION['cart']);
				header('Location: '.BASE.'home/carrinho_reprovado');
			}
		} else {
			//verificar se cpf é valido		
			if ($cli->validadorCPF($post['docNumber'])) {
				//array com dados do cliente
				$dadosCliente = array(
					'nome'=>$post['nome'],
					'email'=>$post['email'],
					'senha'=>md5($post['senha']),
					'tipo_doc'=>(!empty($post['docType']))?$post['docType']:'CPF',
					'numero_doc'=>$post['docNumber'],
					'cep'=>$post['cep'],
					'endereco'=>$post['endereco'],
					'numero'=>$post['numero'],
					'complemento'=>$post['complemento'],
					'bairro'=>$post['bairro'],
					'cidade'=>$post['cidade'],
					'estado'=>$post['estado']
				);
				//verificar se existe algum email e cpf cadastrados
				if ($cli->verificarEmail($dadosCliente['email'])) {
					//verificar se cpf esta cadastrado
					if ($cli->verificarCpf($dadosCliente['numero_doc'])) {
						//salvando id cliente na session
						$_SESSION['lg'] = $cli->set($dadosCliente);
						//array para gerar compra		
						$compra = array(
							'id_cliente'=>$_SESSION['lg'],
							'codigo'=>'',
							'total'=>$post['transactionAmount'],
							'status'=>3
						);
						
						//salvando transação
						$transacao = $h->transacaoMP($post);
						//caso a transação seja aprovada
						if ($transacao['status'] == 'approved') {
							$compra['codigo'] = $transacao['id'];
							$compra['status'] = 1;
							$mensagem = "
								Compra Realizada com Sucesso\r\n
								Compra Codigo: ".$transacao['id']."\r\n
								Valor: R$".$post['transactionAmount']."\r\n\r\n
								Acesse: ".BASE." e saiba mais!
							";
							//enviar email
							$h->mail($dadosCliente['email'], "Compras - Albicod", $mensagem);
							$com->set($compra, $_SESSION['cart']);

							unset($_SESSION['cart']);
							header('Location: '.BASE.'home/carrinho_aprovado');
						} else {
							$compra['codigo'] = $transacao['id'];
							$compra['status'] = 2;
							$mensagem = "
								Compra não aprovada\r\n
								Compra Codigo: ".$transacao['id']."\r\n
								Valor: R$".$post['transactionAmount']."\r\n\r\n
								Acesse: ".BASE." e saiba mais!
							";
							//enviar email
							$h->mail($dadosCliente['email'], "Compras - Albicod", $mensagem);
							$com->set($compra, $_SESSION['cart']);
							unset($_SESSION['cart']);
							header('Location: '.BASE.'home/carrinho_reprovado');
						}
					} else {
						header('Location: '.BASE.'home/carrinho?errorCpf='.true);
					}
					
				} else {
					header('Location: '.BASE.'home/carrinho?errorEmail='.true);
				}
			} else {
				header('Location: '.BASE.'home/carrinho?cpf=error');
			}
		}	
	}
	//pagina de compra aprovada
	public function carrinho_aprovado(){
		$dados = array();
		$dados['alert'] = 1;

		$this->loadTemplate('carrinho_alert', $dados);
	}
	//pagina de compra aprovada
	public function carrinho_reprovado(){
		$dados = array();
		$dados['alert'] = 2;
		
		$this->loadTemplate('carrinho_alert', $dados);
	}
	//sair
	public function sair(){
		if (!empty($_SESSION['lg'])) {
			unset($_SESSION['lg']);
		}
		header('Location: '.BASE);
	}
	public function ajax(){
		$dados = array();
		$h = new Home();
		$cli =  new Clientes();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

		if (!empty($post['emails'])) {
			if ($h->setNewslleter($post)) {
				echo json_encode(1);
			} else {
				echo json_encode(2);
			}
		}
		//consultar cpf
		if (!empty($post['cpf'])) {
			if ($cli->validadorCPF($post['cpf'])) {
				echo json_encode(1);
			} else {
				echo json_encode(2);
			}
		}
	}
}