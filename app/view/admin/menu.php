
	<main class="box">
		<div class="options-box">
			<h1 class="login-title">Painel De Controle</h1>
			<h3 class="user">Seja Bem Vindo(a), <?php echo $user->userName(); ?>.</h3>
			<div class="painel-form-options">
				<a class="button-painel green" href="administrador/novapostagem/">Adicionar Nova Postagem</a>
				<a class="button-painel blue" href="administrador/editarpostagem/">Ediar Postagem</a>
				<a class="button-painel red" href="administrador/excluirpostagem/">Excluir Postagem</a>
				<div class="divisor">
					<p>Opções de Usuário</p>
					<hr>
				</div>
				<a class="button-painel black-blue" href="administrador/novasenha/">Alterar senha de Usuário</a>
				<a class="button-painel red" href="administrador/excluirconta/">Excluir Conta</a>
			</div>
		</div>
	</main>