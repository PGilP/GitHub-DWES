<!DOCTYPE html>
<html>
<head>

<title>Conexión a BBDD con PHP</title>
<meta charset="UTF-8" />

<style>
img {
	width:150px;
	height:150px;	
}
</style>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="jumbotron">
	<h1 class="text-center">Películas</h1>
	<div class="col-sm-12 text-center ">
	<a class="btn btn-danger"  href="./mostrarCatalogo.php">Limpiar filtros</a>
	</div>
	</div>

<?php
include 'Obra.php';
$servidor = "localhost";
$usuario = "alumno";
$clave = "alumno";
$num_obra=$_REQUEST['num_obra'];
$conexion = new mysqli ( $servidor, $usuario, $clave, "catalogo" );
$conexion->query ( "SET NAMES 'UTF8'" );
$resultado = $conexion -> query("SELECT obras.nombre,directores.nombre as director,año as ano,idioma,imagen from obras,directores WHERE directores.id=obras.idDirector AND obras.id=".$num_obra);
if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
} else {
	if($resultado->num_rows != 0){
		echo "<table class='table table-bordered table-hover table-condensed'>";
		echo "<tr><th>Nombre</th><th>Director</th><th>Año</th><th>Idioma</th><th>Imagen</th>";
		while ($obra = $resultado->fetch_object('obras')) {
			echo "<tr>";
			echo "<td>".$obra->getNombre()."</td>\n";
			echo "<td>".$obra->getDirector()."</td>\n";
			echo "<td>".$obra->getAno()."</td>\n";
			echo "<td>".$obra->getIdioma()."</td>\n";
			echo "<td><img class='img-thumbnail' src='./img/".$obra->getImagen()."'></td>\n";
		}
		echo "</table>";
	}else{
		echo "<h3 style='color:red;'>No existe esa obra</h3>";
	}
	
}
?>

</div>
</body>
</html>