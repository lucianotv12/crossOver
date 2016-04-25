<?php
class Cliente 
{
	var $id; 
	var $idTipo; 
	var $nombre; 
	var $domicilio; 
	var $idLocalidad; 
	var $idProvincia; 
	var $pais; 
	var $cp; 
	var $telefono; 
	var $telefono2; 
	var $contacto; 
	var $mail; 
	var $web; 
	var $fechaCarga; 
	var $idUsuario; 
	var $activo; 
	var $observaciones;
	var $idVendedor;
	var $descuento;
	var $nro_cuit;
	var $condicion_iva;
	
	function Cliente($_id=0) 
	{ 
		if ($_id<>0) 
		{ 
			$query_carga= "select * from clientes where id=$_id"; 
			$result_carga = mysql_query($query_carga); 
			$datos_carga = mysql_fetch_assoc($result_carga); 
			$this->id = $datos_carga['id']; 
			$this->idTipo = $datos_carga['idTipo']; 
			$this->nombre = $datos_carga['nombre']; 
			$this->domicilio = $datos_carga['domicilio']; 
			$this->idLocalidad = $datos_carga['idLocalidad']; 
			$this->idProvincia = $datos_carga['idProvincia']; 
			$this->pais = $datos_carga['pais']; 
			$this->cp = $datos_carga['cp']; 
			$this->telefono = $datos_carga['telefono']; 
			$this->telefono2 = $datos_carga['telefono2']; 
			$this->contacto = $datos_carga['contacto']; 
			$this->mail = $datos_carga['mail']; 
			$this->web = $datos_carga['web']; 
			$this->fechaCarga = $datos_carga['fechaCarga']; 
			$this->idUsuario = $datos_carga['idUsuario']; 
			$this->activo = $datos_carga['activo']; 
			$this->observaciones = $datos_carga['observaciones'];
			$this->idVendedor = $datos_carga['idVendedor'];
			$this->descuento = $datos_carga['descuento'];
			$this->nro_cuit = $datos_carga['nro_cuit'];
			$this->condicion_iva = $datos_carga['condicion_iva'];
		}
	}

	function save() 
	{//Guarda o inserta segun corresponda 
		if ($this->id<>0) 
			{ 
			$query_save = "update clientes set idTipo = '$this->idTipo', nombre = '$this->nombre', domicilio = '$this->domicilio', idLocalidad = '$this->idLocalidad', idProvincia = '$this->idProvincia', pais = '$this->pais', cp = '$this->cp', telefono = '$this->telefono', telefono2 = '$this->telefono2', contacto = '$this->contacto', mail = '$this->mail', web = '$this->web', fechaCarga = '$this->fechaCarga', idUsuario = '$this->idUsuario', activo = '$this->activo', observaciones = '$this->observaciones',idVendedor = '$this->idVendedor',descuento = '$this->descuento',nro_cuit = '$this->nro_cuit',condicion_iva = '$this->condicion_iva'  where id='$this->id'"; 
			mysql_query($query_save) or die(mysql_error()); 
			}
		else 
			{
			$query_save = "insert into clientes values (null, '$this->idTipo', '$this->nombre', '$this->domicilio', '$this->idLocalidad', '$this->idProvincia', '$this->pais', '$this->cp', '$this->telefono', '$this->telefono2', '$this->contacto', '$this->mail', '$this->web', '$this->fechaCarga', '$this->idUsuario', '$this->activo','$this->observaciones','$this->idVendedor','$this->descuento','$this->nro_cuit', '$this->condicion_iva')"; 
			mysql_query($query_save) or die(mysql_error()); $this->id = mysql_insert_id(); 
			} 
	}


	function erase()
		{//Borra el CONTACTO, segun el ID, 
		if ($this->id<>0)
			{
				$query_erase = "DELETE FROM clientes WHERE id = $this->id ";
				mysql_query($query_erase) or die(mysql_error());
			}
		
		}	

