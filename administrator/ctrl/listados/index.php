<?php
session_start();
include_once("../../../funciones.php");
//include_once("../../models/clientes.class.php");


//validar_permanencia();
conectar_bd();
//validar_permanencia();
//validar_permanencia_admin();
//$_usuario = unserialize($_SESSION["usuario"]);

#$template = new Template();

if(!isset($_GET["accion"])):
	$accion= "list";
	$_GET["accion"] ="list";
else:
 $accion = $_GET["accion"];
endif;
$detalle = false;

switch($accion):
	case "list" :
		{							
		$pdvs = Pdv::administrator_pdv("KKAA", $_GET["ordenar"],$_GET["tipo_orden"]);		
		include("../../view/listados/index.php");
		}
		break;
	case "list_gt" :
		{				
		$pdvs = Pdv::administrator_pdv("GT", $_GET["ordenar"],$_GET["tipo_orden"]);		
		include("../../view/listados/index.php");
		}
		break;		

	case "list_merchandisers" :
		{				
		$pdvs = Merchandiser::administrator_merchandiser($_GET["ordenar"],$_GET["tipo_orden"]);		
		include("../../view/listados/merchandiser.php");
		}
		break;		

	case "list_supervisores" :
		{
			
		$pdvs = Merchandiser::administrator_supervisores($_GET["ordenar"],$_GET["tipo_orden"]);		
		include("../../view/listados/supervisores.php");
		}
		break;				


endswitch;
?>
