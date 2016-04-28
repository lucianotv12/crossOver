<?php
/*
define('ROOT','localhost');
define('DATABASE','marlboro_cross_over');
define('USER','root');
define('PASS','112233');
define('HOME','http://exploradores.com.ar/');
define('ADMIN','http://exploradores.com.ar/');
define('IMGS','http://exploradores.com.ar/template/img/');
define('JS','http://exploradores.com.ar/template/js/');
define('CSS','http://exploradores.com.ar/template/css/');
define('FLASH','http://exploradores.com.ar/template/flash/');
define('VIEW','http://exploradores.com.ar/view/');
define('CTRL','http://exploradores.com.ar/ctrl/');
define('CLASES','http://exploradores.com.ar/models/');
define('BOOTSTRAP_CSS','http://exploradores.com.ar/template/css/bootstrap/');
define('BOOTSTRAP_JS','http://exploradores.com.ar/template/js/bootstrap/');
define('VALIDACIONES','http://exploradores.com.ar/template/js/validaciones/');
*/
define('ROOT','localhost');
define('DATABASE','marlboro_cross_over');
define('USER','root');
define('PASS','');
define('HOME','http://localhost/crossOver/');
define('ADMIN','http://localhost/crossOver/');
define('IMGS','http://localhost/crossOver/template/img/');
define('JS','http://localhost/crossOver/template/js/');
define('CSS','http://localhost/crossOver/template/css/');
define('FLASH','http://localhost/crossOver/template/flash/');
define('VIEW','http://localhost/crossOver/view/');
define('CTRL','http://localhost/crossOver/ctrl/');
define('CLASES','http://localhost/crossOver/models/');
define('BOOTSTRAP_CSS','http://localhost/crossOver/template/css/bootstrap/');
define('BOOTSTRAP_JS','http://localhost/crossOver/template/js/bootstrap/');
define('VALIDACIONES','http://localhost/crossOver/template/js/validaciones/');


//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(0);

//192.168.1.140
function conectar_bd()
	{
	$conect = mysql_connect(ROOT,USER,PASS);
	if (!$conect)
		{
		echo( "<P>IMPOSIBLE CONECCION A BASE DE DATOS.</P>");
		exit();
		}
		
		// seleccionar la base ****************************
	if (!mysql_select_db(DATABASE) )
		{
   		echo( "<P>No se localizo la base .</P>" );
   		exit();
   		}
	}

/*----------------------------------------------------------------------------*/
/* funcion que valida la permanencia del usuario en la pagina
/* $_redireccion_estricta true/false indica si mata y redirecciona o no
/*----------------------------------------------------------------------------*/
function validar_permanencia ($_redireccion_estricta = true)
	{
	if (!isset($_SESSION["pdv"]))
		{
		# Verifico si me pasa una URL para mostrar un mensaje de error
		if($_redireccion_estricta)
			{# sino muestro el mensaje por defecto y redirecciono al Index
			redireccionar("Su sessi&oacute;n ha caducado, aguarde, ser&aacute; redireccionado...",3);
			}
		return false;
		}
	else
		{
		return true;
		}
	}

function regresar ($_regresar=1)
	{
 	?>
 	<script>
 	function regresar()
 		{
        history.go(-<?= $_regresar ?>)
 		}
 	</script>
 	<body onLoad="regresar()">
 	</body>
 	<?
	}
/*----------------------------------------------------------------------------*/
/* funcion que regresa a la url que inicio la peticion
/*----------------------------------------------------------------------------*/
function redireccionar (  $message="", $seconds=0)
	{
	$url= HOME ;
	header("Refresh: ".$seconds."; url=".$url); // waits 3 seconds & sends to homepage
	echo "<h4>".$message."</h4>";
	die();
	}

/*----------------------------------------------------------------------------*/
/* funcion que hace una inclusion automatica de las clases
/*----------------------------------------------------------------------------*/
function __autoload($class_name)
	{
	$bajadas = "";
	while (!is_dir($bajadas."models"))
		{
		$bajadas .= "../";
		}

		require_once($bajadas."models/".strtolower($class_name).".class.php");
	}

?>
