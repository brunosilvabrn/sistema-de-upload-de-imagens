<?php

namespace App\Model;

use Config\Connection;
use PDO;

class ExcluirConta {

	public function excluir() {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS['URL_PROJECT'];	

		if(isset($_POST["senha"]) && !empty($_POST["senha"])) {

			$id = $_SESSION["idUser"];
			$dados = $this->dadosUser($id);

			if (md5($_POST["senha"]) == $dados["senha"]) {
				$this->deletarPostagem($id);
				$this->deletarUser($id);
				header("Location: ".$base."home/");

			}else {

				$_SESSION["senhaIncorreta"] = true;
				header("Location: ".$base."administrador/excluirconta/");
			} 

			
		}else {

			header("location: ".$base."administrador/excluirconta/");

		}

	}

	public function deletarUser($idUser) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $idUser);
		$sql->execute();

		if($sql->rowCount() > 0) {

			return true;

		}else {

			return false;

		}

	}

	public function deletarPostagem($idUser) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $idUser);
		$sql->execute();

		$dados = $sql->fetch(PDO::FETCH_ASSOC);
		$autor = $dados["nome"];

		$db = $pdo->prepare("SELECT imagem FROM postagens WHERE autor = :autor");
		$db->bindValue(":autor", $autor);
		$db->execute();

		if ($db->rowCount() > 0){

			$dados = $db->fetchAll(PDO::FETCH_ASSOC);

			foreach ($dados as $key) {

				if(is_file("static/uploads/".$key["imagem"])) {

					unlink("static/uploads/".$key["imagem"]);
				}
			}

		}

		$db = $pdo->prepare("DELETE FROM postagens WHERE autor = :autor");
		$db->bindValue(":autor", $autor);
		$db->execute();

	}

	public function dadosUser($idUser) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
		$sql->bindValue(":id", $idUser);
		$sql->execute();

		$dados = $sql->fetch(PDO::FETCH_ASSOC);

		return $dados;

	}
	
}