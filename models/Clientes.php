<?php
class Clientes extends model{
	//verificar se esta logado
	public function verificarLogado(){
		if (!empty($_SESSION['lg'])) {
			return true;
		} else {
			return false;
		}
	}
	//fazer login
	public function login($post){
		$sql = $this->db->prepare('
			SELECT id FROM cad_clientes 
			WHERE email = :email
			AND senha = :senha
		');
		$sql->bindValue(':email', $post['email']);
		$sql->bindValue(':senha', md5($post['senha']));
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			$_SESSION['lg'] = $dados['id'];
			return true;
		} else {
			return false;
		}
	}
	//dados do config
	public function verificarEmail($email){
		$sql = $this->db->query("
			SELECT * FROM cad_clientes 
			WHERE email = '{$email}' 
		");

		if ($sql->rowCount() == 0) {
			return true;
		} else {
			return false;
		}
	}
	//cadatrar cliente
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_clientes SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();

		return $this->db->lastInsertId();
	}
	//atualizar cliente
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE cad_clientes 
			SET {$fields}
			WHERE id = '{$post['id']}'
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//selecionar dados de cliente
	public function get($id){
		$sql = $this->db->query("
			SELECT * FROM cad_clientes 
			WHERE id = '{$id}' 
		");

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