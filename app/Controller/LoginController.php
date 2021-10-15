<?php

namespace App\Controller;

use App\Model\VerificarUsuario;
use App\Model\CadastrarUsuario;

class LoginController {
	
	public static function url() {

		$url = (isset($_GET['url'])) ? $_GET['url'] : 'home';
		$url = array_filter(explode('/', $url));

		return $url;
	}

	public static function loginController() {

		$url = self::url();
		$base = $GLOBALS['URL_PROJECT'];

		if (isset($_SESSION['idUser']) && !empty($_SESSION['idUser'])) {
		
			header("location: ".$base."administrador/");

		}

		// Controllers Models 
		if(isset($url[1]) && !empty($url[1])) {

			$param = $url[1];

			if($param == 'verificar') {

				$login = new VerificarUsuario;
				$login->logged();

			}else if($param == 'cadastrar') {

				$login = new CadastrarUsuario;
				$login->cadastrar();

			}else {
				require 'app/view/pages/header.php';
				require 'app/view/pages/404.php';
				require 'app/view/pages/footer.php';
			}

		}else {

			if($url[0] == 'entrar') {

				require 'app/view/admin/headerEntrar.php';
				require 'app/view/admin/entrar.php';

				//Notificacoes 
				if (isset($_SESSION["senhaIncorreta"])) {

					require 'app/view/admin/notificacaoIncorreta.php';
					unset($_SESSION["senhaIncorreta"]);

				}else if(isset($_SESSION["camposVazio"])) {

					require 'app/view/admin/notificacaoCampos.php';
					unset($_SESSION["camposVazio"]);

				}

				require 'app/view/admin/footerEntrar.php';

			} else if($url[0] == 'cadastrar') {

				require 'app/view/admin/headerCadastrar.php';

				//Notificacoes Pagina De Cadastro
				if (isset($_SESSION["confSenhaIncorreta"])) {

					require 'app/view/admin/notificacaoConfSenha.php';
					unset($_SESSION["confSenhaIncorreta"]);

				}else if(isset($_SESSION["camposVazio"])) {

					require 'app/view/admin/notificacaoCampos.php';
					unset($_SESSION["camposVazio"]);


				}else if(isset($_SESSION["emailUsado"])) {
					
					require 'app/view/admin/notificacaoEmailUsado.php';
					unset($_SESSION["emailUsado"]);

				}else if(isset($_SESSION["usuarioUsado"])) {

					require 'app/view/admin/notificacaoUsuarioUsado.php';
					unset($_SESSION["usuarioUsado"]);

				}

				require 'app/view/admin/cadastrar.php';
				require 'app/view/admin/footerEntrar.php';

			}
		}
	}
}