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
    <body id="body_login" >
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76118200-1', 'auto');
  ga('send', 'pageview');

</script>   
    <div class="container">
                

      <form  name="login_formulario" action="index.php?accion=login"  method="post">
        <div class="row" id="tittle1" style="padding-bottom: 60px">
            <img src="<?=IMGS?>logo-01.png">
        </div>  
        <div class="row" id="text1">
            <h1>¿QUE TAN LEJOS VAS A LLEGAR?</h1>
            <h2>VOS DECIDÍS</h2>
        </div>
        <div class="row" id="login">

            <input type="text"  placeholder="_ Usuario" id="id" name="id" autofocus><br/>
            <input type="text" name="clave"  id="clave" placeholder="_ contraseña"><br/>
            <?php if($msj_error): echo "<p style='color:#D82C33; font-size:25px'>$msj_error</p>"; endif;?>
            <button type="submit" id="button_aceppt">ACEPTAR</button>
         </div> 
      </form>

    </div> <!-- /container -->
    </body>
</html>

<script src="template/js/models/gen_validatorv2.js" language="javascript" type="text/javascript"></script>
<script src="<?= VALIDACIONES ?>index.js" language="javascript" type="text/javascript"></script>