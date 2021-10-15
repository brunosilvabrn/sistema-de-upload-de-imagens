<?php

namespace Config;

use PDO;
require 'config/database.php';

global $pdo;

class Connection {

	public function connect() {

		try {
			
			$pdo = new PDO("mysql:dbname=".DBNAME."; host=".HOST, USER, PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $pdo;

		}catch(PDOException $e) {

			echo "ERROR: ".$e->getMessage();
			exit();

		}
	}

}
