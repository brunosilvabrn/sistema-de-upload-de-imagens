
	<main class="box">	
		<div class="options-box">
			<h1 class="login-title">Adicionar Postagem</h1>
			<form class="form-send" enctype="multipart/form-data" method="POST" action="administrador/novapostagem/criarpostagem/">
				<input class="form-send-input" type="text" name="titulo" placeholder="Titulo" maxlength="100">
				<textarea class="form-send-textarea" name="descricao" rows="6" placeholder="Descrição" maxlength="255"></textarea>
				<div class="input-file-send">
					<input type="file" id="file" name="imagem" class="input-file" onchange="uploadImage(this)">
					<label for="file">
						<span id="file-name" class="file-box">Selecionar Imagem</span>
						<span class="file-button">
							Selecionar Imagem
						</span>
					</label>
				</div>
				<input class="input-send" type="submit" name="" value="Publicar postagem">
			</form>
			<p class="option-bottom"><a href="administrador/menu/">Voltar para o Painel.</a></p>
		</div>
	</main>
	<script src="static/js/targetName.js"></script>