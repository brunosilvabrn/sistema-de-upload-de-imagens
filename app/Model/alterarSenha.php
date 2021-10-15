<?php

namespace App\Model;

use Config\Connection;

class AlterarSenha {

	public function alterarSenha() {
		
		$conn = new Connection();
		$pdo = $conn->connect();

		$id = $_SESSION["idUser"];
		$senhaAtual = filter_var($_POST['senhaAtual'], FILTER_DEFAULT);
		$novaSenha = filter_var($_POST['novaSenha'], FILTER_DEFAULT);
		$confirmarSenha = filter_var($_POST['confirmarSenha'], FILTER_DEFAULT);

		if(!empty($_SESSION["idUser"]) && !empty($_POST['senhaAtual']) && !empty($_POST['confirmarSenha']) && !empty($_POST['confirmarSenha'])) {
		
			if ($novaSenha != $confirmarSenha) {

				$_SESSION["confSenhaIncorreta"] = true;

				header("Location: ../../administrador/novasenha");
				

			}else {

				$db = $pdo->prepare("SELECT * FROM usuarios WHERE senha = :senha AND id = :id");
				$db->bindValue(":id", $id);
				$db->bindValue(":senha", md5($senhaAtual));
				$db->execute();

				if($db->rowCount() > 0) {

					$sql = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
					$sql->bindValue(":id", $id);
					$sql->bindValue(":senha", md5($novaSenha));
					$sql->execute();

					$_SESSION["senhaAlterada"] = true;
					header("Location: ../../administrador/novasenha");

				}else {

					$_SESSION["senhaIncorreta"] = true;
					header("Location: ../../administrador/novasenha");
					
				}

			}	



		}
		
	}

}