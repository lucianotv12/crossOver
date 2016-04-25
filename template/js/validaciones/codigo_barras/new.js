/*----------------------------------------------------------------------------*/
/*               Validaciones para el Formulario de STOCK
/*----------------------------------------------------------------------------*/
//You should create the validator only after the definition of the HTML form

var frmvalidator  = new Validator("codigo_barras");

/*---------- CODIGO BARRAS -----------*/
frmvalidator.addValidation("idcolor","dontselect=0","Tenes que seleccionar un color");

/*---------- CANTIDAD -----------*/
frmvalidator.addValidation("idtalle","dontselect=0","Tenes que seleccionar un talle");
/*---------- PRECIO -----------*/
/*frmvalidator.addValidation("precio","req","debe ingresar el precio");*/


