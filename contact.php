<?php
	include ('config/config.php');
	include ('layout/topo.php');
	include ('controleContato.php');

?>

<div id="conteudo-about">
	<h1 class="orange-title"> Contact us </h1>
	<p> Do you want to include your method in the StoreAnt? Please, send us a message using the form below with you contact information.
		If you have any question, please, use form below to into in contact with our project team.
	</p>
	<?php if(isset($email_enviado)): ?>
		<div id="email-enviado"><?php echo $email_enviado ?> </div>
	<?php endif; ?>
	<form id="contact-form" method="post">
		<input type="text" name ="nome" class="input-xxlarge" placeholder="Name">
		<input type="text" name="email" class="input-xxlarge" placeholder="Email">
		<input type="text" name="assunto" class="input-xxlarge" placeholder="Subject">
		<textarea name="msg"></textarea>
		<div id="btn-contact" class="btn btn-neon-orange">send!</div>
	</form>
</div>

<div class="clear"></div>
<script type="text/javascript" src="js/contact.js"></script>
<?php include ('layout/rodape.php'); ?>