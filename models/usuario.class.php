<?
class Usuario 
{
	
	var $idUsuario; 
	var $nombre; 
	var $apellido; 
	var $telefono; 
	var $email; 
	var $user; 
	var $password; 
	var $gerarquia; 

	function Usuario($_id=0) 
	{
		if ($_id<>0) 
		{
		$query_carga= "select * from usuarios where idUsuario=$_id"; 
		$result_carga = mysql_query($query_carga); 
		$datos_carga = mysql_fetch_assoc($result_carga); 
		$this->idUsuario = $datos_carga['idUsuario']; 
		$this->nombre = $datos_carga['nombre']; 
		$this->apellido = $datos_carga['apellido']; 
		$this->telefono = $datos_carga['telefono']; 
		$this->email = $datos_carga['email']; 
		$this->user = $datos_carga['user']; 
		$this->password = $datos_carga['password']; 
		$this->gerarquia = $datos_carga['gerarquia']; 
		}
	}
	 function save() 
	 {//Guarda o inserta segun corresponda
		if ($this->idUsuario<>0) 
			{ 
				$query_save = "update usuarios set nombre = '$this->nombre', apellido = '$this->apellido', telefono = '$this->telefono', email = '$this->email', user = '$this->user', password = '$this->password', gerarquia = '$this->gerarquia' where idUsuario=$this->idUsuario"; 
				mysql_query($query_save) or die(mysql_error()); 
			}
			else
			{
				$query_save = "insert into usuarios values (null, '$this->nombre', '$this->apellido', '$this->telefono', '$this->email', '$this->user', '$this->password', '$this->gerarquia')";
				mysql_query($query_save) or die(mysql_error()); 
			//echo $query_save; die();
				$this->id = mysql_insert_id(); 
			}
	}

	function erase()
		{//Borra el CONTACTO, segun el ID, 
		if ($this->idUsuario<>0)
			{
				$query_erase = "DELETE FROM usuarios WHERE idUsuario = $this->idUsuario ";
				mysql_query($query_erase) or die(mysql_error());
			}
		
		}


	/*------------------------------------------------------------------------*/
	/* Metodo NUEVO USUARIO : realiza el ingreso de nuevo, validando que los datos ingresados sean validos, 
	/*retornando TRUE en el caso de que pudo ser creado; o False en el caso contrario.
	/*------------------------------------------------------------------------*/		
	function nuevo_usuario($_PARAM)
		{
		$nombreyapellido = mysql_num_rows( mysql_query ("Select idUsuario From usuarios WHERE nombre = '" .$_PARAM["nombre"]."' AND  apellido = '".$_PARAM["apellido"]."'"));
		$email = mysql_num_rows( mysql_query ("Select idUsuario From usuarios WHERE email = '" .$_PARAM["email"]."'"));		
	//	$usuario= mysql_num_rows( mysql_query ("Select idUsuario From usuarios WHERE user = '" .$_PARAM["user"]."'"));

	//	if(

	//			$nombreyapellido == 0	AND	
	//			$email == 0	AND
	//			$usuario == 0		
	//		)	
	//		{
	//				echo "entro aca"; die();
			$usuario = new Usuario ();
			$usuario->set_nombre($_PARAM['nombre']);
			$usuario->set_apellido($_PARAM['apellido']);
			$usuario->set_telefono($_PARAM['telefono']);
			$usuario->set_email($_PARAM['email']);
			$usuario->set_user($_PARAM['usuario']);
			$usuario->set_password($_PARAM['pass']);
			$usuario->set_gerarquia($_PARAM['gerarquia']);
			$usuario->save();
	//		}	
			
		}

	/*FUNCION VERFICADORA DE ADMIN AND PASSWORD*/
	function login_admin($_user,$_password)
		{
		$query_verificacion="select idUsuario from usuarios where user = '$_user' AND password = '$_password'";
		$result_verificacion= mysql_query($query_verificacion);
		$nRows = mysql_num_rows($result_verificacion);
		if ($nRows)
			{
			$dato_usuario = mysql_fetch_assoc($result_verificacion);
			return($dato_usuario["idUsuario"]);
			}
		else
			{
			return(false);
			}
		}

	/*------------------------------------------------------------------------*/
	/* Metodo que  devuelve el listado de todos los usuarios
	/*------------------------------------------------------------------------*/
	function get_usuarios($start, $end)
	{
		$query_listado="Select * from usuarios order by apellido,nombre LIMIT " . $start . ", " . $end;
		$result_listado = mysql_query($query_listado);
		$usuarios = array();
		while ($dato_usuario = mysql_fetch_assoc($result_listado))
		{
		$usuarios[] = new Usuario($dato_usuario["idUsuario"]);
		}
		mysql_free_result($result_listado);
		return($usuarios);
	}

	function total_usuarios()
	{
	$query_all = "select idUsuario from usuarios";
	$result_all = mysql_query($query_all) or die(mysql_error());
	$nrows = mysql_num_rows($result_all);	
	return($nrows);
	}


	
	/*------------------------------------------------------------------------*/
	/* Funcion que retorna un booleano indicando si el usuario es Aministrador
	/*------------------------------------------------------------------------*/
	function es_administrador()
		{
		if ($this->gerarquia==1)
			{
			return true;
			}
		else
			{
			return false;
			}
		}
	
	/*---GETTERS--------------------------------------------------------------*/ 


	/*---Funcion, que devuelve el nombre completo del usuario--------------   */
	function get_nombre_completo ()
	{
	 return($this->nombre ." ".  $this->apellido);

	}

	function get_idUsuario() { 
		return($this->idUsuario); 
	}
	function get_nombre() { 
		return($this->nombre); 
	} 
	function get_apellido() {
		return($this->apellido); 
	}
	function get_telefono() {
		return($this->telefono); 
	} 
	function get_email() {
		return($this->email); 
	} 
	function get_user() { 
		return($this->user); 
	}
	function get_password() {
		return($this->password); 
	}
	function get_gerarquia() {
		return($this->gerarquia); 
	}
	/*------------------------------------------------------------------------*/ /*---SETTERS--------------------------------------------------------------*/ 
	function set_idUsuario($_idUsuario) {
		$this->idUsuario = $_idUsuario; 
	}
	function set_nombre($_nombre) {
		$this->nombre = $_nombre; 
	}
	function set_apellido($_apellido) {
		$this->apellido = $_apellido; 
	}
	function set_telefono($_telefono) {
		$this->telefono = $_telefono; 
	}
	function set_email($_email) {
		$this->email = $_email; 
	}
	function set_user($_user) {
		$this->user = $_user; 
	}
	function set_password($_password) {
		$this->password = $_password; 
	}
	function set_gerarquia($_gerarquia) {
		$this->gerarquia = $_gerarquia; 
	}
	/*------------------------------------------------------------------------*/ 
}

?>