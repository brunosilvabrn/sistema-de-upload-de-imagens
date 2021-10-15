<?php

namespace App\Controller;

use App\Model\VerificarUsuario;
use App\Model\ExcluirConta;

class ExcluirContaController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'menu';
		$url = array_filter(explode('/', $url));

		return $url;

	}

	public static function excluiContaController() {
		
		$url = self::url();
		$base = $GLOBALS['URL_PROJECT'];

		if (isset($url[2]) && $url[2] == "excluir" ) {
		
			$controle = new ExcluirConta();
			$controle->excluir();	
		 	
		}elseif(isset($url[2]) && $url[2] != "excluir" ) {
			
			header("location: ".$base."administrador/excluirconta/");

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