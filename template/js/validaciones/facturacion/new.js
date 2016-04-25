/*----------------------------------------------------------------------------*/
/*               Validaciones para el Formulario de STOCK
/*----------------------------------------------------------------------------*/
//You should create the validator only after the definition of the HTML form

var frmvalidator  = new Validator("datos");

/*---------- CODIGO CLIENTE -----------*/
frmvalidator.addValidation("_idcliente","req","Ingrese datos del Cliente");
frmvalidator.addValidation("_idcliente","numeric","Los datos del cliente tienen que ser solo numeros");

/*---------- REMITO -----------*/
/*frmvalidator.addValidation("n_remito","req","Ingrese Numero Remito");
frmvalidator.addValidation("n_remito","numeric","Los datos del Remito tienen que ser solo numeros");
/*

/*---------- Factura -----------*/
/*frmvalidator.addValidation("n_factura","req","Ingrese Numero Factura");
frmvalidator.addValidation("n_factura","numeric","Numero Factura tiene que ser solo numeros");
*/



