
	<footer>
		<?php $dados = explode('/', $_SERVER['REQUEST_URI']); ?>
		<div class="pagination">
			<a class="btn-page" href="home/1/<?php echo isset($dados[4]) ? $dados[4] : $dados[3] ?>"><</a>
		
			<?php foreach ($info['esquerda'] as $key) {?>
			<a class="btn-page" href="home/<?php echo $key; ?>"><?php echo $key; ?></a>
		<?php } ?>
			<a class="btn-page <?php echo "active" ?>" href="home/<?php echo $info['atual']; ?>/<?php echo isset($dados[4]) ? $dados[4] : $dados[3] ?>"><?php echo $info['atual']; ?></a>
			
			<?php foreach ($info['direita'] as $key) {?>
			<a class="btn-page " href="home/<?php echo $key; ?>/<?php echo isset($dados[4]) ? $dados[4] : $dados[3] ?>"><?php echo $key; ?></a>
		<?php } ?>
			<a class="btn-page" href="<?php echo $dados[2]?>/<?php echo $info['ultima'] ?>/<?php echo isset($dados[4]) ? $dados[4] : $dados[3] ?>">></a>
		</div>
	
	</footer>