$(document).ready(function(){
	$('#contact-form').validate({
		rules: {
			nome: "required",
			email: "required",
			assunto: "required",
			msg: "required"
		},
		messages: {
			nome: "We need to know your name",
			email: "We need to know your email",
			assunto: "We need to know the subject",
			msg: "We need to know your the message"
		}
	});
	
	$("#btn-contact").click(function(){
		if($('#contact-form').submit()){
		}
		
	});
	
	
});