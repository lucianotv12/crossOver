
<div class="cuerpo" style="padding-top :10px;"> 


	<div class="row" id="titulo_principal">
	<H2>LISTADO DE USUARIOS </H2>
	<br>
	</div>

	<div class="row" id="titulos" style="font-size:16px">
		<div class="col-xs-2">Nombre</div>	
		<div class="col-xs-2">Apellido</div>	
		<div class="col-xs-2">Email</div>	
		<div class="col-xs-2">Usuario</div>	
		<div class="col-xs-2">Tipo</div>	
		<div class="col-xs-1">Ver</div>	
		<div class="col-xs-1">Borrar</div>	
	</div>	


	<? $contador = 0;
	foreach ($usuarios as $usuario):
	$contador++;
	?>
	<div class="row" id="<?=$contador%2?'linea_par':'linea_impar'?>">
		<div class="col-xs-2"><?= $usuario->get_nombre() ?></div>
		<div class="col-xs-2"><?= $usuario->get_apellido() ?></div>
		<div class="col-xs-2"><a href="mailto:<?= $usuario->get_email()?>"><?= $usuario->get_email() ?></a></div>
		<div class="col-xs-2"><?= $usuario->get_user() ?></div>
		<div class="col-xs-2"><? if($usuario->get_gerarquia() == 1) echo "Administrador"; else echo "Vendedor"; ?></div>

		<div class="col-xs-1"><a href="index.php?accion=modify&id=<?= $usuario->get_idUsuario() ?>">
		<img src="<?= IMGS?>lupa.gif"  border="0" height ="20px" width="20px" >
		</a></div>

		<div class="col-xs-1"><a href="javaScript:pregunta('<?= $usuario->get_idUsuario()?>','Usuario : <?= $usuario->get_nombre() . $usuario->get_apellido()?>', 'delete')">
		<img  src="<?= IMGS?>eliminar.png"  border="0">
		</a></div>
	</div>
	<? endforeach ?>
	<div class="row">
		<a href="index.php?accion=new">
		<img style="display:block;" src="<?= IMGS?>add2.gif"  border="0" >
		</a>
	</div>	


</form>

</div>
