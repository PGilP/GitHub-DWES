package servlets;

import java.io.PrintWriter;

public class Obra {

	private String nombre, idioma, imagen,director;
	private int id, idDirector, año;
	String ruta="http://localhost:8080/Java07-Catalogo/MostrarObra";
	public Obra() {

	}

	public Obra(String nombre, String idioma, String imagen, int id, int idDirector, int año,String director) {
		super();
		this.nombre = nombre;
		this.idioma = idioma;
		this.imagen = imagen;
		this.id = id;
		this.idDirector = idDirector;
		this.año = año;
		this.setDirector(director);
	}

	public String getNombre() {
		return nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public String getIdioma() {
		return idioma;
	}

	public void setIdioma(String idioma) {
		this.idioma = idioma;
	}

	public String getImagen() {
		return imagen;
	}

	public void setImagen(String imagen) {
		this.imagen = imagen;
	}

	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getIdDirector() {
		return idDirector;
	}

	public void setIdDirector(int idDirector) {
		this.idDirector = idDirector;
	}

	public int getAño() {
		return año;
	}

	public void setAño(int año) {
		this.año = año;
	}
	
	public String getDirector() {
		return director;
	}

	public void setDirector(String director) {
		this.director = director;
	}

	@Override
	public String toString() {
		return "Obra [nombre=" + nombre + ", idioma=" + idioma + ", imagen=" + imagen + ", id=" + id + ", idDirector="
				+ idDirector + ", año=" + año +", director=" + director+ "]";
	}

	public void mostrarCatalogoTr(PrintWriter out) {
		out.println("<tr>");
		out.println("<td><a href='"+ruta+"?obra="+getId()+"'>" + getNombre() + "</a></td>");
		out.println("<td>" + getDirector() + "</td>");
		out.println("</tr>");
	}
	public void mostrarObraTr(PrintWriter out){
		out.println("<tr>");
		out.println("<td>" + getNombre() + "</td>");
		out.println("<td>" + getDirector() + "</td>");
		out.println("<td>" + getAño() + "</td>");
		out.println("<td>" + getIdioma() + "</td>");
		out.println("<td><img class='img-thumbnail' width='100px' height='100px' src='./img/" + getImagen() + "'></td>");
		out.println("</tr>");
	}


}
