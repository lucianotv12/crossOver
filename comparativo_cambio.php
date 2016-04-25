
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>:: Importar de Excel a la Base de Datos ::</title>

</head>

<body>

<!– FORMULARIO PARA SOICITAR LA CARGA DEL EXCEL –>

Selecciona el archivo a importar NUEVOOO NO USO xxx:

<form name="importa" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" >

<input type="file" name="excel" />

<input type='submit' name='enviar'  value="Importar"  />

<input type="hidden" value="upload" name="action" />

</form>

<!– CARGA LA MISMA PAGINA MANDANDO LA VARIABLE upload –>

<?php
set_time_limit(0);
extract($_POST);

if ($action == "upload"){
//    echo "aca entro"; die();

//cargamos el archivo al servidor con el mismo nombre

//solo le agregue el sufijo bak_

$archivo = $_FILES['excel']['name'];

$tipo = $_FILES['excel']['type'];

$destino = "bak_".$archivo;

if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Éxito";

else echo "Error Al Cargar el Archivo";

////////////////////////////////////////////////////////

if (file_exists ("bak_".$archivo)){

/** Clases necesarias */

require_once("Classes/PHPExcel.php");

require_once("Classes/PHPExcel/Reader/Excel2007.php");

// Cargando la hoja de cálculo

$objReader = new PHPExcel_Reader_Excel2007();

$objPHPExcel = $objReader->load("bak_".$archivo);

$objFecha = new PHPExcel_Shared_Date();

// Asignar hoja de excel activa

$objPHPExcel->setActiveSheetIndex(0);

//conectamos con la base de datos

$cn = mysql_connect ("localhost","root","112233") or die ("ERROR EN LA CONEXION");

$db = mysql_select_db ("marlboro_cross_over",$cn) or die ("ERROR AL CONECTAR A LA BD");

// Llenamos el arreglo con los datos  del archivo xlsx

for ($i=1;$i<=450;$i++){ 

$_DATOS_EXCEL[$i]['pos'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['merchan'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['tipo'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['razon_social'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['calle'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['numero'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['localidad'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getCalculatedValue();
$_DATOS_EXCEL[$i]['ob'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getCalculatedValue();

}

}

//si por algo no cargo el archivo bak_

else{echo "Necesitas primero importar el archivo";}

$errores=0;

function generaPass(){
    //Se define una cadena de caractares. Te recomiendo que uses esta.
    $cadena = "abcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
    $longitudCadena=strlen($cadena);
     
    //Se define la variable que va a contener la contraseña
    $pass = "";
    //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
    $longitudPass=6;
     
    //Creamos la contraseña
    for($i=1 ; $i<=$longitudPass ; $i++){
        //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
        $pos=rand(0,$longitudCadena-1);
     
        //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
        $pass .= substr($cadena,$pos,1);
    }
    return $pass;
}

//recorremos el arreglo multidimensional

//para ir recuperando los datos obtenidos

//del excel e ir insertandolos en la BD

$contador = 0;

foreach($_DATOS_EXCEL as $campo => $valor){



 $pos = mysql_real_escape_string($valor["pos"]);
 $merchan = mysql_real_escape_string($valor["merchan"]);
 $tipo = mysql_real_escape_string($valor["tipo"]);
 $razon_social = mysql_real_escape_string($valor["razon_social"]);
 $calle = mysql_real_escape_string($valor["calle"]);
 $numero = mysql_real_escape_string($valor["numero"]); 
 $localidad = mysql_real_escape_string($valor["localidad"]); 
 $ob = mysql_real_escape_string($valor["ob"]); 
 $clave = mysql_real_escape_string(generaPass());
 
 if($pos != "" ):

//            mysql_query("update pdvs set codigos_cargados = '$cantidad'  where pos = '$pos'");

         mysql_query("insert into pdvs values (NULL, '$clave', '$tipo', '0','0', '$razon_social', '$calle', '$numero','$localidad', '0', '0', '$merchan', '$pos', '0', '0', NULL, 0,'$ob','$ob',0,0 )");   
         if(mysql_affected_rows()):
            $contador++;
         endif;   
endif;       


}

//mysql_query("insert into productos_movimientos_log values (null,10, 'Modificacion via excel', 1, 30, 630,CURDATE(),'18:20:00',2)");
//mysql_query("insert into productos_movimientos_log values (null,10, 'Modificacion via excel', 1, 41, 691,CURDATE(),'12:00:00',2)");

/////////////////////////////////////////////////////////////////////////

echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $campo REGISTROS Y $contador CAMBIOS</center></strong>";

//una vez terminado el proceso borramos el

//archivo que esta en el servidor el bak_

unlink($destino);

}

?>

</body>

</html>



?>
