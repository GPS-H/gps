<?php
	require_once("../../bd/conexion.php");
	$query = $mysqli->query("select count(*) as total, case when edad <10 then 'Menores de 10'when edad <20 then 'Entre 10 y 19'when edad <30 then 'Entre 20 y 29'when edad <40 then 'Entre 30 y 39'when edad <50 then 'Entre 40 y 49'when edad <60 then 'Entre 50 y 59'when edad <70 then 'Entre 60 y 69'when edad <80 then 'Entre 70 y 79'when edad <90 then 'Entre 80 y 89'when edad <100 then 'Entre 90 y 99'else 'mayores de 99'end as edadG from paciente group by edadG");
header("Content-type: application/xml");?>
<?xml version='1.0' encoding='ISO-8859-1'?>
<contenido>
<?php while($row = $query->fetch_assoc()){ ?>
<dato><rango><?php echo $row['edadG'] ?></rango><total><?php echo $row['total']?></total></dato>
<?php } ?>
</contenido>