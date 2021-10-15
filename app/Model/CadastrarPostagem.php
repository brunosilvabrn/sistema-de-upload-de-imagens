<?php

namespace App\Model;

use Config\Connection;
use PDO;

class CadastrarPostagem {

	public function cadastrar() {

		$conn = new Connection();
		$pdo = $conn->connect();

		$base = $GLOBALS['URL_PROJECT'];
	
		if(!isset($_POST["titulo"]) || empty($_POST["titulo"]) || !isset($_POST["descricao"]) || empty($_POST["descricao"]) || !isset($_FILES["imagem"]) || empty($_FILES["imagem"])) {

			$_SESSION["camposVazio"] = true;
			header("Location: ".$base."administrador/novapostagem/");

		} else {

			$idUsuario = $_SESSION["idUser"];
			$dados = $this->userGetId($idUsuario);

			$titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		$descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		$nomeUsuario = $dados["nome"];
	 		$data = date('d/m/Y');
	 		$imagem = $this->uploadImagem($_FILES["imagem"]);
	 		
	 		$sql = $pdo->prepare("INSERT INTO postagens (autor, titulo, descricao, data, imagem) VALUES (:autor, :titulo, :descricao, :data, :imagem)");
	 		$sql->bindValue(":autor", $nomeUsuario);
	 		$sql->bindValue(":titulo", $titulo);
	 		$sql->bindValue(":descricao", $descricao);
	 		$sql->bindValue(":data", $data);
	 		$sql->bindValue(":imagem", $imagem);
	 		$sql->execute();
	 		
	 		if ($sql->rowCount() > 0) {

	 			$_SESSION["postagemSucesso"] = true;
				header("Location: ".$base."administrador/novapostagem/");

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

	private function uploadImagem($imagem=true) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$diretorio = 'static/uploads/';
		$gerarNome = date("YmdHis-").md5(time());
		$posicao = strpos($imagem['name'], '.');
		$extensao = substr($imagem['name'], $posicao);
		$novoNome = $gerarNome.$extensao;

		$dirImagem = $diretorio.$novoNome;

		if (move_uploaded_file($imagem['tmp_name'], $dirImagem)) {
			
			// $sql = $pdo->prepare("INSERT INTO imagens (nome) VALUES (:nome)");
			// $sql->bindValue(":nome", $novoNome);
			// $sql->execute();
				
			return $novoNome;

		}


	}
	
}