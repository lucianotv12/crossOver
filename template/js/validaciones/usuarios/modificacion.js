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
frmvalidator.addValidation("email","maxlen=45","req","Ingrerse el E-Mail");
frmvalidator.addValidation("email","email","E-Mail, debe ser un e-mail valido");
frmvalidator.addValidation("email","req", "Ingrese su E-Mail" );

/*---------- USER-----------*/
frmvalidator.addValidation("usuario","req","Ingrese el nombre de usuario");
frmvalidator.addValidation("usuario","maxlen=15", "Usuario, no debe superar los 15 caracteres");

/*---------- PASSWORD-----------*/
frmvalidator.addValidation("pass","req","Ingrese la Contraseña");
frmvalidator.addValidation("pass","maxlen=10", "Contraseña, no debe superar los 10 caracteres");
frmvalidator.addValidation("pass","alnum","Contraseña, debe ser alfanimerico");
frmvalidator.addValidation("pass","minlen=4", "Contraseña,  debe ser mayor de 4 caracteres");

