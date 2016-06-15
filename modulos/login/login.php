<?php 
	include('loginControle.php');
	include (LO_LAYOUT_DIR.'topo.php');

?>
<link type="text/css" rel="stylesheet" href='css/login.css' />

<div id="conteudo" class="login-area">
	<div id="co-left">
		<img src="<?php echo IMAGENS_DIR.'logo.png'; ?>" alt="logo storeant">
		Only for registred users.<br>
		Do you want to register? <a href=<?php echo MODULOS_DIR."login/cadastro.php"?>> click here </a>
	</div>
	<div id="co-right">
		<form id="form-login" class="form-scooter-blue" method="post">
			<input type="text" name="email-login" class="input-xlarge" placeholder="Login email">
			<input type="password" name="senha-login" class="input-xlarge" placeholder="Password">
			<input type="submit" class="btn btn-neon-orange" value="Login" name="acessar">
			<div><?php echo $erro == '' ? '': $erro; ?></div>
		</form>
	</div>
	<div class="clear"></div>
</div>	