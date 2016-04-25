

<div class="row" id="tittle1">
	<h1>LLEGAR LEJOS DEPENDE DE VOS</h1>
</div>



<div id="listado_pdv"  >
  <div class="col-xs-9">
<!--  	<div class="row text-center" id="flechas">
  		<div class="col-xs-9 col-xs-offset-3">
  			<img src="< ?=IMGS?>flecha-arriba.png" class="img-responsive">
  		</div>
   	</div>-->
  	<? $contador = 1;
      $_pdv = unserialize($_SESSION["pdv"]);
      $usuario_tipo = $_pdv->tipo;
      if($usuario_tipo == 3 or $usuario_tipo == 4):
        $usuario_x = "nombre";
        $usuario_actual = $_pdv->nombre; 
      else:   
        $usuario_x = "razon_social";
        $usuario_actual = $_pdv->razon_social; 
      endif;  
     // print_r($_pdv);

  	 foreach($ranking as $pdv):
      if($contador > 10):
        $rank_muestra = "";
      else:
        $rank_muestra = "_".$contador;
      endif;  

      ?>

  	<div class="row"> 

  		<div class="col-xs-9 col-xs-offset-2" style="">
      <? if($_pdv->id == $pdv["id"]): $ranking_style = "ranking_selected" . $rank_muestra; else: $ranking_style = "ranking"; endif; ?>
  			<div class="row" id="<?= $ranking_style;?>" >
  				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-6" >
  					<?= utf8_encode($pdv["$usuario_x"]);?>
  				</div>
          <div class="col-xs-8 col-sm-5 col-md-4 col-lg-4" >
  					<?= $pdv["km"];?> KM recorridos
  				</div>		
          <div class="col-xs-2 col-sm-3 col-md-4 col-lg-2 text-left" >
  					<?= $contador;?> º
  				</div>

  			</div>
  		</div>
  	</div>	
  	<? 
  	$contador ++;
  	endforeach;?>
    <div class="row" style=" padding-top: 150px;">
    <br/>
    </div>
<!--  	<div class="row text-center" id="flechas">
  		<div class="col-xs-9 col-xs-offset-3">
  			<img src="< ?=IMGS?>flecha-abajo.png" class="img-responsive">
   		</div>
  	</div>-->
  </div>
  <div class="col-xs-3 text-right">
    <? if($usuario_tipo == "GT"):
    ?>
        <img src="<?= IMGS?>premios-ranking-GT.png" class="img-responsive">    
    <?  
        elseif($usuario_tipo == "KKAA"):
    ?>      
      <img src="<?= IMGS?>premios-ranking-KA.png" class="img-responsive">
    <?  
        elseif($usuario_tipo == 3):
    ?>      
      <img src="<?= IMGS?>premio-tv-led-chica.png" class="img-responsive">
    <?  
        elseif($usuario_tipo == 4):
    ?>      
      <img src="<?= IMGS?>premios-retailer01.png" class="img-responsive">

    <?
        endif;
    ?>

  <!--	<img src="<?=IMGS?>premios.png" class="img-responsive">-->
  </div>
</div>
<!--
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>


  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    <div class="item">
      <img src="..." alt="...">
      <div class="carousel-caption">
        ...
      </div>
    </div>
    ...
  </div>


  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>-->




<!--
<script type="text/javascript">
    $(function () {
        $(".demo1").bootstrapNews({
            newsPerPage: 3,
            autoplay: true,
			pauseOnHover:true,
            direction: 'up',
            newsTickerInterval: 4000,
            onToDo: function () {
                //console.log(this);
            }
        });

</script>     -->   