	function nuevo_cliente($_PARAM, $_idtipo)
	{
		$cliente = new Cliente ();
		$cliente->set_idTipo($_idtipo);
		$cliente->set_nombre($_PARAM['nombre']);
		$cliente->set_domicilio($_PARAM['domicilio']);
		$cliente->set_idLocalidad($_PARAM['cmbLocalidad']);
		$cliente->set_idProvincia($_PARAM['cmbProvincia']);
		$cliente->set_pais('Argentina');
		$cliente->set_cp($_PARAM['cp']);
		$cliente->set_telefono($_PARAM['telefono']);
		$cliente->set_telefono2($_PARAM['telefono2']);
		$cliente->set_contacto($_PARAM['contacto']);
		$cliente->set_mail($_PARAM['mail']);
		$cliente->set_web($_PARAM['web']);
		$cliente->set_fechaCarga('0');
		$cliente->set_idUsuario($_PARAM['idUsuario']);
		$cliente->set_activo(1);
		$cliente->set_observaciones($_PARAM['observaciones']);
		$cliente->set_idVendedor($_PARAM['idVendedor']);
		$cliente->set_descuento($_PARAM['descuento']);
		$cliente->set_nro_cuit($_PARAM['nro_cuit']); 
		$cliente->set_condicion_iva($_PARAM['condicion_iva']); 
		$cliente->save();

	
	}

	function get_clientes($start=0, $end=0,$_id_tipo,$busqueda=0)
	{
		if($start==0 and $end== 0)	$limit ="" ; else $limit = "LIMIT $start , $end";
		if($busqueda) $whereclause = "AND (nombre like '%$busqueda%' or domicilio like '%$busqueda%' OR telefono like '%$busqueda%' OR contacto like '%$busqueda%' OR mail like '%$busqueda%')"; else $whereclause ="";
		$query_listado = "Select * FROM clientes where idTipo = $_id_tipo and activo = 1 $whereclause order by id $limit";
		$result_listado = mysql_query($query_listado);
		$clientes = array();
		while ($dato_cliente = @mysql_fetch_assoc($result_listado))
		{
		$clientes[] = new Cliente($dato_cliente["id"]);
		}
		@mysql_free_result($result_listado);
		return($clientes);
	}

	function get_clientes_deudores()
	{
		include_once("facturas.class.php");
		$query_listado = "Select * FROM clientes where idTipo = 1 and activo = 1 order by id ";
		$result_listado = mysql_query($query_listado);
		$clientes = array();
		while ($dato_cliente = @mysql_fetch_assoc($result_listado))
		{
			$es_deudor= Factura::get_cliente_deudor($dato_cliente["id"]);
			
			if($es_deudor == "<FONT COLOR=RED><B>DEUDOR</B></FONT>")
			{
			$clientes[] = new Cliente($dato_cliente["id"]);
			}
		}
		@mysql_free_result($result_listado);
		return($clientes);
	
		
	}

	function total_clientes()
	{
	$query_all = "select id from clientes";
	$result_all = mysql_query($query_all) or die(mysql_error());
	$nrows = mysql_num_rows($result_all);	
	return($nrows);
	}

	function get_provincias()
	{
		$whereclause = "idProvincia = 1 AND ";
		$query = "SELECT * from provincias where  Activo = 1 order by Descripcion";
		$result_listado = mysql_query($query);
		$provincias = array();
		while ($row = @mysql_fetch_assoc($result_listado))
		{
		$provincias[] = $row;
		}
		@mysql_free_result($result_listado);
		return($provincias);
	}

	function get_localidades($idProvincia)
	{
		$query = "SELECT idLocalidad, Descripcion from localidades where Activo = 1 and idProvincia = $idProvincia order by Descripcion";
		$result_listado = mysql_query($query);
		$localidades = array();
		while ($row = @mysql_fetch_assoc($result_listado))
		{
		$localidades[] = $row;
		}
		@mysql_free_result($result_listado);
		return($localidades);	
	}

