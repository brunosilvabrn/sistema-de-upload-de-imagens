	<main class="box">
		<div class="options-box editar-postagem-scroll">
			<h1 class="login-title">Excluir Postagem</h1>
			<p class="option-top"><a href="administrador/menu/">Voltar para o painel.</a></p>
			<table class="table">
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Id</th>
			      <th scope="col">Titulo</th>
			      <th scope="col" class="w120px">Data</th>
			      <th scope="col" class="w95px">Excluir</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php if($dados) { foreach ($dados as $key) { ?>
			    <tr>
			      <th scope="row"><?php echo $key["id"] ?></th>
			      <td><?php echo $key["titulo"] ?></td>
			      <td><?php echo $key["data"] ?></td>
			      <td><a class="button-deletar" href="administrador/confimarexclusaopostagem/<?php echo $key["id"] ?>">Deletar</a></td>
			    </tr>
			    <?php } }?>
			  </tbody>
			</table>	
		</div>
	</main>