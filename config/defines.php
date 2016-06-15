<?php	

	/* CONFIGURA��ES DO BANCO DE DADOS 
	define('SERVIDOR_BD', 'mysql.dcc.ufmg.br');
	define('USUARIO_BD', 'storeant');
	define('SENHA_BD', 'storeantMingal');
	*/
	
		
	define('SERVIDOR_BD', 'localhost');
	define('USUARIO_BD', 'root');
	define('SENHA_BD', '');
	
	define('NOME_BD', 'storeant');
	define('PREFIXO_BD', 'st_');
	
	/* Diret�rios (com http) para links, imagens, ... */
	define('RAIZ_GERAL_DIR', 'http://localhost/');
	//define('RAIZ_GERAL_DIR', 'http://www.storeant.dcc.ufmg.br/');
	define('RAIZ_DIR', RAIZ_GERAL_DIR . 'repo/');
	//define('RAIZ_DIR', RAIZ_GERAL_DIR . '/');
	define('APPS_DIR', RAIZ_DIR . 'apps/');
	define('BOOTSTRAP_DIR', RAIZ_DIR . 'bootstrap/');
	define('CLASSES_DIR', RAIZ_DIR . 'classes/');
	define('CONFIG_DIR', RAIZ_DIR . 'config/');
	define('CSS_DIR', RAIZ_DIR . 'css/');
	define('ICONES_DIR', RAIZ_DIR . 'icones/');
	define('IMAGENS_DIR', RAIZ_DIR . 'img/');
	define('JQUERY_DIR', RAIZ_DIR . 'jquery/');
	define('LAYOUT_DIR', RAIZ_DIR . 'layout/');
	define('MODULOS_DIR', RAIZ_DIR . 'modulos/');
	define('USUARIOS_DIR', RAIZ_DIR . 'usuarios/');
	define('CLINICAS_DIR', RAIZ_DIR . 'clinicas/');
	
	/* Diretórios (sem http) para includes */
	define('LO_RAIZ_GERAL_DIR', $_SERVER['DOCUMENT_ROOT']);
	define('LO_RAIZ_DIR', LO_RAIZ_GERAL_DIR . '/repo/');
	//define('LO_RAIZ_DIR', LO_RAIZ_GERAL_DIR . '/');
	define('LO_APPS_DIR', LO_RAIZ_DIR . 'apps/');
	define('LO_BOOTSTRAP_DIR', LO_RAIZ_DIR . 'bootstrap/');
	define('LO_CLASSES_DIR', LO_RAIZ_DIR . 'classes/');
	define('LO_CONFIG_DIR', LO_RAIZ_DIR . 'config/');
	define('LO_CSS_DIR', LO_RAIZ_DIR . 'css/');
	define('LO_ICONES_DIR', LO_RAIZ_DIR . 'icones/');
	define('LO_IMAGENS_DIR', LO_RAIZ_DIR . 'img/');
	define('LO_JQUERY_DIR', LO_RAIZ_DIR . 'jquery/');
	define('LO_LAYOUT_DIR', LO_RAIZ_DIR . 'layout/');
	define('LO_MODULOS_DIR', LO_RAIZ_DIR . 'modulos/');
	define('LO_USUARIOS_DIR', LO_RAIZ_DIR . 'usuarios/');
	define('LO_CLINICAS_DIR', LO_RAIZ_DIR . 'clinicas/');

	/* Configura��es de seguran�a */
	define('TOKEN_SEG', 'Jo40eJ24Ms59rM69Rs');
?>
