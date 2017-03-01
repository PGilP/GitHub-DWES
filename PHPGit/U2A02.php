<?php
// Comentarios de los tres tipos

	// Hola
	
	# adios
	
	/*
	 * hasta luego
	 */

// Sentencias echo con los dos tipos de comillas
	
	$nombre = "Pablo";
	echo "<h1>Hola $nombre </h1>
			  <p>¿Qué tal?</p>";
	
	echo '<h1>Hola $nombre </h1>';

// Uso de al menos tres operadores de comparación y dos operadores lógicos

	$a = 8;
	$b = 1;
	$c;
	if ($a < $b) {
		$c = $b - $a;
		echo "<p> \$a es $c numeros menor que \$b </p> ";
	} elseif ($a > $b) {
		$c = $a - $b;
		echo "<p> \$a es $c numeros mayor que \$b </p>";
	}

// Uso de un operador de asignación

// Declaración y uso de una variable por referencia

// Declaración y uso de dos constantes, una que obligue a respetar las mayúsculas en su uso y otra que no lo haga

// Declaración y uso de un variable booleana y otra de tipo double

// Uso de is_numeric, is_boolean y is_double con estas variables

// Declaración de una variable de tipo string. Pruebas con la función *strlen* y con tres de las funciones indicadas en el enlace.

// Declaración de un array escalar y uno asociativo
// Ordenación y volcado de información con *var_dump* siguiendo dos criterios de ordenación en cada uno de los arrays

// Una estructura de control de cada tipo (if-elsif-else, switch, while, do-while, for)

// Un recorrido por cada uno de los dos arrays utilizando foreach, generando por ejemplo una lista ordenada con sus elementos

// Dos pruebas con la variable superglobal _SERVER

// Dos pruebas de funciones: una devolverá algun tipo, la otra no

// Una función que utilice una variable global

// Un formulario que reciba datos y los muestre por pantalla
?>