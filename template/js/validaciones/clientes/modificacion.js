/*----------------------------------------------------------------------------*/
/*               Validaciones para el Formulario de Usuarios
/*----------------------------------------------------------------------------*/
//You should create the validator only after the definition of the HTML form

var frmvalidator  = new Validator("cliente");

/*---------- RAZON SOCIAL -----------*/
frmvalidator.addValidation("nombre","req","Ingrese Razon social del cliente");

/*---------- Nombre -----------*/
frmvalidator.addValidation("nro_cuit","req","Ingrese el Nro de Cuit");
frmvalidator.addValidation("nro_cuit","num","Cuitt, debe contener numeros unicamente");

/*---------- E-Mail -----------*/
frmvalidator.addValidation("domicilio","req","Ingrerse el Domicilio del Cliente");


frmvalidator.addValidation("cmbProvincia","dontselect=0", "Debe seleccionar una provincia");

frmvalidator.addValidation("cmbLocalidad","dontselect=0", "Debe seleccionar una localidad");

frmvalidator.addValidation("condicion_iva","dontselect=0", "Debe seleccionar Condicion de Iva del cliente");