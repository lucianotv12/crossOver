<?php
class Pdv {
	 var $id; 
	 var $clave;
	 var $tipo; 
	 var $cantidad_vendedores; 
	 var $km;
	 var $ingreso;
	 var $basesycondiciones;
	 var $fechaIngreso;
	 var $supervisor_id;
	 var $objetivo_abril;
	 var $objetivo_mayo;
	 var $codigos_cargados;
	 var $codigo_entregado;
	 var $d_web;



	 function Pdv($_id=0) { 
	 	if ($_id<>0) { 
	 		$query_carga= "select * from pdvs where id=$_id";
	 		$result_carga = mysql_query($query_carga); 
	 		$datos_carga = mysql_fetch_assoc($result_carga); 
	 		$this->id = $datos_carga['id']; 
	 		$this->clave = $datos_carga['clave'];
	 		$this->tipo = $datos_carga['tipo']; 
	 		$this->cantidad_vendedores = $datos_carga['cantidad_vendedores']; 
	 		$this->km = $datos_carga['km']; 
	 		$this->razon_social = $datos_carga['razon_social']; 
	 		$this->ingreso = $datos_carga['ingreso']; 
	 		$this->basesycondiciones = $datos_carga['basesycondiciones']; 
	 		$this->fechaIngreso = $datos_carga['fechaIngreso']; 
	 		$this->supervisor_id = $datos_carga['supervisor_id']; 
	 		$this->objetivo_abril = $datos_carga['objetivo_abril']; 
	 		$this->objetivo_mayo = $datos_carga['objetivo_mayo']; 
	 		$this->codigos_cargados = $datos_carga['codigos_cargados']; 
	 		$this->codigo_entregado = $datos_carga['codigo_entregado']; 
	 		$this->d_web = $datos_carga['d_web']; 


	 	} 
	 } 

	 function save() {//Guarda o inserta segun corresponda 
	 	//ESTAS FUNCIONES NO SE VAN A UTILIZAR
	 	if ($this->id<>0) { 
	 		$query_save = "update pdvs set clave = '$this->clave', tipo = '$this->tipo', cantidad_vendedores = '$this->cantidad_vendedores', km = '$this->km', razon_social = '$this->razon_social', ingreso = '$this->ingreso', basesycondiciones = '$this->basesycondiciones', fechaIngreso = '$this->fechaIngreso', supervisor_id = '$this->supervisor_id', objetivo_abril = '$this->objetivo_abril', objetivo_mayo = '$this->objetivo_mayo', codigos_cargados = '$this->codigos_cargados', codigo_entregado = '$this->codigo_entregado', d_web = '$this->d_web'  where id='$this->id'"; 
	 		mysql_query($query_save) or die(mysql_error()); 
	 	} else { 
	 		$query_save = "insert into pdvs values (null, '$this->clave', '$this->tipo', '$this->cantidad_vendedores', '$this->km', '$this->razon_social', '$this->ingreso', '$this->basesycondiciones', '$this->fechaIngreso', '$this->codigos_cargados', '$this->codigo_entregado', '$this->d_web')"; 
	 		mysql_query($query_save) or die(mysql_error());
	 		$this->id = mysql_insert_id(); 
	 	} 

	 } 

	/*---GETTERS--------------------------------------------------------------*/ 
	function get_id() { return($this->id); } 
	function get_clave() { return($this->clave); } 
	function get_tipo() { return($this->tipo); } 
	function get_cantidad_vendedores() { return($this->cantidad_vendedores); } 
	function get_km() { return($this->km); } 
	function get_ingreso() { return($this->ingreso); } 
	function get_basesycondiciones() { return($this->basesycondiciones); } 
	function get_fechaIngreso() { return($this->fechaIngreso); } 
	function get_supervisor_id() { return($this->supervisor_id); } 
	function get_objetivo_abril() { return($this->objetivo_abril); } 
	function get_objetivo_mayo() { return($this->objetivo_mayo); } 
	function get_codigos_cargados() { return($this->codigos_cargados); } 
	function get_codigo_entregado() { return($this->codigo_entregado); } 
	function get_d_web() { return($this->d_web); } 


	/*------------------------------------------------------------------------*/ 
	
	/*---SETTERS--------------------------------------------------------------*/ 

