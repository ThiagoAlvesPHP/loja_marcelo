<?php
class Config extends model{
	//selecionar dados de cliente
	public function get(){
		$sql = $this->db->query("SELECT * FROM cad_config");
		return $sql->fetch(PDO::FETCH_ASSOC);
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
			UPDATE cad_config 
			SET {$fields}
		");

		foreach ($post as $key => $value) {
            $sql->bindValue(":{$key}", $value);
        }
		$sql->execute();
	}
	
}