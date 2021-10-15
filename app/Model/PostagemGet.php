<?php

namespace App\Model;

use Config\Connection;
use PDO;

class PostagemGet {

	public function getPostagem($id) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS["URL_PROJECT"];

		$sql = $pdo->prepare("SELECT * FROM postagens WHERE id = :id ORDER BY id DESC");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {

			$dados = $sql->fetch(PDO::FETCH_ASSOC);
			
			return $dados;

		}else {

			header("location: ".$base."administrador/menu/");

		}
	}

	public function postagensGet() {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT * FROM postagens ORDER BY id DESC");
		
		$sql->execute();

		if ($sql->rowCount() > 0) {
			
			$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
		
			return $dados;

		}else {

			return false;

		}
	}

	public function userGetPostagens($id) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$db = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id ORDER BY id DESC");
		$db->bindValue(":id", $id);
		$db->execute();

		if ($db->rowCount() > 0) {
			$dados = $db->fetch(PDO::FETCH_ASSOC);
			$nome = $dados["nome"];
			$sql = $pdo->prepare("SELECT * FROM postagens WHERE autor = :nome ORDER BY id DESC");
			$sql->bindValue(":nome", $nome);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				
				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);

				return $dados;

			}else {

				return false;
				
			}

		}

		

	}

	public function secure($idUser, $idPostagem) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS['URL_PROJECT'];
		
		$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $idUser);
		$sql->execute();

		$nome = $sql->fetch(PDO::FETCH_ASSOC);
		$usuario = $nome['nome'];

		// echo $usuario; exit();

		$db = $pdo->prepare("SELECT * FROM postagens WHERE id = :idPostagem");
		$db->bindValue(":idPostagem", $idPostagem);
		$db->execute();

		$dados = $db->fetch(PDO::FETCH_ASSOC);

		if($dados["autor"] == $usuario) {
			return true;
		}else {
			header("location: ".$base."administrador/editarpostagem/");
		}

	}

	
}