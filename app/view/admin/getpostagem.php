
	<main class="box">	
		<div class="options-box">
			<h1 class="login-title">Editar Postagem</h1>
			<form class="form-send" enctype="multipart/form-data" method="POST" action="administrador/getpostagem/<?php echo $dados['id'] ?>/editar">
				<input class="form-send-input" type="text" value="<?php echo $dados['titulo'] ?>" name="titulo" placeholder="Titulo" maxlength="100">
				<textarea class="form-send-textarea" name="descricao" rows="6" placeholder="Descrição" maxlength="255"><?php echo $dados['descricao'] ?></textarea>
				
				<input class="input-send" type="submit" name="" value="Editar postagem">
			</form>
			<p class="option-bottom"><a href="administrador/editarpostagem/">Voltar para o Painel.</a></p>
		</div>
	</main>
	<script src="static/js/targetName.js"></script>