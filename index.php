<?php
session_start();

include_once("funciones.php");
conectar_bd();
$perfiles_vendedores = false;
$cagar_reciente = false;
$msj_error = "";
if(!isset($_GET["accion"]))$accion= "login";
else $accion = $_GET["accion"];
switch($accion):
	case "login": 
			if (isset($_POST["id"]) && isset($_POST["clave"])):

			$id = Pdv::login_admin($_POST["id"],$_POST["clave"]);
			if ($id):
				$datos = explode("-", $id);
				if($datos["0"] == 'PDV'):
			 		$_pdv = new Pdv($datos["1"]);
			  		$_SESSION["pdv"] = serialize($_pdv);
			  	elseif($datos["0"] == 'MERCHAN'):
			 		$_merchan = new Merchandiser($datos["1"]);
			  		$_SESSION["pdv"] = serialize($_merchan);			  		
			  	endif;	
			else:
				$msj_error = "El Usuario y/o la clave son invalidas, por favor verifiquelas";
		//		regresar();
			endif;
		endif;
		break;

	case "cantidad_vendedores":				
		if(isset($_POST["vendedores"])):
			$_pdv = unserialize($_SESSION["pdv"]);
			$vendedores = $_POST["vendedores"];
			$vendedores_actuales = $_pdv->cantidad_vendedores;
			Pdv::registro_vendedores($_pdv->id, $vendedores, $vendedores_actuales);
			$perfiles_vendedores = true;
		endif;	
		break;	
	case "carga_vendedores":
		$_pdv = unserialize($_SESSION["pdv"]);
		Vendedor::cargaVendedores($_POST,$_pdv->id,$_pdv->cantidad_vendedores);
		$cagar_reciente = true;
		break;
	case "cerrar_sesion": 
		session_destroy();
		session_start();
		break;
	case "mi_perfil":
			$habilitarCantVendedores = true;	
			include("view/perfil_vendedores.php");
			die;
		break;	

	case "modifica_clave":
			if($_POST["bases"] == "on"):
				if($_POST["clave1"] == $_POST["clave2"] ):
					$_pdv = unserialize($_SESSION["pdv"]);

					if($_pdv->tipo == "GT" or $_pdv->tipo == "KKAA"):
					$cambios= 	Pdv::modifica_clave($_POST, $_pdv->id);
						session_destroy();
						session_start();			
					 	$_pdv = new Pdv($cambios);
					  	$_SESSION["pdv"] = serialize($_pdv);		

					else:	
						$cambios= Merchandiser::modifica_clave($_POST, $_pdv->id);

						session_destroy();
						session_start();			
						$_pdv = new Merchandiser($cambios);
						$_SESSION["pdv"] = serialize($_pdv);					
						echo '<script type="text/javascript">

						window.location.assign("ctrl/home/index.php");
						</script>';

					endif;	
				else:
					$msj_error = "Clave y Repetir clave deben ser iguales, por favir ingrese nuevamente las claves";
				endif;	

			else:
				$msj_error = "Para continuar debe seleccionar las bases y condiciones";
			endif;	
		break;			


endswitch;


		if(!$_SESSION["pdv"]):
			include("view/index.php");
		else:
			$_pdv = unserialize($_SESSION["pdv"]);

			if($_pdv->basesycondiciones == 0):
						include("view/nueva_clave.php");
					die;
			endif;		


			if($_pdv->tipo == 3 or $_pdv->tipo == 4):
			// 	header("Location: ctrl/home/index.php");	
			echo '<script type="text/javascript">

			window.location.assign("ctrl/home/index.php");
			</script>';

			else:	

				$vendedoresCargados = Pdv::comprobar_vendedores( $_pdv->id,$_pdv->cantidad_vendedores); 
					if($_pdv->cantidad_vendedores == 0 ):
						include("view/vendedores.php");
					else:
						if($perfiles_vendedores or (!$vendedoresCargados and !$cagar_reciente)):
							include("view/perfil_vendedores.php");
						else:
						echo '<script type="text/javascript">
						window.location.assign("ctrl/home/index.php");
						</script>';
						
						// 	header("Location: ctrl/home/index.php");					
						endif;	
					endif;

			endif;		
		endif;
?>
