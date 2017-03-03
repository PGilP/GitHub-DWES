<!DOCTYPE html>
<html>
<head>
<title>Cookies y sesiones</title>
<meta charset="UTF-8"/>
</head>
<body>
<?php
setcookie("test", "test", time() + 3600, '/');
if(count($_COOKIE) ==0){
	echo "<h3>Advertencia: tu navegador tiene las cookies deshabilitadas. Esta aplicación no funcionará</h3>";
}
$pagina_param_elim= $_SERVER['PHP_SELF']."?eliminarCookie=yes";
if(isset($_POST["enviar"])) {
	setcookie("visitante", $_POST["nombre"], time() + (15), "/PHP-Sesiones07/cookies"); // 86400 = segundos en 1 día
	header("Location:".$_SERVER['PHP_SELF']);
}
if(isset($_COOKIE["visitante"])) {
	echo "<h2>Damos la bienvenida a $_COOKIE[visitante]</h2>";
	if(isset($_REQUEST["eliminarCookie"])){
		setcookie("visitante",$_COOKIE[visitante] , time() - (15), "/PHP-Sesiones07/cookies");
		header("Location:".$_SERVER['PHP_SELF']);
	}
}
else{
	
 //solicitar nombre al usuario
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <label>Escribe tu nombre para dirigirnos a ti:</label>
    <input type="text" name="nombre"><br/>
    <input type="submit" value="Enviar" name="enviar">
</form>
<?php

}
?> 
<p><a href="<?php echo $_SERVER['PHP_SELF']?>">Enlace a esta misma página</a></p>
<p><a href="<?php echo $pagina_param_elim ?>">Borrar cookie</a></p>
</body></html>