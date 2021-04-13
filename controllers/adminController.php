<?php
class adminController extends controller {
	public function __construct(){
        if (empty($_SESSION['cLogin'])) {
            header('Location: '.BASE.'login');
        }
    }

	public function index() {
		$dados = array();
		
		$this->loadTemplateAdmin('admin_dashboard', $dados);
	}
	//menu
	public function sair(){
		if (!empty($_SESSION['cLogin'])) {
			unset($_SESSION['cLogin']);
		}
		header('Location: '.BASE);
	}
}