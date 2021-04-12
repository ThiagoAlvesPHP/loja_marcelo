<?php
class Compras extends model{
	//cadatrar cliente
	public function set($post, $produtos){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_compras SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();

		$id_compra = $this->db->lastInsertId();

		foreach ($produtos as $id_produto => $quantidade) {
			$produto = (new Produtos)->get($id_produto);

			$sql = $this->db->query("
				INSERT INTO cad_compra_produtos 
				SET id_compra = '{$id_compra}',
				id_produto = '{$id_produto}',
				quantidade = '{$quantidade}',
				valor = '{$produto['valor']}'
			");
		}
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