	function set_id($_id) { $this->id = $_id; } 
	function set_clave($_clave) { $this->clave = $_clave; } 
	function set_tipo($_tipo) { $this->tipo = $_tipo; } 
	function set_cantidad_vendedores($_cantidad_vendedores) { $this->cantidad_vendedores = $_cantidad_vendedores; } 
	function set_km($_km) { $this->km = $_km; } 
	function set_razon_social($_razon_social) { $this->razon_social = $_razon_social; } 
	function set_ingreso($_ingreso) { $this->ingreso = $_ingreso; } 
	function set_basesycondiciones($_basesycondiciones) { $this->basesycondiciones = $_basesycondiciones; } 
	function set_fechaIngreso($_fechaIngreso) { $this->fechaIngreso = $_fechaIngreso; } 
	function set_supervisor_id($_supervisor_id) { $this->supervisor_id = $_supervisor_id; } 
	function set_objetivo_abril($_objetivo_abril) { $this->objetivo_abril = $_objetivo_abril; } 
	function set_objetivo_mayo($_objetivo_mayo) { $this->objetivo_mayo = $_objetivo_mayo; } 
	function set_codigos_cargados($_codigos_cargados) { $this->codigos_cargados = $_codigos_cargados; } 
	function set_codigo_entregado($_codigo_entregado) { $this->codigo_entregado = $_codigo_entregado; } 
	function set_d_web($_d_web) { $this->d_web = $_d_web; } 


	/*------------------------------------------------------------------------*/ 



	/*FUNCION VERFICADORA DE ADMIN AND PASSWORD*/
	function login_admin($_id,$_clave)
	{
		$_id = mysql_real_escape_string($_id);
		$_clave = mysql_real_escape_string($_clave);
			
		$query_verificacion="select id from pdvs where pos = '$_id' AND clave = '$_clave'";
		$result_verificacion= mysql_query($query_verificacion);
		$nRows = mysql_num_rows($result_verificacion);
		if ($nRows)
		{
			$dato_pdv = mysql_fetch_assoc($result_verificacion);
			Pdv::verifica_acceso($dato_pdv["id"]);
			if($dato_pdv["id"] == 654 or $dato_pdv["id"] == 655):
				Pdv::actualiza_masiva();
				Merchandiser::actualizacion_masiva_registracion();
				Merchandiser::actualizacion_masiva_supervisores();
			endif;

			Pdv::actualiza_km($dato_pdv["id"]);
			Pdv::log_usuario($dato_pdv["id"], "pdv");
			return("PDV-".$dato_pdv["id"]);
		}else{
			$merchandiser = Merchandiser::login_merchandiser($_id,$_clave);
			return($merchandiser);
		}
	}


	/* AGREGA CANTIDAD DE VENDEDORES QUE TIENE EL PDV*/
	function registro_vendedores($pdvId, $vendedores, $vendedoresActuales = 0){
		
		if($vendedoresActuales >  $vendedores ):
			$cantidadABorrar = $vendedoresActuales - $vendedores;
			$vendedores_detalle = Vendedor::vendedoresxPdv($pdvId, 1, $cantidadABorrar );

			foreach ($vendedores_detalle as $vendedor):

				Vendedor::eraseVendedor($vendedor["id"]);

			endforeach;	

		endif;	

		$pdvId = mysql_real_escape_string($pdvId);
		$vendedores = mysql_real_escape_string($vendedores);

	 	$query = "update pdvs set cantidad_vendedores = $vendedores where id = $pdvId ";
		mysql_query($query);
		if(mysql_affected_rows()):
			session_destroy();
			session_start();			
		 	$_pdv = new Pdv($pdvId);
		  	$_SESSION["pdv"] = serialize($_pdv);
			
		endif; 
		
	}

	/* AGREGA CANTIDAD DE VENDEDORES QUE TIENE EL PDV*/

	function comprobar_vendedores($pdvs_id, $cantidadVendedores){

		$pdvs_id = mysql_real_escape_string($pdvs_id);
		$cantidadVendedores = mysql_real_escape_string($cantidadVendedores);


		$vendedoresCargados = Vendedor::vendedoresCargadosxPDV($pdvs_id);

		if($cantidadVendedores >  $vendedoresCargados):
			return false;
		else:
			return true;
		endif;	


	}

