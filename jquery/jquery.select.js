(function($){
    $.fn.select = function(configuracoes){
		//configurações padrão
        var config = {
            'layout': 'grade',		//mostra as opções como uma grade ou lista de opções
        };
        if (configuracoes){
			$.extend(config, configuracoes); //insere as configurações passadas como argumento
		}
		
        return $(this).each(function(){
			
			//Mapeia a estrutura do select
			var conteiner = $(this);
			var botao = conteiner.find('.select-botao');
			var box = conteiner.find('.select-box');
			var celulas = box.find('.select-box-celula');
			
			//Verifica o layout a ser aplicado no select
			if(config.layout == 'lista'){
				conteiner.addClass('select-lista');
			}
			else{
				conteiner.addClass('select-grade');
			}
			
			//Verifica se há seleção única pré-selecionada (uso de tipo rádio)
			var preSelecionada = celulas.find('input[type="radio"]:checked');
			if(preSelecionada.length != 0){
				preSelecionada.parent().addClass('select-box-celula-selecionada');
				botao.find('.select-botao-text').text(preSelecionada.next().text());
			}
			//Verifica se há múltiplas seleções pré-selecionadas (uso de checkbox)
			else{
				var preSelecionadas = celulas.find('input[type="checkbox"]:checked');
				preSelecionadas.each(function(){
					$(this).parent().addClass('select-box-celula-selecionada');
				});
			}
			
			//Define as ações de clique no botão do select, que abre e fecha a box de opções
			botao.click(function(){
				if(botao.hasClass('select-botao-aberto')){ //importante: 1º fecha a box e dps estiliza o botão
					box.slideToggle(350, function(){
						botao.removeClass('select-botao-aberto');
					});
				}
				else{ //importante: 1º estiliza o botão e dps abre a box
					botao.toggleClass('select-botao-aberto');
					box.slideToggle(350);
				}
			});
			
			//Define uma ação ao se clicar em uma célula na box de opções de acordo com seu tipo(única ou múltiplas opções)
			var isRadio = celulas.find('input').is('input[type="radio"]');
			var isCheckbox = celulas.find('input').is('input[type="checkbox"]');
			celulas.find('label').click(function(){
				if(isRadio){
					valorSelecionado = $(this).text();
					celulas.removeClass('select-box-celula-selecionada');
					$(this).parent().addClass('select-box-celula-selecionada');
					box.slideUp(350, function(){
						botao.find('.select-botao-text').text(valorSelecionado);
						botao.removeClass('select-botao-aberto');
					});
				}
				else if(isCheckbox){
					$(this).parent().toggleClass('select-box-celula-selecionada');
				}
			});
			
        });
    };
})(jQuery);