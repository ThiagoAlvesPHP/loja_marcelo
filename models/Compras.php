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
	//compras de cliente
	public function getComprasCliente($id_cliente){
		$sql = $this->db->query("
			SELECT * FROM cad_compras 
			WHERE id_cliente = '{$id_cliente}' 
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	public function get($id){
		$sql = $this->db->query("
			SELECT 
			cad_compras.*, 
			cad_clientes.nome
			FROM cad_compras 
			INNER JOIN cad_clientes
			ON cad_compras.id_cliente = cad_clientes.id
			WHERE cad_compras.id = '{$id}' 
		");

		$dados = $sql->fetch(PDO::FETCH_ASSOC);
		$dados['produtos'] = $this->getProdutosCompra($dados['id']);

		return $dados;
	}
	//cadatrar cliente
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE cad_compras 
			SET {$fields}
			WHERE id = '{$post['id']}'
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//produtos da compra
	public function getProdutosCompra($id_compra){
		$sql = $this->db->query("
			SELECT 
			cad_compra_produtos.*, 
			cad_produtos.nome
			FROM cad_compra_produtos 
			INNER JOIN cad_produtos
			ON cad_compra_produtos.id_produto = cad_produtos.id
			WHERE cad_compra_produtos.id_compra = '{$id_compra}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//consulta data datatable
	public function datatableAll($sql){
		$sql = $this->db->query($sql);
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getSearch($mes, $ano){
		$sql = $this->db->query("
			SELECT 
			cad_compras.*, 
			cad_clientes.nome
			FROM cad_compras 
			INNER JOIN cad_clientes
			ON cad_compras.id_cliente = cad_clientes.id
			WHERE MONTH(cad_compras.dt_registro) = '{$mes}' 
			AND YEAR(cad_compras.dt_registro) = '{$ano}'
			AND cad_compras.status = 1
			ORDER BY cad_compras.dt_registro DESC
		");

		return $sql->fetchAll(PDO::FETCH_ASSOC);;
	}
}