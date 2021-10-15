<?php

namespace App\Controller;

use App\Model\ExcluirPostagem;
use App\Model\PostagemGet;

class ExcluirPostagemController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'menu';
		$url = array_filter(explode('/', $url));

		return $url;

	}

	public static function excluirPostagemController() {
		
		$url = self::url();
		$base = $GLOBALS['URL_PROJECT'];

		if (isset($url[2]) && is_numeric($url[2])) {
			
			$controle = new ExcluirPostagem();
			$controle->secure($_SESSION["idUser"], $url[2]);
		 	
		}else {

			header("location: ".$base."administrador/excluirpostagem/");
		}


		if(isset($url[3]) && $url[3] == "excluir") {
			
			$excluir = new ExcluirPostagem();
			$excluir->excluirPostagem($url[2]);

		}elseif(isset($url[3]) && $url[3] != "excluir") {

			header("location: ".$base."administrador/excluirpostagem/");

		}
		
	}

	public static function notificacao() {
		//Notificacoes
		if (isset($_SESSION["senhaIncorreta"])) {

			require 'app/view/admin/notificacaoIncorreta.php';
			unset($_SESSION["senhaIncorreta"]);

		}	
	}

}