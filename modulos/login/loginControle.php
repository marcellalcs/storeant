<?php 
	include('../../config/config.php');
	$erro = '';
	if(isset($_POST['email-login']) && isset($_POST['senha-login'])){
			
		$sys_user = new Usuario($bd, $sys_log);

	
		if($sys_user->login($_POST['email-login'], $_POST['senha-login'])){
		
			
			header ("location: ".RAIZ_DIR);
			exit; //necessário pois o header só é executado depois que o php é todo interpretado
		}else{
			$erro = "Erro ao executar login.";
		}
	}

?>