<?php

// Error reporting:error_reporting(E_ALL^E_NOTICE);
include ('../../config/config.php');
// include "connect.php";
include "comment.class.php";


/*
/	Select all the comments and populate the $comments array with objects
*/

$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id ASC");

while($row = mysql_fetch_assoc($result))
{
	$comments[] = new Comment($row);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Coment&aacute;rios em PhP & Mysql | Lojawa.com.br | DEMO</title>

<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>
<BR><BR><BR>
<div id="main">

<?php

/*
/	Output the comments one by one:
*/

foreach($comments as $c){
	echo $c->markup();
}

?>

<div id="addCommentContainer">
	<p>Adicionar Coment&aacute;rio</p>
	<form id="addCommentForm" method="post" action="">
    	<div>
        	<label for="name">Seu nome</label>
        	<input type="text" name="name" id="name" />
            
            <label for="email">Seu E-mail</label>
            <input type="text" name="email" id="email" />
            
            <label for="url">Website (n&atilde;o requerido)</label>
            <input type="text" name="url" id="url" />
            
            <label for="body">Coment&aacute;rio</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
            
            <input type="submit" id="submit" value="Publicar" />
        </div>
    </form>
</div>

</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
