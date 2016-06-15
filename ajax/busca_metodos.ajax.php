<?php
	
	//Por seguranÃ§a e desempenho retorna o erro e termina a execuÃ§Ã£o se uma das variÃ¡veis estÃ¡ faltando
	if(!isset($_REQUEST['term']) || !isset($_REQUEST['cp']) /*|| !isset($_REQUEST['compartilhamento'])*/){
		echo '[{
			"erro": "1",
			"mensagem": "Nenhum paciente foi encontrado!"
		}]';
		exit;
	}
	
	//Insere a configuraÃ§Ã£o do sistema
	include('../../config/config.php');

	// Verifica a permissÃ£o de acesso ao aplicativo
    include_once 'ver_permissao.php';
	
	//Insere o controle de pacientes do sistema
	include(LO_APPS_DIR.'pacientes/class/Pacientes.php');

	// pega permissÃ£o do usuÃ¡rio sobre o app
	$permissao_usr_app = $app_permissao[5];
	
	/* Cria o objeto paciente */
	$paciente = new Pacientes($bd, $sys_log);
	
	$termo = mysql_real_escape_string($_REQUEST['term']);
	$opcao = mysql_real_escape_string($_REQUEST['cp']);
	// $compartilhamento = mysql_real_escape_string($_REQUEST['compartilhamento']);
	
	/* Determina as variÃ¡veis da query pelo nÂº da escolha do campo no select de busca */
	$tabelas = "lo_pacientes LEFT JOIN lo_pacientes_contatos USING (ID_Paciente)"; //" LEFT JOIN lo_pacientes_compartilhamento USING (ID_Paciente))";
	switch($opcao){
		case 0:	//CÃ³digo do paciente
			$campos = "ID_Paciente";
			break;
		case 1:	//Nome do paciente
			$campos = "Nome";
			break;
		case 2:	//CPF do paciente
			$campos = "CPF";
			break;
		case 3:	//RG do paciente
			$campos = "RG";
			break;
		case 4:	//Telefones do paciente
			$campos = "Telefone_Residencial, Telefone_Comercial, Celular";
			break;
		case 5:	//Nascimento do paciente
			$campos = "Dia_Nascimento, Mes_Nascimento, Ano_Nascimento";
			break;
		case 6:	//Data de cadastro do paciente
			$campos = "Dia_Cadastro, Mes_Cadastro, Ano_Cadastro";
			break;
		case 7:	//Empresa onde o paciente trabalha
			$campos = "Empresa";
			$tabelas = "(((lo_pacientes LEFT JOIN lo_pacientes_contatos USING (ID_Paciente)) LEFT JOIN lo_pacientes_profissao USING (ID_Paciente)))";// LEFT JOIN lo_pacientes_compartilhamento USING (ID_Paciente)
			break;
		case 8:	//Quem indicou o respectivo paciente
			$campos = "Nome_indicador";
			$tabelas = "(((lo_pacientes LEFT JOIN lo_pacientes_contatos USING (ID_Paciente)) LEFT JOIN lo_pacientes_indicacao USING (ID_Paciente)))";// LEFT JOIN lo_pacientes_compartilhamento USING (ID_Paciente)
			break;
		case 9:	//MÃªs de nascimento do paciente
			$campos = "Mes_Nascimento";
			break;
		default:
			echo '[{
				"erro": "1",
				"mensagem": "Nenhum paciente foi encontrado!"
			}]';
			exit;
	}

	/* Seleciona como serÃ¡ e monta a query */
	$query = "SELECT lo_pacientes.ID_Paciente, lo_pacientes_contatos.Telefone_Residencial, lo_pacientes_contatos.Telefone_Comercial, lo_pacientes_contatos.Celular, lo_pacientes_contatos.Email, lo_pacientes_contatos.Facebook, lo_pacientes_contatos.Skype, lo_pacientes_contatos.Twitter, lo_pacientes_contatos.Linkedin FROM $tabelas WHERE ";
	
	if(!$permissao_usr_app->visualizar && !$permissao_usr_app->editar){
		$query .= "lo_pacientes.ID_Usuario='$sys_user->id' AND ";
	}

	$query .= "lo_pacientes.ID_Conta='$sys_conta->id' ";

	$query .= "AND Deletado='0' AND (";/*lo_pacientes_compartilhamento.ID_Usuario='$sys_user->id' */
	if(($opcao == 5) || ($opcao == 6)){
		$campos = explode(",", $campos);
		$termo = explode("/", $termo);
		$query .= "$campos[0] LIKE '%$termo[0]%' AND $campos[1] LIKE '%$termo[1]%' AND $campos[2] LIKE '%$termo[2]%')";
	}
	else if($opcao == 9){
		switch ($termo) {
			case 'janeiro':
				$termo = 1;
				break;
			case 'fevereiro':
				$termo = 2;
				break;
			case 'marÃ§o':
				$termo = 3;
				break;
			case 'abril':
				$termo = 4;
				break;
			case 'maio':
				$termo = 5;
				break;
			case 'junho':
				$termo = 6;
				break;
			case 'julho':
				$termo = 7;
				break;
			case 'agosto':
				$termo = 8;
				break;
			case 'setembro':
				$termo = 9;
				break;
			case 'outubro':
				$termo = 10;
				break;
			case 'novembro':
				$termo = 11;
				break;
			case 'dezembro':
				$termo = 12;
				break;
		}
		 $query .= "$campos = '$termo')";
	}
	else{
		$campos = explode(",", $campos);
		for($i=0; $i<count($campos)-1; $i++){
			$query .= $campos[$i] ." LIKE '%$termo%' OR ";
		}
		$query .= $campos[$i]. " LIKE '%$termo%')";
	}
	

	// switch ($compartilhamento) {
	// 	case 'meus':
	// 		$query .= " AND lo_pacientes.ID_Usuario='$sys_user->id'";
	// 		break;
	// 	case 'compartilhados':
	// 		$query .= " AND lo_pacientes.ID_Usuario!='$sys_user->id'";
	// 		break;
	// 	default:
	// 		break;
	// }

	if($opcao == 9){
		$query .= " ORDER BY $campos ASC";	
	}else{
		$query .= " ORDER BY ". $campos[0] ." ASC";	
	}

	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	
	/* Insere os resultados em uma matriz (array de array) que serÃ¡ convertida para JSON,
	   caso algum registro foi encontrado, senÃ£o envia um erro e uma mensagem de erro     */
	if($num_rows < 1){	//Nenhum registro foi encontrado
		echo '[{
			"erro": "1",
			"mensagem": "Nenhum paciente foi encontrado!"
		}]';
	}
	else{	//Pelo menos um registro foi encontrado
		$json = array();
		while($row = mysql_fetch_assoc($result)){
			//Define os telefones
			$tel1 = ($row['Telefone_Residencial'] == NULL) ? "(xx)xxxx-xxxx" : $row['Telefone_Residencial'];
			$tel2 = ($row['Telefone_Comercial'] == NULL) ? "(xx)xxxx-xxxx" : $row['Telefone_Comercial'];
			//insere os resultados
			$paciente->selecionar_paciente($row['ID_Paciente'], $sys_conta->id);
			$json[] = array(
				'cod'	=>	$row['ID_Paciente'],
				'nome'	=>	$paciente->nome,
				'foto'	=>	($paciente->foto == NULL) ? IMAGENS_DIR."foto_padrao.jpg" : USUARIOS_DIR.$paciente->id_usuario.'/5/'.$paciente->foto,
				'idade'	=>	$paciente->calcular_idade(),
				'tels'	=>	$tel1 . ' / ' . $tel2,
				'celular'	=>	($row['Celular'] == NULL) ? "(xx)xxxx-xxxx" : $row['Celular'],
				'email'	=>	($row['Email'] == NULL) ? "" : $row['Email'],
				'facebook'	=>	($row['Facebook'] == NULL) ? "" : $row['Facebook'],
				'twitter'	=>	($row['Twitter'] == NULL) ? "" : $row['Twitter']
			);
		}
		echo(json_encode($json));
	}
?>
