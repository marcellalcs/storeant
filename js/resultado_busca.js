function carregaMetodos(dados){
	$.getJSON('resultado_busca.ajax.php', dados, function(resultado){
		boxMetodos = $('#metodos-result-pesquisa');
	    boxMetodos.hide().empty();
	    if(resultado[0].erro == 1){
	    		cardMetodos = 	'<div class="box-result-pesquisa-nm">';
	 			cardMetodos += 		'<div class="box-title-result>">';
	 			cardMetodos +=			'<h3 class="title-result"> Nenhum método encontrado </h3>';
	 			cardMetodos += 		'</div>';
				cardMetodos += '</div>';
				boxMetodos.append(cardMetodos);
	    }else{
	    	for(i = 0; i<resultado.length; i++){
	    		cardMetodos = 	'<a href="?pagina=md&id-met=' + resultado[i].id + '">';
	    		cardMetodos += 	'<div class="box-result-pesquisa">';
	 			cardMetodos += 		'<div class="box-title-result>">';
	 			cardMetodos +=			'<h3 class="title-result">' + resultado[i].nome + '</h3>';
	 			cardMetodos +=		'</div>';
	 			cardMetodos +=		'<div class="box-descr-result">'+ resultado[i].desc;
	 			cardMetodos +=		'</div>';
	 			cardMetodos += 		'<div class="box-tags-result">';
	 			cardMetodos += 		'</div>';
				cardMetodos += '</div>';
				cardMetodos += '</a>';
				boxMetodos.append(cardMetodos);
	    	}
	    }
	    boxMetodos.show();
	});
}

function selectAll(obj_all, cl_selcts){
	if(obj_all.checked){
			 cl_selcts.each(function() {
	            this.checked = true;                        
	        });
		}else{
			cl_selcts.each(function() {
	            this.checked = false;                        
	        });
		}
}

$(document).ready(function(){
	//Carrega todos os pacotes (após DOM estar pronta)
	var dados = '';
	carregaMetodos(dados);
	
		
	//Carrega pacotes a partir de filtro de tipo
	$("#btn-search").on('click', function(){
		var dados = $("form").serializeArray();
		carregaMetodos(dados);
	});
	
	$('#sl-coleta-all').click(function(){
		selectAll(this, $('.sl-coleta'));
	});
	
	$('#sl-analise-all').click(function(){
		selectAll(this, $('.sl-analise'));
	});
	
	$('#sl-momento-all').click(function(){
		selectAll(this, $('.sl-momento'));
	});
	
	$('#sl-recursos-all').click(function(){
		selectAll(this, $('.sl-recursos'));
	});
});


