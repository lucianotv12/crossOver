<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <link href="<?= CSS?>fonts.css" rel="stylesheet">
        <link href="<?= BOOTSTRAP_CSS?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= CSS?>login.css" rel="stylesheet">



        <title>Marlboro Cross Over</title>
    </head>
    <body id="body_vendedores">
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-76118200-1', 'auto');
      ga('send', 'pageview');

    </script>   
    <?php 

    $_pdv = unserialize($_SESSION["pdv"]);
    $cantidad_vendedores = $_pdv->cantidad_vendedores;
    $vendedores_cargados = Vendedor::vendedoresCargadosxPDV($_pdv->id);
    $diferencia_vendedores = $cantidad_vendedores - $vendedores_cargados;    
    ?>    


    <div class="container">
                
        <div class="row" id="tittle1">
             <img src="<?=IMGS?>logo-01.png">

        </div>  
        
        <?if($habilitarCantVendedores == true):?>        
          <form name="login_formulario" action="index.php?accion=cantidad_vendedores"  method="post">
            <div class="row" id="text1">
                <h2>¿CUANTOS TRABAJADORES TRABAJAN EN TU PDV?</h2>
            </div> 
            <div class="row" id="login">
            <select name="vendedores" placeholder="#VENDEDORES" autofocus>
                <option value="0"># SELECCIONE VENDEDORES</option>
                <option value="1" <?if($cantidad_vendedores == 1) echo "selected";?>>1</option>
                <option value="2" <?if($cantidad_vendedores == 2) echo "selected";?>>2</option>
                <option value="3" <?if($cantidad_vendedores == 3) echo "selected";?>>3</option>
                <option value="4" <?if($cantidad_vendedores == 4) echo "selected";?>>4</option>
            </select><br/>
                <button type="submit" id="button_aceppt">ACEPTAR</button>
             </div> 

          </form>
        <? endif;?>  

      <form  name="vendedores" action="index.php?accion=carga_vendedores" method="post">

        <div class="row" id="text1">
            <h2>CARGÁ ACÁ SUS DATOS</h2>
        </div> 

        <div class="row">
        <?php
        if($cantidad_vendedores == 1):
            $agregado = '<div class="col-xs-5"></div>';
            $rows = "col-xs-2";
            $rows_button = "col-xs-2";
        elseif($cantidad_vendedores == 2):
            $agregado = '<div class="col-xs-4"></div>';
            $rows = "col-xs-2";
            $rows_button = "col-xs-4";
            $stilo = "text-align: center";
        elseif($cantidad_vendedores == 3):
            $agregado = '<div class="col-xs-3"></div>';            
            $rows = "col-xs-2";
            $rows_button = "col-xs-6";
        elseif($cantidad_vendedores == 4):
            $agregado = '<div class="col-xs-2"></div>';            
            $rows = "col-xs-2";
            $rows_button = "col-xs-8";        
        endif;            
        echo $agregado;
            $contador = 0;
        if($vendedores_cargados != 0):
            $vendedores = Vendedor::vendedoresxPdv($_pdv->id);

            foreach ($vendedores as $vendedor): //CARGO LOS VENDEDORES
            ?>
            <div class="<?= $rows?>" style="padding: 0; margin: 0 "  >
                <div class="card">
                    <div class="avatar">
                        <img src="<?=IMGS?>perfil_<?= $contador + 1;?>.png" alt="" />
                    </div>
                    <div class="content">
                       <input type="number"  placeholder="#CELULAR" name="celular_<?= $contador?>" id="celular" value="<?= $vendedor["celular"]?>" autofocus>
                        <input type="email"  placeholder="#MAIL" name="email_<?= $contador?>" value="<?= $vendedor["email"]?>" autofocus>
                    </div>    
                </div>
            </div>        
            <?            
            $contador++;    
            endforeach;    
        endif;    
        for($i=0; $i< $diferencia_vendedores; $i++): ?>
            <div class="<?= $rows?>" style="padding: 0; margin: 0 " >
                <div class="card">

                    <div class="avatar">
                        <img src="<?=IMGS?>perfil_<?= $contador + 1;?>.png" alt="" />
                    </div>
                    <div class="content">
                       <input type="number"  placeholder="#CELULAR" name="celular_<?= $contador?>" id="celular" autofocus>
                        <input type="email"  placeholder="#MAIL" name="email_<?= $contador?>" autofocus>
                    </div>    
                </div>
            </div>        
        <?php 
        $contador++;
        endfor;
        echo $agregado;
        ?>    
        </div>
        <div class="row" >
            <?= $agregado?>
            <div class="<?= $rows_button?>" style="padding: 0; margin: 0; padding-right: 5px;">
                <button type="submit" id="button_save">GUARDAR CAMBIOS</button>
            </div>    
            <?= $agregado?>            
        </div>

      </form>

    </div> <!-- /container -->
    </body>
</html>
<script src="template/js/models/gen_validatorv2.js" language="javascript" type="text/javascript"></script>
<script src="<?= VALIDACIONES ?>carga_vendedores.js" language="javascript" type="text/javascript"></script>