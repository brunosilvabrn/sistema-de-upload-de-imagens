<?php

namespace App\Controller;

use App\Model\PostagensHome;

class HomeController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'home';
		$url = array_filter(explode('/', $url));

		return $url;
	}

	public static function homeController() {

		$url = self::url();

		$pag = isset($url[1]) ? $url[1] : '1';

		if (isset($_GET['search']) && !empty($_GET['search'])) {

			$posts = new PostagensHome();
			$dados = $posts->pesquisa($pag, $_GET['search']);

		}elseif(isset($_GET['search']) && empty($_GET['search'])) {

			$base = $GLOBALS['URL_PROJECT'];
			header("location: ".$base."home/");
			
		}else {

			$posts = new PostagensHome();
			$dados = $posts->postagens($pag);

		}

		require 'app/view/pages/header.php';
		
		if($dados) {

			require 'app/view/pages/postagens.php';

			if (isset($_GET['search']) && !empty($_GET['search'])) {

				$info = $posts->paginacaoPesquisa($pag, $_GET['search']);

			}else {

				$info = $posts->paginacao($pag);

			}			
		
			require 'app/view/pages/pagination.php';
			require 'app/view/pages/footer.php';

		}else {

			require 'app/view/pages/nenhumapostagem.php';
			
		}
		
		
		

		
	}

}