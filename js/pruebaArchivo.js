$(document).ready(function ()
{
	(function($) {  //obtener valores de url 
	    $.get = function(key)   {  
	        key = key.replace(/[\[]/, '\\[');  
	        key = key.replace(/[\]]/, '\\]');  
	        var pattern = "[\\?&]" + key + "=([^&#]*)";  
	        var regex = new RegExp(pattern);  
	        var url = unescape(window.location.href);  
	        var results = regex.exec(url);  
	        if (results === null) {  
	            return null;  
	        } else {  
	            return results[1];  
	        }  
	    }  
	})(jQuery); 

	obtenerDatosFolios();

	$( "#btnDescargaVideos").on("click", function() {
	  downloadVideos();
	});
});
function obtenerDatosFolios()
{
	var objParam = {
				'opcion':2,
				};
	$.ajax({
	async: true,
	cache: false,
	type: 'POST',
	url: 'php/pruebavideo.php',
	data: objParam,
	dataType: 'json',
	success: function(datos)
	{
	 	if (datos != "") 
	 	{
	 		//se subio correctamente el archivo
	 		mensajeVerde(datos);
	 		desbloquearUI();
	 	}
	 	else
	 	{
	 		mensajeRojo(datos.mensaje);
	 		desbloquearUI();
	 	}
	},
	beforeSend: function()
	{
			bloquearUI("Cargando informacion, espere un momento porfavor...");
	},
	error: function(a)
	{
		desbloquearUI();
	 	mensajeRojo("Ocurrio un error al buscar la informacion.");
	}
	});
}
function downloadVideos()
{
	var video = "";
	var objParam = {
				'opcion':1,
				'archivo': video,
				};
	$.ajax({
	async: true,
	cache: false,
	type: 'POST',
	url: 'php/pruebavideo.php',
	data: objParam,
	dataType: 'json',
	success: function(datos)
	{
	 	if (datos.respuesta == 1) 
	 	{
	 		//se subio correctamente el archivo
	 		$( "#btnDescargaVideos").html(datos.info);
	 		mensajeVerde(datos.mensaje);
	 		desbloquearUI();
	 	}
	 	else
	 	{
	 		mensajeRojo(datos.mensaje);
	 		desbloquearUI();
	 	}
	},
	beforeSend: function()
	{
			bloquearUI("Descargando Video, espere un momento porfavor...");
	},
	error: function(a)
	{
		desbloquearUI();
	 	mensajeRojo("Ocurrio un error al descargar el video.");
	}
	});
}

function mensajeRojo(sMensaje, callBack)
	{
		var newHtml = "<div class='error' >";
		newHtml += "<div>";
		newHtml += sMensaje;
		newHtml += "</div></div>";
		//$('#Mensaje').dialog('destroy');
		$('#Mensaje').html(newHtml);
		$('#Mensaje').dialog( {
						  
							modal:true,
							cache: false,
							resizable:true,
							autoOpen: true,
							width:'500px',
							title: 'ERROR CRITICO',
							buttons:
							{
								Aceptar: function() 
								{
									$( this ).dialog( "close" );
									$("input:text:visible:first").focus();
									$('#Mensaje').html('');
									
									if(typeof callBack == "function"){
										callBack();
									}
									
									$(this).dialog('destroy');
								},							
							},
						}).parent('.ui-dialog').find('.ui-dialog-titlebar-close').hide();;
						
		$('.ui-dialog-buttonpane').find('button:contains("Aceptar")').css('width', '80px');
		$('.ui-dialog-buttonpane .ui-dialog-buttonset').css({ float:'none'});
		$('.ui-dialog-buttonpane .ui-dialog-buttonset').attr({align:'center'});
	}

	function mensajeVerde(sMensaje, callBack)
	{
		var newHtml = "<div class='exito'>";
		newHtml += "<p>";
		newHtml += sMensaje;
		newHtml += "</p></div>";
		//$('#Mensaje').dialog('destroy');
		$('#Mensaje').html(newHtml);
		$('#Mensaje').dialog( {
						  
							modal:true,
							cache: false,
							resizable:false,
							autoOpen: true,
							title: 'EXITO',
							buttons:
							{
								Aceptar: function() 
								{
									$( this ).dialog( "close" );
									$("input:text:visible:first").focus();
									$('#Mensaje').html('');
									
									if(typeof callBack == "function"){
										callBack();
									}
									
									$(this).dialog('destroy');
								},							
							},
						}).parent('.ui-dialog').find('.ui-dialog-titlebar-close').hide();;
						
		$('.ui-dialog-buttonpane').find('button:contains("Aceptar")').css('width', '80px');
		$('.ui-dialog-buttonpane .ui-dialog-buttonset').css({ float:'none'});
		$('.ui-dialog-buttonpane .ui-dialog-buttonset').attr({align:'center'});
	}
