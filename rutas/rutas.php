<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
	
	$coordinador = new ControladorCoordinador();
	$coordinador -> index($_GET["page"]);

}else{

	if (count(array_filter($arrayRutas)) == 0) {

		/*============================================
		Cuando no se hace ninguna petición a la API
		============================================*/

		$json = array(
			"detalle" => "no encontrado 1" 
		);

		echo json_encode($json, true);
		return;

	}else{
		/*============================================
		Cuando pasamos solo un índice en el array $arrayRutas
		============================================*/

		if (count(array_filter($arrayRutas)) == 1) {

			/*============================================
			Cuando se hace peticiones desde coordinador
			============================================*/

			if (array_filter($arrayRutas)[1] == "coordinador") {
				
				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$coordinador = new ControladorCoordinador();
					$coordinador -> index(null);
				}
				/*============================================
				Peticiones POST
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array( "ID_ROL"=>$_POST["ID_ROL"],
									"ID_CARRERA"=>$_POST["ID_CARRERA"],
									"ID_USUARIO"=>$_POST["ID_USUARIO"];

					$crearcoordinador = new ControladorCoordinador();
					$crearcoordinador -> create($datos);

					echo '<pre>'; print_r($_SERVER["REQUEST_METHOD"]); echo '</pre>';
					
					return;

				}else{
					$json = array(
						"detalle" => "no encontrado 2" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 3" 
				);

				echo json_encode($json, true);
				return;
			}	
		}else{

			/*============================================
			Cuando se hace peticiones desde un solo coordinador
			============================================*/

			if (array_filter($arrayRutas)[1] == "coordinador" && is_numeric(array_filter($arrayRutas)[2])) {

				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$coordinador = new ControladorCoordinador();
					$coordinador -> show(array_filter($arrayRutas)[2]);
				}
				/*============================================
				Peticiones PUT
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array();
					
					parse_str(file_get_contents('php://input'), $datos);

					$editarcoordinador = new ControladorCoordinador();
					$editarcoordinador -> update(array_filter($arrayRutas)[2], $datos);
				}
				/*============================================
				Peticiones DELETE
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") {
					
					$borrarcoordinador = new ControladorCoordinador();
					$borrarcoordinador -> delete(array_filter($arrayRutas)[2]);
				}else{
					$json = array(
						"detalle" => "no encontrado 4" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 5" 
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
}