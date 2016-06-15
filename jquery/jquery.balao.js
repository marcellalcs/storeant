(function($){
    $.fn.balao = function(configuracoes){
		
		//configurações padrão
        var config = {
            'width': false,			//largura do balão
			'height': false,		//altura do balão
			'balaoPos': 'acima',	//posição do balão em relação ao objeto que o contém - acima, abaixo, esquerda, direita.
			'setaPos': 'esquerda'	//posição da seta no balão - setaPos = acima, abaixo p/ balaoPos. = esq., dir. ou setaPos = esq., dir. p/ balaoPos. = acima, abaixo.
        };
        if (configuracoes){
			$.extend(config, configuracoes); //insere as configurações passadas como argumento
		}
		
        return this.each(function(){
			
			//Seleção dos elementos
			var conteiner = $(this);
			var botao = conteiner.find('.balao-botao');
			var balao = conteiner.find('.balao-box');
			
			//Variáveis auxiliares para o clickout
			var mouseIsInside = false;
			var balaoIsOpened = false;
			
			//Definição da posição do balão em relação ao elemento que o contém
			switch(config.balaoPos){
				case 'acima':
					var balaoPos = conteiner.height()+1+'px';
					balao.css('bottom', balaoPos);
					balao.addClass('balao-acima');
					break;
				case 'abaixo':
					var balaoPos = conteiner.height()+1+'px';
					balao.css('top', balaoPos);
					balao.addClass('balao-abaixo');
					break;
				case 'esquerda':
					var balaoPos = conteiner.width()+1+'px';
					balao.css('right', balaoPos);
					balao.addClass('balao-esquerda');
					break;
				case 'direita':
					var balaoPos = conteiner.width()+1+'px';
					balao.css('left', balaoPos);
					balao.addClass('balao-direita');
					break;
			}
			
			//Definição da posição da seta em relação ao balão
			switch(config.setaPos){
				case 'acima':
					balao.css('top', 0);
					balao.addClass('seta-acima');
					break;
				case 'abaixo':
					balao.css('bottom', 0);
					balao.addClass('seta-abaixo');
					break;
				case 'esquerda':
					balao.css('left', 0);
					balao.addClass('seta-esquerda');
					break;
				case 'direita':
					balao.css('right', 0);
					balao.addClass('seta-direita');
					break;
			}
			
			//Ajuste de tamanho do balão se definido nas configurações
			if(config.width){
				balao.css('width', config.width);
			}
			if(config.height){
				balao.css('height', config.height);
			}
			
			//Clickout do balão
			$(document).click(function(event){
				var clickAlvo = $(event.target);
				if(!clickAlvo.is(botao)){
					if(!clickAlvo.parents('.balao-botao').is(botao)){
						if(!mouseIsInside){
							if(balaoIsOpened){
								conteiner.removeClass('open-balao');
								balaoIsOpened = false;
							}
						}
					}
				}
			});
			
			//Permite abertura e fechamento do balão ao se clica no botão
			botao.click(function(){
				$(this).parent('.balao-conteiner').toggleClass('open-balao');
				if(conteiner.hasClass('open-balao')){
					balaoIsOpened = true;
				}
				else{
					balaoIsOpened = false;
				}
			});
			
			/* "Seta" a variável auxiliar para true, ou seja, o mouse está dentro do balão */
			balao.mouseenter(function(){
				mouseIsInside = true; 
			});
			
			/* "Seta" a variável auxiliar para false, ou seja, o mouse está fora do balão */
			balao.mouseleave(function(event){
				var $elem = $(event.toElement);
				mouseIsInside = false;

				if ($elem.is('ul.autocomplete-balao') || $elem.parents('ul.autocomplete-balao').length > 0) {
					mouseIsInside = true;
				}
			});
			
        });
    };
})(jQuery);