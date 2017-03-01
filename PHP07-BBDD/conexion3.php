<!DOCTYPE html>
<html>
<head>
<title>Conexión a BBDD con PHP</title>
<meta charset="UTF-8" />
</head>
<style>
* {
	margin: 2px;
}
</style>
<body>
	<h2>Pruebas con la base de datos de animales</h2>
<?php
$servidor = "localhost";
$usuario = "alumno";
$clave = "alumno";
?>
<p>Vamos a utilizar las siguientes variables:</p>
	<ul>
<?php
echo "<li>Nombre del servidor al que nos vamos a conectar a MySQL: $servidor</li>";
echo "<li>Nombre de usuario con el que nos vamos a conectar a MySQL: $usuario</li>";
echo "<li>Contraseña del usuario en MySQL: $clave</li>";
?>
</ul>
<?php
echo "<h3>Estableciendo conexión...</h3>";
$conexion = new mysqli ( $servidor, $usuario, $clave );
if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
} else {
	echo "<p>Información de servidor: $conexion->host_info</p>";
	
	mysqli_close ( $conexion );
}
?>
<?php

$conexion = new mysqli ( $servidor, $usuario, $clave, "animales" );
$conexion->query ( "SET NAMES 'UTF8'" );
// si quisiéramos hacerlo en dos pasos:
// $conexion = new mysqli($servidor,$usuario,$clave);
// $conexion->select_db("animales");

if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
}
?>
<table style='border: 0'>
		<tr style='background-color: lightblue'>
			<th>Chip</th>
			<th>Nombre</th>
			<th>Especie</th>
			<th>Imagen</th>
		</tr>
	<?php
	
	$resultado = $conexion->query ( "SELECT * FROM animal ORDER BY chip" );
	while ( $fila = $resultado->fetch_array ( MYSQLI_ASSOC ) ) {
		$ruta = "./img/";
		$ruta .= "$fila[imagen]";
		echo "<tr style='background-color:lightgreen'>";
		echo "<td>$fila[chip]</td>";
		echo "<td>$fila[nombre]</td>";
		echo "<td>$fila[especie]</td>\n";
		echo "<td><img src='$ruta'></img></td>\n";
		echo "</tr>";
	}
	echo "<h3>Desconectando...</h3>";
	mysqli_close ( $conexion );
	?>
</table>
<ul>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion5.php">Conexión 5</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion4.php">Conexión 4</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion6.php">Conexión 6</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion2.php">Conexión 2</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/">Conexión 1</a></li>
</ul>
</body>
</html>