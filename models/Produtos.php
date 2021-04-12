<?php
class Produtos extends model{
	////dados do produto
	public function get($id){
		$sql = $this->db->query("SELECT * FROM cad_produtos WHERE id = '{$id}'");
		return $sql->fetch(PDO::FETCH_ASSOC);
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
}