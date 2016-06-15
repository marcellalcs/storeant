<?php 
	include('administracaoControle.php');
	include (LO_LAYOUT_DIR.'topo.php');
?>
<link type="text/css" rel="stylesheet" href='css/administracao.css' />
<!-- Mensagem do sistema SYSLOG -->
<div class="<?php echo ($sys_log->GetFlag()) ? $sys_log->classe : 'none'; ?>" id="box-syslog">
	<?php $sys_log->Imprime();?>
</div>
<div id="conteudo" class="login-area">
	<h2 class="texto-neon-orange">Bem vindo ao painel administrativo</h2>
	<div id="barra-btn">
		<a class="btn btn-neon-orange" href="administracao.php?action=au">Autorizar Usuários</a>
		<a class="btn btn-neon-orange" href="administracao.php?action=ac">Autorizar Comentários</a>
		<a class="btn btn-neon-orange" href="administracao.php?action=am">Autorizar Métodos</a>
		<a class="btn btn-scooter-blue" href="<?php echo MODULOS_DIR.'cadastra_metodo/cadastra_metodo.php'?>">Cadastrar Métodos</a>
	</div>
	
	<div id="conteudo-pagina">
		<?php
			
			if(!isset($_REQUEST['action']) || $_REQUEST['action'] == 'au'){
				include ('administracao_au.php');
			}
			elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ac') {
				include ('administracao_ac.php');
			}
			
			?>
	</div>
	<div class="clear"></div>
</div>	