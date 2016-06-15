<?php

include ('layout/topo.php');


?>

<div id="conteudo">
	<div class="<?php echo ($sys_log->GetFlag()) ? $sys_log->classe : 'none'; ?>" id="box-syslog">
	<?php $sys_log->Imprime(); ?>
</div>
	área do usuário
</div>