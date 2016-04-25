<?php
class Merchandiser {

	 var $id;
	 var $nombre; 
	 var $jefe_id; 
	 var $gerente_id;
	 var $activo; 
	 var $dni; 
	 var $clave; 
	 var $tipo; 
	 var $ingreso;
	 var $basesycondiciones;
	 var $fechaIngreso;
	 var $codigos_cargados;
	 var $km;
	 var $d_registracion;
	 var $d_codigos;
	 var $d_volumen;


	 function Merchandiser($_id=0) {

	 	 if ($_id<>0) { 
	 	 	$query_carga= "select * from merchandisers where id=$_id";
	 	 	 $result_carga = mysql_query($query_carga); 
	 	 	 $datos_carga = mysql_fetch_assoc($result_carga); 
	 	 	 $this->id = $datos_carga['id'];
	 	 	 $this->nombre = $datos_carga['nombre']; 
	 	 	 $this->jefe_id = $datos_carga['jefe_id']; 
	 	 	 $this->gerente_id = $datos_carga['gerente_id'];
	 	 	 $this->activo = $datos_carga['activo']; 
	 	 	 $this->dni = $datos_carga['dni']; 
	 	 	 $this->clave = $datos_carga['clave']; 
	 	 	 $this->tipo = $datos_carga['tipo']; 
	 	 	 $this->ingreso = $datos_carga['ingreso']; 
	 	 	 $this->basesycondiciones = $datos_carga['basesycondiciones']; 
	 	 	 $this->fechaIngreso = $datos_carga['fechaIngreso']; 
	 	 	 $this->codigos_cargados = $datos_carga['codigos_cargados']; 
	 	 	 $this->km = $datos_carga['km']; 
	 	 	 $this->d_registracion = $datos_carga['d_registracion']; 
	 	 	 $this->d_codigos = $datos_carga['d_codigos']; 
	 	 	 $this->d_volumen = $datos_carga['d_volumen']; 
	 	 	 
	 	 }
	 }
	 function save() {//Guarda o inserta segun corresponda
	 	if ($this->id<>0) { 
	 		$query_save = "update merchandisers set nombre = '$this->nombre', jefe_id = '$this->jefe_id', gerente_id = '$this->gerente_id', activo = '$this->activo', dni = '$this->dni', clave = '$this->clave', tipo = '$this->tipo', ingreso = '$this->ingreso', basesycondiciones = '$this->basesycondiciones', fechaIngreso = '$this->fechaIngreso', codigos_cargados = '$this->codigos_cargados', km = '$this->km', d_registracion = '$this->d_registracion', d_codigos = '$this->d_codigos', d_volumen = '$this->d_volumen' where id='$this->id'"; 
	 		mysql_query($query_save) or die(mysql_error()); 
	 	} else { 
	 		$query_save = "insert into merchandisers values (null, '$this->nombre', '$this->jefe_id', '$this->gerente_id', '$this->activo', '$this->dni', '$this->clave', '$this->tipo', '$this->ingreso', '$this->basesycondiciones', '$this->fechaIngreso', '$this->codigos_cargados', '$this->km', '$this->d_registracion', '$this->d_codigos', '$this->d_volumen')"; 
	 		mysql_query($query_save) or die(mysql_error()); 
	 		$this->id = mysql_insert_id(); 
	 	} 

	 }


	/*FUNCION VERFICADORA DE ADMIN AND PASSWORD*/
	function login_merchandiser($_id,$_clave)
	{	
		$_id = mysql_real_escape_string($_id);
		$_clave = mysql_real_escape_string($_clave);
			
		 $query_verificacion="select id from merchandisers where dni = '$_id' AND clave = '$_clave'";
		$result_verificacion= mysql_query($query_verificacion);
		$nRows = mysql_num_rows($result_verificacion);
		if ($nRows)
		{	
			$dato_merchandiser = mysql_fetch_assoc($result_verificacion);
			Merchandiser::verifica_acceso($dato_merchandiser["id"]);		
			//DESAFIO REGISTRACION
			$merchan = new Merchandiser($dato_merchandiser["id"]);
			$merchan_tipo = $merchan->get_tipo();
			$merchan_jefe = $merchan->get_jefe_id();

			if($merchan_tipo == 3 and $merchan_jefe != 1):
				//logica registracion
			 	$total_pos = mysql_result(mysql_query("select count(id) from pdvs where merchandiser_id = " . $merchan->get_id()),0);
				$total_registrados = mysql_result(mysql_query("select count(id) from pdvs where merchandiser_id = " . $merchan->get_id() . " and ingreso = 1"),0);

				$porcentaje_registro = $total_registrados * 100 / $total_pos; 


				if($porcentaje_registro > 39):
					if( $porcentaje_registro >= 40 and $porcentaje_registro < 50):
						$porcentaje =  "100";
					elseif( $porcentaje_registro >= 50 and $porcentaje_registro < 60):
						$porcentaje = "200";
					elseif( $porcentaje_registro >= 60 and $porcentaje_registro < 70):
						$porcentaje = "300";
					elseif( $porcentaje_registro >= 70 and $porcentaje_registro < 80):
						$porcentaje = "400";
					elseif( $porcentaje_registro >= 80 and $porcentaje_registro < 90):
						$porcentaje = "500";
					elseif( $porcentaje_registro >= 90 and $porcentaje_registro < 100):
						$porcentaje = "600";					
					elseif( $porcentaje_registro == 100):
						$porcentaje = "700";
					endif;

					$total_km = $merchan->get_d_codigos + $merchan->get_d_volumen + $porcentaje;

					//update d_registracion and km
					mysql_query("update merchandisers set d_registracion = '$porcentaje', km = '$total_km' where id = ". $merchan->get_id());
				endif;	
			endif;	




			//DESAFIO REGISTRACION

			return("MERCHAN-" . $dato_merchandiser["id"]);			
		}else{
			return(false);
		}

	}


