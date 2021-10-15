<?php

namespace App\Model;
use Config\Connection;

class UserName {

	public function userName() {

		$id = $_SESSION["idUser"];

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		$dados = $sql->fetch();

		return $dados["nome"];
	}
	
}