<?php

class ControladorCoordinador{

	/*============================================
	Mostrar todos los registros
	============================================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
			Mostrar coordinadores con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$coordinador = ModeloCoordinador::index("coordinador", $cantidad, $desde);

		}else{

			/*============================================
			Mostrar todos los coordinadores
			============================================*/

			$coordinador = ModeloCoordinador::index("coordinador", null, null);

		}

		
		if (!empty($coordinador)) {
			

			$json = array(
				"status"=>200,
				"total_registros"=>count($coordinador),
				"detalle"=> $coordinador
			);

			echo json_encode($json, true);
			return;

		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún coordinador registrado"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Crear un coordinador
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error".$key
				);

				echo json_encode($json, true);
				return;

			}
		}


		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "ID_ROL"=>$datos["ID_ROL"],
						"ID_CARRERA"=>$datos["ID_CARRERA"],
						"ID_USUARIO"=>$datos["ID_USUARIO"];
						
		$create = ModeloCoordinador::create("coordinador", $datos);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($create == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Su registro ha sido guardado"
			);

			echo json_encode($json, true);
			return;
		}
	}
	/*============================================
	Mostrando un solo coordinador
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todos los coordinadores
		============================================*/

		$coordinador = ModeloCoordinador::show("coordinador", $id);

		if (!empty($coordinador)) {
			
			$json = array(
				"status"=>200,
				"detalle"=> $coordinador
			);

			echo json_encode($json, true);
			return;

		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún coordinador registrado"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Editar un coordinador
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( "ID_CARRERA"=>$datos["ID_CARRERA"],
							"ID_ROL"=>$datos["ID_ROL"],
							"ID_USUARIO"=>$datos["ID_USUARIO"]);

			$update = ModeloCoordinador::update("coordinador", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar coordinador
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = ModeloCoordinador::delete("coordinador", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}