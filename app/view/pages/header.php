<!DOCTYPE html>
<html lang="pt-br">
<head>
	<base href="<?php echo $GLOBALS['URL_PROJECT']; ?>">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload de Imagens</title>
	<link rel="stylesheet" type="text/css" href="static/css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>
	<nav>
		<div class="painel-logo">
			Upload Imagens
		</div>
		<div class="search">
			<form action="home/1/?search=t" method="GET">

				<input class="input-search" type="text" name="search" value="" placeholder="Pesquisar">
				
				<input class="input-sub" type="submit" name="">
				<img src="static/img/search.png">
			</form>
		</div>
		<div class="logout">
			<a href="entrar/">Entrar</a>
		</div>
	</nav>