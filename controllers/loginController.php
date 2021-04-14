<?php
class loginController extends controller {
	public function __construct(){
        if (!empty($_SESSION['cLogin'])) {
            header('Location: '.BASE.'admin');
        }
    }

	public function index() {
		$dados = array();
		$c = new Usuarios();
		$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		if (!empty($post)) {
			if ($c->login($post)) {
				header('Location: '.BASE.'admin');
			} else {
				$dados['error_login'] = true;
			}
		}
		
		$this->loadView('admin_login', $dados);
	}
}