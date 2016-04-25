/*----------------------------------------------------------------------------*/
/*               Validaciones para el Formulario de Usuarios
/*----------------------------------------------------------------------------*/
//You should create the validator only after the definition of the HTML form

var frmvalidator  = new Validator("usuario");

/*---------- Apellido -----------*/
frmvalidator.addValidation("apellido","req","Ingrese el Apellido");
frmvalidator.addValidation("apellido","maxlen=30","Apellido, no debe superar los 30 caracteres");
frmvalidator.addValidation("apellido","alpha","Apellido, debe contener letras unicamente");

/*---------- Nombre -----------*/
frmvalidator.addValidation("nombre","req","Ingrese el Nombre");
frmvalidator.addValidation("nombre","maxlen=30","Nombre, no debe superar los 30 caracteres");
frmvalidator.addValidation("nombre","alpha","Nombre, debe contener letras unicamente");

/*---------- E-Mail -----------*/
frmvalidator.addValidation("email","maxlen=45","Mail, no debe superar los 45 caracteres");
frmvalidator.addValidation("email","email","E-Mail, debe ser un e-mail v&aacute;lido");
frmvalidator.addValidation("email","req", "Ingrese  E-Mail" );

/*---------- Pass -----------*/
frmvalidator.addValidation("pass","req","Ingrese el password");

/*---------- pass -----------*/
frmvalidator.addValidation("pass1","req", "Ingrese el password" );

/*---------- pass -----------*/
//frmvalidator.addValidation("acepto_terminos","selone_radio", "TIENE QUE ACEPTAR LOS TERMINOS Y CONDICIONES" );