	function ranking_merchan($_id){
		
		$_id = mysql_real_escape_string($_id);
		$no_prueba = " AND ( id != 48 and id != 49) ";

		if($_id == 3):

			$_merchan = unserialize($_SESSION["pdv"]);
			$zona = $_merchan->gerente_id;
			$jefe = $_merchan->id;

			if($zona != 0):
				$merchanClause = " AND gerente_id = $zona";
			else:
				$merchanClause = " AND jefe_id = $jefe ";
			endif;	

		endif;	

		$id = mysql_real_escape_string($_id);
	 	$sql = "select * from merchandisers where tipo = $id $merchanClause $no_prueba order by km desc";
		$result = mysql_query($sql);
		$pdvs = array();
		while ($row = mysql_fetch_assoc($result)):
			$pdvs[] = $row;
		endwhile;
		return $pdvs;
	}


	function verifica_acceso($_id){

		$_id = mysql_real_escape_string($_id);
		
		$query = "select ingreso from merchandisers where id = $_id";

		$result= mysql_result(mysql_query($query), 0);

		if($result == 0):
			$sql = "update merchandisers set ingreso = 1, fechaIngreso = NOW() where id = $_id ";
			mysql_query($sql);

		endif;		


	}

	function modifica_clave($_PARAM,$_id){
		$clave = mysql_real_escape_string($_PARAM["clave1"]);	
		$bases = mysql_real_escape_string($_PARAM["bases"]);	
		$_id = mysql_real_escape_string($_id);		

		$sql = "UPDATE merchandisers set basesycondiciones = '1', clave = '$clave' where id= $_id ";
		mysql_query($sql);


		return $_id;

	}

	
	/*---GETTERS--------------------------------------------------------------*/ 

	function get_id() { return($this->id); }
	function get_nombre() { return($this->nombre); } 
	function get_jefe_id() { return($this->jefe_id); } 
	function get_gerente_id() { return($this->gerente_id); } 
	function get_activo() { return($this->activo); } 
	function get_dni() { return($this->dni); } 
	function get_clave() { return($this->clave); } 
	function get_tipo() { return($this->tipo); } 
	function get_ingreso() { return($this->ingreso); } 
	function get_basesycondiciones() { return($this->basesycondiciones); } 
	function get_fechaIngreso() { return($this->fechaIngreso); } 
	function get_codigos_cargados() { return($this->codigos_cargados); } 
	function get_km() { return($this->km); } 
	function get_d_registracion() { return($this->d_registracion); } 
	function get_d_codigos() { return($this->d_codigos); } 
	function get_d_volumen() { return($this->d_volumen); } 


	/*------------------------------------------------------------------------*/
	/*---SETTERS--------------------------------------------------------------*/ 
	function set_id($_id) { $this->id = $_id; } 
	function set_nombre($_nombre) { $this->nombre = $_nombre; } 
	function set_jefe_id($_jefe_id) { $this->jefe_id = $_jefe_id; }
	function set_gerente_id($_gerente_id) { $this->gerente_id = $_gerente_id; } 
	function set_activo($_activo) { $this->activo = $_activo; } 
	function set_dni($_dni) { $this->dni = $_dni; } 
	function set_clave($_clave) { $this->clave = $_clave; }
	function set_tipo($_tipo) { $this->tipo = $_tipo; } 
	function set_ingreso($_ingreso) { $this->ingreso = $_ingreso; } 
	function set_basesycondiciones($_basesycondiciones) { $this->basesycondiciones = $_basesycondiciones; } 
	function set_fechaIngreso($_fechaIngreso) { $this->fechaIngreso = $_fechaIngreso; } 
	function set_codigos_cargados($_codigos_cargados) { $this->codigos_cargados = $_codigos_cargados; } 
	function set_km($_km) { $this->km = $_km; } 
	function set_d_registracion($_d_registracion) { $this->d_registracion = $_d_registracion; } 
	function set_d_codigos($_d_codigos) { $this->d_codigos = $_d_codigos; } 
	function set_d_volumen($_d_volumen) { $this->_d_volumen = $_d_volumen; } 

	/*------------------------------------------------------------------------*/

 }//endclass


?>