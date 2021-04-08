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
	

		$this->loadTemplate('home', $dados);
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