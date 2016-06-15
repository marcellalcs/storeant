(function($){
    $.fn.autocompletemulti = function(configuracoes){
		
		//configurações padrão
        var config = {
			'autoFocus': false, //determina se o primeiro item é focada toda vez que a busca é finalizada
			'delay': 450,  //mínimo de espera para a chamada do ajax ser feita
			'minLength': 2,  //mínimo de chars de entrada que o usuário deve digitar para chamada do ajax ser feita
			'position': {my:"left top", at:"left bottom", collision:"none"},  //posição da lista de sugestões
			'source': null,  //URL do arquivo fonte do ajax(espera retorno JSON), array de opções ou função de mapeamento de opções
			'_renderItem': null,  //método para personalizar um item do autocomplete
			'_renderMenu': null,  //método para personalizar o menu do autocomplete
			'_resizeMenu': null,  //método para definir o tamanho do menu do autocomplete
			'inputName': 'acm[]'  //nome padrão dado ao "input virtual"
        };
		
        if(configuracoes){
			$.extend(config, configuracoes); //insere as configurações passadas como argumento
		}
		
        return this.each(function(){
			//Seleção dos componentes
			var virtualInput = $(this);
			var inputTypeSpace = virtualInput.find('textarea');
			//Extrai as caracteristicas do input virtual
			var virtualInputTamanho = virtualInput.width();
			var virtualInputPadLeft = parseInt(virtualInput.css('padding-left').slice(0, -2));
			//Define as caracteristicas iniciais do campo virtual e do espaço de entrada de dados
			virtualInput.css('position', 'relative');
			inputTypeSpace.width(1).val('');
			var inputTypeSpacePos = inputTypeSpace.position(); //relativo as linhas(top, left) mais externas do pai(incluindo padding)
			var inputTypeSpaceTamanho = virtualInputTamanho - inputTypeSpacePos.left + virtualInputPadLeft - 1;
			if(inputTypeSpaceTamanho < 100) inputTypeSpaceTamanho = virtualInputTamanho - 1;
			inputTypeSpace.width(inputTypeSpaceTamanho);
			//Definições de ações do plugin
			inputTypeSpace.autocomplete({
				autoFocus: config.autoFocus,
				delay: config.delay,
				minLength: config.minLength,
				position: config.position,
				source: config.source,
				focus: function(){
					return false;  //Previne ação padrão do autocomplete ao focar 
				},
				select: function(event, ui){
					var item =
					'<div class="acm-item-box">'+
						'<span class="acm-item">'+
							'<div class="acm-text">'+ui.item.label+'</div>'+
							'<div class="acm-x"></div>'+
						'</span>'+
						'<input name="'+config.inputName+'" type="hidden" value="'+ui.item.valor+'">'+
					'</div>';
					inputTypeSpace.before(item);
					inputTypeSpace.width(1).val('');
					var inputTypeSpacePos = inputTypeSpace.position(); //relativo as linhas(top, left) mais externas do pai(incluindo padding)
					var inputTypeSpaceTamanho = virtualInputTamanho - inputTypeSpacePos.left + virtualInputPadLeft - 1;
					if(inputTypeSpaceTamanho < 100) inputTypeSpaceTamanho = virtualInputTamanho - 1;
					inputTypeSpace.width(inputTypeSpaceTamanho);
					
					return false;
				}
			});
			if(config._renderItem == null){
				inputTypeSpace.data("ui-autocomplete")._renderItem = function(ul, item){
					var box =
					'<div class="acm-rst">'+
						'<div class="acm-rst-img-box">'+
							'<img src="'+item.img+'" alt="'+item.label+'" title="'+item.label+'" />'+
						'</div>'+
						'<div class="acm-rst-info-box">'+
							'<span class="acm-rst-label">'+item.label+'</span>'+
							'<br />'+
							'<span class="acm-rst-desc">'+item.desc+'</span>'+
						'</div>'+
					'</div>';
					return $("<li><a>"+ box +"</a></li>").appendTo(ul);
				};
			}
			else{
				inputTypeSpace.data("ui-autocomplete")._renderItem = config._renderItem;
			}
			if(config._renderMenu != null){
				inputTypeSpace.data("ui-autocomplete")._renderMenu = config._renderMenu;
			}
			if(config._resizeMenu != null){
				inputTypeSpace.data("ui-autocomplete")._resizeMenu = config._resizeMenu;
			}
			inputTypeSpace.keydown(function(event){
				if(event.keyCode === $.ui.keyCode.BACKSPACE){
					if(inputTypeSpace.val() == ""){
						inputTypeSpace.prev('.acm-item-box').remove();
						inputTypeSpace.width(1).val('');
						var inputTypeSpacePos = inputTypeSpace.position(); //relativo as linhas(top, left) mais externas do pai(incluindo padding)
						var inputTypeSpaceTamanho = virtualInputTamanho - inputTypeSpacePos.left + virtualInputPadLeft - 1;
						if(inputTypeSpaceTamanho < 100) inputTypeSpaceTamanho = virtualInputTamanho - 1;
						inputTypeSpace.width(inputTypeSpaceTamanho);
					}
				}
				else if(event.keyCode === $.ui.keyCode.ENTER){
					event.preventDefault();
				}
				else if(inputTypeSpace.scrollTop() > 0){
					inputTypeSpace.width(virtualInput.width());
				}
			});
			virtualInput.focusin(function(){
				virtualInput.addClass('acm-focus');
			});
			virtualInput.focusout(function(){
				virtualInput.removeClass('acm-focus');
			});
			virtualInput.on('click', '.acm-x', function(){
				$(this).parents('.acm-item-box').fadeOut(function(){
					$(this).remove();
					inputTypeSpace.width(1).val('');
					var inputTypeSpacePos = inputTypeSpace.position(); //relativo as linhas(top, left) mais externas do pai(incluindo padding)
					var inputTypeSpaceTamanho = virtualInputTamanho - inputTypeSpacePos.left + virtualInputPadLeft - 1;
					if(inputTypeSpaceTamanho < 100) inputTypeSpaceTamanho = virtualInputTamanho - 1;
					inputTypeSpace.width(inputTypeSpaceTamanho);
				});
			});
        });
		
    };
})(jQuery);