<?php

namespace App\Model;

use Config\Connection;
use PDO;

class ExcluirPostagem {

	public function excluirPostagem($id) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS['URL_PROJECT'];		
		
		$this->deletarImagem($id);

		$sql = $pdo->prepare("DELETE FROM postagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		$_SESSION["excluidoComSucesso"] = true;
		header("Location: ".$base."administrador/excluirpostagem/");

	}

	public function deletarImagem($id) {

		$conn = new Connection();
		$pdo = $conn->connect();	
			
		$sql = $pdo->prepare("SELECT * FROM postagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
		
			$dados = $sql->fetch(PDO::FETCH_ASSOC);

			$base = $GLOBALS['URL_PROJECT'];
			$arquivo = $base."static/uploads/".$dados["imagem"];

			if (is_file("static/uploads/".$dados["imagem"])) {
				unlink("static/uploads/".$dados["imagem"]);
			}		
			
		}

	}

	public function secure($idUser, $idPostagem) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $idUser);
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
			$base = $GLOBALS['URL_PROJECT'];
			header("location: ".$base."administrador/excluirpostagem/");
		}

	}
	
}