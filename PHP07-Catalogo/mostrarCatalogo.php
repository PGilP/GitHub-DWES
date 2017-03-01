<!DOCTYPE html>
<html>
<head>

<title>Conexión a BBDD con PHP</title>
<meta charset="UTF-8" />

<style>
	#busc{
		right:30px;
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
	
<?php
include 'Obra.php';
$select_nom_asc="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector ORDER BY nombre ASC";
$select_nom_des="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector ORDER BY nombre DESC";
$select_dir_asc="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector ORDER BY director ASC";
$select_dir_des="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector ORDER BY director DESC";
$select_default="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector";
$servidor = "localhost";
$usuario = "alumno";
$clave = "alumno";
$conexion = new mysqli ( $servidor, $usuario, $clave, "catalogo" );
$conexion->query ( "SET NAMES 'UTF8'" );
if ($conexion->connect_errno) {
	echo "<p>Error al establecer la conexión (" . $conexion->connect_errno . ") " . $conexion->connect_error . "</p>";
} else {
?>
<div class="row">
<div class="form-group col-sm-6">
<h4>Buscar películas: </h4>
<form action="mostrarCatalogo.php" method="get">
	<input type="text" name="pelis" list="pelis" required>
		<datalist id="pelis">
<?php 
$peticion="SELECT nombre FROM obras";
$resultado=$conexion->query($peticion);
while ($option_ob=$resultado->fetch_assoc()) {
	echo "<option>".$option_ob['nombre']."</option>\n";
}
mysqli_free_result($resultado);

?>
	</datalist>
	<button type="submit" value="Buscar Película" name="buscar" >
		<span class="glyphicon glyphicon-search"></span>
	</button>	


</form>
</div>

<div class="form-group col-sm-6 text-right">
<form action="mostrarCatalogo.php" method="get">
	<h4 id="busc">Buscar directores:</h4>
	
	<input type="text" name="consulta_dir" list="directores" required>
		<datalist id="directores">
<?php 
$peticion="SELECT nombre FROM directores";
$resultado=$conexion->query($peticion);
while ($option_dir=$resultado->fetch_assoc()) {
	echo "<option>".$option_dir['nombre']."</option>\n";
}
mysqli_free_result($resultado);

?>
	</datalist>
	<button   type="submit" value="Buscar Director" name="buscar" >
		<span class="glyphicon glyphicon-search"></span>
	</button>
	
</form>
</div>
</div>
<div class="col-sm-12 text-center ">
<a class="btn btn-danger"  href="./mostrarCatalogo.php">Limpiar filtros</a>
</div>
</div>

<?php 

if(!isset($_REQUEST['consulta_dir'])){
	//Ordenacion del catalogo
	if(isset($_REQUEST['pelis'])){
		$consulta=$_REQUEST['pelis'];
	}
		
		if(isset($_REQUEST['nombre'])){
			if($_REQUEST['orden']=="asc"){
				if(!isset($consulta)){
					$tri_asc_nom="<span>&#9650;</span>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom'>&#9660;</a>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir'>&#9650;</a>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir'>&#9660;</a>";
					$peticion=$select_nom_asc;
				}else if(isset($consulta)){
					$tri_asc_nom="<span>&#9650;</span>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom&pelis=$consulta'>&#9660;</a>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir&pelis=$consulta'>&#9650;</a>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir&pelis=$consulta'>&#9660;</a>";
					$peticion="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector AND obras.nombre LIKE '%$consulta%' ORDER BY obras.nombre ASC";
				}
				
			}else if($_REQUEST['orden']=="des"){
				if(!isset($consulta)){
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom'>&#9650;</a>";
					$tri_des_nom="<span>&#9660;</span>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir'>&#9650;</a>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir'>&#9660;</a>";
					$peticion=$select_nom_des;
				}else if(isset($consulta)){
					
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom&pelis=$consulta'>&#9650;</a>";
					$tri_des_nom="<span>&#9660;</span>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir&pelis=$consulta'>&#9650;</a>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir&pelis=$consulta'>&#9660;</a>";
					$peticion="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector AND obras.nombre LIKE '%$consulta%' ORDER BY obras.nombre DESC";
				}
			}
		}else if(isset($_REQUEST['director'])){
			if($_REQUEST['orden']=="asc"){
				if(!isset($consulta)){
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom'>&#9650;</a>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom'>&#9660;</a>";
					$tri_asc_dir="<span>&#9650;</span>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir'>&#9660;</a>";
					$peticion=$select_dir_asc;
				}else if(isset($consulta)){
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom&pelis=$consulta'>&#9650;</a>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom&pelis=$consulta'>&#9660;</a>";
					$tri_asc_dir="<span>&#9650;</span>";
					$tri_des_dir="<a class='orden' href='?orden=des&director=dir&pelis=$consulta'>&#9660;</a>";
					$peticion=$peticion="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector AND obras.nombre LIKE '%$consulta%' ORDER BY directores.nombre ASC";
				}
			
			}else if($_REQUEST['orden']=="des"){
				if(!isset($consulta)){
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom'>&#9650;</a>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom'>&#9660;</a>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir'>&#9650;</a>";
					$tri_des_dir="<span>&#9660;</span>";
					$peticion=$select_dir_des;
				}else if(isset($consulta)){
					
					$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom&pelis=$consulta'>&#9650;</a>";
					$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom&pelis=$consulta'>&#9660;</a>";
					$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir&pelis=$consulta'>&#9650;</a>";
					$tri_des_dir="<span>&#9660;</span>";
					$peticion="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector AND obras.nombre LIKE '%$consulta%' ORDER BY directores.nombre DESC";
				}
			}	
		}else{
			if(!isset($consulta)){
				$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom'>&#9650;</a>";
				$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom'>&#9660;</a>";
				$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir'>&#9650;</a>";
				$tri_des_dir="<a class='orden' href='?orden=des&director=dir'>&#9660;</a>";
				$peticion=$select_default;
			}else if(isset($consulta)){
				$tri_asc_nom="<a class='orden' href='?orden=asc&nombre=nom&pelis=$consulta'>&#9650;</a>";
				$tri_des_nom="<a class='orden' href='?orden=des&nombre=nom&pelis=$consulta'>&#9660;</a>";
				$tri_asc_dir="<a class='orden' href='?orden=asc&director=dir&pelis=$consulta'>&#9650;</a>";
				$tri_des_dir="<a class='orden' href='?orden=des&director=dir&pelis=$consulta'>&#9660;</a>";
				$peticion="SELECT obras.nombre,directores.nombre as director,obras.id from obras,directores WHERE directores.id=obras.idDirector AND obras.nombre LIKE '%$consulta%'";
			}
		}
	$resultado = $conexion -> query($peticion);
	if($resultado->num_rows>0){
		echo "<table class='table table-hover table-bordered table-striped '>\n";
		echo "<tr>\n";
		echo "<th>Nombre".$tri_asc_nom." ". $tri_des_nom."</td>\n";
		echo "<th>Director".$tri_asc_dir." ". $tri_des_dir."</td>\n";
		echo "</tr>";
		while ($obra = $resultado->fetch_object('obras')) {
			echo "<tr >\n";
			echo "<td><a href='./mostrarObra.php?num_obra=".$obra->getId()."'>".$obra->getNombre()."</a></td>\n";
			echo "<td>".$obra->getDirector()."</td>\n";
			echo "</tr>\n";
		}
		echo "</table>\n";
	}else{
		echo "<p style='color:red'>No se ha encontrado su consulta</p>";
	}
	
	//Fin de ordenación del catálogo

}else if(isset($_REQUEST['consulta_dir'])){
	// Principio de página de autor
	
	$nomDirector=$_REQUEST['consulta_dir'];
	
	$peticion="SELECT nombre,num_peliculas, ano_nac FROM directores WHERE nombre LIKE '%$nomDirector%'";
	$resultado=$conexion->query($peticion);
	if($resultado->num_rows>0){
		
		echo "<table class='table table-hover table-bordered'>";
		echo "<tr>\n";
		echo "<th>Nombre</th>\n";
		echo "<th>Número de películas</th>\n";
		echo "<th>Año de nacimiento</th>\n";
		echo "</tr>";
		while ($autor=$resultado->fetch_assoc()) {
			echo "<tr>\n";
			echo "<td>".$autor['nombre']."</td>\n";
			echo "<td>".$autor['num_peliculas']."</td>\n";
			echo "<td>".$autor['ano_nac']."</td>\n";
			echo "</tr>\n";
		}
		echo "</table>";
		mysqli_free_result($resultado);
		if (isset($_REQUEST['orden'])){
			if( $_REQUEST['orden']=="asc"){
				echo "<h4>Sus obras <span>&#9650;</span> <a class=orden href='?orden=des&consulta_dir=".$nomDirector."'>&#9660;</a></h4>";
				$peticion="SELECT obras.nombre FROM obras,directores WHERE obras.idDirector=directores.id AND directores.nombre LIKE '%$nomDirector%' ORDER BY obras.nombre ASC";
			}elseif ($_REQUEST['orden']=="des"){
				echo "<h4>Sus obras <a class=orden href='?orden=asc&consulta_dir=".$nomDirector."'>&#9650;</a> <span>&#9660;</span></h4>\n";
				$peticion="SELECT obras.nombre FROM obras,directores WHERE obras.idDirector=directores.id AND directores.nombre LIKE '%$nomDirector%' ORDER BY obras.nombre DESC";
			}
		}else{
			echo "<h4>Sus obras <a class=orden href='?orden=asc&consulta_dir=".$nomDirector."'>&#9650;</a> <a class=orden href='?orden=des&consulta_dir=".$nomDirector."'>&#9660;</a></h4>\n";
			$peticion="SELECT obras.nombre FROM obras,directores WHERE obras.idDirector=directores.id AND directores.nombre LIKE '%$nomDirector%'";
		}
		
		
		$resultado=$conexion->query($peticion);
		echo "<ul>\n";
		while ($obras_dir=$resultado->fetch_assoc()) {
			echo "<li>".$obras_dir['nombre']."</li>\n";
		}
		echo"</ul>\n";
	}else{
		echo "<p style='color:red'>No existe ningún director con dicho nombre</p>";
	}
	
	
	// Fin de pagina de autor
}
mysqli_close ( $conexion );
}
?>

</div>
</body>
</html>