<?php 
	include('cadastra_metodoControle.php');
?>
<link type="text/css" rel="stylesheet" href='css/cadastra_metodo.css' />
<link type="text/css" rel="stylesheet" href=<?php echo LO_CSS_DIR . 'barra_busca.css'?> />

<!-- Modal adicionar publicação relacionada-->
<div id="dialog-add-publi" style="display: none;" title="Add Publication">
	<form id="add-publi" method="post">
		<input type="text" name="pbc-nome" id="pbc-nome" class="input-xlarge" placeholder="Publication titlte"/>
		<input type="text" name="pbc-autores" class="input-xlarge" placeholder="Authors (separated by ;)"/>
		<input type="text" name="pbc-evento" class="input-medium" placeholder="Event"/>
		<input type="text" name="pbc-data" class="input-small" placeholder="Year"/>
		<input type="text" name="pbc-link" id="pbc-link" class="input-xlarge" placeholder="Publication Link"/>
		<input type="hidden" name="id-metodo" value="<?php echo $metodo->id != '' ? $metodo->id : '' ; ?>"/>
		<input type="hidden" name="pbc-relacionada" value="cadastrar"/>
	</form>
</div>
<!-- Modal adicionar ferramenta-->
<div id="dialog-add-tool" style="display: none;" title="Add Tool">
	<form id="add-tool" method="post">
		<div id="tool-img"></div>
		<div id="inputs-box">
			<input type="text" name="tool-nome" id="tool-nome" class="input-xxlarge" placeholder="Tool Name"/>
			<input type="text" name="tool-link" class="input-xxlarge" placeholder="Link to tool"/>
			<textarea class="input-xxlarge" name="tool-desc" id="tool-desc" />Descrição</textarea>
			<input type="hidden" name="id-metodo" value="<?php echo $metodo->id != '' ? $metodo->id : '' ; ?>"/>
			<input type="hidden" name="add-tool" value="cadastrar"/>
		</div>
	</form>
</div>

<div id="conteudo" class="cadastra-metodo-area">
	<h1 class="texto-neon-orange"> Registration methods </h1>
	<form id="cadastra-metodo-form" method="post" class="form-scooter-blue">
		<div id="id-mtd">
			<label>Method Name</label>
			<input type="text" name="nome-mtd" class="input-xxlarge" placeholder="Method Name" value="<?php echo $metodo->nome != '' ? $metodo->nome : '' ; ?>"/></br>
			<label>Description</label>
			<textarea class="input-xxlarge" name="mtd-desc"> <?php echo $metodo->descricao; ?></textarea>
		</div>	
		<div id="class-mtd">
			<div id="barra-busca">	
				<div id="barra-busca-box">
					<div class="cat-busca-box">
						<div class="cat-busca-title">
							<div class="ico-cat coleta"></div>
							<div>Data collection method <span class="cat-dados-info">?</span></div>
						</div>
						<div class="cat-busca-valores">
							<ul>
								<li><input type="checkbox" name="coleta-value[]" class="coleta-value" value="Todas"/>All</li>
								<li><input type="checkbox" name="coleta-value[]" class="coleta-value" value="Inspection"/>Inspection</li>
								<li><input type="checkbox" name="coleta-value[]" class="coleta-value" value="Observation in controled environmen"/>Observation in controled environmen</li>
								<li><input type="checkbox" name="coleta-value[]" class="coleta-value" value="Observation in natural setting"/>Observation in natural setting</li>
								<li><input type="checkbox" name="coleta-value[]" class="coleta-value" value="Users' opinion or experiment measuments"/>Users' opinion or experiment measuments</li>
							</ul>
						</div>
					</div>
					<div class="cat-busca-box">
						<div class="cat-busca-title">
							<div class="ico-cat analise"></div>
							<div>Analysis <span class="cat-dados-info">?</span></div>
						</div>
						<div class="cat-busca-valores">
							<ul>
								<li><input type="checkbox" name="analise-value[]" class="analise-value" value="Todas"/>All</li>
								<li><input type="checkbox" name="analise-value[]" class="analise-value" value="Qualitative"/>Qualitative</li>
								<li><input type="checkbox" name="analise-value[]" class="analise-value" value="Quantitative"/>Quantitative</li>
							</ul>
						</div>
					</div>
					<div class="cat-busca-box">
						<div class="cat-busca-title">
							<div class="ico-cat momento"></div>
							<div>Moment of aplication<span class="cat-dados-info">?</span></div>
						</div>
						<div class="cat-busca-valores">
							<ul>
								<li><input type="checkbox" name="momento-value[]" class="momento-value" value="Todos"/>All</li>
								<li><input type="checkbox" name="momento-value[]" class="momento-value" value="Summative"/>Summative</li>
								<li><input type="checkbox" name="momento-value[]" class="momento-value" value="Formative"/>Formative</li>
							</ul>
						</div>
					</div>
					<div class="cat-busca-box">
						<div class="cat-busca-title">
							<div class="ico-cat general"></div>
							<div>Scope <span class="cat-dados-info">?</span></div>
						</div>
						<div class="cat-busca-valores">
							<ul>
								<li><input type="checkbox" name="recurso-value[]" class="recurso-value" value="General"/>General</li>
								<li><input type="checkbox" name="recurso-value[]" class="recurso-value" value="Specific"/>Specific</li>
								
							</ul>
						</div>
					</div>
					<div class="cat-busca-box recursos-box">
						<div class="cat-busca-title">
							<div class="ico-cat origem"></div>
							<div>Origin <span class="cat-dados-info" title="New: new method proposed specifically for collaborative systems. Adapted: an existent method that was changed in order to evaluate collaborative systems. Generic: methods that can be used to evaluate collaborative systems but that have not been specifically proposed or adapted for the collaborative context ">?</span></div>
						</div>
						<div class="cat-busca-valores">
							<ul>
								<li><input type="checkbox" name="recurso-value[]" class="recurso-value" value="General"/>New</li>
								<li><input type="checkbox" name="recurso-value[]" class="recurso-value" value="Specific"/>Adapted</li>
								<li><input type="checkbox" name="recurso-value[]" class="recurso-value" value="Specific"/>Generic</li>
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<input type="submit" class="btn btn-scooter-blue" name="cadastrar" value="cadastrar"/>
	</form>
	<div id="box-hidden-mtdinfo" class="<?php echo $class_mtdinfo?> ">	
		<div id="box-publi">
			<h2 class="texto-neon-orange"> Publications</h2>
			<div id="conteiner-pm">
				
			</div>
			<div id="btn-add-publi" class="btn btn-neon-orange"> + Publication </div>
		</div>
		<div id="box-tools">
			<h2 class="texto-neon-orange">Tools</h2>
			<div id="btn-add-tool" class="btn btn-neon-orange"> + Tool </div>
			<div class='fm-cards'>
				<div class="fmc-img"><img src="img/fm-logo2.png"></div>
				<div class="fmc-desc">
					<span class="fmc-title">Tool Name</span></br>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/cadastra_metodo.js"></script>