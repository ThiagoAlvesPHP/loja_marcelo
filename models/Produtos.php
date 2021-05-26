<?php
class Produtos extends model{
	////dados do produto
	public function get(){
		$sql = $this->db->query("SELECT * FROM cad_produtos");
		$dados = $sql->fetch(PDO::FETCH_ASSOC);
		$dados['imagem'] = $this->imgProduto($dados['id']);
		return $dados;
	}
	public function imgProduto($id_produto){
		$sql = $this->db->query("
			SELECT * FROM cad_produto_imagens 
			WHERE id_produto = '{$id_produto}'
		");
		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	public function upImgProduto($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE cad_produto_imagens SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//cadatrar cliente
	public function setCartao($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_cliente_cartoes SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}

	//atualizar produto
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("UPDATE cad_produtos SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
}