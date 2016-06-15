function showLoading(){
	if($("#jquery-waiting-base-container").length == 0){
		var loadingHTML =	'<div id="jquery-waiting-base-container" class="jquery-waiting-base-container back-verde-sistema">'+
								'<span class="loading7"></span>'+
								'<br/>Carregando'+
							'</div>';
		$("body").append(loadingHTML);
	}
	else{
		$("#jquery-waiting-base-container").show();
	}
}

function hideLoading(){
	$("#jquery-waiting-base-container").fadeOut("slow");
}