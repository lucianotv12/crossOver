/*----------------------------------------------------------------------------*/
/*               Validaciones para el Formulario de STOCK
/*----------------------------------------------------------------------------*/
//You should create the validator only after the definition of the HTML form

var frmvalidator  = new Validator("stock");

/*---------- CODIGO CLIENTE -----------*/
frmvalidator.addValidation("codigo_barras","req","Ingrese  Codigo de barras");
frmvalidator.addValidation("codigo_barras","numeric","Codigo de barras tiene que ser solo numeros");
frmvalidator.addValidation("codigo_barras","minlen=8","Codigo de barras tiene que tener 8 digitos");
frmvalidator.addValidation("codigo_barras","maxlen=8","Codigo de barras tiene que tener 8 digitos");



/*---------- REMITO -----------*/
frmvalidator.addValidation("cantidad","req","Ingrese  Cantidad");
frmvalidator.addValidation("cantidad","numeric","Cantidad tiene que ser solo numeros");




