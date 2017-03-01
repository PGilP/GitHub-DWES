<?php
class Animal{

	private $nombre,$tipo,$chip,$imagen;
		
	function getChip(){
		return $this->chip;
	}
	
	function getEspecie(){
		return $this->tipo;
	}
	
	function getImagen(){
		return $this->imagen;
	}
	
	function getNombre(){
		return $this->nombre;
	}
	
	function __toString(){
		
		return "<ul>
					<li>".$this->nombre."</li>
					<li>".$this->chip."</li>
					<li>".$this->tipo."</li>
					<li>".$this->imagen."</li>
				</ul>";
	}
}
?>