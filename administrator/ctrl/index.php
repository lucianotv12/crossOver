<?php
session_start();
include_once("../../../funciones.php");
//include_once("../../models/clientes.class.php");


validar_permanencia();
conectar_bd();
//validar_permanencia();
//validar_permanencia_admin();
//$_usuario = unserialize($_SESSION["usuario"]);

#$template = new Template();

if(!isset($_GET["accion"]))$accion= "list";
else $accion = $_GET["accion"];
$detalle = false;


switch($accion):
	case "list" :
		{				
//		Template::draw_header("body_ranking");
		include("../view/index.php");
//		Template::draw_header("body_ranking");

		}
		break;

endswitch;
?>
