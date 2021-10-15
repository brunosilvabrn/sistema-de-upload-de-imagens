<?php

namespace App\Model;
use Config\Connection;

class CriarPostagem {

	public function criarPostagem() {

		$conn = new Connection();
		$pdo = $conn->connect();

		if(isset($_POST["titulo"]) && !empty($_POST["titulo"]) && isset($_POST["descricao"]) && !empty($_POST["descricao"]) && isset($_POST["imagem"]) && !empty($_POST["imagem"])) {
	 		
	 		$titulo = filter_var($_POST["titulo"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		$descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_SPECIAL_CHARS);
	 		$img = $_POST["imagem"];
	 		
	 		$base = $GLOBALS['URL_PROJECT'];
			header("location: ".$base."administrador/novapostagem/");
	 		
	 	}else {
	 		
	 		$_SESSION["camposVazio"] = true;
	 		$base = $GLOBALS['URL_PROJECT'];
			header("location: ".$base."administrador/novapostagem/");
			
	 	}

	}
	
}