<?php include ('controleMetodo_descricao.php'); ?>
<div class="caract-m">
	<div class="cat-busca-box">
		<div class="cat-busca-title">
			<div class="ico-cat coleta"></div>
			<div class="tag-name">Data Collection Method <span class="cat-dados-info">?</span></div>
			<div class="cat-busca-more-info"> Forma como as informações para avaliação são obtidas.</div>
		</div>
		<div class="cat-tags">
			<ul id="lista-itens-pesq">
				<?php for($i=0; $i<count($array_coleta); $i++): ?>
					<li clas="item-pesq">
						<span class="tag-value"> <?php echo $array_coleta[$i]['Tipo_Coleta'] ?> </span>
					</li>
				<?php endfor; ?>	
			</ul>
		</div>
	</div>
	<div class="cat-busca-box">
		<div class="cat-busca-title">
			<div class="ico-cat analise"></div>
			<div class="tag-name">Type of Analysis <span class="cat-dados-info">?</span></div>
			<div class="cat-busca-more-info"> Tipo de análise feita nos dados coletados.</div>
		</div>
		<div class="cat-tags">
			<ul id="lista-itens-pesq">
				<li clas="item-pesq">
					<?php if($metodo->analise == 'todos'): ?>
						<span class="tag-value">Qualitative</span>
						<span class="tag-value">Quantitative</span>
					<?php else: ?>
						<span class="tag-value"><?php echo $metodo->analise?></span>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="cat-busca-box">
		<div class="cat-busca-title">
			<div class="ico-cat momento"></div>
			<div class="tag-name">Moment of Aplication <span class="cat-dados-info">?</span></div>
			<div class="cat-busca-more-info"> Qual fase do desenvolvimento a análise é feita.</div>
		</div>
		<div class="cat-tags">
			<ul id="lista-itens-pesq">
				<li clas="item-pesq">
					<?php if($metodo->momento == 'todos'): ?>
						<span class="tag-value">Formative</span>
						<span class="tag-value">Somativeitative</span>
					<?php else: ?>
						<span class="tag-value"><?php echo $metodo->momento?></span>
					<?php endif; ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="cat-busca-box">
		<div class="cat-busca-title">
			<div class="ico-cat geral"></div>
			<div class="tag-name">General or specific <span class="cat-dados-info">?</span></div>
			<div class="cat-busca-more-info"> Quais recursos são utilizados na avaliação</div>
		</div>
		<div class="cat-tags">
			<ul id="lista-itens-pesq">
				<?php for($i=0; $i<count($array_recurso); $i++): ?>
					<li clas="item-pesq">
						<span class="tag-value"> <?php echo $array_recurso[$i]['Tipo_Recurso'] ?> </span>
					</li>
				<?php endfor; ?>	
			</ul>
		</div>	
	</div>
	<div class="cat-busca-box origem-box">
		<div class="cat-busca-title">
			<div class="ico-cat origem"></div>
			<div class="tag-name">Origin <span class="cat-dados-info">?</span></div>
			<div class="cat-busca-more-info"> Quais recursos são utilizados na avaliação</div>
		</div>
		<div class="cat-tags">
			<ul id="lista-itens-pesq">
				<?php for($i=0; $i<count($array_recurso); $i++): ?>
					<li clas="item-pesq">
						<span class="tag-value"> <?php echo $array_recurso[$i]['Tipo_Recurso'] ?> </span>
					</li>
				<?php endfor; ?>	
			</ul>
		</div>	
	</div>
</div>
<div class="title-m">
	<h2 class="nome-m"><?php echo $metodo->nome; ?></h2>
</div>
<div class="left-box">
	<div class="discription-m">
		<?php echo $metodo->descricao; ?><br>
	</div>
	<div class="tools-m">
		<h3 class="m-title"> Tools</h3> 
		<?php if($ferramentas_metodo): ?>
			<?php for($i=0; $i<count($ferramentas_metodo); $i++): ?>
				<div class='fm-cards'>
					<div class="fmc-img"><img src="img/fm-logo2.png"></div>
					<div class="fmc-desc">
						<span class="fmc-title"><?php echo $ferramentas_metodo[$i]['Nome'] ?></span></br>
					</div>
				</div>
			<?php endfor; ?>
		<?php else: ?>
		<div class='fm-cards'>
				<div class="fmc-desc">
					There's no tool registered for this method
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="publicacoes-metodo">
		<h3 class='m-title'>Related Publications</h3> 
		<?php for($i=0; $i<count($publicacoes); $i++): ?>
			<div class='pm-cards'>	
				<span class="pm-autores"><?php echo $publicacoes[$i]['Autores']?>, </span>
				<span class='pm-nome'><?php echo $publicacoes[$i]['Nome']?>, </span>
				<span class="pm-evento"> <?php echo $publicacoes[$i]['Evento_Publicacao'] .", ". $publicacoes[$i]['Data_Publicacao']?>.</span>
				<span class="pm-link"><a href="<?php echo $publicacoes[$i]['Link_Publicacao']?>" target="_blank"> Publication Link </a></span>
			</div>
		<?php endfor; ?>
	</div>
</div>
<div class="right-box">
	
		<h3 class="m-title">Comments</h3>
	<?php if(!isset($_SESSION['nome-u'])): ?>
		<div>
			You must be registred  to comment.
			<a href=<?php echo MODULOS_DIR . "login/login.php"?>> click here to login </a>
		</div>
	<?php else: ?>
		<form id="addCommentForm" method="post" action="">
	    	<div>
	        	
	        	<input type="hidden" class="input-xlarge" name="name" id="name" value="<?php echo $_SESSION['nome-u']?>" />
	            <input type="hidden" class="input-xlarge" name="email" id="email" value="<?php echo $_SESSION['email-u']?>" />
	            <label for="body">Comment</label>
	            <textarea class="input-xlarge" name="body" id="body" cols="20" rows="5"></textarea>
	            <input type="hidden" name="id-meth" value="<?php echo $metodo->id ?>" /><br>
	            <input type="submit" class="btn btn-neon-orange" id="submit" value="Publish" />
	        </div>
	    </form>
	<?php endif; ?>
	<div id="addCommentContainer">
		<?php
			//output comentários
			foreach($comments as $c){
				echo $c->markup();
			}
		?>
	</div>
</div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="modulos/comentarios/script.js"></script>