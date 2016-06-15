<?php
	include('../../config/config.php');
	$usuario = new Usuario($bd, $sys_log);

	if(isset($_REQUEST['cadastrar-usuario'])){
		$usuario->nome = $_REQUEST['nome'];
		$usuario->senha= $_REQUEST['senha'];
		$usuario->email = $_REQUEST['email'];
		$usuario->funcao = $_REQUEST['funcao'];
		$usuario->filiacao = $_REQUEST['filiacao'];
		$usuario->tipo = 2;  //usuário padrão
		$usuario->ativo = 0; //usuario ainda não foi ativado pelo administrdor
		$usuario->cadastrar();
		
		mail("marcellalcs@gmail.com" , "Cadastro Storeant" , "O usuário $usuario->nome acabou de se cadastrar. Acesse o painel de administração para liberar o acesso", "From: cadastro@storeant.dcc.ufmg.br" );
	}

	

?>