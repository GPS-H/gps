<?php
	require_once("../../bd/conexion.php");
	$query = $mysqli->query("select count(*) as total, razon_desecho from filtro where estado_filtro = 'DESECHADO' group by razon_desecho;");
header("Content-type: application/xml");?>
<?xml version='1.0' encoding='ISO-8859-1'?>
<contenido>
<?php while($row = $query->fetch_assoc()){ ?>
<dato><razon><?php echo $row['razon_desecho'] ?></razon><total><?php echo $row['total']?></total></dato>
<?php } ?>
</contenido>