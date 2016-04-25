
var frmvalidator  = new Validator("login_formulario");
/*---------- USER-----------*/
frmvalidator.addValidation("id","req","Ingrese Nº Punto de Venta");
frmvalidator.addValidation("id","maxlen=30", "no debe superar los 30 caracteres");
/*frmvalidator.addValidation("id","num", "Debe contener numeros unicamente");*/

/*----------PASSWORD-----------*/
frmvalidator.addValidation("clave","req","Ingrese la contraseña");
frmvalidator.addValidation("clave","maxlen=30", "Contraseña, no debe superar los 30 caracteres");
frmvalidator.addValidation("clave","minlen=4", "Contraseña, debe superar los 4 caracteres");
//frmvalidator.addValidation("clave","alnum", "Contraseña, debe contener letras y numeros unicamente");
