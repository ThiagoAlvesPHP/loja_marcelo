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

	//atualizar configurações
	public function setNewslleter($post){
		$sql = $this->db->query("SELECT * FROM cad_newsletter WHERE emails = '{$post['emails']}' ");

		if ($sql->rowCount() == 0) {
			$fields = [];
	        foreach ($post as $key => $value) {
	            $fields[] = "$key=:$key";
	        }
	        $fields = implode(', ', $fields);
			$sql = $this->db->prepare("INSERT INTO cad_newsletter SET {$fields}");

			foreach ($post as $key => $value) {
	            $sql->bindValue(":{$key}", $value);
	        }
			$sql->execute();

			return true;
		} else {
			return false;
		}
	}
}