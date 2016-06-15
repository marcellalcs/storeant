<?php 
	include('cadastroControle.php');
	include (LO_LAYOUT_DIR.'topo.php');
?>

<link href="css/cadastro.css" rel="stylesheet" type="text/css" />
<!-- Mensagem do sistema SYSLOG -->
<div class="<?php echo ($sys_log->GetFlag()) ? $sys_log->classe : 'none'; ?>" id="box-syslog">
	<?php $sys_log->Imprime(); ?>
</div>
<div id="conteudo" class="cadastro-area">
	<h1 class="orange-title">Cadastre-se e colabore conosco!</h1>
	<form id="form1" method="post" class="form-scooter-blue">
		<div class="box-input">Nome: </br>
			<input name="nome" type="text" class="textfield_1 input-xxlarge" id="nome" size="25" maxlength="15" onblur="verificar_nome()"/>
		</div>
		<div class="box-input"> Email: </br>
			<input name="email" type="text" class="textfield_1 input-xxlarge" id="email" size="25" maxlength="25" onblur="verificar_email()">
		</div>
		<div class="box-input"> Função: </br>
			<input name="funcao" type="text" class="textfield_1 input-xxlarge" id="funcao" size="25" maxlength="25" onblur="verificar_email()">
		</div>
		<div class="box-input"> Filiação: </br>
			<input name="filiacao" type="text" class="textfield_1 input-xxlarge" id="filiacao" size="25" maxlength="25" onblur="verificar_email()">
		</div>
		<div class="box-input">Senha: </br>
			<input name="senha" type="password" class="textfield_1" id="senha" onkeyup="testaSenha(this.value);" size="25" maxlength="15">
		</div>	
		<input name="cadastrar-usuario" type="submit" class="botao_enviar1 btn btn-scooter-blue" id="botao_enviar" value="Cadastrar"/>
	</form>
</div>