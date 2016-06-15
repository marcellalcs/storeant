<?php

if(!isset($_SESSION)){
	session_start();
}

//Restringe o accesso: permite ou nega o acesso a uma página
function Autorizado($usuariosAutorizados, $gruposAutorizados, $userName, $grupoUsuario) {
  //Por segurança, inicia-se com visitante não autorizado.
  $valido = false;

  //Se um visitante não está logado, então a sessão de usuário está vazia. 
  if (!empty($userName)) {
    //Transforma as strings em arrays. 
    $arrayUsers = explode(",", $usuariosAutorizados);
    $arrayGroups = explode(",", $gruposAutorizados);
	//Se o usuário está na array, então seu acesso é válido
    if (in_array($userName, $arrayUsers)) {
      $valido = true;
    }
	//Se o grupo do usuário está na array, então o acesso desse grupo é válido
    if (in_array($grupoUsuario, $arrayGroups)) {
      $valido = true;
    }
  }
  
  return $valido; 
}

?>