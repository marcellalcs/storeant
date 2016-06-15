<?php
	include ('../../config/config.php');
	$publicacao = new Publicacao($bd, $sys_log);
	

	if(isset($_REQUEST['pbc-relacionada']) && $_REQUEST['pbc-relacionada'] == 'cadastrar'){
		$publicacao->nome = isset($_REQUEST['pbc-nome']) ? $_REQUEST['pbc-nome'] : '';
		$publicacao->id_metodo = isset($_REQUEST['id-metodo']) ? $_REQUEST['id-metodo'] : '';
		$publicacao->autores = isset($_REQUEST['pbc-autores']) ? $_REQUEST['pbc-autores'] : '';
		$publicacao->evento = isset($_REQUEST['pbc-evento']) ? $_REQUEST['pbc-evento'] : '';
		$publicacao->link_publi = isset($_REQUEST['pbc-link']) ? $_REQUEST['pbc-link'] : '';
		$publicacao->data = isset($_REQUEST['pbc-data']) ?  $_REQUEST['pbc-data'] : '';
		$publicacao->resumo = isset($_REQUEST['pbc-abstract']) ? $_REQUEST['pbc-abstract'] : '';
		
		
		if($publicacao->criar()){
			$json[] = array(
				'id' 		=>  $publicacao->id,
				'autores'	=>	$publicacao->autores,
				'nome'		=>	$publicacao->nome,
				'evento'	=>	$publicacao->evento,
				'ano'		=>	$publicacao->data,
				'link'		=> $publicacao->link_publi
			);
			echo(json_encode($json));
	}else{
		echo '[{
			"erro": "1",
			"mensagem": "Não foi possível inserir esta publicação"
		}]';
		exit;
		}
	}else
		exit;
	
	
?>