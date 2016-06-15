<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "comment.class.php";
include ('../../config/config.php');

/*
/	This array is going to be populated with either
/	the data that was sent to the script, or the
/	error messages.
/*/

$arr = array();
$validates = Comment::validate($arr);


if($validates)
{
	/* Everything is OK, insert to database: */
	$comentario = new Comment($arr, $bd, $sys_log);

	
			
	$comentario->create_comment($arr['Nome'], $arr['Email'], $arr['Mensagem'], $arr['ID_Metodo']);
	

	
	$arr['Data_Comentario'] = date('r',time());
	$arr['ID'] = mysql_insert_id();
	
	/*
	/	The data in $arr is escaped for the mysql query,
	/	but we need the unescaped variables, so we apply,
	/	stripslashes to all the elements in the array:
	/*/
	
	$arr = array_map('stripslashes',$arr);
	
	$insertedComment = new Comment($arr, $bd, $sys_log);

	/* Outputting the markup of the just-inserted comment: */

	echo json_encode(array('status'=>1,'html'=>"<div id='cmt-inserido'>Comentário inserido, aguarde moderação<div>"));

}
else
{
	/* Outputtng the error messages */
	echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>