<?php
	include(LO_MODULOS_DIR.'comentarios/comment.class.php');
	
	if(isset($_REQUEST['pagina']) && isset($_REQUEST['id-met'])){
		
		$metodo = new Metodo($bd, $sys_log);
		$publicacao_principal = new Publicacao($bd, $sys_log);
		$publicacoes_relacionadas = new Publicacao($bd, $sys_log);
		$coleta = new Coleta($bd, $sys_log);
		$recurso = new Recurso($bd, $sys_log);
		$ferramentas = new Ferramenta($bd, $sys_log);
		
		$metodo->id = $_REQUEST['id-met'];
		$metodo->selecionar();
		$array_coleta = $coleta->selecionar_por_metodo($metodo->id);
		$array_recurso = $recurso->selecionar_por_metodo($metodo->id);
		
		$publicacao_principal->id = $metodo->artigo_original;
		$publicacao_principal->selecionar();
		
		$publicacoes = $publicacoes_relacionadas->selecionar_por_metodo($metodo->id);
		$ferramentas_metodo = $ferramentas->selecionar_por_metodo($metodo->id);		
		
		
		//Comentários
		
		$comments = array();
		$result = mysql_query("SELECT * FROM st_comentarios WHERE ID_Metodo = $metodo->id AND Ativo = '1' ORDER BY id DESC");
		while($row = mysql_fetch_assoc($result)){
			$comments[] = new Comment($row, $bd, $sys_log);
		}
		
	}


?>

