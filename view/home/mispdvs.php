
<?php 
	$_pdv = unserialize($_SESSION["pdv"]);


	if($_pdv->jefe_id == 1 and $_pdv->tipo == 3 ):
		$muestra = "boss";
	else:
		$muestra =  $_pdv->id;
	endif;	


?>

<div class="row" id="tittle1" style=" font-weight: normal;">
	<h1>MIS PDVS</h1><br/>
</div>

<div class="row" id="tittle1">
	<div class="col-xs-2"></div>	
	<div class="col-xs-8 text-center">
	<h4>				<a href="<?php echo  HOME?>reporteexcel.php?id=<?php echo $muestra?>"> Haz clic para descargar el reporte</a></h4>
	</div>
	<div class="col-xs-2"></div>	
</div>
