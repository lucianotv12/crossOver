<?php
session_start();
include_once("../../funciones.php");
//include_once("../../models/clientes.class.php");


validar_permanencia();
conectar_bd();
//validar_permanencia();
//validar_permanencia_admin();
//$_usuario = unserialize($_SESSION["usuario"]);

#$template = new Template();

if(!isset($_GET["accion"]))$accion= "home";
else $accion = $_GET["accion"];
$detalle = false;


switch($accion):
	case "home" :
		{				

		Template::draw_header();
		include("../../view/home/index.php");
		Template::draw_footer();

		}
		break;
	case "ranking" :
		{ 
		$_pdv = unserialize($_SESSION["pdv"]);
		$ranking = Pdv::ranking_pdv($_pdv->tipo);	

		Template::draw_header("body_ranking");
		include("../../view/home/ranking.php");
		Template::draw_footer();

		}	
		break;
	case "ranking_merchan" :
		{



		$ranking = Merchandiser::ranking_merchan($_GET["tipo"]);	

		Template::draw_header("body_ranking");
		include("../../view/home/ranking.php");
		Template::draw_footer();

		}	
		break;		

	case "premios" :
		{
		Template::draw_header("body_premios");
		include("../../view/home/premios.php");
		Template::draw_footer();

		}	
		break;
	case "promo" :
		{
		Template::draw_header();
		include("../../view/home/promo.php");
		Template::draw_footer();

		}	
		break;
	case "mispdvs" :
		{
		Template::draw_header();
		include("../../view/home/mispdvs.php");
		Template::draw_footer();

		}	
		break;		
	case "basesycondiciones" :
		{

		$_pdv = unserialize($_SESSION["pdv"]);
		if($_pdv->tipo == "KKAA"):
			$bases = "basesycondiciones_KA.php";
		else:
			$bases = "basesycondiciones.php";
		endif;

		Template::draw_header("body_bases");
		include("../../view/home/" . $bases);
		Template::draw_footer();

		}			

endswitch;
?>
