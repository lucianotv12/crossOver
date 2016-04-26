
<div class="row" id="tittle1">
	<h1>LLEGAR LEJOS DEPENDE DE VOS</h1>
</div>

<div class="row" id="text1">
	<h2>SUMÁ KMs CUMPLIENDO LOS SIGUIENTES DESAFÍOS</h2>
</div>

<?php	
	$_pdv = unserialize($_SESSION["pdv"]);
	if($_pdv->tipo == 3):
		$ruta_codigos = IMGS ."desafio-codigos-merchan.png";
		$ruta_volumen = IMGS ."desafio-volumen-merch.png";		
		$ruta_web = IMGS. "desafio-registracion-02.png";	
		$id_web = "";
		$imagen_premios = IMGS . "avion-tv-01.png";
		$desafio_web = 0;

	elseif($_pdv->tipo == 4):
		$ruta_codigos = IMGS ."desafio-codigos-sup.png";
		$ruta_volumen = IMGS ."desafio-volumen-sup.png";	
		$ruta_web = "";

		$imagen_premios = IMGS . "avion-dibujo.png";
		$desafio_web = 0;

	else:
		$ruta_codigos =  IMGS ."desafio-codigos-02.png";
		$ruta_volumen =  IMGS ."desafio-volumen-02.png";
		$ruta_web =	 IMGS. "desafio-web-02.png";	
		$imagen_premios = IMGS . "avion-dibujo.png";
		$desafio_web = $_pdv->d_web;

	endif;
	?>
		<div id="popup" style="display: none;">
		    <div class="content-popup">
		        <div class="close_cod"><a href="#" id="close"><img src="<?php echo IMGS?>close.png"></a></div>
		        <div>
		        	<img src="<?php echo  $ruta_codigos?>">
		        </div>
		    </div>
		</div>
		<div class="popup-overlay"></div>

		<div id="popup_vol" style="display: none;">
		    <div class="content-popup">
		        <div class="close_vol"><a href="#" id="close_vol"><img src="<?php echo IMGS?>close.png"></a></div>
		        <div>
		        	<img src="<?php echo  $ruta_volumen ?>">
		        	<span id="span_vol_abril"><?php echo $_pdv->objetivo_abril;?></span><br/>
		        	<span id="span_vol_mayo"><?php echo $_pdv->objetivo_mayo;?></span>

		        </div>
		    </div>
		</div>
		<div class="popup-overlay_vol"></div>

		<div id="popup_web" style="display: none;">
		    <div class="content-popup">
		        <div class="close_web"><a href="#" id="close_web"><img src="<?php echo IMGS?>close.png"></a></div>
		        <div>
		        	<img src="<?php echo  $ruta_web?>">
		        	<span id="span_web">
  		                <a href="index.php?accion=game"><button type="submit" id="button_save">JUGÁ AHORA</button></a>
		        	</span>

		        </div>
		    </div>
		</div>
		<div class="popup-overlay_web"></div>

		<div id="popup_registracion" style="display: none;">
		    <div class="content-popup">
		        <div class="close_registracion"><a href="#" id="close_registracion"><img src="<?php echo IMGS?>close.png"></a></div>
		        <div>
		        	<img src="<?php echo  $ruta_web?>">
		        </div>
		    </div>
		</div>
		<div class="popup-overlay_registracion"></div>

		<div id="popup_auto" style="">
		    <div class="content-popup">

		        <div>
		        	<img src="<?php echo  IMGS?>auto.jpg" class="img-responsive">
		        </div>
		    </div>
		</div>
		<div class="popup-overlay_registracion"></div>		

	

