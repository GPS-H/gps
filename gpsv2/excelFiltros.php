<?php
    $conexion = new mysqli("localhost", "gps", "12345", "scmth",3306);
    if (mysqli_connect_errno()) {
        printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
        exit();
    }
    $consulta = "SELECT *FROM filtro;";
    $resultado = $conexion->query($consulta);
    if($resultado->num_rows > 0 ){
        require_once '/lib/PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("schmt")->setTitle("Oficios");
        $tituloReporte = "Filtros";
        $titulosColumnas = array('id_filtro','numero_lavado','estado_filtro','razon_desecho');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:H1');                      
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1',$tituloReporte)
                    ->setCellValue('A3',  $titulosColumnas[0])
                    ->setCellValue('B3',  $titulosColumnas[1])
                    ->setCellValue('C3',  $titulosColumnas[2])
                    ->setCellValue('D3',  $titulosColumnas[3]);
                    $i=4;
        while ($fila = $resultado->fetch_array()) {
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, utf8_encode($fila['id_filtro']))
                    ->setCellValue('B'.$i, utf8_encode($fila['numero_lavado']))
                    ->setCellValue('C'.$i, utf8_encode($fila['estado_filtro']))
                    ->setCellValue('D'.$i, utf8_encode($fila['razon_desecho']));
                    $i++;
        }
        for($i = 'A'; $i <= 'D'; $i++){
            $objPHPExcel->setActiveSheetIndex(0)            
                ->getColumnDimension($i)->setAutoSize(TRUE);
        }
        $objPHPExcel->getActiveSheet()->setTitle('Pacientes');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ReporteFiltros.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
    else{
        print_r('No hay resultados para mostrar');
    }
?>