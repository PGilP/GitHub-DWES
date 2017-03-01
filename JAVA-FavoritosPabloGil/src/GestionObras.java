

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class GestionObras
 */
@WebServlet("/GestionObras")
public class GestionObras extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public GestionObras() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String peliculas =request.getParameter("peliculas");
		String[] pelisIndividuales = peliculas.split(";");
		
		
		String series =request.getParameter("series");
		String[] seriesIndividuales = series.split(";");
		
		
		String canciones =request.getParameter("canciones");
		String[] cancionesIndividuales = canciones.split(";");
		
		String libros =request.getParameter("libros");
		String[] librosIndividuales = libros.split(";");
		
		response.setContentType("text/html");
		PrintWriter out= response.getWriter();
		out.println("<html><head><title>Formulario</title></head>");
		out.println("<body><form method=\"get\" action=\"/FavoritosPabloGil/GestionFavoritos\">");
		out.println("<span>Introduce tu nombre</span><input type=\"text\" name=\"nombre\"><br>");
		out.println("<span><b>Pelicula favorita:</b></span><br><select name=\"peliculas\">");
		out.println("<option value=\"\" disabled selected>--Elija la pelicula--</option>");
		for(int i=0;i<pelisIndividuales.length;i++){
			out.println("<option value=\""+pelisIndividuales[i]+"\">"+pelisIndividuales[i]+"</option>");
		}
		out.println("</select>");
		out.println("<br><span><b>Serie favorita:</b></span><br><select name=\"series\" size=\""+seriesIndividuales.length+"\">");
		
		for(int i=0;i<seriesIndividuales.length;i++){
			out.println("<option value=\""+seriesIndividuales[i]+"\">"+seriesIndividuales[i]+"</option>");
		}
		out.println("</select>");
		out.println("<br><span><b>Cancion favorita:</b></span><br>");
		for(int i=0;i<cancionesIndividuales.length;i++){
			out.println("<span>"+cancionesIndividuales[i]+"</span><input type=\"radio\" value=\""+cancionesIndividuales[i]+"\" name=\"cancion\"><br>");
			
		}
		out.println("<span><b>Libros favoritos:</b><br>");
		for(int i=0;i<librosIndividuales.length;i++){
			out.println("<span>"+librosIndividuales[i]+"</span><input type=\"checkbox\" name=\"libros\" value=\""+librosIndividuales[i]+"\">");
		}
		out.println("<br><input type=\"submit\">");
		out.println("</form></body></html>");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
