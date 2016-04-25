<?php
session_start();
include_once("../../funciones.php");

validar_permanencia();
conectar_bd();
//validar_permanencia();
//validar_permanencia_admin();
//$_usuario = unserialize($_SESSION["usuario"]);

#$template = new Template();

if(!isset($_GET["accion"]))$accion= "list";
else $accion = $_GET["accion"];
$detalle = false;
switch($accion)
	{
	case "list" :
				{				
				if(!isset($_GET["start"])){		
				$start = 0;
				}else{
				$start = $_GET["start"];
				}
				$end = 5 ; 
				$usuarios = Usuario::get_usuarios($start,$end);	
				$total_usuarios = Usuario::total_usuarios();
				Template::draw_header();
				include("../../view/usuarios/list.php");
				}
				break;
	case "new" :
				{
				// Muestra el formulario de NUEVO
				$usuario = new Usuario;
				$mensaje_cabezera = "ALTA DEL USUARIO";
				$boton=true;		
				$cambio = "nuevo";
				$deshabilitado = "";
				$nombre = "";
				$apellido="";
				$telefono="";
				$email="";
				$user="";
				$pass="";
				$gerarquia="";
					
					Template::draw_header();
					include("../../view/usuarios/abm.php");

				}
				break;

	case "detail" :
				{
				// ESPERA UN ID
				$usuario = new Usuario($_GET["id"]);
					$mensaje_cabezera = "DETALLE DEL USUARIO";  		
					$cambio = "";
					$boton=false;		
					$detalle = true;
					$deshabilitado = "disabled";
					$nombre = $usuario->get_nombre();
					$apellido=$usuario->get_apellido();
					$telefono = $usuario->get_telefono();
					$email=$usuario->get_email();
					$user=$usuario->get_user();
					$pass=$usuario->get_password();
					$gerarquia=$usuario->get_gerarquia();
					Template::draw_header();
					include("../../view/usuarios/abm.php");
				}
				break;
	case "modify" :
				{
				// ESPERA UN ID
					$usuario = new Usuario($_GET["id"]);
				
					$mensaje_cabezera = "MODIFICACION DEL USUARIO";
					$cambio = "modificar";
					$detalle = false;
					$boton=true;							
					$deshabilitado = "";
					$nombre = $usuario->get_nombre();
					$apellido=$usuario->get_apellido();
					$telefono = $usuario->get_telefono();
					$email=$usuario->get_email();
					$user=$usuario->get_user();
					$pass=$usuario->get_password();	
					$gerarquia=$usuario->get_gerarquia();

					Template::draw_header();
					include("../../view/usuarios/abm.php");

				}
				break;

	case "delete" :
				{
				// ESPERA UN ID
				// No icluye Vista, Borra directo..
				$usuario = new Usuario($_GET["id"]);
				$usuario->erase();
				//ingreso un registro en el log
				$hoy = date("Y-m-d G:i:s"); 
				$texto = "Baja usuario".$_GET["id"];

				header("Location: index.php");
				}
				break;
				
	case "insert":
				{
				if($_POST['pass'] == $_POST['pass1'])
					{	
						$usuario = new Usuario;
						$usuario->nuevo_usuario($_POST);
					//ingreso un registro en el log
					$hoy = date("Y-m-d G:i:s"); 
					$texto = "Alta nuevo usuario ";
	//				mysql_query("insert into log values(null,".$_usuario->get_idUsuario().",'".$texto."', '".$hoy."')");
					header("Location: index.php");								
					}
				else	
					{
					$usuario = new Usuario;
					$mensaje_cabezera = "ALTA DEL USUARIO";
					$boton=true;		
					$cambio = "nuevo";
					$deshabilitado = "";
					$nombre = $_POST["nombre"];
					$apellido=$_POST["apellido"];
					$telefono=$_POST["telefono"];
					$user = $_POST["usuario"];	
					$email=$_POST["email"];
		//			$gerarquia = Usuario::gerarquia_usuario($_usuario->id);
					include("../../view/usuarios/abm.php");
					echo"<FONT SIZE=3 COLOR=red><B>&nbsp;Las contraseņas ingresadas no coinciden!!!</B></FONT>";
					}	
#					$_SESSION["usuario"] = serialize($usuario);

				}
				break;
				
				
	case "update":
				{
				if($_POST['pass'] == $_POST['pass1'])
					{					
					$usuario = new Usuario($_GET["id"]);
					$usuario->set_nombre($_POST['nombre']);
					$usuario->set_apellido($_POST['apellido']);
					$usuario->set_telefono($_POST['telefono']);
					$usuario->set_email($_POST['email']);
					$usuario->set_user($_POST['usuario']);
					$usuario->set_password($_POST['pass']);
					$usuario->set_gerarquia($_POST['gerarquia']);
#				$usuario->set_user($_POST['user']);
#				$usuario->set_pass($_POST['pass']);
					$usuario->save();

					//ingreso un registro en el log
					$hoy = date("Y-m-d G:i:s"); 
					$texto = "Modificacion usuario ".$_GET["id"];
//					mysql_query("insert into log values(null,".$_usuario->get_id().",'".$texto."', '".$hoy."')");

					//	if($usuario->get_id_tipo() != 1 ){
						header("Location: index.php");
					//	}else{
					//	header("Location: index.php?accion=detail&id=".$_usuario->idUsuario);
					//	}
					}
				else
					{
					$mensaje_cabezera = "MODIFICACION DEL USUARIO";
					$cambio = "modificar";
					$detalle = false;
					$boton=true;							
					$deshabilitado = "";
					$usuario = new Usuario($_GET["id"]);
					$nombre = $usuario->get_nombre();
					$apellido=$usuario->get_apellido();
					$telefono = $usuario->get_telefono();
					$email=$usuario->get_email();
					$user=$usuario->get_user();
					$pass=$usuario->get_password();					
					$gerarquia=$usuario->get_gerarquia();					

		//			$gerarquia = Usuario::gerarquia_usuario($_usuario->id);
	//				include("../../../../view/usuario/usuarios/menu.php");
					include("../../view/usuarios/abm.php");
						echo"Las contraseņas ingresadas no coinciden";					
					}
	
				}
	}
?>