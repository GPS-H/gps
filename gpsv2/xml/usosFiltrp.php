<?php
	require_once("../../bd/conexion.php");
	$query = $mysqli->query('select numero_lavado,count(*)as total from filtro group by numero_lavado;');
	header("Content-type: application/xml");?>
<?xml version='1.0' encoding='ISO-8859-1'?>
<contenido>
<?php while($row = $query->fetch_assoc()){ ?>
<dato><lavado><?php echo $row['numero_lavado'] ?> Uso(s)</lavado><total><?php echo $row['total']?></total></dato>
<?php } ?>
</contenido>