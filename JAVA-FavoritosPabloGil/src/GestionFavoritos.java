
import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class GestionFavoritos
 */
@WebServlet("/GestionFavoritos")
public class GestionFavoritos extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public GestionFavoritos() {
		super();
		// TODO Auto-generated constructor stub
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		String pelicula = request.getParameter("peliculas");
		String nombre = request.getParameter("nombre");
		String series = request.getParameter("series");
		String cancion = request.getParameter("cancion");
		String[] valoresCheckbox = request.getParameterValues("libros");
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		out.println("<html><head><title>Respuesta</title></head>");
		out.println("<table>");
		out.println("<tr><th>Nombre</th>" + "<td>" + nombre + "</td></tr>");
		out.println("<tr><th>Pelicula</th>" + "<td>" + pelicula + "</td></tr>");
		out.println("<tr><th>Serie</th>" + "<td>" + series + "</td></tr>");
		out.println("<tr><th>Cancion</th>" + "<td>" + cancion + "</td></tr>");
		out.println("<tr><th>Libros</th>");
		// Enumeration <String> parametrosServlet =
		// this.getInitParameterNames();
		// while (parametrosServlet.hasMoreElements()){
		// String actual=parametrosServlet.nextElement();
		// out.print("<tr><td>"+actual+"</td><td>"+this.getInitParameter(actual)+"</td>");
		// }
		for (int i = 0; i < valoresCheckbox.length; i++) {
			out.println("<td>" + valoresCheckbox[i] + ",</td>");
		}
		out.println("</tr></table></body></html>");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
