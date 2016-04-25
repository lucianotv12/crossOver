<?PHP
    $_pdv = unserialize($_SESSION["pdv"]);
    $usuario_tipo = $_pdv->tipo;
?>

<div class="row" id="tittle1" style=" font-weight: normal;">
	<h3>¡TU ESFUERZO TIENE PREMIO!</h3>
</div>

<div class="row"  >

  <? if($usuario_tipo == "GT"):?>
	<div class="col-xs-12 text-center">
      <img src="<?= IMGS?>premios-PDV-GT.png" class="img-responsive">
	</div>	
	<div class="col-xs-12">
	  		<p>* El premio consiste en un viaje para los miembros del pdv ganador, con un máximo de 3 vendedores por pdv. 
	  		**se podrá canjear el monto del premio "viaje" por otro/s destino/s del mismo valor a elección.</p>
	</div>

  <? elseif($usuario_tipo == "KKAA"):?>
  	<div class="col-xs-12 text-center">      
      <img src="<?= IMGS?>premios-PDV-KKAA.png" class="img-responsive">
	</div>			
		<div class="col-xs-12">
		  		<p>* El premio consiste en un viaje para los miembros del pdv ganador, con un máximo de 3 vendedores por pdv. 
		  		**se podrá canjear el monto del premio "viaje" por otro/s destino/s del mismo valor a elección.</p>
		</div>

  <? elseif($usuario_tipo == 3):?>      
	  	<div class="col-xs-12 col-xs-offset-4 text-center">
    	  <img src="<?= IMGS?>premio-tv-led-grande.png" class="img-responsive">
		</div>	
  <? elseif($usuario_tipo == 4):?>      
      <div class="col-xs-12 col-xs-offset-4 text-center">
      	<img src="<?= IMGS?>premios-retailer02.png" class="img-responsive">
		</div>	
  <? endif;?>

</div>

    <div class="row" style=" padding-top: 150px;">
    <br/>
    </div>