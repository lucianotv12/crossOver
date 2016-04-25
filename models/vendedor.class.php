<?php 
	class Vendedor { 

		var $id; 
		var $nombre; 
		var $celular; 
		var $email; 
		var $foto; 
		var $pdvs_id; 

		function Vendedor($_id=0) { 
			if ($_id<>0) { 
				$query_carga= "select * from vendedores where id=$_id"; 
				$result_carga = mysql_query($query_carga); 
				$datos_carga = mysql_fetch_assoc($result_carga); 
				$this->id = $datos_carga['id']; 
				$this->nombre = $datos_carga['nombre']; 
				$this->celular = $datos_carga['celular']; 
				$this->email = $datos_carga['email']; 
				$this->foto = $datos_carga['foto']; 
				$this->pdvs_id = $datos_carga['pdvs_id']; 
			} 
		} 

		function save() {//Guarda o inserta segun corresponda 
			if ($this->id<>0) { 
				$query_save = "update vendedores set nombre = '$this->nombre', celular = '$this->celular', email = '$this->email', foto = '$this->foto', pdvs_id = '$this->pdvs_id' where id='$this->id'"; 
				mysql_query($query_save) or die(mysql_error()); 
			} else {
				$query_save = "insert into vendedores values (null, '$this->nombre', '$this->celular', '$this->email', '$this->foto', '$this->pdvs_id')"; 
				mysql_query($query_save) or die(mysql_error()); 
				$this->id = mysql_insert_id(); 
			} 
		}

		function eraseVendedores($_pdvs_id){
			$query_delete = "DELETE FROM vendedores where pdvs_id = '$_pdvs_id'";
			mysql_query($query_delete);

		}

		function eraseVendedor($_vendedor_id){
			$query_delete = "DELETE FROM vendedores where id = '$_vendedor_id'";
			mysql_query($query_delete);

		}

		function cargaVendedores($_PARAM, $_pdvs_id, $cantidad_vendedores){

			Vendedor::eraseVendedores($_pdvs_id);

			for($i=0;$i<$cantidad_vendedores;$i++):
				$celular = $_PARAM['celular_' . $i];
				$celular = mysql_real_escape_string($celular);
				$email = $_PARAM['email_' . $i];
				$email = mysql_real_escape_string($email);

				if($celular ):
					$vendedor = new Vendedor();
					$vendedor->set_nombre('');
					$vendedor->set_celular($celular);
					$vendedor->set_email($email);
					$vendedor->set_foto('');				
					$vendedor->set_pdvs_id($_pdvs_id);
					$vendedor->save();
				endif;
			endfor;	

		

		/*	if($cantidad_vendedores != $cantidad_cargados):

				Pdv::registro_vendedores($_pdvs_id,$cantidad_cargados);

			endif;
		*/		

		}

		function vendedoresCargadosxPDV($_pdvs_id){
			$_pdvs_id = mysql_real_escape_string($_pdvs_id);
					//comprobar los vendedores que se cargaron
			$query = "select count(id) as cantidad from vendedores where pdvs_id = $_pdvs_id ";
			return  mysql_result(mysql_query($query),0);
		}	

		function vendedoresxPdv($pdvs_id, $order=0, $limit=0){
			$pdvs_id = mysql_real_escape_string($pdvs_id);

			if($order):
				$order = " ORDER BY id DESC";
			else:
				$order = "";
			endif; 

			if($limit):
				$limit = "LIMIT " . $limit;  
			else:
				$limit = "";
			endif; 				

			$query = "select * from vendedores where pdvs_id = $pdvs_id $order $limit";

			$result = mysql_query($query) or die(mysql_error());
			$vendedores = array();
			while($row = mysql_fetch_assoc($result)):
				$vendedores[] = $row;
			endwhile;	
			mysql_free_result($result);
			return $vendedores;

		}

		/*---GETTERS--------------------------------------------------------------*/ 
		function get_id() { return($this->id); } 
		function get_nombre() { return($this->nombre); } 
		function get_celular() { return($this->celular); } 
		function get_email() { return($this->email); } 
		function get_foto() { return($this->foto); } 
		function get_pdvs_id() { return($this->pdvs_id); } 
		/*------------------------------------------------------------------------*/ 
		/*---SETTERS--------------------------------------------------------------*/
		function set_id($_id) { $this->id = $_id; } 
		function set_nombre($_nombre) { $this->nombre = $_nombre; } 
		function set_celular($_celular) { $this->celular = $_celular; } 
		function set_email($_email) { $this->email = $_email; } 
		function set_foto($_foto) { $this->foto = $_foto; }
		function set_pdvs_id($_pdvs_id) { $this->pdvs_id = $_pdvs_id; } 

		/*------------------------------------------------------------------------*/ 




	}//endClass


	?>