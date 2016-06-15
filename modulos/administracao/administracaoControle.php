<?php 
	include('../../config/config.php');
	include('classe/Administracao.php');

	$administracao = $usuario = new Administracao($bd, $sys_log);
	$lista_usuarios = $administracao->listar_usuarios_pendentes();

	

	if(isset($_REQUEST['liberar']) && $_REQUEST['liberar'] == 'OK'){
		$id = $_REQUEST['id-comentario'];
		$administracao->permitir_comentario($id);

	}
	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ac'){
		$lista_comentarios = $administracao->listar_comentarios_pendentes();
		
	}
?>

