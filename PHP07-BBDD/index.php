<!DOCTYPE html>
<html>
<head>
<title>Conexión a BBDD con PHP</title>
<meta charset="UTF-8" />
</head>
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
	echo "<h3>Desconectando...</h3>";
	mysqli_close ( $conexion );
}
?>

<ul>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion6.php">Conexión 6</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion5.php">Conexión 5</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion4.php">Conexión 4</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion3.php">Conexión 3</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion2.php">Conexión 2</a></li>
</ul>
</body>
</html>