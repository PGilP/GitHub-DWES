<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<title>U4-A01</title>
</head>
<body>
<?php 
function leerLineas($ruta) {
	$archivo = fopen ( $ruta, "r" ) or die ( "Imposible abrir el archivo" );
	while ( ! feof ( $archivo ) ) {
		echo fgets ( $archivo ) . "<br/>";
	}
	fclose ( $archivo );
}
?>
<?php
// $archivo = fopen("/DWES07-gitLab/PHP07-Archivos07/files/temporal.txt","x+") or die("IMPOSIBLE");
unlink("files/temporal.txt");
?>
</body>
</html>