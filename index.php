<?php
include ('config/config.php');
include ('layout/topo.php');


?>

<div id="conteudo">
	
	<?php
		if(isset($_REQUEST['pagina']) && $_REQUEST['pagina'] == 'md'){
			include ('metodo_descricao.php');
		}else{
			echo
			'<div id="co-left">
				<img src="img/logo.png" alt="logo storeant">
				Welcome to StoreAnt, a virtual repository tool containing information about collaborative systems evaluation methods.
				It supports researchers and prac-titioners in finding and comparing information about methods, and identifying
				methods that comply to specific criteria (e.g. how the data is collected). </br>
				<div class="link-colabore"> <a href=' . MODULOS_DIR . 'login/cadastro.php class="texto-neon-orange"> Collaborate with us </a></div>
				<div></div>
			</div>
			<div id="co-right">
				<img src="img/home.jpg" />
			</div>
			<div class="clear"></div>';
			include ('layout/barra_busca.php');
			include ('resultado_busca.php');
		}
	?>

	<!-- 
	<div id="barra-extras">
		<div class="box-extras span4">
			<div class="extras-title">
				Ranking de métodos
			</div>
			<div class="extras-slider">
				aqui slider
			</div>
		</div>
		<div class="box-extras span3">
			<div class="extras-title">
				Compare métodos
			</div>
			<div class="extras-slider">
				aqui slider
			</div>
		</div>
		<div class="box-extras span2">
			<div class="extras-title">
				Ajude-me a encontrar!
			</div>
			<div class="extras-slider">
				aqui slider
			</div>
		</div>
	</div>
	-->
</div>
<div class="clear"></div>

<?php include ('layout/rodape.php'); ?>