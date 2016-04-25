
var frmvalidator  = new Validator("login_formulario");


 frmvalidator.addValidation("vendedores","dontselect=0", 'Debe seleccionar la cantidad de vendedores');

/*---------- cantidad-----------*/
frmvalidator.addValidation("vendedores","req","Cantidad de vendedores");
frmvalidator.addValidation("vendedores","maxlen=1", "No puede registrar mas de x vendedores");
frmvalidator.addValidation("vendedores","num", "Debe contener numeros unicamente");

