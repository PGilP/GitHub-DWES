<html>
<head>
<title>Cookies y sesiones</title>
<meta charset="UTF-8"/>
</head>
<body>
<?php
if(isset($_COOKIE["visitante"])) {
	echo "<h2>Damos la bienvenida a $_COOKIE[visitante]</h2>";
}
else {
	echo "<h2>No se encuentra el nombre del visitante</h2>";
}
?>
<a href="<?php echo $_SERVER['PHP_SELF']?>">Enlace a esta misma página</a>
</body></html>