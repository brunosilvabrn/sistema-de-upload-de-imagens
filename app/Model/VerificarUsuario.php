<?php

namespace App\Model;

use Config\Connection;

class VerificarUsuario {

	public function logged() {
		
		$conn = new Connection();
		$pdo = $conn->connect();

		if(!isset($_POST['usuario']) || !isset($_POST['senha'])) {
			$_SESSION["camposVazio"] = true;
			header("Location: ../entrar/");
		}

		$usuario = filter_var($_POST['usuario'], FILTER_DEFAULT);
		$senha = filter_var($_POST['senha'], FILTER_DEFAULT);

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(":email", $usuario);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0) {

			$dados = $sql->fetch();
			$_SESSION["idUser"] = $dados["id"];
			header("Location: ../administrador/");

			return true;

		}else if(empty($usuario) || empty($senha)) {

			$_SESSION["camposVazio"] = true;
			header("Location: ../entrar/");

		}else {

			$_SESSION["senhaIncorreta"] = true;
			header("Location: ../entrar/");

		}

		// header("Location: ../entrar/");
	}

	public function loggedGet($usuario, $senha) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
		$sql->bindValue(":email", $usuario);
		$sql->bindValue(":senha", md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0) {

			$dados = $sql->fetch();
			$_SESSION["idUser"] = $dados["id"];

			header("Location: ../administrador/");

		}

	}
	
}