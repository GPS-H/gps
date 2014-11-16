// JavaScript Document
var ordenar = '';
$(document).ready(function(){
	// Llamando a la funcion de busqueda al
	// cargar la pagina
	filtrar()
	
	var dates = $( "#del, #al" ).datepicker({
			yearRange: "-50",
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onSelect: function( selectedDate ) {
				var option = this.id == "del" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
	});
// realiza la funcion al momento de teclear dentro del INPUT con ID=nombre -->(BUSCAR) :P
	$('#nombre').keyup(function(){ filtrar() });
     
	// boton cancelar  (no existe por el momento :)  es opcional fue prueba de ejemplo
	$("#btncancel").click(function(){ 
		$(".filtro input").val('')
		$(".filtro select").find("option[value='0']").attr("selected",true)
		filtrar() 
	});
// ordenar por (ordena la tablas al dar click en los TITULOS) :P
	$("#data th span").click(function(){
		var orden = '';
		if($(this).hasClass("desc"))
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("asc");
			ordenar = "&orderby="+$(this).attr("title")+" asc"		
		}else
		{
			$("#data th span").removeClass("desc").removeClass("asc")
			$(this).addClass("desc");
			ordenar = "&orderby="+$(this).attr("title")+" desc"
		}
		filtrar()
	});
});
// funcion filtrar la que hace todo :P
function filtrar()
{	
	$.ajax({
		data: $("#frm_filtro").serialize()+ordenar,
		type: "POST",
		dataType: "json",
		url: "ajax.php?action=listar",
			success: function(data){
				var html = '';
				if(data.length > 0){
					$.each(data, function(i,item){
						html += '<tr>'
							html += '<td>'+item.nombre+'</td>'
							html += '<td>'+item.apellidos+'</td>'
							html += '<td>'+item.direccion+'</td>'
							html += '<td>'+item.email+'</td>'
							html += '<td>'+item.celular+'</td>'
							html += '<td>'+item.telefono+'</td>'
						html += '</tr>';
															
					});					
				}
				if(html == '') html = '<tr><td colspan="4" align="center">No se encontraron registros..</td></tr>'
				$("#data tbody").html(html);
			}
	  });
}