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
 * Servlet implementation class MostrarCatalogo
 */
@WebServlet("/MostrarCatalogo")
public class MostrarCatalogo extends HttpServlet {
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public MostrarCatalogo() {
		super();

	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		ServletContext contexto = getServletContext();
		Connection conn = null;
		Statement sentencia = null;
		PrintWriter out = response.getWriter();
		String estilo = "<style>#cabecera:hover{background-color:white}</style>";
		response.setContentType("text/html;UTF-8");

		out.println("<!DOCTYPE html><html><head><meta charset='UTF-8'/>" + estilo
				+ "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'><script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script><script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script><meta charset='UTF-8'/></head><body>");
		out.println("<div class='container'>");
		out.println("<div class='jumbotron'><h4 class='text-center'>Catálogo</h4></div>");
		try {

			Class.forName("org.mariadb.jdbc.Driver").newInstance();

			String url = contexto.getInitParameter("url");
			String userName = contexto.getInitParameter("userName");
			String password = contexto.getInitParameter("password");
			System.out.println(url + ";" + userName + "" + password);
			conn = DriverManager.getConnection(url, userName, password);
			sentencia = conn.createStatement();
			String consulta_nom_asc="SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector ORDER BY nombre ASC";
			String consulta_def = "SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector";
			String consulta_nom_des="SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector ORDER BY nombre DESC";
			String consulta_dir_asc = "SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector ORDER BY director ASC";
			String consulta_dir_des="SELECT obras.*,directores.nombre AS director FROM obras,directores WHERE directores.id=obras.idDirector ORDER BY director DESC";
			ResultSet rset;
			System.out.println(request.getParameter("orden"));
			System.out.println(request.getParameter("tipo"));
			if(request.getParameter("tipo")!=null ){
				if(request.getParameter("orden").equals("asc")){
					rset= sentencia.executeQuery(consulta_dir_asc);
				}else if(request.getParameter("orden").equals("des")){
					rset= sentencia.executeQuery(consulta_dir_des);
				}else{
					rset = sentencia.executeQuery(consulta_def);
				}
			}else if(request.getParameter("orden")!=null){
				if(request.getParameter("orden").equals("asc")){
					rset= sentencia.executeQuery(consulta_nom_asc);
				}else if(request.getParameter("orden").equals("des")){
					rset= sentencia.executeQuery(consulta_nom_des);
				}else{
					rset = sentencia.executeQuery(consulta_def);
				}
			}else{
				rset = sentencia.executeQuery(consulta_def);
			}
			
			if (!rset.isBeforeFirst()) {
				out.println("<h3>Algo salió mal</h3>");

			} else {
				out.println("<table class='table table-hover'>");
				out.println("<tr id='cabecera'>");
				out.println("<th>Nombre <a href='./MostrarCatalogo?orden=asc'>&#9652;</a> <a href='./MostrarCatalogo?orden=des'>&#9662;</a></th>");
				out.println("<th>Director <a href='./MostrarCatalogo?orden=asc&tipo=dir'>&#9652;</a> <a href='./MostrarCatalogo?orden=des&tipo=dir'>&#9662;</a></th>");
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
					obra.mostrarCatalogoTr(out);
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
		out.println("</div></body></html>");
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}

}
