<div>
	<h3 class="texto-neon-orange">Comentários pendentes </h3>
</div>

<table id="listaUsuarios" class="table table-neon-orange">
<thead>
	<tr class="tab-cabecalho">
		<th class="nome-c">Nome</th>
		<th class="email-c" colspan="2">Email</th>
		<th class="mensagem-c">Mensagem</th>
		<th class="data-cadastro-c">Data Cadastro</th>
		<th class="tab-checkbox">
		</th>
	</tr>
</thead>
<tbody>
	
	<?php for($i=0; $i<count($lista_comentarios); $i++): ?>
	<form method="get">
	<tr>
		<td class="nome-u"><?php echo $lista_comentarios[$i]['Nome']?></td>
		<td class="email-u" colspan="2"><?php echo $lista_comentarios[$i]['Email']?></td>
		<td class="funcao-u"><?php echo $lista_comentarios[$i]['Mensagem']?></th>
		<td class="Filiação-u"><?php echo $lista_comentarios[$i]['Data_Comentario']?></td>
		<td class="autorizar-u"> 
			<input type="hidden" name="action" value="ac" />
			<input type="hidden" name="id-comentario" value=<?php echo $lista_comentarios[$i]['ID']; ?> />
			
			<input name="liberar" type="submit" class="btn btn-neon-orange" id="btn-liberar" name="btn-liberar" value="OK"/>
		</td>
			
		</th>
	</tr>
	</form>
	<?php endfor; ?>
	
</tbody>
</table>