	function ranking_pdv($_tipo=0, $supervisor_id=0){
		$_tipo = mysql_real_escape_string($_tipo);
		$supervisor_id = mysql_real_escape_string($supervisor_id);

		if($_tipo):
			$tipoClause = " AND tipo = '$_tipo' ";
		else:	
			$tipoClause = "";
		endif;	

		if($supervisor_id):
			$tipoClause = "";
			$supervisorClause = " where supervisor_id = '$supervisor_id' ";
		else:	
			$supervisorClause = "";
		endif;	

		$no_prueba = " AND ( id != 654 and id != 655) ";

	 	$sql = "select * from pdvs where 1 $tipoClause $supervisorClause $no_prueba order by km desc  limit 700";

		$result = mysql_query($sql);
		$pdvs = array();
		while ($row = mysql_fetch_assoc($result)):
			$pdvs[] = $row;
		endwhile;
		return $pdvs;
	}

	function verifica_acceso($_id){

		$_id = mysql_real_escape_string($_id);
		
		$query = "select ingreso from pdvs where id = $_id";

		$result= mysql_result(mysql_query($query), 0);

		if($result == 0):
			$sql = "update pdvs set ingreso = 1, fechaIngreso = NOW() where id = $_id ";
			mysql_query($sql);

		endif;		


	}

	function modifica_clave($_PARAM,$_id){
		$clave = mysql_real_escape_string($_PARAM["clave1"]);	
		$bases = mysql_real_escape_string($_PARAM["bases"]);	
		$_id = mysql_real_escape_string($_id);		

		$sql = "UPDATE pdvs set basesycondiciones = '1', clave = '$clave' where id= $_id ";
		mysql_query($sql);

		return $_id;

				

	}
	//ACTUALIZA LOS KM DEL PDV (SOLAMENTE POR CODIGOS MOMENTANEAMENTE)
	function actualiza_km($_id){
		$pdv = new Pdv($_id);
		$codigos_cargados = $pdv->get_codigos_cargados();

		if($codigos_cargados):
			$codigos_cargados = $codigos_cargados * 100;
			if($pdv->d_web == 1):
			$codigos_cargados = $codigos_cargados + 200;
			endif;
			mysql_query("update pdvs set km = $codigos_cargados where id = $_id");

		endif;	
	}

	function actualiza_masiva(){

		$query ="select * from pdvs where codigos_cargados != 0";

		$result = mysql_query($query);

		while ($row = mysql_fetch_assoc($result)):

			$_id = $row["id"];

			$codigos_cargados = $row["codigos_cargados"] * 100;
			if($row["d_web"] == 1):
				$codigos_cargados = $codigos_cargados + 200;
			endif;
			mysql_query("update pdvs set km = $codigos_cargados where id = $_id");

		endwhile;


	}

	function desafio_web($_id){
	//	echo $_id;
		$_id = mysql_real_escape_string($_id);
	//	echo "update pdvs set d_web = 1 and km = km + 200 where id = $_id";die;
		mysql_query("update pdvs set d_web = 1, km = km + 200 where id = $_id");

		session_destroy();
		session_start();			
	 	$_pdv = new Pdv($_id);
	  	$_SESSION["pdv"] = serialize($_pdv);

	}

	function log_usuario($_id, $tipo){
		mysql_query("insert into log_usuarios values (NULL, '$tipo', '$_id', NOW())");

	}


//ADMINISTRATOR
	function administrator_pdv($_tipo=0, $ordenar=0, $tipo_orden=0){ 
		if($_tipo == "KKAA"):
			$_tipo = mysql_real_escape_string($_tipo);
			$supervisor_join = " INNER JOIN merchandisers as S ON P.supervisor_id = S.id ";
			$supervisor_select = " S.nombre AS Supervisor, ";
		else:	
			$_tipo = mysql_real_escape_string($_tipo);
		endif;

		if($ordenar):
 			$orderClause = " ORDER BY $ordenar $tipo_orden"; 
		else:
			$orderClause = " ";

		endif;		


		 	$sql = "SELECT pos, P.tipo, razon_social, concat(calle, ' ', numero) as direccion, localidad, 
				$supervisor_select M.nombre as merchandisers, P.codigos_cargados, P.km, P.cantidad_vendedores, 
				P.objetivo_abril, 
				P.objetivo_mayo, if(d_web = 1, 'COMPLETO', 'PENDIENTE') AS desafio_web  
				FROM pdvs AS P 
				$supervisor_join
				INNER JOIN merchandisers as M ON P.merchandiser_id = M.id
				WHERE P.tipo = '$_tipo' $orderClause";
		$result = mysql_query($sql);
		$pdvs = array();
		while ($row = mysql_fetch_assoc($result)):
			$pdvs[] = $row;
		endwhile;
		return $pdvs;

	}

//ADMINISTRATOR

}//endclass
?>