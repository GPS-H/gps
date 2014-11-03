<script language="JavaScript" src="js/jquery-1.5.1.min.js"></script>
<script language="JavaScript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />
<?php
	require_once("bd/conexion.php");
	$con = "select * from palabras";
	$query = $mysqli->query('select *from pacientes');
?>
    <script>
	$(function() {
		<?php
			while($row = $query->fetch_assoc()) {
      			$elementos[]= '"'.$row['nombre'].'"';
			}
			$arreglo= implode(", ", $elementos);
		?>	
		var availableTags=new Array(<?php echo $arreglo; ?>);
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>
<form >
	<label for="tags">buscar </label>
	<input id="tags" name="nombre">
    <input name="Enviar" type="submit" />
</form>
