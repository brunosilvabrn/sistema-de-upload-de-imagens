<?php

namespace App\Model;

use Config\Connection;
use PDO;

class EditarPostagem {

	public function editar($id) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS['URL_PROJECT'];

		if(!isset($_POST["titulo"]) || empty($_POST["titulo"]) || !isset($_POST["descricao"]) || empty($_POST["descricao"])) {

			header("Location: ".$base."administrador/editarpostagem/");

		} else {

			$idUsuario = $_SESSION["idUser"];
			$dados = $this->userGetId($idUsuario);

			$titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		$descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		
	 		$sql = $pdo->prepare("UPDATE postagens SET titulo = :titulo, descricao = :descricao WHERE id = :id");
	 		$sql->bindValue(":titulo", $titulo);
	 		$sql->bindValue(":descricao", $descricao);
	 		$sql->bindValue(":id", $id);
	 		$sql->execute();
	 		
	 		if ($sql->rowCount() > 0) {

	 			$_SESSION["postagemEditadaSucesso"] = true;
				header("Location: ".$base."administrador/editarpostagem/");

	 		}
			

		}


	}

	private function userGetId($id) {
		
		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		$dados = $sql->fetch(PDO::FETCH_ASSOC);

		return $dados;
	}

	public function secure($idUser, $idPostagem) {

		$conn = new Connection();
		$pdo = $conn->connect();
		
		$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		$nome = $sql->fetch(PDO::FETCH_ASSOC);
		$usuario = $nome['nome'];

		$db = $pdo->prepare("SELECT * FROM postagens WHERE id = :idPostagem");
		$db->bindValue(":idPostagem", $idPostagem);
		$db->execute();

		$dados = $db->fetch(PDO::FETCH_ASSOC);

		if($dados["autor"] == $usuario) {
			return true;
		}else {
			header("location: ".$base."/administrador/editarpostagem/");
		}

	}
	
}