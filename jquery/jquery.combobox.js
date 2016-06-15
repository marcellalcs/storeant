(function( $ ) {
    $.widget("custom.combobox", {
		options: {
			autocompleteOptions: null,
			inputPlaceHolder: null
		},
		
		_create: function() {
			this.wrapper = $("<div></div>")
			.addClass("custom-combobox")
			.insertAfter(this.element);
			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},
		
		_createAutocomplete: function() {
			var selected = this.element.children(":selected"),
			value = selected.val() ? selected.text() : "";
			
			this.input = $('<input type="text">')
			.appendTo(this.wrapper)
			.val(value)
			.addClass("custom-combobox-input")
			.tooltip();
			if(this.options.inputPlaceHolder != null){
				this.input.attr('placeholder', this.options.inputPlaceHolder);
			}
			if(this.options.autocompleteOptions == null){
				this.input.autocomplete({
					delay: 0
				});
			}
			else{
				this.input.autocomplete(this.options.autocompleteOptions);
			}
			this.input.autocomplete("option", "source", $.proxy(this, "_source"));
			this.input.autocomplete("option", "minLength", 0);
			this._on(this.input, {
				autocompleteselect: function(event, ui) {
					ui.item.option.selected = true;
					this._trigger("select", event, {
						item: ui.item.option
					});
				},
				autocompletechange: "_removeIfInvalid"
			});
		},

		_createShowAllButton: function() {
			var input = this.input,
			wasOpen = false;

			$('<a></a>')
			.addClass("custom-combobox-toggle")
			.attr("tabIndex", -1)
			.attr("title", "Mostrar tudo")
			.tooltip()
			.appendTo(this.wrapper)
			.height(input.height())
			.html('<i class="custom-combobox-caret">')
			.mousedown(function() {
				wasOpen = input.autocomplete("widget").is(":visible");
			})
			.click(function() {
				input.focus();
				// Close if already visible
				if (wasOpen) {
					return;
				}
				// Pass empty string as value to search for, displaying all results
				input.autocomplete("search", "");
			});
		},
		
		_source: function(request, response) {
			var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
			response( this.element.children("option").map(function() {
				var text = $(this).text();
				if (this.value && (!request.term || matcher.test(text)))
					return {
						label: text,
						value: text,
						option: this
					};
			}) );
		},
		
		_removeIfInvalid: function(event, ui) {
			// Selected an item, nothing to do
			if (ui.item) {
				return;
			}
			// Search for a match (case-insensitive)
			var value = this.input.val(),
			valueLowerCase = value.toLowerCase(),
			valid = false;
			this.element.children("option" ).each(function() {
				if ($(this).text().toLowerCase() === valueLowerCase) {
					this.selected = valid = true;
					return false;
				}
			});
			// Found a match, nothing to do
			if (valid) {
				return;
			}
			// Remove invalid value
			this.input
			.attr("title", value + " foi não encontrado(a)")
			.tooltip("open");
			this.element.val("");
			this._delay(function() {
				this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.data("ui-autocomplete").term = "";
		},
		
		_destroy: function() {
			this.wrapper.remove();
			this.element.show();
		}
    });
})( jQuery );