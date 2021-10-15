<?php

namespace App\Controller;
use App\Model\CadastrarPostagem;

class novaPostagemController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'menu';
		$url = array_filter(explode('/', $url));

		return $url;

	}

	public static function novaPostagemController() {
		
		$url = self::url();
		$base = $GLOBALS['URL_PROJECT'];

		if (isset($url[2]) && $url[2] == "criarpostagem") {

			$postagem = new CadastrarPostagem();
			$postagem->cadastrar();
		 	
		}elseif(isset($url[2]) && $url[2] !== "criarpostagem") {
			
			header("location: ".$base."administrador/novapostagem/");
	
		}
		
	}

	public static function notificacao() {

		//Notificacoes Pagina De Login 
		if (isset($_SESSION["senhaIncorreta"])) {
			
			require 'app/view/admin/notificacaoIncorreta.php';
			unset($_SESSION["senhaIncorreta"]);


		}else if(isset($_SESSION["camposVazio"])) {

			require 'app/view/admin/notificacaoCampos.php';
			unset($_SESSION["camposVazio"]);

		}elseif(isset($_SESSION["postagemSucesso"])) {

			require 'app/view/admin/notificacaoPostagemSucesso.php';
			unset($_SESSION["postagemSucesso"]);
			
		}
	}

}