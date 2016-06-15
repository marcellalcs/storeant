<div id="barra-busca">
	<div id="barra-busca-box">
		<span class="orange-title"> Search by category</span>
		<form id="form-busca-cat" name="form-busca-cat">
			<div class="cat-busca-box">
				<div class="cat-busca-title">
					<div class="ico-cat coleta"></div>
						Data collection method <span class="cat-dados-info" title="describes how the data is collected in the method.">?</span>
				</div>
				<div class="cat-busca-valores">
					<ul>
						<li><label title="All options"><input type="checkbox" id ="sl-coleta-all" name="coleta-value[]" class="coleta-value" value="Todos"/>All</label></li>
						<li><label title="Inspection on the interface"><input type="checkbox" class ="sl-coleta" name="coleta-value[]" class="coleta-value" value="Inspection"/>Inspection</label></li>
						<li><label title="Tests involving users on labs"><input type="checkbox" class ="sl-coleta" name="coleta-value[]" class="coleta-value" value="Observation in controlled environment"/>Observation in controlled environment</label></li>
						<li><label title="Observation on natural user enviroment"><input type="checkbox" class ="sl-coleta" name="coleta-value[]" class="coleta-value" value="Observation in natural setting"/>Observation in natural setting</label></li>
						<li><label title="Colect users opinions"><input type="checkbox" class ="sl-coleta" name="coleta-value[]" class="coleta-value" value="Users' opinion or experiment measuments"/>Users' opinion or experiment measuments</label></li>
					</ul>
				</div>
			</div>
			<div class="cat-busca-box">
				<div class="cat-busca-title">
					<div class="ico-cat analise"></div>
					Analysis <span class="cat-dados-info" title="what type of analysis the method yields.">?</span>
				</div>
				<div class="cat-busca-valores">
					<ul>
						<li><label title="All options"><input type="checkbox" id="sl-analise-all" name="analise-value[]" class="analise-value" value="Todos"/>All</label></li>
						<li><label title="Quantitative aprouch"><input type="checkbox" class="sl-analise" name="analise-value[]" class="analise-value" value="Quantitative"/>Quantitative </label></li>
						<li><label title="Qualitative aprouch"><input type="checkbox" class="sl-analise" name="analise-value[]" class="analise-value" value="Qualitative"/>Qualitative </label></li>
					</ul>
				</div>
			</div>
			<div class="cat-busca-box">
				<div class="cat-busca-title">
					<div class="ico-cat momento"></div>
					Moment <span class="cat-dados-info" title="The moment of the systems development in which the method should be applied, before or after the development process">?</span>
				</div>
				<div class="cat-busca-valores">
					<ul>
						<li><label title="All options"><input type="checkbox" id="sl-momento-all" name="momento-value[]" class="momento-value" value="Todos"/>All</label></li>
						<li><label title="The method should be applied after the systems development"><input type="checkbox" class="sl-momento" name="momento-value[]" class="momento-value" value="Summative"/>Summative</label></li>
						<li><label title="the method should be applied before the systems development"><input type="checkbox" class="sl-momento" name="momento-value[]" class="momento-value" value="Formative"/>Formative</label></li>
					</ul>
				</div>
			</div>
			<div class="cat-busca-box recursos-box">
				<div class="cat-busca-title">
					<div class="ico-cat recursos"></div>
					Resources <span class="cat-dados-info" title="Wich resources are necessary to apply the method">?</span>
					<div class="cat-busca-more-info"> </div>
				</div>
				<div class="cat-busca-valores">
					<ul>
						<li><label title="All options"><input type="checkbox" id="sl-recursos-all" name="recurso-value[]" class="recurso-value" value="Todos"/>All</label></li>
						<li><label title="Specialist interface evaluation"><input type="checkbox" class="sl-recursos" name="recurso-value[]" class="recurso-value" value="Specialist"/>Specialist</label></li>
						<li><label title="Users to the system"><input type="checkbox" class="sl-recursos" name="recurso-value[]" class="recurso-value" value="Users"/>Users</label></li>
						<li><label title="Facility that provides controlled conditions"><input type="checkbox" class="sl-recursos" name="recurso-value[]" class="recurso-value" value="Laboratory"/>Laboratory</label></li>
						<li><label title="Tools to capture informations from interviews"><input type="checkbox" class="sl-recursos" name="recurso-value[]" class="recurso-value" value="Enterview materials"/>Interview materials</label></li>
					</ul>
				</div>
			</div>
			<div id="box-keyword">
				<input type="text" class="input-xxlarge" name="busca-keyword" placeholder="keyword search" />
				<div id="btn-search" class="btn btn-neon-orange">Search</div>
			</div>
		</form>
		<!-- 
			<span class="orange-title"> Busque por palavra-chave</span>
			<form id="form-busca-keyw">		
				<div id="box-busca-keyw">
					<div id="busca-texto">
						<input type="text" name="busca-texto" id="busca-texto"  class="input-xxlarge" placeholder="Pesquise um método"/>
					</div>
				</div>
				<a href="#" class="btn btn-neon-orange">Pesquisar</a>
				<div class="clear"></div>
			</form>	
		-->
		
		<script>
			 $(function() {
			    $( document ).tooltip();
			  });	
		</script>
		
		<script type="text/javascript" src="layout/barra_busca.js"></script>
	</div>
</div>