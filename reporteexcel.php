<?php
/*    $conexion = new mysqli('localhost','usuario','password','repexcel',3306);
	if (mysqli_connect_errno()) {
    	printf("La conexión con el servidor de base de datos falló: %s\n", mysqli_connect_error());
    	exit();
	}*/

	$cn = mysql_connect ("localhost","root","112233") or die ("ERROR EN LA CONEXION");

	$db = mysql_select_db ("marlboro_cross_over",$cn) or die ("ERROR AL CONECTAR A LA BD");

	$_id = $_GET["id"];

	if($_id == "boss"):
		$merchan_clause = " ";
	else:
		$merchan_clause = " AND merchandiser_id = " . $_id;
	endif;

	$no_usa = " AND POS != 'PRUEBA_GT'";

	 $consulta = "SELECT P.pos, P.tipo, M.nombre as merchandisers, 
					if(M.jefe_id = 50, 'Aladro Guadalupe', 
					  if(M.jefe_id = 51, 'Morano Javier', 
						  if(M.jefe_id = 52, 'Herrera Fernando',
							  if(M.jefe_id = 53, 'Giraldez Alejandra', '')         
					      )      
					   )
					) AS jefe
					,razon_social, calle, numero, localidad, P.km,
					if(P.ingreso, 'Registrado', 'No Registrado') as Pos_estado,
					 objetivo_abril, objetivo_mayo, P.codigos_cargados 
					FROM pdvs AS P 
					inner join merchandisers as M ON M.id = P.merchandiser_id
					WHERE P.tipo = 'GT' $merchan_clause $no_usa
					ORDER BY km DESC";
	$resultado = mysql_query($consulta);
	//if(@mysql_num_rows($resultado) > 0 ){ echo "aca entro";
						
	//	date_default_timezone_set('America/Mexico_City');

		if (PHP_SAPI == 'cli')
			die('Este archivo solo se puede ver desde un navegador web');

		/** Se agrega la libreria PHPExcel */
//		require_once 'lib/PHPExcel/PHPExcel.php';
		require_once("Classes/PHPExcel.php");



		// Se crea el objeto PHPExcel
		$objPHPExcel = new PHPExcel();

		// Se asignan las propiedades del libro
		$objPHPExcel->getProperties()->setCreator("Exploradores") //Autor
							 ->setLastModifiedBy("Exploradores") //Ultimo usuario que lo modificó
							 ->setTitle("Reporte PDVS ")
							 ->setSubject("Reporte PDVS")
							 ->setDescription("Reporte PDVS")
							 ->setKeywords("Reporte PDVS")
							 ->setCategory("Reporte excel");

		$tituloReporte = "Reporte de Pdvs por Merchandiser";
		$titulosColumnas = array('POS','TIPO', 'MERCHANDISER', 'JEFE', 'RAZON SOCIAL', 'CALLE', 'NUMERO', 'LOCALIDAD','ESTADO POS' ,'OB. VOLUMEN ABRIL', 'OB.VOLUMEN MAYO', 'CODIGOS CARGADOS', 'OB ACTIVIDAD WEB', 'KILOMETROS');
		
		$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:L1');
						
		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
        		    ->setCellValue('E3',  $titulosColumnas[4])
            		->setCellValue('F3',  $titulosColumnas[5])
            		->setCellValue('G3',  $titulosColumnas[6])
        		    ->setCellValue('H3',  $titulosColumnas[7])
            		->setCellValue('I3',  $titulosColumnas[8])
        		    ->setCellValue('J3',  $titulosColumnas[9])
            		->setCellValue('K3',  $titulosColumnas[10])
            		->setCellValue('L3',  $titulosColumnas[11])
            		->setCellValue('M3',  $titulosColumnas[12])
            		->setCellValue('N3',  $titulosColumnas[13]);
		
		//Se agregan los datos de los alumnos
		$i = 4;
		while ($fila = mysql_fetch_array($resultado)) {
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $fila['pos'])
        		    ->setCellValue('B'.$i,  $fila['tipo'])
        		    ->setCellValue('C'.$i,  mysql_real_escape_string($fila['merchandisers']))
        		    ->setCellValue('D'.$i,  $fila['jefe'])			
        		    ->setCellValue('E'.$i,  mysql_escape_string($fila['razon_social']))
		            ->setCellValue('F'.$i,  mysql_escape_string($fila['calle']))
        		    ->setCellValue('G'.$i,  $fila['numero'])
            		->setCellValue('H'.$i,  $fila['localidad'])
            		->setCellValue('I'.$i,  $fila['Pos_estado'])
            		->setCellValue('J'.$i,  $fila['objetivo_abril'])
            		->setCellValue('K'.$i,  $fila['objetivo_mayo'])
            		->setCellValue('L'.$i,  $fila['codigos_cargados'])
            		->setCellValue('M'.$i,  'Pendiente')
            		->setCellValue('N'.$i,  $fila['km']);
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
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
				'rotation'   => 90,
        		'startcolor' => array(
            		'rgb' => 'B21515'
        		),
        		'endcolor'   => array(
            		'argb' => 'FF431a5d'
        		)
			),
            'borders' => array(
            	'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'wrap'          => TRUE
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFFFFF')
			),
           	'borders' => array(
               	'left'     => array(
                   	'style' => PHPExcel_Style_Border::BORDER_THIN ,
	                'color' => array(
    	            	'rgb' => 'FFFFFF'
                   	)
               	)             
           	)
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:N3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:N".($i-1));
				
		for($i = 'A'; $i <= 'N'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Pdvs');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="pdvs.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
		
/*	}
	else{
		print_r('No hay resultados para mostrar');
	}*/
?>