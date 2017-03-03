<?php
if (session_status () == PHP_SESSION_NONE) {
	session_name ( "idSesionU5A02-07-contador" );
	session_start ();
}

if (isset($_REQUEST["cerrarSesion"])) {
	$_SESSION=array();
	session_unset();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
				$params["path"], $params["domain"],
				$params["secure"], $params["httponly"]
				);
	}
	session_destroy();
}
if (session_status () == PHP_SESSION_NONE) {
	$mensaje="<h3>No hay sesión iniciada</h3>";
}else{
if (isset ( $_SESSION ['contador'] )) {
	$_SESSION ['contador'] += 1;
} else {
	$_SESSION ['contador'] = 1;
}
if(isset($_REQUEST['num'])){
	$_SESSION['contador']= $_REQUEST['num']+1;
}
if (isset ( $_REQUEST ['reiniciarContador'] )) {
	$_SESSION ['contador'] = 1;
}
	
$mensaje = "Has visitado esta página " . $_SESSION ['contador'] . " veces en esta sesión.";
	}
?>
<html>
<head>
<title>Sesiones</title>
<meta charset="UTF-8" />
</head>
<body>
	<h3><?php echo $mensaje;?></h3>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<label for="num">¿Cuántas veces ha visitado la página</label>
		<input type="number" name="num" id="num">
		<input type="submit" value="Cambiar">
	</form>
	<p>
		<a href="<?php echo $_SERVER['PHP_SELF']?>">Recargar la página</a>
	</p>
	<p>
		<a href="<?php echo $_SERVER['PHP_SELF']."?reiniciarContador=true"?>">Reiniciar contador</a>
	</p>
	<p>
		<a href="<?php echo $_SERVER['PHP_SELF']."?cerrarSesion=true"?>">Cerrar sesión</a>
	</p>
</body>
</html>