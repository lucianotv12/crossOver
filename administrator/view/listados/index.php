<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="<?= CSS?>fonts.css" rel="stylesheet">
        <link href="<?= BOOTSTRAP_CSS?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= CSS?>login.css" rel="stylesheet">


        <title>Marlboro Cross Over</title>
        <script type="text/javascript">
            function ordenar_por(pagina,campo,orden)
            {

            document.datos.action="index.php?accion=" + pagina + "&ordenar=" + campo + "&tipo_orden=" + orden ;
            document.datos.submit();

            }            

        </script>


    </head>
    <body id="" >

    <div class="container">

        <div class="row" style="padding:10px; font-size: 20px;">
            <SPAN STYLE="COLOR:RED">SELECCIONE LOS SIG. LISTADOS :  </SPAN>
            <a href="index.php?accion=list">PDVS : KKAA</a> |
            <a href="index.php?accion=list_gt">PDVS : GT</a> |
            <a href="index.php?accion=list_supervisores"> SUPERVISORES KKAA</a> | 
            <a href="index.php?accion=list_merchandisers"> MERCHANDISER</a> | 


        </div>

        <div class="table-responsive">
        
        <form method="post" name="datos">
                
            <table class="table table-striped table-bordered">
              <tr style="background: gray; color: white; font-size: 13px; font-family: arial; font-weight: normal;">
                <th>POS
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','pos','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','pos','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>           
                </th>
                <th>TIPO</th>
                <th>RAZ.SOCIAL
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','razon_social','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','razon_social','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>           
                </th>
                <th>CALLE Y NRO</th>
                <th>LOCALIDAD</th>
                <? if($_GET["accion"] != "list_gt"):?>
                <th>SUPERVI.
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','Supervisor','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','Supervisor','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>
                </th>
                <?endif;?>
                <th>MERCHAN.
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','merchandisers','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','merchandisers','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>
                </th>
                <th>COD. </th>
                <th>KM. </th>
                <th>VENDEDORES </th>
                <th>OB.ABRIL</th>
                <th>OB.MAYO</th>
                <th>D. WEB</th>

              </tr>
              <?php foreach($pdvs as $pdv):?>
              <tr style=" color: gray; font-size: 12px; font-family: arial; font-weight: normal;">
                <td><?php echo $pdv["pos"];?></td>   
                <td><?php echo $pdv["tipo"];?></td>   
                <td><?php echo $pdv["razon_social"];?></td>   
                <td><?php echo $pdv["direccion"];?></td>   
                <td><?php echo $pdv["localidad"];?></td>   
               <? if($_GET["accion"] != "list_gt"):?> 
                    <td><?php echo $pdv["Supervisor"];?></td>   
                <?endif;?>    
                <td><?php echo $pdv["merchandisers"];?></td>   
                <td><?php echo $pdv["codigos_cargados"];?></td>
                <td><?php echo $pdv["km"];?></td>      
                <td><?php echo $pdv["cantidad_vendedores"];?></td>   
                <td><?php echo $pdv["objetivo_abril"];?></td>   
                <td><?php echo $pdv["objetivo_mayo"];?></td>   
                <td><?php echo $pdv["desafio_web"];?></td>   

              </tr>  
              <?php endforeach;?>

            </table>
        </form>    
        </div>
    </div> <!-- /container -->
    </body>
</html>
