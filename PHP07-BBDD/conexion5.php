<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$servidor = "localhost";
$usuario = "alumno_rw";
$clave = "alumno_rw";
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

$conexion = new mysqli ( $servidor, $usuario, $clave, "animales" );
$conexion->query ( "SET NAMES 'UTF8'" );
// si quisiéramos hacerlo en dos pasos:
// $conexion = new mysqli($servidor,$usuario,$clave);
// $conexion->select_db("animales");

if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
}


$conexion = new mysqli ( $servidor, $usuario, $clave, "animales" );
$conexion->query ( "SET NAMES 'UTF8'" );
// si quisiéramos hacerlo en dos pasos:
// $conexion = new mysqli($servidor,$usuario,$clave);
// $conexion->select_db("animales");

if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
}
?>
<?php
echo "<h2>Listado de cuidadores</h2>";
echo "<h3>Pulsa en cada cuidador para ver los animales de los que se ocupa</h3>";

$resultado = $conexion-> query("SELECT * FROM cuidador");
echo "<ul>\n";
while($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
	echo "<li><a href='cuidador.php?idCuidador=$fila[idCuidador]'>$fila[Nombre]</a></li>\n";
  // Ejemplo: <li><a href='cuidador.php?idCuidador=12345'>Alberto</a></li>
}
echo "</ul>";
?>
<?php 
echo "<h3>Desconectando...</h3>";
mysqli_close ( $conexion );
?>
<ul>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion6.php">Conexión 6</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion4.php">Conexión 4</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion3.php">Conexión 3</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/conexion2.php">Conexión 2</a></li>
	<li><a href="http://localhost:8000/DWES07-gitLab/PHP07-BBDD/">Conexión 1</a></li>
</ul>
</body>
</html>
