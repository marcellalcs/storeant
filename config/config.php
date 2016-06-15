<?php

/*
 * EXCLUSIVO PARA USO NO SERVIDOR
 */	
 	ini_set("display_errors", "1");
 	ini_set("display_startup_errors", "1");
 	ini_set("html_errors", "1");
 	ini_set("track_errors", "1");
	error_reporting(E_ALL ^ E_DEPRECATED);

 

	/* INCLUI OS DEFINES DO SISTEMA */

	include_once('defines.php');
	
	/* INCLUI AS CLASSES GLOBAIS DO SISTEMA */
	include(LO_CLASSES_DIR.'Bd.php');
	include(LO_CLASSES_DIR.'Usuario.php');
	include(LO_CLASSES_DIR.'Metodo.php');
	include(LO_CLASSES_DIR.'Publicacao.php');
	include(LO_CLASSES_DIR.'Coleta.php');
	include(LO_CLASSES_DIR.'Recurso.php');
	include(LO_CLASSES_DIR.'Ferramenta.php');
	include(LO_CLASSES_DIR.'SysLog.php');
	include(LO_CLASSES_DIR.'Tools.php');
	
	/* ESTALECE A CONEXÃO COM O BANCO DE DADOS */
	$bd = new Bd(SERVIDOR_BD, USUARIO_BD, SENHA_BD, NOME_BD, PREFIXO_BD);
	$bd->Connect();
	
	if(!isset($_SESSION)){
		session_start();
	}

	/*CRIA OBJ SYS_LOG*/
	$sys_log = new SysLog();
	date_default_timezone_set('America/Sao_Paulo');
	
	$tools = new Tools($bd, $sys_log);
?>
