
<div class="container">


<? if($cambio == "nuevo") {?>
<form name="usuario" method="post" enctype="multipart/form-data" action="index.php?accion=insert">
<? }else{ ?>
<form name="usuario" method="post" enctype="multipart/form-data" action="index.php?accion=update&id=<?= $usuario->get_idUsuario() ?>">
<? } ?>

	<div class="cuerpo_abm" >
		<div class="row">
			<h1> Usuario</h1>
		</div>

		<div class="row">
			<div class="col-xs-4"> Nombre:</div>	
			<div class="col-xs-8"> <input name="nombre" maxlength="30" type="text" <?= $deshabilitado?> value="<?=$nombre?>" onFocus="foco(this);" onBlur="no_foco(this);" class="form-control"></div>	
		</div>
		<div class="row">
			<div class="col-xs-4"> Apellido:</div>	
			<div class="col-xs-8"> <input name="apellido" maxlength="30" type="text" <?= $deshabilitado?> value="<?=$apellido?>" onFocus="foco(this);" onBlur="no_foco(this);" class="form-control"></div>	
		</div>		
		<div class="row">
			<div class="col-xs-4"> Telefono:</div>	
			<div class="col-xs-8"> <input name="telefono" maxlength="30" type="text" <?= $deshabilitado?> value="<?=$telefono?>" onFocus="foco(this);" onBlur="no_foco(this);" class="form-control"></div>	
		</div>				
		<div class="row">
			<div class="col-xs-4"> Email:</div>	
			<div class="col-xs-8"> <input name="email" maxlength="30" type="text" <?= $deshabilitado?> value="<?=$email?>" onFocus="foco(this);" onBlur="no_foco(this);" class="form-control"></div>	
		</div>		
		<div class="row">
			<div class="col-xs-4"> Usuario:</div>	
			<div class="col-xs-8"> <input name="usuario" maxlength="30" type="text" <?= $deshabilitado?> value="<?=$user?>" onFocus="foco(this);" onBlur="no_foco(this);" class="form-control"></div>	
		</div>			
		<div class="row">
			<div class="col-xs-4"> Clave:</div>	
			<div class="col-xs-8"> <input class="form-control" name="pass" maxlength="10" type="password" <?= $deshabilitado?> value="<?=$pass?>" onFocus="foco(this);" onBlur="no_foco(this);"></div>	
		</div>						
		<? if($cambio == "nuevo" OR $cambio == "modificar"){?>	

		<div class="row">
			<div class="col-xs-4"> Confirmar Clave:</div>	
			<div class="col-xs-8"> <input class="form-control" name="pass1" maxlength="10" type="password" <?= $deshabilitado?> value="<?=$pass?>" onFocus="foco(this);" onBlur="no_foco(this);"></div>	
		</div>						
		<? }?>

		<div class="row">
			<div class="col-xs-4"> Gerarquia :</div>	
			<div class="col-xs-8"> 
				<select name="gerarquia" class="form-control">
					<option value="1" <? if($gerarquia == 1) echo "selected";?>>Administrador</option>
					<option value="0" <? if($gerarquia == 0) echo "selected";?>>Vendedor</option>
				</select>
			</div>				
		</div>
		<div class="row">
				<div class="row" style="padding-top:10px;padding-bottom:10px;"> <!--BOTONERA -->
					<div class="col-xs-11 text-right">
	           		
	           		 <input type="submit" name="submit" class="btn btn-success" value="Guardar">
					</div>
				</div>	
		</div>								

	</form>
</div>	