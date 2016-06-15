
	
	/*
	if( !isset($_REQUEST['coleta']) &&
	 	!isset($_REQUEST['analise']) &&
	 	!isset($_REQUEST['momento']) &&
		!isset($_REQUEST['geral']) &&
		!isset($_REQUEST['origem']) &&
		!isset($_REQUEST['palavra-chave'])
		){
			echo '[{
				"erro": "1",
				"mensagem": "Nenhum critério de busca foi configurado!"
			}]';
			exit;
		}
		
	$metodo = New Metodo ($bd, $sys_log);
	
	definição das variáveis de busca	
	isset($_REQUEST['coleta']) ? $coleta = $_REQUEST['coleta'] : $coleta = '';
	isset($_REQUEST['analise']) ? $analise = $_REQUEST['analise'] : $analise = '';
	isset($_REQUEST['momento']) ? $momento = $_REQUEST['momento'] : $momento = '';
	isset($_REQUEST['geral']) ? $geral = $_REQUEST['geral'] : $geral = '';
	isset($_REQUEST['origem']) ? $origem = $_REQUEST['origem'] : $origem = '';
	isset($_REQUEST['palavra-chave']) ? $palavra_chave = $_REQUEST['palavra-chave'] : $palavra_chave = '';
	
	
	//busca sobre coleta
	$criterio_coleta = "";
	if($coleta != ''){
		$criterio_coleta .= "Coleta = '$coleta[0]'";
		for($i = 1; count($coleta)< $i; $i++){
			$criterio_coleta .= " OR 'Coleta' = '$coleta[$i]'";
		}
	}

	//busca sobre análise
	$criterio_analise = "";
	if($analise != ''){
		$criterio_analise .= "Analise = '$analise[0]'";
		for($i = 1; count($analise)< $i; $i++){
			$criterio_analise .= " OR 'Analise' = '$analise[$i]'";
		}
	}
	//busca sobre momento
	$criterio_momento = "";
	if($momento != ''){
		$criterio_momento .= "Momento = '$momento[0]'";
		for($i = 1; count($momento)< $i; $i++){
			$criterio_momento .= " OR 'Momento' = '$momento[$i]'";
		}
	}
	//busca sobre geral
	$criterio_geral = "";
	if($geral != ''){
		$criterio_geral .= "Geral = '$geral[0]'";
		for($i = 1; count($momento)< $i; $i++){
			$criterio_geral .= " OR 'Geral' = '$geral[$i]'";
		}
	}
	//busca sobre origem
	$criterio_origem = "";
	if($origem != ''){
		$criterio_origem .= "Origem = '$origem[0]'";
		for($i = 1; count($origem)< $i; $i++){
			$criterio_origem .= " OR 'Origem' = '$origem[$i]'";
		}
	}
	//busca sobre palavra-chave
	
	
	//Montagem query
	$tabela = $metodo->_tabela;
	$colunas = "*";
	$condicao = $criterio_coleta . $criterio_analise . $criterio_momento . $criterio_geral . $criterio_origem;
	$resultado = $metodo->_bd->Select($colunas, $tabela, $condicao);
	
	if(count($resultado)>0){
		$json = array();
		for($i = 0; $i<count($resultado); $i++){
			$json[] = array(
				'id'		=> $resultado[$i]['ID_Metodo'],
				'nome' 		=> $resultado[$i]['Nome'],
				'coleta'	=> $resultado[$i]['Coleta'],
				'analise' 	=> $resultado[$i]['Analise'],
				'momento'	=> $resultado[$i]['Momento'],
				'geral'		=> $resultado[$i]['Geral'],
				'origem'	=> $resultado[$i]['Origem'],
				'artigo'	=> $resultado[$i]['Artigo_Original'],
			);
		}
	}
	echo(json_encode($json));
	
	/*
