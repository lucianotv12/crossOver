<?php

class Template
{
	function draw_header($_variable=0,$_id=0)
	{
       setlocale(LC_ALL,"es_ES");              
	   $_usuario = unserialize($_SESSION["usuario"]);
       ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        	<title>Marlboro Cross Over</title>
            <link href="<?= CSS?>fonts.css" rel="stylesheet"/>
            <link href="<?= BOOTSTRAP_CSS?>bootstrap.min.css" rel="stylesheet"/>
            <link href="<?= CSS?>home.css" rel="stylesheet"/>
            <link href="<?= CSS?>popup.css" rel="stylesheet"/>
<!--            <link href="<?= CSS?>scroll/bootstrap-theme.min.css" rel="stylesheet"/> -->

                
        	<script language="JavaScript" src="<?=JS?>funciones.js"></script>
            <script language="JavaScript" src="<?=JS?>jquery-1.12.1.min.js"></script>

            <script language="JavaScript" src="<?=BOOTSTRAP_JS?>bootstrap.min.js"></script>
<!--            <script language="JavaScript" src="<?=JS?>scroll/jquery.bootstrap.newsbox.js"></script> -->


            <script type="text/javascript">

            $(document).ready(function(){

                setTimeout(function() {
                    $('#popup_auto').fadeOut(1500);
                },2500);


/*                $('#popup_auto').fadeIn('slow');
                $('.popup-overlay_auto').fadeIn('slow');
                $('.popup-overlay_auto').height($(window).height());
                return false;
*/
              $('#open').click(function(){
                $('#popup').fadeIn('slow');
                $('.popup-overlay').fadeIn('slow');
                $('.popup-overlay').height($(window).height());
                return false;
              });
              
              $('#close').click(function(){
                $('#popup').fadeOut('slow');
                $('.popup-overlay').fadeOut('slow');
                return false;
              });
              // VOLUMEN
              $('#open_vol').click(function(){
                $('#popup_vol').fadeIn('slow');
                $('.popup-overlay_vol').fadeIn('slow');
                $('.popup-overlay_vol').height($(window).height());
                return false;
              });
              
              $('#close_vol').click(function(){
                $('#popup_vol').fadeOut('slow');
                $('.popup-overlay_vol').fadeOut('slow');
                return false;
              });
              // WEB
              $('#open_web').click(function(){
                $('#popup_web').fadeIn('slow');
                $('.popup-overlay_web').fadeIn('slow');
                $('.popup-overlay_web').height($(window).height());
                return false;
              });
              
              $('#close_web').click(function(){
                $('#popup_web').fadeOut('slow');
                $('.popup-overlay_web').fadeOut('slow');
                return false;
              });
              // REGISTRACION
              $('#open_registracion').click(function(){
                $('#popup_registracion').fadeIn('slow');
                $('.popup-overlay_registracion').fadeIn('slow');
                $('.popup-overlay_registracion').height($(window).height());
                return false;
              });
              
              $('#close_registracion').click(function(){
                $('#popup_registracion').fadeOut('slow');
                $('.popup-overlay_registracion').fadeOut('slow');
                return false;
              });
              $('#close_auto').click(function(){
                $('#popup_auto').fadeOut('slow');
                $('.popup-overlay_auto').fadeOut('slow');
                return false;
              });

            });
            </script>

        </head>

        <body id="<?= $_variable?>" onload="#open">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76118200-1', 'auto');
  ga('send', 'pageview');

</script>        
        <div class="container">
        
            <div class="row" id="cabecera">
                <div class="col-xs-8">
                </div>
<?php
$_pdv = unserialize($_SESSION["pdv"]);

if($_pdv->tipo == 3):
  $razonSocial = $_pdv->nombre;
  $leyenda = "MERCHANDISER";
  $ver_perfil = false;  
elseif($_pdv->tipo == 4):
  $razonSocial = $_pdv->nombre;
  $leyenda = "SUPERVISOR";  
  $ver_perfil = false;
else:
  $razonSocial = $_pdv->razon_social;
   $leyenda = "PDV";
   $ver_perfil = true;
 endif; 


?>                
                <div class="col-xs-2" style="text-align: right; ">    
                      <p id="perfil_user"><?php echo $razonSocial?> </p>
                      <p> <?php echo $leyenda?> </p>
                 </div> 
                <div class="col-xs-2" style="text-align: left; ">    
                      
                        <!-- Small button group -->
                        <div class="btn-group">

                              <img src="<?php echo IMGS?>perfil_mas.png"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                              
                               <ul class="dropdown-menu">
                                 <?php if($ver_perfil == true):?>   <li> <a href="<?php echo HOME?>index.php?accion=mi_perfil">VER MI PERFIL</a></li><?php endif;?>
                                    <li> <a href="<?php echo HOME?>index.php?accion=cerrar_sesion">CERRAR SESIÓN</a></li>
                              </ul>
                        </div>
                </div>        

              </div>   


<?php

  }

	function draw_footer()
	{ 
	?>


        </div> <!-- /container -->

        <footer>
          <div class="container">
            <div class="row" id="row_footer">
              <div class="col-xs-3" id="logo_footer">
                <img src="<?=IMGS?>logo-footer.png" class="img-responsive">
              </div>
              <div class="col-xs-9" id="menu_footer">
                <div class="row">
                    <a href="index.php" id="<?= ($_GET['accion'] == '')? 'footer_activo': '' ?>">Desafios</a>
                    &nbsp;
                    &nbsp;
                    <?
                      $_pdv = unserialize($_SESSION["pdv"]);
                      if($_pdv->tipo == 3):?>
                        <a href="index.php?accion=ranking_merchan&tipo=3" id="<?= ($_GET['accion'] == 'ranking_merchan')? 'footer_activo':''?>">RANKING</a> 
                      <?php elseif($_pdv->tipo == 4):  ?>
                        <a href="index.php?accion=ranking_merchan&tipo=4" id="<?= ($_GET['accion'] == 'ranking_supervisores')? 'footer_activo':''?>">RANKING</a> 
                      <? else:?>
                        <a href="index.php?accion=ranking" id="<?= ($_GET['accion'] == 'ranking')? 'footer_activo':''?>">RANKING</a> 
                      <? endif;?>
                    &nbsp;
                    &nbsp;
                    <a href="index.php?accion=premios" id="<?= ($_GET['accion'] == 'premios')? 'footer_activo':''?>">Premios</a>      
                    &nbsp;
                    &nbsp;
                    <?
                      $_pdv = unserialize($_SESSION["pdv"]);
                      if($_pdv->tipo == 3):?>
                        <a href="index.php?accion=mispdvs" id="<?= ($_GET['accion'] == 'promo')? 'footer_activo':''?>">MIS PDVS</a> 
                      <? else:?>
                        <a href="index.php?accion=promo" id="<?= ($_GET['accion'] == 'promo')? 'footer_activo':''?>">Promoción Consumidores</a> 
                      <? endif;?>


                    &nbsp;
                    &nbsp;
                    <a href="index.php?accion=basesycondiciones" id="<?= ($_GET['accion'] == 'basesycondiciones')?'footer_activo':''?>">Bases y Condiciones</a>                    
                </div>                     
              </div>
            </div>
                
            </div>
        </footer>
        </body>

    </html>

	<?php
	}
}
?>