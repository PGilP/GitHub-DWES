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
include 'Animal.php';
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
try {
	$pdo = new PDO ( "mysql:host=localhost;dbname=animales", $usuario, $clave );
	$consulta->prepare("SELECT chip, nombre, especie AS tipo, imagen FROM animal ORDER BY nombre");
	
?>
<table>
<?php
	
?>
</table>
<?php
} catch ( PDOException $e ) {
	echo "<p>¡Error!: " . $e->getMessage () . "</p>";
	die ();
}
echo "<h3>Desconectando...</h3>";
$pdo = null;
?>

<ul>
		<li><a
			href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion5.php">Conexión
				5</a></li>
		<li><a
			href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion4.php">Conexión
				4</a></li>
		<li><a
			href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion3.php">Conexión
				3</a></li>
		<li><a
			href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion2.php">Conexión
				2</a></li>
		<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/">Conexión
				1</a></li>
	</ul>



</body>
</html>