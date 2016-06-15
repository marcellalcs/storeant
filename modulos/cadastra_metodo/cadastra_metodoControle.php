<?php
	include ('../../config/config.php');
	include (LO_LAYOUT_DIR . 'topo.php');
	
	$sys_user = new Usuario($bd, $sys_log);
	$metodo = new Metodo($bd, $sys_log);
	$publicacao = new Publicacao($bd, $sys_log);
	$ferramenta = new Ferramenta($bd, $sys_log);
	
	$erro = '';
	$class_mtdinfo = 'hide-box';
	if (isset($_REQUEST['cadastrar']) && $_REQUEST['cadastrar'] == 'cadastrar') {
		
		
		$metodo->nome = $_REQUEST['nome-mtd'];
		$array_coleta = isset($_REQUEST['coleta-value']) ? $_REQUEST['coleta-value'] : '';
		$metodo->analise = isset($_REQUEST['analise-value']) ? $_REQUEST['analise-value'][0] : '';
		$metodo->momento = isset($_REQUEST['momento-value']) ? $_REQUEST['momento-value'][0] : '';
		$metodo->descricao = isset($_REQUEST['mtd-desc']) ? $_REQUEST['mtd-desc'] : '';
		$array_recurso = isset($_REQUEST['recurso-value']) ? $_REQUEST['recurso-value'] : '';
	
		$metodo->criar_metodo($array_coleta, $array_recurso)? $class_mtdinfo = 'show-box' : $class_mtdinfo = 'hide-box' ;
	}
		
	/*
		
		//info publicação artigo original
		$publicacao->nome = isset($_REQUEST['artigo-mtd']) ? $_REQUEST['artigo-mtd'] : '';
		$publicacao->id_metodo = $metodo->id;
		$publicacao->autores = isset($_REQUEST['autores-mtd']) ? $_REQUEST['autores-mtd'] : '';
		$publicacao->evento = isset($_REQUEST['evento-mtd']) ? $_REQUEST['evento-mtd'] : '';
		$publicacao->link_publi = isset($_REQUEST['link-mtd']) ? $_REQUEST['link-mtd'] : '';
		$publicacao->data = isset($_REQUEST['data-mtd']) ?  $_REQUEST['data-mtd'] : '';
		$publicacao->resumo = isset($_REQUEST['abstract-mtd']) ? $_REQUEST['abstract-mtd'] : '';
		
		$publicacao->criar();
		$metodo->atualizar_publicacao_original($publicacao->id);
	}
	if(isset($_REQUEST['pbc-relacionada']) && $_REQUEST['pbc-relacionada'] == 'cadastrar'){
		$publicacao->nome = isset($_REQUEST['pbc-nome']) ? $_REQUEST['pbc-nome'] : '';
		$publicacao->id_metodo = isset($_REQUEST['id-metodo']) ? $_REQUEST['id-metodo'] : '';
		$publicacao->autores = isset($_REQUEST['pbc-autores']) ? $_REQUEST['pbc-autores'] : '';
		$publicacao->evento = isset($_REQUEST['pbc-evento']) ? $_REQUEST['pbc-evento'] : '';
		$publicacao->link_publi = isset($_REQUEST['pbc-data']) ? $_REQUEST['pbc-data'] : '';
		$publicacao->data = isset($_REQUEST['data-mtd']) ?  $_REQUEST['data-mtd'] : '';
		$publicacao->resumo = isset($_REQUEST['pbc-abstract']) ? $_REQUEST['pbc-abstract'] : '';
		$publicacao->criar();
	}
	if(isset($_REQUEST['add-tool']) && $_REQUEST['add-tool'] == 'cadastrar'){
		$ferramenta->id_metodo = isset($_REQUEST['id-metodo']) ? $_REQUEST['id-metodo'] : '';
		$ferramenta->nome = isset($_REQUEST['tool-nome']) ? $_REQUEST['tool-nome'] : '';
		$ferramenta->descricao = isset($_REQUEST['tool-desc']) ? $_REQUEST['tool-desc'] : '';
		$ferramenta->link_tool = isset($_REQUEST['tool-link']) ? $_REQUEST['tool-link'] : '';
		$ferramenta->criar();
	}
	 */
?>