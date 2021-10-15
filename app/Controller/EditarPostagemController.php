<?php

namespace App\Controller;

use App\Model\EditarPostagem;
use App\Model\PostagemGet;

class EditarPostagemController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'menu';
		$url = array_filter(explode('/', $url));

		return $url;

	}

	public static function editarPostagemController() {
		
		$url = self::url();
		$base = $GLOBALS['URL_PROJECT'];

		if (isset($url[2]) && is_numeric($url[2])) {

			$postagem = new PostagemGet();
			$postagem->secure($_SESSION["idUser"], $url[2]);
		 	
		}else {
			
			header("location: ".$base."/administrador/editarpostagem/");

		}


		if(isset($url[3]) && $url[3] == "editar") {

			$editar = new EditarPostagem();
			$editar->editar($url[2]);

		}
		
	}

	public static function notificacao() {
		//Notificacoes 
		if (isset($_SESSION["senhaIncorreta"])) {

			require 'app/view/admin/notificacaoIncorreta.php';
			unset($_SESSION["senhaIncorreta"]);

		}else if(isset($_SESSION["camposVazio"])) {

			require 'app/view/admin/notificacaoCampos.php';
			unset($_SESSION["camposVazio"]);

		}elseif(isset($_SESSION["postagemSucesso"])) {

			require 'app/view/admin/notificacaoPostagemSucesso.php';
			unset($_SESSION["postagemSucesso"]);
			
		}elseif(isset($_SESSION["postagemEditadaSucesso"])) {

			require 'app/view/admin/notificacaoEditadaSucesso.php';
			unset($_SESSION["postagemEditadaSucesso"]);
			
		}
	}

}