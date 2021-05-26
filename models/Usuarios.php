<?php
class Usuarios extends model{
	//fazer login
	public function login($post){
		$sql = $this->db->prepare('
			SELECT id FROM cad_usuarios 
			WHERE login = :login
			AND senha = :senha
			AND status = 1
		');
		$sql->bindValue(':login', $post['login']);
		$sql->bindValue(':senha', md5($post['senha']));
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			$_SESSION['cLogin'] = $dados['id'];
			return true;
		} else {
			return false;
		}
	}
	//selecionar dados de cliente
	public function get($id){
		$sql = $this->db->query("
			SELECT * FROM cad_usuarios 
			WHERE id = '{$id}' 
		");

		return $sql->fetch(PDO::FETCH_ASSOC);
	}
	//verificar se emaile login já existem
	public function verificarLoginEmail($post, $id = ''){

		if (!empty($id)) {
			$sql = $this->db->query("
				SELECT * FROM cad_usuarios 
				WHERE id != '{$id}'
			");
			$sql = $sql->fetchAll(PDO::FETCH_ASSOC);
			foreach ($sql as $c) {
				if ($c['email'] == $post['email'] OR $c['login'] == $post['login']) {
					return false;
				} else {
					return true;
				}
			}
		} else {
			$sql = $this->db->query("
				SELECT * FROM cad_usuarios 
				WHERE email = '{$post['email']}'
				OR login = '{$post['login']}' 
			");

			if ($sql->rowCount() == 0) {
				return true;
			} else {
				return false;
			}
		}
	}
	//cadatrar de usuario
	public function set($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("INSERT INTO cad_usuarios SET {$fields}");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	//atualizar usuario
	public function up($post){
		$fields = [];
        foreach ($post as $key => $value) {
            $fields[] = "$key=:$key";
        }
        $fields = implode(', ', $fields);
		$sql = $this->db->prepare("
			UPDATE cad_usuarios 
			SET {$fields}
			WHERE id = '{$post['id']}'
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
}