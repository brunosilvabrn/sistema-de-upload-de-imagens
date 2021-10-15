<?php

namespace App\Model;

use Config\Connection;
use PDO;

class PostagensHome {


	public function postagens($pag) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$limite = 6;
		$pagina = $pag;
		$comeco = ($limite * $pagina) - $limite;
		
		$sql = $pdo->prepare("SELECT * FROM postagens ORDER BY id DESC LIMIT $comeco, $limite");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			
			$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
		
			return $dados;

		}else {
			return false;
		}

	}

	public function pesquisa($pag ,$pesquisa) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$limite = 6;
		$pagina = $pag;
		$comeco = ($limite * $pagina) - $limite;
		
		$sql = $pdo->prepare("SELECT * FROM postagens WHERE titulo LIKE '%$pesquisa%' OR descricao LIKE '%pesquisa%' ORDER BY id DESC LIMIT $comeco, $limite");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			
			$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
		
			return $dados;

		}else {

			return false;

		}

	}

	public function paginacao($pag) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$limite = 6;

		$sql = $pdo->prepare("SELECT * FROM postagens");
		$sql->execute();

		$total = $sql->rowCount();
		$totalPagina = ceil($total / $limite);

		$exibirButton = 2;
		$pagina = $pag;

		$anterior = (($pagina - 1) == 0) ? 1 : $pagina - 1;
		$posterior = (($pagina + 1) >= $totalPagina) ? $totalPagina : $pagina + 1;

		$esquerda = array();
		$direita = array();

		for ($i = $pagina - $exibirButton; $i <= $pagina - 1; $i++) { 

			if($i > 0) {

				array_push($esquerda, $i);
				
			}
		}
		
		for ($i = $pagina + 1; $i < $pagina + $exibirButton; $i++) { 

			if($i <= $totalPagina) {

				array_push($direita, $i);

			}
		}


		$arr = array('atual' => $pagina,'anterior' => $anterior, 'posterior' => $posterior, 'ultima' => $totalPagina, 'esquerda' => $esquerda, 'direita' => $direita);

		return $arr;

	}

	public function paginacaoPesquisa($pag, $pesquisa) {

		$conn = new Connection();
		$pdo = $conn->connect();

		$limite = 6;
		$pagina = $pag;
		$comeco = ($limite * $pagina) - $limite;
		
		$sql = $pdo->prepare("SELECT * FROM postagens WHERE titulo LIKE '%$pesquisa%' OR descricao LIKE '%pesquisa%' LIMIT $comeco, $limite");
		$sql->execute();

		$total = $sql->rowCount();
		$totalPagina = ceil($total / $limite);

		$exibirButton = 2;
		$pagina = $pag;

		$anterior = (($pagina - 1) == 0) ? 1 : $pagina - 1;
		$posterior = (($pagina + 1) >= $totalPagina) ? $totalPagina : $pagina + 1;	

		$esquerda = array();
		$direita = array();

		for ($i = $pagina - $exibirButton; $i <= $pagina - 1; $i++) { 

			if($i > 0) {

				array_push($esquerda, $i);
				
			}
		}
		
		for ($i = $pagina + 1; $i < $pagina + $exibirButton; $i++) { 

			if($i <= $totalPagina) {

				array_push($direita, $i);

			}
		}


		$arr = array('atual' => $pagina,'anterior' => $anterior, 'posterior' => $posterior, 'ultima' => $totalPagina, 'esquerda' => $esquerda, 'direita' => $direita);

		return $arr;

	}
	
}