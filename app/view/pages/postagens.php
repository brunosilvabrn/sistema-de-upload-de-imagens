
	<main class="box">		
		 <?php foreach ($dados as $key) {?>
		<div class="card">
			<h2 class="card-title"><?php echo $key["titulo"]; ?></h2>
			<img src="static/uploads/<?php echo $key["imagem"]; ?>">
			<p class="card-text"><?php echo $key["descricao"]; ?></p>
			<small><?php echo $key["data"]; ?></small>
			<div class="card-footer">
				<a class="buttom-download" download="img-<?php echo $key["id"]; ?>-download" href="static/uploads/<?php echo $key["imagem"]; ?>">Download</a>
				<p class="name-user"><span class="p400">Autor: </span><?php echo $key["autor"]; ?></p>
			</div>
		</div>
	<?php } ?>
		</div>
	</main>
