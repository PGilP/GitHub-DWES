package servlets;



import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

import javax.servlet.ServletContext;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;



/**
 * Servlet implementation class MostrarObra
 */
@WebServlet("/MostrarObra")
public class MostrarObra extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public MostrarObra() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		ServletContext contexto = getServletContext();
		Connection conn = null;
		Statement sentencia = null;
		response.setContentType("text/html;UTF-8");
		PrintWriter out = response.getWriter();
		String estilo = "<style></style>";
		out.println("<!DOCTYPE html><html><head><meta charset='UTF-8'/>" + estilo
				+ "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script><meta charset='UTF-8'/></head><body>");
		out.println("<div class='container'>");
		out.println("<div class='jumbotron'><h4 class='text-center'>Película</h4></div>");
		String rutaCatalogo="http://localhost:8080/Java07-Catalogo/MostrarCatalogo";
		try {

			Class.forName("org.mariadb.jdbc.Driver").newInstance();

			String url = contexto.getInitParameter("url");
			String userName = contexto.getInitParameter("userName");
			String password = contexto.getInitParameter("password");
			System.out.println(url + ";" + userName + "" + password);
			conn = DriverManager.getConnection(url, userName, password);
			sentencia = conn.createStatement();
			
			String consulta_def = "SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector AND obras.id="+request.getParameter("obra");
			ResultSet rset = sentencia.executeQuery(consulta_def);

			if (!rset.isBeforeFirst()) {
				out.println("<h3>Algo salió mal</h3>");

			} else {
				out.println("<table class='table table-hover'>");
				out.println("<tr id='cabecera'>");
				out.println("<th>Nombre</th>");
				out.println("<th>Director</th>");
				out.println("<th>Año</th>");
				out.println("<th>Idioma</th>");
				out.println("<th>Imagen</th>");
				out.println("</tr>");
				
				while (rset.next()) {
					Obra obra;
					obra = new Obra(rset.getString("nombre"),
							        rset.getString("idioma"),
							        rset.getString("imagen"),
							        rset.getInt("id"), 
							        rset.getInt("idDirector"),
							        rset.getInt("año"), 
									rset.getString("director"));
					System.out.println(obra.toString());
					obra.mostrarObraTr(out);
				}
				out.println("</table>");

			}

			if (sentencia != null) {
				sentencia.close();
			}
			if (conn != null) {
				conn.close();
			}

		} catch (Exception e) {
			e.printStackTrace();
		}
		out.println("<a href='"+rutaCatalogo+"'>Mostrar Catalogo</a>");
		out.println("</div></body></html>");
		out.close();
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
