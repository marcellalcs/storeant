function cadastraPubli(dados){
	$.getJSON('cadastra_publicacao.ajax.php', dados, function(resultado){
		pm_card = "<div class='pm-cards'>";
		pm_card += 		"<span class='pm-autores'>" + resultado[0]['autores'] + ",</span>";
		pm_card +=		"<span class='pm-nome'>" + resultado[0]['nome'] +", </span>";
		pm_card +=		"<span class='pm-evento'>" + resultado[0]['evento'] +"," + resultado[0]['ano'] +".</span>";
		pm_card +=		"<span class='pm-link'><a href='"+ resultado[0]['link'] +"#' target='_blank'> Publication Link </a></span>";
		pm_card +=	"</div>";
		
		$('#conteiner-pm').append(pm_card);
	});
}



$(document).ready(function() {
	$('#btn-add-publi').on('click',function(){
		$('#dialog-add-publi').dialog({
			resizable: false,
			modal: true,
			width: false,
			minWidth: false,
	       	buttons: {
				Adicionar: function(){
					var dados = $("#add-publi").serializeArray();
					cadastraPubli(dados);
					$(this).dialog('close');
					}
				}
			});
	});
	
	
	$('#btn-add-tool').on('click',function(){
		$('#dialog-add-tool').dialog({
			resizable: false,
			modal: true,
			width: false,
			minWidth: false,
	       	buttons: {
				Adicionar: function(){
					$('#add-tool').submit();
				}
			}
		});
	});

});