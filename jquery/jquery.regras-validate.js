(function($){

	// Return true se a data informada for menor ou igual a data atual
	$.validator.addMethod('data-menor-igual', function(value, element, params) {
		if (this.optional(element)) return true;

		var test = false,
			hoje = new Date(),
			data = new Date(value.split('/').reverse().join('/')),
			tempo_hoje = hoje.getTime(),
			tempo_data = data.getTime(),
			dif,
			nova;

		if (tempo_data <= tempo_hoje) {
			test = true;
		} else {
			dif = tempo_data - tempo_hoje;
			nova = new Date(tempo_data + dif);
			test = nova.getFullYear() == hoje.getFullYear()
				   && nova.getMonth() == hoje.getMonth()
				   && nova.getDate() == hoje.getDate();
		}

		return test;
	});

})(jQuery);