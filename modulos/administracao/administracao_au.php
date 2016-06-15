<div>
	<h3 class="texto-neon-orange">Usuários pendentes </h3>
</div>

<table id="listaUsuarios" class="table table-neon-orange">
<thead>
	<tr class="tab-cabecalho">
		<th class="nome-u">Nome</th>
		<th class="email-u" colspan="2">Email</th>
		<th class="funcao-u">Função</th>
		<th class="Filiação-u">Filiação</th>
		<th class="data-cadastro-u">Data Cadastro</th>
		<th class="tab-checkbox">
		</th>
	</tr>
</thead>
<tbody>
	<?php for($i=0; $i<count($lista_usuarios); $i++): ?>
	<tr>
		<td class="nome-u"><?php echo $lista_usuarios[$i]['Nome']?></th>
		<td class="email-u" colspan="2"><?php echo $lista_usuarios[$i]['Email']?></th>
		<td class="funcao-u"><?php echo $lista_usuarios[$i]['Funcao']?></th>
		<td class="Filiação-u"><?php echo $lista_usuarios[$i]['Filiacao']?></th>
		<td class="data-cadastro-u"><?php echo $lista_usuarios[$i]['Data_Cadastro']?></th>
		<td class="autorizar-u"> <div class="btn btn-neon-orange"> OK </div>
			
		</th>
	</tr>
	<?php endfor; ?>
</tbody>
</table>