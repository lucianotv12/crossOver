<?php
/*----------------------------------------------------------------------------*/
function crear_getters($campos)
	{
	echo "
		/*---GETTERS--------------------------------------------------------------*/
		";
    /*---------*/
	for($i=0; $i<=count($campos)-1; $i++)
		{
		echo "function get_$campos[$i]()
			{
			return(\$this->$campos[$i]);
			}
		";
		}
    /*---------*/
	echo "
		/*------------------------------------------------------------------------*/
		";

	}
/*----------------------------------------------------------------------------*/
function crear_setters($campos)
	{
	echo "
		/*---SETTERS--------------------------------------------------------------*/
		";
    /*---------*/
	for($i=0; $i<=count($campos)-1; $i++)
		{

		echo "function set_$campos[$i](\$_$campos[$i])
			{
			\$this->$campos[$i] = \$_$campos[$i];
			}
		";
		}
    /*---------*/
	echo "
		/*------------------------------------------------------------------------*/
		";
	}
/*----------------------------------------------------------------------------*/
function crear_save($campos, $tabla)
	{
    echo "
		function save()
			{//Guarda o inserta segun corresponda
			if (\$this->id<>0)
				{
				\$query_save = \"update ".$tabla." set ";
    /*---------*/
	for($i=1; $i<=count($campos)-1; $i++)
		{
		echo $campos[$i]." = \$this->".$campos[$i];
		if ($i<>count($campos)-1)
			{			echo ", ";			}
		}
    /*---------*/
			echo" where id=\$this->id\";
				mysql_query(\$query_save) or die(mysql_error());
				}
			else
				{
				\$query_save = \"insert into ".$tabla." values (null";
    /*---------*/
	for($i=1; $i<=count($campos)-1; $i++)
		{
		echo ", \$this->".$campos[$i];
		}
    /*---------*/
			echo")\";
				mysql_query(\$query_save) or die(mysql_error());
				\$this->id = mysql_insert_id();
				}
			}
	";
	}
/*----------------------------------------------------------------------------*/
function crear_constructor($campos, $nombre, $tabla)
	{
    echo "

    function ".$nombre."(\$_id=0)
		{
		if (\$_id<>0)
			{
			\$query_carga= \"select * from ".$tabla." where id=\$_id\";
   			\$result_carga = mysql_query(\$query_carga);
			\$datos_carga = mysql_fetch_assoc(\$result_carga);
			";
    /*---------*/
	for($i=0; $i<=count($campos)-1; $i++)
		{
		echo "
			\$this->".$campos[$i]." = \$datos_carga['".$campos[$i]."'];";
		}
    /*---------*/
	echo "
			}
		}
	";

	}
/*----------------------------------------------------------------------------*/
function crear_variables_superiores($campos)
	{	for($i=0; $i<=count($campos)-1; $i++)
		{
		echo "
			var \$".$campos[$i].";";
		}
	}
/*----------------------------------------------------------------------------*/
function crear_objeto($campos, $nombre, $tabla)
	{
	$campos= explode(", ",$campos);
    echo "class ".$nombre."
    	{    	";
    crear_variables_superiores($campos);
	crear_constructor($campos, $nombre, $tabla);
	crear_save($campos, $tabla);
	crear_getters($campos);
    crear_setters($campos);    echo"    	}
    ";	}
/*----------------------------------------------------------------------------*/

if (isset($_POST["submit"]))
	{
	crear_objeto($_POST["campos"], $_POST["nombre"], $_POST["tabla"]);
	}

?>

<form name="" action="" method="post">
<label>Nombre </label><input name="nombre" type="text" value="">
<label>Tabla </label><input name="tabla" type="text" value="">
<label>Campos </label><input name="campos" type="text" value="">
<input type="submit" name="submit" value="submit">
</form>

