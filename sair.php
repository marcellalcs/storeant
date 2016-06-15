<?php 
	include('config/config.php');
		session_destroy();
		header ("location: ". RAIZ_DIR);
		exit; //necessário pois o header só é executado depois que o php é todo interpretado
?>