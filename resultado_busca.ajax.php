<?php

	include('config/config.php');
	
	$metodo = new Metodo($bd, $sys_log);
	
	$termo = isset($_REQUEST['busca-keyword']) ? $_REQUEST['busca-keyword']: '' ; 
	$array_coleta = isset($_REQUEST['coleta-value']) ? $_REQUEST['coleta-value']: '' ; 
	$array_recurso = isset($_REQUEST['recurso-value']) ? $_REQUEST['recurso-value']: '' ;
	$array_analise = isset($_REQUEST['analise-value']) ? $_REQUEST['analise-value']: '' ;
	$array_momento = isset($_REQUEST['momento-value']) ? $_REQUEST['momento-value']: '' ;
	
	
	$condicao_coleta = '';
	if(!empty($array_coleta) && count($array_coleta) == 1){
		$condicao_coleta = "st_coleta_metodo.Tipo_Coleta = '$array_coleta[0]'";
	}
	elseif(count($array_coleta) > 1){
		for($i=0;$i<count($array_coleta); $i++){
			if($i == 0){
				$condicao_coleta .= "(st_coleta_metodo.Tipo_Coleta = '". addslashes($array_coleta[$i]) ."' OR "	;
			}
			elseif($i == count($array_coleta) - 1){
				$condicao_coleta .= "st_coleta_metodo.Tipo_Coleta = '". addslashes($array_coleta[$i]) ."')"	;
			}else{
				$condicao_coleta .= "st_coleta_metodo.Tipo_Coleta = '" . addslashes($array_coleta[$i]) . "' OR ";
			} 
		}
	}

	$condicao_recurso = '';
	if(!empty($array_recurso) && count($array_recurso) == 1){
		$condicao_recurso = "st_metodo_recursos.Tipo_Recurso = '$array_recurso[0]' ";
	}
	elseif(count($array_recurso) > 1){
		for($i=0;$i<count($array_recurso); $i++){
			if($i == 0){
				$condicao_recurso .= "(st_metodo_recursos.Tipo_Recurso = '" . addslashes($array_recurso[$i]) ."' OR "	;
			}
			elseif($i == count($array_recurso) - 1){
				$condicao_recurso .= "st_metodo_recursos.Tipo_Recurso = '" . addslashes($array_recurso[$i]) ."') "	;
			}else{
				$condicao_recurso .= "st_metodo_recursos.Tipo_Recurso = '". addslashes($array_recurso[$i]) . "' OR ";
			} 
		}
	}
	
	
	if(empty($array_analise) || $array_analise[0] == 'Todos'){
		$condicao_analise = '';
	}else{
		$condicao_analise = "'" . $array_analise[0] . "'";
	}
	
	if(empty($array_momento) || $array_momento[0] == 'Todos'){
		$condicao_momento = '';
	}else{
		$condicao_momento = "'" . $array_momento[0] . "'";
	}
	
	$colunas = "SELECT DISTINCT st_metodo.ID_Metodo, st_metodo.Nome, st_metodo.Descricao";
	
	$tabelas = " FROM st_metodo JOIN
			  st_coleta_metodo ON
			  st_metodo.ID_Metodo = st_coleta_metodo.ID_Metodo JOIN
			  st_metodo_recursos ON
			  st_metodo.ID_Metodo = st_metodo_recursos.ID_Metodo";
	
	$condicao = '';  
	
	if($condicao_coleta != ''){
		$condicao .= $condicao_coleta;	
	}
	
	if($condicao_coleta != '' && $condicao_recurso != ''){
		$condicao .= " AND " . $condicao_recurso;
	}elseif($condicao_coleta == '' && $condicao_recurso != '') {
		$condicao .= $condicao_recurso;
	}
	
	if(($condicao_recurso != '' || $condicao_coleta != '') && $condicao_analise != ''){
		$condicao .= " AND st_metodo.Analise = " . $condicao_analise . " OR st_metodo.Analise = 'All' ";
	}elseif($condicao_recurso == '' && $condicao_analise != ''){
		$condicao .= "st_metodo.Analise = ". $condicao_analise . " OR st_metodo.Analise = 'All' ";
	}
	
	if(($condicao_recurso != '' || $condicao_coleta != '' || $condicao_analise != '') && $condicao_momento != ''){
		$condicao .= " AND st_metodo.Momento = " . $condicao_momento . "OR st_metodo.Momento = 'All'";
	}elseif($condicao_analise == '' && $condicao_momento != ''){
		$condicao .= "st_metodo.Momento = " . $condicao_momento . "OR st_metodo.Momento = 'All'";
	}
	
	if($termo != ''){
		$condicao .= "st_metodo.Nome LIKE '%" . $termo . "%'";
	}
	
	if($condicao != ''){
		$condicao = ' WHERE ' . $condicao ;
	}
		
	$query = $colunas . $tabelas . $condicao . " ORDER BY st_metodo.Nome ASC";
	$resultado = mysql_query($query);

	$dados = array();
	if ($resultado != null) {
		if (mysql_num_rows($resultado) > 0){
			for ($i = 0; $i < mysql_num_rows($resultado); $i++){
				$dados[] = mysql_fetch_array($resultado);
			}
		}
	}else{
		echo '[{
			"erro": "1",
			"mensagem": "Nenhum método foi encontrado!"
		}]';
	exit;
	}
	
	
	$json = array();
	if(count($dados)>0){
		for($i=0; $i<count($dados); $i++){
			$json[] = array(
				'id' 		=>  $dados[$i]['ID_Metodo'],
				'nome'		=>	$dados[$i]['Nome'],
				'desc'		=>	$dados[$i]['Descricao'],
			);
		}
		echo(json_encode($json));
	}else{
		echo '[{
			"erro": "1",
			"mensagem": "Nenhum método foi encontrado!"
		}]';
		exit;
	}
	
	
?>