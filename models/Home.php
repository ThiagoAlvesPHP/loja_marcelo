<?php
class Home extends model{
	//dados do config
	public function getConfig(){
		$sql = $this->db->query("SELECT * FROM cad_config");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//dados do produto
	public function getProduto(){
		$sql = $this->db->query("SELECT * FROM cad_produtos");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//imagem do produto
	public function getProdutoImg($id_produto){
		$sql = $this->db->query("
			SELECT imagem FROM cad_produto_imagens 
			WHERE id_produto = '{$id_produto}'
		");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//dados do produto
	public function getProdutoId($id){
		$sql = $this->db->query("SELECT * FROM cad_produtos WHERE id = '{$id}' ");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//selecionar estados validos
	public function getUf(){
		$sql = $this->db->query("SELECT * FROM cad_estados WHERE status = 1");
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//validar estado
	public function validarUF($uf){
		$sql = $this->db->query("
			SELECT * FROM cad_estados 
			WHERE uf = '{$uf}' 
			AND status = 1
		");
		if ($sql->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	//calcular frete
	public function freteCorreios($cepDestination, $dados) {
		//cep de origem 13825000
		$sCepOrigem = "13825000";
		$array = array(
			'price' => 0,
			'date' => '',
		);

		$nVlPeso = floatval($dados['peso']);
		$nVlComprimento = floatval($dados['comprimento']);
		$nVlAltura = floatval($dados['altura']);
		$nVlLargura = floatval($dados['largura']);
		$nVlDiametro = floatval($dados['diametro']);
		$nVlValorDeclarado = floatval($dados['valor'] * $dados['qt']);

		$soma = $nVlComprimento + $nVlAltura + $nVlLargura;
		
		if ($soma < 45) {
			$nVlComprimento = 15;
			$nVlAltura = 15;
			$nVlLargura = 15;
		}

		if($soma > 200) {
			$nVlComprimento = 66;
			$nVlAltura = 66;
			$nVlLargura = 66;
		}

		if ($nVlValorDeclarado < 20.1) {
			$nVlValorDeclarado = 0;
		}

		if($nVlDiametro > 90) {
			$nVlDiametro = 90;
		}

		if($nVlPeso > 40) {
			$nVlPeso = 40;
		}
		if ($nVlPeso == 0) {
			$nVlPeso = 0.1;
		}

		//40010 - 04510
		$data = array(
			'nCdServico' => '40010',
			'sCepOrigem' => $sCepOrigem,
			'sCepDestino' => $cepDestination,
			'nVlPeso' => $nVlPeso,
			'nCdFormato' => '1',
			'nVlComprimento' => $nVlComprimento,
			'nVlAltura' => $nVlAltura,
			'nVlLargura' => $nVlLargura,
			'nVlDiametro' => $nVlDiametro,
			'sCdMaoPropria' => 'n',
			'nVlValorDeclarado' => $nVlValorDeclarado,
			'sCdAvisoRecebimento' => 'n',
			'StrRetorno' => 'xml'
		);

		$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
		$data = http_build_query($data);

		$ch = curl_init($url.'?'.$data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$r = curl_exec($ch);
		$r = simplexml_load_string($r);

		$array['price'] = current($r->cServico->Valor);
		$array['date'] = current($r->cServico->PrazoEntrega);

		return $array;
	}
	//consultar cep
	public function cepConsultar($cep){
		$url = "https://viacep.com.br/ws/".$cep."/xml/";

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$r = curl_exec($ch);
		$r = simplexml_load_string($r);

		return $r;
	}
	//TRANSAÇÃO
	public function transacaoMP($post){
		MercadoPago\SDK::setAccessToken("TEST-3797020972438326-052422-ce17294d3464630399bf2bb218a700b9-490976225");

	    $payment = new MercadoPago\Payment();
	    $payment->transaction_amount = (float)$post['transactionAmount'];
	    $payment->token = $post['token'];
	    $payment->description = $post['description'];
	    $payment->installments = (int)$post['installments'];
	    $payment->payment_method_id = $post['paymentMethodId'];
	    $payment->payer = array("email" => $post['email']);

	    $payment->save();

	    $resposta = array(
	        'status' => $payment->status,
	        'status_detail' => $payment->status_detail,
	        'id' => $payment->id
	    );
	    return $resposta;
	}

	//email de notificãção de compra
	public function mail($email, $assunto, $mensagem){

		$headers = array(
		    'From' => 'thiagoalves@albicod.com',
		    'Reply-To' => 'albicod.com@gmail.com',
		    'X-Mailer' => 'PHP/' . phpversion()
		);

		mail($email, $assunto, $mensagem, $headers);
	}
}