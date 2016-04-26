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
                
            <table class="table table-striped">
              <tr style="background: gray; color: white; font-size: 20px">
                <th>NOMBRE
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','nombre','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','nombre','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>           
                </th>
                <th>JEFE
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','JEFE','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','JEFE','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>           
                </th>
                <th>EMAIL</th>
                <th>FECHA INGRESO</th>
                <th>CODIGOS
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','codigos_cargados','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','codigos_cargados','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>
                </th>
                <th>KM
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','km','ASC')"><img  src="<?= IMGS?>prev.png"  border="0"  ></a>
                    <a href="javaScript:ordenar_por('<?=$_GET["accion"]?>','km','DESC')"><img  src="<?= IMGS?>next.png"  border="0" ></a>
                </th>
                <th>D.REGISTRACION </th>
                <th>D.VOLUMEN</th>
                <th>D.CODIGOS</th>

              </tr>
              <?php foreach($pdvs as $pdv):?>
              <tr style="color:gray">
                <td><?php echo $pdv["nombre"];?></td>   
                <td><?php echo $pdv["JEFE"];?></td>   
                <td><?php echo $pdv["dni"];?></td>   
                <td><?php echo $pdv["fechaIngreso"];?></td>   
                <td><?php echo $pdv["codigos_cargados"];?></td>   
                <td><?php echo $pdv["km"];?></td>      
                <td><?php echo $pdv["d_registracion"];?></td>   
                <td><?php echo $pdv["d_volumen"];?></td>   
                <td><?php echo $pdv["d_codigos"];?></td>   


              </tr>  
              <?php endforeach;?>

            </table>
        </form>    
        </div>
    </div> <!-- /container -->
    </body>
</html>
