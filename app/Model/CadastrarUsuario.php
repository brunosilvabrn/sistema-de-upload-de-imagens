<?php

namespace App\Model;

use Config\Connection;
use App\Model\VerificarUsuario;

class CadastrarUsuario {

	public function cadastrar() {

		$conn = new Connection();
		$pdo = $conn->connect();

		if(empty($_POST['usuario']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmarSenha'])) {

			$_SESSION["camposVazio"] = true;
			header("Location: ../cadastrar/");

		} else {

			$usuario = filter_var($_POST['usuario'], FILTER_DEFAULT);
			$email = filter_var($_POST['email'], FILTER_DEFAULT);
			$senha = filter_var($_POST['senha'], FILTER_DEFAULT);
			$confirmarSenha = filter_var($_POST['confirmarSenha'], FILTER_DEFAULT);

			$db = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
			$db->bindValue(":email", $email);		
			$db->execute();

			if($db->rowCount() > 0) {

				$_SESSION["emailUsado"] = true;
				header("Location: ../cadastrar/");

			}else {

				$d = $pdo->prepare("SELECT * FROM usuarios WHERE nome = :nome");
				$d->bindValue(":nome", $usuario);
				$d->execute();


				if($d->rowCount() > 0) {

					$_SESSION["usuarioUsado"] = true;
					header("Location: ../cadastrar/");
					
				}else {
								
					if($senha != $confirmarSenha) {

						$_SESSION["confSenhaIncorreta"] = true;
						header("Location: ../cadastrar/");

					}else {

						$sql = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
						$sql->bindValue(":nome", $usuario);
						$sql->bindValue(":email", $email);
						$sql->bindValue(":senha", md5($senha));
						$sql->execute();
			
						if($sql->rowCount() > 0) {

							$redirect = new VerificarUsuario();
							$redirect->loggedGet($email, $senha);

						}

					}
				}

			}

		}


	}
	
}