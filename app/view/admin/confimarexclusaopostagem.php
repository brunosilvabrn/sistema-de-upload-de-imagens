
	<main class="box">
		<div class="options-box">
			<h1 class="login-title text-center">Tem certeza que deseja excluir esta postagem?</h1>
			<span><b>Titulo: </b><?php echo $dados['titulo'] ?></span>
			<span><b>Data: </b><?php echo $dados['data'] ?></span>
			<div class="painel-form-options">
				<a class="button-painel red" href="<?php echo $GLOBALS['URL_PROJECT'] ?>administrador/confimarexclusaopostagem/<?php echo $dados['id'] ?>/excluir">Excluir</a>
			</div>
			<p class="option-bottom"><a href="administrador/menu/">Voltar para o Painel.</a></p>
		</div>
	</main>