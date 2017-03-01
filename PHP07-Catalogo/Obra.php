<?php 

class obras{
	private $id,$idDirector,$nombre,$ano,$imagen,$idioma,$director;
	function setId($id){
		$this->id=$id;
	}
	function setNombre($nombre){
		$this->nombre=$nombre;
	}
	function setIdDirector($idDirector){
		$this->idDirector=$idDirector;
	}
	function setAno($ano){
		$this->ano=$ano;
	}
	function setImagen($imagen){
		$this->imagen=$imagen;
	}
	function setIdioma($idioma){
		$this->idioma=$idioma;
	}
	
	function getId(){
		return $this->id;
	}
	function getIdDirector(){
		return $this->idDirector;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getAno(){
		return $this->ano;
	}
	function getImagen(){
		return $this->imagen;
	}
	function getIdioma(){
		return $this->idioma;
	}
	function getDirector(){
		return $this->director;
	}

}

?>
