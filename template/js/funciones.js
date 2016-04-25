function foco(elemento) {
elemento.style.border = "1px solid red";
}

function no_foco(elemento) {
elemento.style.border = "1px solid blue";
}

function pregunta(idcliente,dato,accion)  
{

	var update=window.confirm("Se procedera a borrar  " + dato + " " +  idcliente + " desea continuar?");
	
	if (update){
	document.datos.action="index.php?accion="+ accion +"&id=" + idcliente;
	document.datos.submit();
	}else
	
	document.datos.action="";
}

function cambiar_precios()  
{

var update=window.confirm("Se modificaran datos que afectaran a los precios de uno o varios productos, desea continuar?");

if (update){
document.datos.action="gestion_precios.php?accion=cambiar";	
document.datos.submit();
}else

document.datos.action="gestion_precios.php?accion=nocambiar";	

}

function modificar_importe(idProducto,accion,start,buscador)  
{
	//accion, es la funcion que va a llamar en el controlador (en este caso, actualizar precios)
	//precio : precio nuevo

	var update=window.confirm("Se procedera a modificar el precio del Producto  " +  idProducto + " desea continuar?");
	
	if (update){
		document.datos.action="index.php?accion="+ accion +"&id=" + idProducto + "&start=" + start + "&buscador=" + buscador ;
	document.datos.submit();
	
	}else
	
	document.datos.action="";
}



function popUp(URL) {
day = new Date();
id = day.getTime();
//eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=1000,height=1000');");
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=850,height=800');");

}


function busqueda(accion,buscador)
{

document.datos.action="index.php?accion="+ accion +"&buscador=" + buscador ;
document.datos.submit();

}

function busqueda_fecha(anio,mes)
{

document.datos.action="index.php?accion=balance_iva&anio=" + anio + "&mes=" + mes  ;
document.datos.submit();

}

function ordenar_por(pagina,campo,orden)
{

document.datos.action="index.php?accion=" + pagina + "&ordenar=" + campo + "&tipo_orden=" + orden ;
document.datos.submit();

}

function imprSelec(nombre)
{
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print( );
  ventimp.close();
}

function genera_presupuesto()  
{

var update=window.confirm("Desea generar el presupuesto?");

if (update){
document.datos.submit();
}else

document.datos.action="";
}

var nav4 = window.Event ? true : false;
function acceptNum(evt){
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57, '.' = 46
var key = nav4 ? evt.which : evt.keyCode;
return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}