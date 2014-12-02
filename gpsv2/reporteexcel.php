<?php
    $conexion = new mysqli("localhost", "gps", "12345", "scmth",3306);
    if (mysqli_connect_errno()) {
        printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
        exit();
    }
    $consulta = "SELECT * FROM  paciente";
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows > 0 ){
        require_once '/lib/PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("schmt")->setTitle("Oficios");
        $tituloReporte = "Pacientes";
        $titulosColumnas = array('nombre','apellidos','direccion','correo','telefono','celular','sexo','fecha_registro');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:H1');                      
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1',$tituloReporte)
                    ->setCellValue('A3',  $titulosColumnas[0])
                    ->setCellValue('B3',  $titulosColumnas[1])
                    ->setCellValue('C3',  $titulosColumnas[2])
                    ->setCellValue('D3',  $titulosColumnas[3])
                    ->setCellValue('E3',  $titulosColumnas[4])
                    ->setCellValue('F3',  $titulosColumnas[5])
                    ->setCellValue('G3',  $titulosColumnas[6])
                    ->setCellValue('H3',  $titulosColumnas[7]);
                    $i=4;
        while ($fila = $resultado->fetch_array()) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, utf8_encode($fila['nombre']))
                    ->setCellValue('B'.$i, utf8_encode($fila['apellidos']))
                    ->setCellValue('C'.$i, utf8_encode($fila['direccion']))
                    ->setCellValue('D'.$i, utf8_encode($fila['correo']))
                    ->setCellValue('E'.$i, utf8_encode($fila['telefono']))
                    ->setCellValue('F'.$i, utf8_encode($fila['celular']))
                    ->setCellValue('G'.$i, utf8_encode($fila['sexo']))
                    ->setCellValue('H'.$i, utf8_encode($fila['fecha_registro']));
                    $i++;
        }
        for($i = 'A'; $i <= 'H'; $i++){
            $objPHPExcel->setActiveSheetIndex(0)            
                ->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $objPHPExcel->getActiveSheet()->setTitle('Pacientes');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ReportePacientes.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    else{
        print_r('No hay resultados para mostrar');
    }
?>