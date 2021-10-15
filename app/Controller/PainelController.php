<?php

namespace App\Controller;

use App\Model\UserName;
use App\Model\Logout;
use App\Model\AlterarSenha;
use App\Model\EditarPostagem;
use App\Model\PostagemGet;
use App\Controller\NovaPostagemController;
use App\Controller\EditarPostagemController;
use App\Controller\ExcluirPostagemController;
use App\Controller\ExcluirContaController;

class PainelController {

	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'menu';
		$url = array_filter(explode('/', $url));

		return $url;

	}

	public static function painelController() {

		if(isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])) {

			$url = self::url();

			$user = new UserName();

			if (!isset($url[1])) {

				require 'app/view/admin/headerPainel.php';
				require 'app/view/admin/menu.php';

			}elseif($url[1] == 'novasenha'){

				if(isset($url[2]) && $url[2] == 'alterarsenha') {

					$novasenha = new AlterarSenha();
					$novasenha->alterarSenha();

				}else {

				require 'app/view/admin/headerEntrar.php';
				require 'app/view/admin/novaSenha.php';

				if (isset($_SESSION["confSenhaIncorreta"])) {

					require 'app/view/admin/notificacaoConfSenha.php';
					unset($_SESSION["confSenhaIncorreta"]);

				}elseif(isset($_SESSION["senhaAlterada"])) {

					require 'app/view/admin/notificacaoSenhaAlterada.php';
					unset($_SESSION["senhaAlterada"]);

				}elseif (isset($_SESSION["senhaIncorreta"])) {

					require 'app/view/admin/notificacaoIncorreta.php';
					unset($_SESSION["senhaIncorreta"]);

				}

				require 'app/view/admin/footerEntrar.php';

				}

			}elseif($url[1] == 'excluirconta') {

				require 'app/view/admin/headerEntrar.php';

				$control = new ExcluirContaController();
				$control->notificacao();
				$control->excluiContaController();
				
				require 'app/view/admin/excluirConta.php';
				require 'app/view/admin/footerEntrar.php';

			}elseif($url[1] == 'sair') {

				$logged = new Logout();
				$logged->logout();

			}else {

				if(file_exists('app/view/admin/'.$url[1].'.php')) {
					
					if ($url[1] == "novapostagem") {

						$control = new NovaPostagemController();
						$control->notificacao();											
						$control->novaPostagemController();
						
					}elseif($url[1] == "getpostagem") {

						$control = new EditarPostagemController();					
						$control->editarPostagemController();

						$info = new PostagemGet();
						$dados = $info->getPostagem($url[2]);


					}elseif($url[1] == "editarpostagem" || $url[1] == "excluirpostagem") {

						$control = new EditarPostagemController();
						$control->notificacao();

						$id = $_SESSION['idUser'];

						$info = new PostagemGet();						
						$dados = $info->userGetPostagens($id);

					}elseif($url[1] == "confimarexclusaopostagem") {

						$info = new PostagemGet();
						$dados = $info->getPostagem($url[2]);

						$excluir = new ExcluirPostagemController();

						$excluir->excluirPostagemController();

					}

					if($url[1] == "excluirpostagem") {

						$notificacao = new ExcluirPostagemController();
						$notificacao->notificacao();

					}

					require 'app/view/admin/headerPainel.php';
					require 'app/view/admin/'.$url[1].'.php';
					require 'app/view/admin/footerPainel.php';
				
				}else {

					require 'app/view/admin/headerPainel.php';
					require 'app/view/pages/404.php';
					require 'app/view/admin/footerPainel.php';

				}

			}		 	

		} else {
			
			$base = $GLOBALS['URL_PROJECT'];				
			header("Location: ".$base."entrar/");

		}
		
	}

}