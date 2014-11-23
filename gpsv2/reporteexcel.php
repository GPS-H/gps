<?php
    $conexion = new mysqli('localhost','gps','12345','scmth',3306);
	if (mysqli_connect_errno()) {
   		printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
   		exit();
	}
	//$tabla = $_GET['tabla'];
	//$consulta = "SELECT * FROM $tabla";
	
	  $consulta = "  select nombre,f.numero_lavado,f.estado_filtro, fecha_lavado from (select r.id_filtro, p.nombre, r.fecha_lavado from paciente as p inner join registro as r on p.id_paciente=r.id_paciente) as n inner join filtro as f on n.id_filtro=f.id_filtro" ;
	  $resultado = $conexion->query($consulta);
	if($resultado->num_rows > 0 ){
		
		/** Se agrega la libreria PHPExcel */
		require_once ("lib/PHPExcel/PHPExcel.php");
		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();
		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("ASE")->setTitle("Oficios");

		$tituloReporte = "REPORTE SEMANAL";
		$titulosColumnas = array('Nombre','Numero de Lavado','Estado del Filtro','Fecha de Lavado');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:D1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
            		->setCellValue('E3',  $titulosColumnas[4]);
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = $resultado->fetch_array()) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i, utf8_encode($fila['nombre']))
		            ->setCellValue('B'.$i, utf8_encode($fila['numero_lavado']))
        		    ->setCellValue('C'.$i, utf8_encode($fila['estado_filtro']))
            		->setCellValue('D'.$i, utf8_encode($fila['fecha_lavado']))
            		;
					$i++;
		}
		
		$estiloTituloReporte = array(
    'font' => array(
        'name'      => 'Verdana',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>16,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array(
            'argb' => 'FF220835')
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
 
$estiloTituloColumnas = array(
    'font' => array(
        'name'  => 'Arial',
        'bold'  => true,
        'color' => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
    'rotation'   => 90,
        'startcolor' => array(
            'rgb' => 'c47cf2'
        ),
        'endcolor' => array(
            'argb' => 'FF431a5d'
        )
    ),
    'borders' => array(
        'top' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        ),
        'bottom' => array(
            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
            'color' => array(
                'rgb' => '143860'
            )
        )
    ),
    'alignment' =>  array(
        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'wrap'      => TRUE
    )
);
 
$estiloInformacion = new PHPExcel_Style();
$estiloInformacion->applyFromArray( array(
    'font' => array(
        'name'  => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array(
            'argb' => 'FFFFFF')
    ),
    'borders' => array(
        'left' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN ,
        'color' => array(
                'rgb' => '3a2a47'
            )
        )
    )
));
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
$objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);
$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));
		
		
		
	
		for($i = 'A'; $i <= 'E'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('REPORTE SEMANAL');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		//$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Reporte_'.$tabla.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save('php://output');
		$objWriter->save('php://output');
		exit;
		
	}
	else{
		print_r('No hay resultados para mostrar');
	}
?>