	function get_vendedores()
	{
		$query = "SELECT * from vendedores where activo = 1  order by nombre";
		$result_listado = mysql_query($query);
		$vendedores = array();
		while ($row = @mysql_fetch_assoc($result_listado))
		{
		$vendedores[] = $row;
		}
		@mysql_free_result($result_listado);
		return($vendedores);	
	}


	/*---GETTERS--------------------------------------------------------------*/ 
	function get_id() { return($this->id); } 
	function get_idTipo() { return($this->idTipo); } 
	function get_nombre() { return($this->nombre); } 
	function get_domicilio() { return($this->domicilio); } 
	function get_idLocalidad() { return($this->idLocalidad); } 
	function get_idProvincia() { return($this->idProvincia); } 
	function get_pais() { return($this->pais); } 
	function get_cp() { return($this->cp); } 
	function get_telefono() { return($this->telefono); } 
	function get_telefono2() { return($this->telefono2); } 
	function get_contacto() { return($this->contacto); } 
	function get_mail() { return($this->mail); } 
	function get_web() { return($this->web); } 
	function get_fechaCarga() { return($this->fechaCarga); } 
	function get_idUsuario() { return($this->idUsuario); } 
	function get_activo() { return($this->activo); } 
	function get_observaciones() { return($this->observaciones); } 
	function get_idVendedor() { return($this->idVendedor); } 
	function get_descuento() { return($this->descuento); } 
	function get_nro_cuit() { return($this->nro_cuit); } 
	function get_condicion_iva() { return($this->condicion_iva); } 

	function get_localidad()
	{
//	echo $hola = $this->idLocalidad; die();
		// mysql_query("select Descripcion from localidades where idLocalidad = " . $this->idLocalidad); die();
	return ($query = @mysql_result(mysql_query("select Descripcion from localidades where idLocalidad = " . $this->idLocalidad),0));	
	}

	function get_provincia()
	{
//	echo $hola = $this->idLocalidad; die();
		// mysql_query("select Descripcion from localidades where idLocalidad = " . $this->idLocalidad); die();
	return ($query = @mysql_result(mysql_query("select Descripcion from provincias where idProvincia = " . $this->idProvincia),0));	
	}

	/*------------------------------------------------------------------------*/ 
	
	/*---SETTERS--------------------------------------------------------------*/ 
	function set_id($_id) { $this->id = $_id; } 
	function set_idTipo($_idTipo) { $this->idTipo = $_idTipo; } 
	function set_nombre($_nombre) { $this->nombre = $_nombre; } 
	function set_domicilio($_domicilio) { $this->domicilio = $_domicilio; } 
	function set_idLocalidad($_idLocalidad) { $this->idLocalidad = $_idLocalidad; } 
	function set_idProvincia($_idProvincia) { $this->idProvincia = $_idProvincia; } 
	function set_pais($_pais) { $this->pais = $_pais; } 
	function set_cp($_cp) { $this->cp = $_cp; } 
	function set_telefono($_telefono) { $this->telefono = $_telefono; } 
	function set_telefono2($_telefono2) { $this->telefono2 = $_telefono2; } 
	function set_contacto($_contacto) { $this->contacto = $_contacto; } 
	function set_mail($_mail) { $this->mail = $_mail; } 
	function set_web($_web) { $this->web = $_web; } 
	function set_fechaCarga($_fechaCarga) { $this->fechaCarga = $_fechaCarga; } 
	function set_idUsuario($_idUsuario) { $this->idUsuario = $_idUsuario; } 
	function set_activo($_activo) { $this->activo = $_activo; }
	function set_observaciones($_observaciones) { $this->observaciones = $_observaciones; }
	function set_idVendedor($_idVendedor) { $this->idVendedor = $_idVendedor; }
	function set_descuento($_descuento) { $this->descuento = $_descuento; }
	function set_nro_cuit($_nro_cuit) { $this->nro_cuit = $_nro_cuit; }
	function set_condicion_iva($_condicion_iva) { $this->condicion_iva = $_condicion_iva; }


	/*------------------------------------------------------------------------*/ 


}
	


?>