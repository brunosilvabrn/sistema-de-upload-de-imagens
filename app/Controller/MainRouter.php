<?php

namespace App\Controller;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\PainelController;
// Controlador da Rota Principal
class MainRouter {

	public static function router() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'home';
		$url = array_filter(explode('/', $url));

		return $url;
	}
	
	public static function app() {

		$page = self::router();

		if($page[0] == 'home') {

			$home = new HomeController();
			$home->homeController();

		}elseif ($page[0] == 'entrar' or $page[0] == 'cadastrar') {
			
			$login = new LoginController();
			$login->loginController();

		}elseif($page[0] == 'administrador'){

			if(!isset($_SESSION["idUser"]) || empty($_SESSION["idUser"])) {

				$base = $GLOBALS['URL_PROJECT'];
				header("Location: ".$base."entrar/");
				
			}else {
				
				$painel = new PainelController();
				$painel->painelController();
				
			}

		}else {

			require 'app/view/pages/header.php';
			require 'app/view/pages/404.php';
			require 'app/view/pages/footer.php';

		}
	}
}