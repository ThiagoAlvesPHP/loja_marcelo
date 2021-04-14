<?php
class Dashboard extends model{
	//total de clientes cadastrados
	public function countCliente(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM cad_clientes");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//total de compras
	public function countCompras(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM cad_compras");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//total de produtos
	public function countProdutos(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM cad_produtos");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//total de usuarios
	public function countUsuarios(){
		$sql = $this->db->query("SELECT COUNT(*) as c FROM cad_usuarios");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	
}