<?php

namespace App\Model;

class Logout {

	public function logout() {
		
		if(isset($_SESSION["idUser"])) {
			session_destroy();
		}

		header("Location: ../../entrar/");
		exit();
	}

}