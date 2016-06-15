<?php

	if(isset($_REQUEST['nome'])){
		$msg = "Contato Storeant - Nome: " . $_REQUEST['nome'] . "Email: " . $_REQUEST['email'] . "<br>" . $_REQUEST['msg']; 
			
		if(mail('marcellalcs@gmail.com', '[STOREANT] Contato', $msg)){
			$email_enviado = "Your message was send! Thanks";
		};
	}

?>