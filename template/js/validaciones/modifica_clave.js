
var frmvalidator  = new Validator("login_formulario");


 frmvalidator.addValidation("clave1","req", 'Clave no puede estar vacia');
 frmvalidator.addValidation("clave2","req", 'Repetir Clave no puede estar vacia');
 frmvalidator.addValidation("clave1","minlen=6", 'Clave debe contener al menos 6 caracteres');
 frmvalidator.addValidation("clave2","minlen=6", 'Repetir Clave debe contener al menos 6 caracteres');


frmvalidator.addValidation("bases","shouldselchk=on");