<div class="row" id="desafios">
	<?php $_pdv = unserialize($_SESSION["pdv"]);
	if($_pdv->codigos_cargados):
		$codigos_cargados =	$_pdv->codigos_cargados;
	else:
		$codigos_cargados = 0;
	endif;	

	if($_pdv->km):
		$km =	$_pdv->km;
		if($km > "10000"):
			$km_image = "kilometros-11.png";
		elseif($km > "9000"):
			$km_image = "kilometros-10.png";
		elseif($km > "8000"):
			$km_image = "kilometros-09.png";
		elseif($km > "7000"):
			$km_image = "kilometros-08.png";
		elseif($km > "6000"):
			$km_image = "kilometros-07.png";
		elseif($km > "5000"):
			$km_image = "kilometros-06.png";
		elseif($km > "4000"):
			$km_image = "kilometros-05.png";
		elseif($km > "3000"):
			$km_image = "kilometros-04.png";
		elseif($km > "2000"):
			$km_image = "kilometros-03.png";
		elseif($km > "1000"):
			$km_image = "kilometros-02.png";
		else:	
			$km_image = "kilometros-01.png";
		endif;

	else:
		$km = 0;
		$km_image = "kilometros-01.png";
	endif;	


	if($_pdv->tipo == 3):?>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-md-offset-3 col-lg-offset-3 text-center" >
			<a href="#" id="open"><img  src="<?php echo  IMGS?>desafio-codigos-01.png" ></a>	
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center" >
			<a href="#" id="open_vol"><img  src="<?php echo  IMGS?>desafio-volumen-01.png"  ></a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
			<a href="#" id="open_registracion"><img  src="<?php echo  IMGS?>desafio-registracion-01.png" ></a>	
		</div>				
	<?php elseif($_pdv->tipo == 4):?>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-md-offset-4 col-lg-offset-4 text-center" >
			<a href="#" id="open"><img  src="<?php echo  IMGS?>desafio-codigos-01.png" ></a>	
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center" >
			<a href="#" id="open_vol"><img  src="<?php echo  IMGS?>desafio-volumen-01.png"  ></a>
		</div>	
	<?php else:?>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-md-offset-3 col-lg-offset-3 text-center" >
			<a href="#" id="open"><img  src="<?php echo  IMGS?>desafio-codigos-01.png" ></a>	
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center" >
			<a href="#" id="open_vol"><img  src="<?php echo  IMGS?>desafio-volumen-01.png"  ></a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 text-center">
			<a href="#" id="open_web"><img  src="<?php echo  IMGS?>desafio-web-01.png" ></a>	
		</div>
	<?php endif;?>
</div>

<div class="row" >
	<div class="col-xs-11 col-xs-offset-1"  id="km">
		<div class="col-xs-9">
			<div class="row" id="km_acumulados" >
			<?php echo $km;?> km <img src="<?php echo  IMGS?>tipito-rojo.png" id="tipito_rojo" class="img-responsive">
			</div>
			<div class="row" ><img src="<?php echo  IMGS . $km_image?>" class="img-responsive"></div>
			<div class="row" id="km_descripcion"> <p id="fuente_grande"><?php echo $codigos_cargados;?></p> Cupones cargados &nbsp; &bull; &nbsp;
							OBJETIVO VOLUMEN <font color="#D82C33">PENDIENTE </font>
							 <?php if($_pdv->tipo == 3): 
								 echo " &nbsp; &bull; &nbsp; D. REGISTRACION <font color='#D82C33'>PENDIENTE</font>"; 
							 elseif($_pdv->tipo == 4):

							 else: ?>
							&nbsp;&bull;
							DESAFÍO WEB  <?if($desafio_web == 0):?><font color="#D82C33">PENDIENTE </font>							
										 <? else:?><font color="GREEN">CUMPLIDO </font><?endif;?>

							 <?endif;?>

			</div>
		</div>
		<div class="col-xs-3">
			<?php if($_pdv->tipo == 4):?>
				<a href="premios"><img src="<?php echo  $imagen_premios?>" id="img_premios"></a>
			<?php else:?>
				<a href="premios"><img src="<?php echo  $imagen_premios?>" id="img_premios"></a>
			<?php endif;?>
		</div>	
	</div>
</div>